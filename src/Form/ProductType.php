<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('catalogue')
            ->add('price')
            ->add('Category')
            ->add('Media',EntityType::class /* type du champ qu'on travaille avec */ , [
                'class' => Media::class, /* Quelle est la classe à laquelle on va pointer*/
                'multiple' => false,
                'expanded' => true
            ])
            ->add('Add_Product', SubmitType::class, [
                'attr' => ['label' => 'Add Product'] // add label to the button
            ]) // bouton de type submit
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
