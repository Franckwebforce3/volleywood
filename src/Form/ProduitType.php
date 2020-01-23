<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Choix de la catégorie' => [
                        'Casquette' => 'Casquette',
                        'Vêtements' => 'Vêtements',
                        'Ballon' => 'Ballon',
                        'Goodies' => 'Goodies',
                    ],
                ],
            ])
            ->add('taille')
            ->add('couleur')
            ->add('prixVente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
