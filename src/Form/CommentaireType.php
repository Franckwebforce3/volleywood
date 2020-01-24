<?php

namespace App\Form;
use App\Entity\User;
use App\Entity\Commentaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('poceBleu')
            ->add('message')
            ->add('idParent', HiddenType::class)
            // ->add('datePublication')
            ->add('users', EntityType::class,  [
                'class' => User::class, // ON VA FAIRE UNE RELATION AVEC User
                'choice_label' => 'id',   // QUELLE PROPRIETE SERA AFFICHEE DANS LE FORMULAIRE
            ])
            // ->add('articles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
