<?php

namespace App\Form;

use App\Service\Api\Base\DTO\NewsItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseNewsItemType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsItem::class,
            'allow_extra_fields' => true,
            'csrf_protection' => false,
        ]);
    }
}
