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
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ton mot de passe doit avoir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('password2', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                // 'attr' => ['class' => 'form-control mb-30'],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Confirmez votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ton mot de passe doit avoir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
                'empty_data' => 'avatarParDefaut',//// METTRE UN AVATAR PAR DEFAUT
            ])
            ->add('cp', TextType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                    // new Length([
                    //     'min' => 5,
                    //     'minMessage' => 'Ton code postal doit comporter {{ limit }} chiffres',
                    //     // max length allowed by Symfony for security reasons
                    //     'max' => 4096,
                    // ]),
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
