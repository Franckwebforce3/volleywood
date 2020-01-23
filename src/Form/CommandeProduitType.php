<?php

namespace App\Form;

use App\Entity\CommandeProduit;
use App\Entity\Commande;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commandes', EntityType::class, [
                'class' => Commande::class, // ON VA FAIRE UNE RELATION AVEC User
                'choice_label' => 'refcommande',   // QUELLE PROPRIETE SERA AFFICHEE DANS LE FORMULAIRE
            ])
            ->add('produits', EntityType::class, [
                'class' => Produit::class, // ON VA FAIRE UNE RELATION AVEC User
                'choice_label' => 'titre',   // QUELLE PROPRIETE SERA AFFICHEE DANS LE FORMULAIRE
            ])
            ->add('quantite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeProduit::class,
        ]);
    }
}
