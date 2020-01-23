<?php

namespace App\Form;

use App\Entity\Magasin;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MagasinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('produits', EntityType::class, [
                'class' => Produit::class, // ON VA FAIRE UNE RELATION AVEC User
                'choice_label' => 'titre',   // QUELLE PROPRIETE SERA AFFICHEE DANS LE FORMULAIRE
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Magasin::class,
        ]);
    }
}
