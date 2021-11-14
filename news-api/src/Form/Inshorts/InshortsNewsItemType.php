<?php

namespace App\Form\Inshorts;

use App\Form\BaseNewsItemType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class InshortsNewsItemType extends BaseNewsItemType
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
            ->add('content', TextType::class, [
                'constraints' => new NotBlank(),
            ])
            ->add('readMoreUrl', TextType::class, [
                'property_path' => 'url',
            ])
            ->add('imageUrl', TextType::class, [
                'property_path' => 'image',
            ])
            ->add('date', TextType::class, [
                'constraints' => new NotBlank(),
                'mapped' => false,
            ])
            ->add('time', TextType::class, [
                'constraints' => new NotBlank(),
                'mapped' => false,
            ]);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $date = $form->get('date')->getData();
            $time = $form->get('time')->getData();
            $event->getData()->setDate(new \DateTime("$date $time"));
        });
    }
}
