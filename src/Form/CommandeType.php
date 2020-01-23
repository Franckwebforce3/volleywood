<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('refcommande')
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Statut' => [
                        'New' => '1',
                        'Préparée' => '2',
                    ],
                ],
            ])
            ->add('dateLivraison')
            ->add('user', EntityType::class, [
                                'class' => User::class, // ON VA FAIRE UNE RELATION AVEC User
                                'choice_label' => 'username',   // QUELLE PROPRIETE SERA AFFICHEE DANS LE FORMULAIRE
            ])
            // ->add('produits')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
