<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, 
                [
                    'choices'  => ['User' => 'ROLE_USER',
                                    'Membre' => 'ROLE_MEMBRE',                       
                                    'Admin' => 'ROLE_ADMIN',                                        
                    ],               
                    'multiple'=>true,               
                    'expanded'=>true,               
                    'data'=> ['User', 'Membre', 'Admin'],//clé(index) du tableau choice               
                'choice_attr' => function($choice, $key, $value) {                   
                    // ajout d'un sélecteur de class html(.tous_les_contrats ou .contrats_choisis) aux champs                   
                    $class = $key == 'Tous' ? 'tous_les_contrats': 'contrats_choisis';                   
                    return ['class' => $class];               
                },                
                ] 
            )
            // ->add('roles', ChoiceType::class, [
            //     'choices' => [
            //         'Role-user'         => '["ROLE_USER"]',
            //         'Role-membre'         => '["ROLE_MEMBRE"]',
            //         'Role-administrateur' => '["ROLE_ADMIN"]',
            //     ],
            // ])
            ->add('pseudo')
            // ->add('avatar')
            ->add('ville')
            ->add('cp')
            ->add('adresse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
