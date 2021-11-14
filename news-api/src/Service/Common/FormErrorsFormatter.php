<?php

namespace App\Service\Common;

use Symfony\Component\Form\FormInterface;

class FormErrorsFormatter
{
    public static function grabFormErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $property = self::formatFormProperty($error->getOrigin());
            $errors[] = [
                'message' => $error->getMessage(),
                'property' => $property,
            ];
        }

        return $errors;
    }

    private static function formatFormProperty(FormInterface $form): ?string
    {
        if ($form->getParent() === null) {
            return null;
        }

        $parentProperty = self::formatFormProperty($form->getParent());
        if ($parentProperty !== null) {
            $property = "{$parentProperty}.{$form->getName()}";
        } else {
            $property = $form->getName();
        }

        return $property;
    }
}
