<?php

namespace App\Form\Type;

use App\Entity\Post;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 10])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le titre ici...',
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Tapez votre contenu ici...',
                    'rows' => 6,
                ]
            ])
            ->add('publishedAt', DateTimeType::class, [
                'label' => 'Date de publication',
                'widget' => 'single_text',
                'constraints' => [
                    new NotNull(),
                    new GreaterThan(new \DateTime('-1 month')),
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('Author', TextType::class, [
                'label' => 'Auteur',
                'constraints' => [
                    new NotBlank()
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom de l\'auteur',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => '<i class="bi bi-plus-circle"></i> Créer',
                'attr' => [
                    'class' => 'btn btn-primary mt-4 px-5 py-2',
                ],
                'label_html' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}