<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    // Ceci est le formulaire d'ajout de vidéos
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // On ajoutera les class nécéssaires
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('url', UrlType::class)
            ->add('thumbnail', UrlType::class)
            // On a mis dans le Video.php, par défaut, l'ajout de la date de post donc plus besoin
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}