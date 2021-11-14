<?php

namespace App\Form\Inshorts;

use App\Form\BaseNewsType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class InshortsNewsType extends BaseNewsType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('data', CollectionType::class, [
            'entry_type' => InshortsNewsItemType::class,
            'allow_add' => true,
        ]);
    }
}
