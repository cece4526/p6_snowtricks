<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Tricks;
use App\Form\VideoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Nom du trick :'
            ])
            ->add('slogan', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'décrire le trick en une phrase'
                ],
                'label' => 'chapo :'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'label' => 'Description du trick :'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('videos', CollectionType::class, [
                'entry_type'=> VideoType::class,
                'entry_options'  => ['label' => false],
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mt-4'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
