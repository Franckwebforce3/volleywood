<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                //'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre mot de passe',
                    ]),
                ],
            ])
            ->add('confirmPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Confirmer mot de passe',
                //'mapped' => false,
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
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
