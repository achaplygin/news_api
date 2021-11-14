<?php

namespace App\Form;

use App\Service\Api\Base\DTO\NewsList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseNewsType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsList::class,
            'allow_extra_fields' => true,
            'csrf_protection' => false,
        ]);
    }
}
