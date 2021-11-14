<?php

namespace App\Form;

use App\Controller\DTO\RequestNews;
use App\Enum\NewsCategory\CommonCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, [
                'choices' => CommonCategories::getAsArray(),
                'empty_data' => CommonCategories::ALL,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RequestNews::class,
            'allow_extra_fields' => false,
            'csrf_protection' => false,
        ]);
    }
}
