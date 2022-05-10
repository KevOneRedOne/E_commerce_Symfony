<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AddProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NAME')
            ->add('DESCRIPTION')
            ->add('imageFile', FileType::class, ['required' => false])
            ->add('PRICE')
            ->add('category_id', EntityType::class, [ // je précise le champ 'category' est une entité
                'class' => Category::class, // j'indique le nom de l'entité
                'choice_label' => 'title',
            ]);
 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'attr' => [
                'novalidate' => 'novalidate' //permet de désactiver la validation html pour ce formulaire
            ]
        ]);
    }
}
