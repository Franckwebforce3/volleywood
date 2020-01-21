<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// POUR ENVOYER UN EMAIL
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

// FORMULAIRE D'ACTIVATION
use App\Form\ActivationUserType;
use App\Repository\UserRepository;
use Symfony\Component\Mailer\Transport\Smtp\Auth\PlainAuthenticator;

/**
 * @Route("/register")
 */
class RegistrationController extends AbstractController
{

    /**
     * @Route("/inscription", name="inscription")
     */
    public function register(Request $request, MailerInterface $mailer, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        $message = "";
        if ($form->isSubmitted() && $form->isValid()) {
            // BRICOLAGE POUR RATTRAPER LE PROBLEME SUR roles
            $user->setRoles(["ROLE_USER"]);

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            // IL FAUT GERER LE FICHIER UPLOADE AVEC photo
            // https://symfony.com/doc/current/controller/upload_file.html
            $avatar = $form['avatar']->getData();
            if ($avatar)
            {
                // ON A UN FICHIER UPLOADE
                // https://www.php.net/manual/fr/transliterator.transliterate.php
                $originalFilename = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                //$safeFilename = \Transliterator::transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $safeFilename =  $originalFilename;
                $fileName = $safeFilename . '-' . uniqid() . '.' . $avatar->guessExtension();

                // ON VA STOCKER CE NOM EN BASE DE DONNEES
                $user->setAvatar($fileName);

                // ON VA STOCKER LE FICHIER
                $projectDir = $this->getParameter("kernel.project_dir");
                $cheminDossier = "$projectDir/public/assets/upload";
                // dump($projectDir);

                $avatar->move($cheminDossier, $fileName);
            }
            // HASHAGE DU MOT DE PASSE
            // $passwordNonHashe = $user->getPassword();
            // $passwordHashe    = password_hash($passwordNonHashe, PASSWORD_BCRYPT);
            // $user->setPassword($passwordHashe);
            
            // JE CREE UNE CLE D'ACTIVATION ALEATOIRE
            $cleActivation = md5(password_hash(uniqid(), PASSWORD_DEFAULT));
            $user->setCleActivation($cleActivation);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');

            // OK ON A CREE UN NOUVEL User
            $message = "COOL BIENVENUE TON COMPTE EST CREE";

            
            // IL FAUT ENVOYER UN EMAIL A L'ADMIN
            $email = (new Email())
                ->from('contact@monsite.fr')
                ->to('admin@monsite.fr')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject("NOUVELLE INSCRIPTION")
                ->text("NOUVELLE INSCRIPTION CLE ACTIVATION: $cleActivation")
                ->html("<p>NOUVELLE INSCRIPTION</p> CLE ACTIVATION: $cleActivation");
                // ON PEUT UTILISER DES TEMPLATES TWIG POUR CREER LE HTML DES EMAILS
                // https://symfony.com/doc/current/mailer.html#twig-html-css

            /** @var Symfony\Component\Mailer\SentMessage $sentEmail */
            $sentEmail = $mailer->send($email);
            // $messageId = $sentEmail->getMessageId();

            // return $this->redirectToRoute('user_index');
        }

        // AFFICHAGE DE LA PAGE
        return $this->render('registration/register.html.twig', [
            'controller_name' => 'RegistrationController',

            // CLES => VARIABLES TWIG
            'message'                => $message,
            'registrationForm'       => $form->createView(),
        ]);
    }

    /**
     * @Route("/activation", name="activation")
     */
    public function activation(Request $request, MailerInterface $mailer, UserRepository $userRepository)
    {
        // ON VA CREER UN FORMULAIRE A PARTIR DE LA CLASSE ActivationUserType
        $form = $this->createForm(ActivationUserType::class);
        // ON TRANSMET LES INFOS DE LA REQUETE AU FORMULAIRE $form
        $form->handleRequest($request);
        
        // TRAITEMENT DU FORMULAIRE
        if ($form->isSubmitted())
        {
            // DEBUG
            dump("FORMULAIRE SOUMIS A TRAITER");
            if($form->isValid()) 
            {
               // DEBUG
                dump("FORMULAIRE VALIDE A TRAITER");
                // RECUPERER LES INFOS DU FORMULAIRE
                // $tabInfo = $request->get("activation_user);
                // https://symfony.com/doc/current/form/without_class.htmlion_user");
                $tabInfo = $form->getData();
                extract($tabInfo);
                // dd($tabInfo);

                
                // ON PASSE PAR $form
                // $email = $form->get("email")->getData();
                // $cleActivation = $form->get("cleActivation")->getData();

                // REQUETE READ SUR ENTITE User
                $userTrouve = $userRepository->findOneBy([ "email" => $email, "cle_activation" => $cleActivation]);
                if ($userTrouve != null)
                {
                    // OK ON A TROUVE
                    // dump($userTrouve);
                    
                    // IL FAUT ACTIVER LE User
                    // ET IL FAUT EFFACER LA cleActivation
                    $userTrouve->setRoles(["ROLE_TOTO", "ROLE_MEMBRE"]);
                    $userTrouve->setCleActivation(uniqid());
                    // ON N'A PAS BESOIN DE FAIRE persist
                    // => ON A RECUPERE $userTrouve AVEC $userRepository
                    // ET DONC SYMFONY SE SOUVIENT DU LIEN ENTRE L'ENTITE ET LA LIGNE SQL

                    // SYNCHRONISER AVEC LA TABLE SQL
                    // $userRepository->flush();
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->flush();
                }
                else
                {
                    // ERREUR
                    dump("USER NON TROUVE");     
                }

                // DEBUG
                dump("INFOS RECUPEREES $email/$cleActivation");
            }
        }

        // AFFICHAGE DE LA PAGE
        return $this->render('public/activation.html.twig', [
            'controller_name' => 'RegistrationController',
            // CLES => VARIABLES TWIG
            "form"      => $form->createView(),
            "message"   => $message ?? "",
        ]);

    }
}
