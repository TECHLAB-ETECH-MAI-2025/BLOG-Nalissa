<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'title',
            'multiple' => true,
            'expanded' => false, // mettre true pour des cases à cocher
            'label' => 'Catégories',
            'attr' => ['class' => 'form-select', 'size' => 1],
        ])
        ->add('image', FileType::class, [
            'label' => 'Choisir une image',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '2M',
                    'mimeTypes' => ['image/jpeg', 'image/png'],
                    'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG ou PNG)',
                ])
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
