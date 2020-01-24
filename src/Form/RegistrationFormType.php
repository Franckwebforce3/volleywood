<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
// POUR AVOIR UN INPUT type="file"
use Symfony\Component\Form\Extension\Core\Type\FileType;

// POUR POUVOIR AVOIR UN CHAMP type="email"
use Symfony\Component\Form\Extension\Core\Type\EmailType;

// POUR PROTEGER LES FICHIERS QU'ON PEUT UPLOADER
use Symfony\Component\Validator\Constraints\File;
class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                ])
            ->add('email', EmailType::class, [
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs des mots de passes doivent correspondre.',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer mot de passe'],
            ])
            ->add('avatar', FileType::class, [
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => "Merci d'envoyer une image valide",
                    ]),
                ],
            ])
            ->add('cp', TextType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
            ])

            ->add('ville', TextType::class, [
            ])

            ->add('adresse', TextType::class, [
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
