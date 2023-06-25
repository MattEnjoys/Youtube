<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
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