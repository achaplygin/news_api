<?php

namespace App\Form\Currents;

use App\Form\BaseNewsItemType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CurrentsNewsItemType extends BaseNewsItemType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
            ])
            ->add('title', TextType::class, [
                'constraints' => new NotBlank(),
            ])
            ->add('author', TextType::class, [
                'constraints' => new NotBlank(),
            ])
            ->add('description', TextType::class, [
                'constraints' => new NotBlank(),
                'property_path' => 'content',
            ])
            ->add('url', TextType::class)
            ->add('image', TextType::class)
            ->add('published', DateTimeType::class, [
                'constraints' => new NotBlank(),
                'property_path' => 'date',
                'widget' => 'single_text',
            ]);
    }
}
