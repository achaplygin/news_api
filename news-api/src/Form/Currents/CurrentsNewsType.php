<?php

namespace App\Form\Currents;

use App\Form\BaseNewsType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class CurrentsNewsType extends BaseNewsType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('news', CollectionType::class, [
            'entry_type' => CurrentsNewsItemType::class,
            'allow_add' => true,
            'property_path' => 'data',
        ]);
    }
}
