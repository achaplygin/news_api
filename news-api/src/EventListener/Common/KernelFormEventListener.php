<?php

namespace App\EventListener\Common;

use App\EventListener\DTO\ResponseError;
use App\Service\Common\FormErrorsFormatter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class KernelFormEventListener
{
    public const REQUEST_FORM_KEY = 'form';
    public const REQUEST_FORM_DATA_KEY = 'formData';

    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        try {
            if ($this->getFormType($request)) {
                $form = $this->createForm($request);
                $this->submitForm($form, $request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $request->attributes->set(self::REQUEST_FORM_KEY, $form);
                    if (($formData = $form->getData()) && is_object($formData)) {
                        $request->attributes->set(self::REQUEST_FORM_DATA_KEY, $formData);
                    }
                } else {
                    $event->setResponse($this->getResponseForFormErrors($form));
                }
            }
        } catch (\Throwable $e) {
            $event->setResponse($this->getResponseForException($e));
        }
    }

    private function getFormType(Request $request): ?string
    {
        return $request->get('_form_type');
    }

    private function getBlockPrefix(Request $request): ?string
    {
        return $request->get('_block_prefix');
    }

    private function getRouteParams(Request $request): array
    {
        $routeParams = $request->attributes->get('_route_params', []);

        return array_filter($routeParams, static function ($key) {
            return strpos($key, '_') !== 0;
        }, ARRAY_FILTER_USE_KEY);
    }

    private function createForm(Request $request): FormInterface
    {
        $formType = "App\\Form\\{$this->getFormType($request)}";
        $blockPrefix = $this->getBlockPrefix($request);

        return $blockPrefix ?
            $this->formFactory->createNamed($blockPrefix, $formType) :
            $this->formFactory->create($formType);
    }

    private function submitForm(FormInterface $form, Request $request): void
    {
        if ($this->getBlockPrefix($request)) {
            $form->handleRequest($request);
        } else {
            $submitData = $this->grabDataForSubmit($request);
            $form->submit($submitData);
        }
    }

    private function grabDataForSubmit(Request $request): array
    {
        $routeParams = $this->getRouteParams($request);

        $data = $request->isMethod(Request::METHOD_GET)
            ? $request->query->all()
            : $request->request->all();

        return array_merge($data, $routeParams);
    }

    private function getResponseForException(\Throwable $e): JsonResponse
    {
        $error = new ResponseError($e->getMessage(), 'Internal error');

        return new JsonResponse(['errors' => [$error]], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function getResponseForFormErrors(FormInterface $form): JsonResponse
    {
        $errors = [];

        if (!$form->isSubmitted()) {
            $errors[] = new ResponseError("Form is not submitted. Expected name: '{$form->getName()}'");
        }

        foreach (FormErrorsFormatter::grabFormErrors($form) as $error) {
            $errors[] = new ResponseError($error['message'], $error['property']);
        }

        return new JsonResponse(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST);
    }
}
