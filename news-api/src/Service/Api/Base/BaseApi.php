<?php

namespace App\Service\Api\Base;

use App\Enum\NewsCategory\BaseApiCategories;
use App\Form\BaseNewsType;
use App\Service\Api\Base\DTO\NewsList;
use App\Service\Common\FormErrorsFormatter;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class BaseApi
{
    protected const FORM_CLASS = BaseNewsType::class;
    protected const ENUM_CLASS = BaseApiCategories::class;

    protected HttpClientInterface $httpClient;
    protected FormFactoryInterface $formFactory;
    protected string $baseUri;
    protected ?string $auth;
    protected LoggerInterface $logger;

    public function __construct(
        HttpClientInterface $httpClient,
        FormFactoryInterface $formFactory,
        LoggerInterface $logger,
        string $baseUri,
        ?string $auth = null
    ) {
        $this->httpClient = $httpClient;
        $this->formFactory = $formFactory;
        $this->logger = $logger;
        $this->baseUri = $baseUri;
        $this->auth = $auth;
    }

    abstract public function getNews(string $category): ?NewsList;

    public function prepareCategory(string $category): string
    {
        /** @var $enum BaseApiCategories */
        $enum = static::ENUM_CLASS;
        return $enum::mapCommonToApiCategory($category);
    }

    protected function get(string $path, array $query = []): ?NewsList
    {
        try {
            $response = $this->httpClient->request('GET', $this->baseUri . $path, ['query' => $query]);

            if ($this->isSuccess($response)) {
                return $this->grabResponse($response->toArray());
            }
        } catch (ExceptionInterface $e) {
            $this->logger->error($e->getMessage(), [
                'path' => $path,
                'query' => $query,
                'trace' => $e->getTrace(),
            ]);
        }

        return null;
    }

    protected function isSuccess(ResponseInterface $response): bool
    {
        try {
            $code = $response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            $code = null;
        }

        return $code >= 200 && $code < 300;
    }

    protected function grabResponse(array $data): ?NewsList
    {
        $result = new NewsList();
        $form = $this->formFactory->create(static::FORM_CLASS, $result);
        $form->submit($data);
        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->logger->error("Form '{$form->getName()}' has errors", [
                'errors' => FormErrorsFormatter::grabFormErrors($form),
                'form' => static::FORM_CLASS,
                'data' => $data,
            ]);

            return $result;
        }

        return $result;
    }
}
