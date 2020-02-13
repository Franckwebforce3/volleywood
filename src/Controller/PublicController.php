<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\ActivationUserType;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="public")
     */
    public function index()
    {
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    //////////////////////////////////// AJOUT DE LA FONCTION ACTIVATION ////////////////////////////////////////////
    /**
     * @Route("/activation", name="activation")
     */
    public function activation(Request $request, UserRepository $userRepository)
    {
        // ON VA CREER UN FORMULAIRE A PARTIR DE LA CLASSE ActivationUserType
        $form = $this->createForm(ActivationUserType::class);
        // ON TRANSMET LES INFOS DE LA REQUETE AU FORMULAIRE $form
        $form->handleRequest($request);

        // TRAITEMENT DU FORMULAIRE
        if ($form->isSubmitted())
        {
           // DEBUG
            if($form->isValid()) 
            {
               // DEBUG
                // RECUPERER LES INFOS DU FORMULAIRE
                // $tabInfo = $request->get("activation_user);
                // https://symfony.com/doc/current/form/without_class.htmlion_user");
                $tabInfo = $form->getData();
                extract($tabInfo);

                
                // ON PASSE PAR $form
                // $email = $form->get("email")->getData();
                // $cleActivation = $form->get("cleActivation")->getData();

                // REQUETE READ SUR ENTITE User
                $userTrouve = $userRepository->findOneBy([ "email" => $email, "cleActivation" => $cleActivation]);
                if ($userTrouve != null)
                {
                    // OK ON A TROUVE
                    
                    // IL FAUT ACTIVER LE User
                    // ET IL FAUT EFFACER LA cleActivation
                    $userTrouve->setRoles(["ROLE_MEMBRE"]);
                    $userTrouve->setCleActivation(uniqid());
                    // ON N'A PAS BESOIN DE FAIRE persist
                    // => ON A RECUPERE $userTrouve AVEC $userRepository
                    // ET DONC SYMFONY SE SOUVIENT DU LIEN ENTRE L'ENTITE ET LA LIGNE SQL

                    // SYNCHRONISER AVEC LA TABLE SQL
                    $userRepository->flush();
                }
                else
                {
                    // ERREUR
                }

                // DEBUG
            }
        }

        // AFFICHAGE DE LA PAGE
        return $this->render('public/activation.html.twig', [
            // CLES => VARIABLES TWIG
            "form"      => $form->createView(),
            "message"   => $message ?? "",
        ]);

    }
/////////////////////////////////////////FIN DE LA FONCTION ACTIVATION/////////////////////////////////////////
    /**
     * @Route("/galerie", name="galerie")
     */
    public function galerie()
    {
        return $this->render('public/galerie.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('public/contact.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ArticleRepository $articleRepository, CommentaireRepository $commentaireRepository)
    {
        // $commentaires = $commentaireRepository->findAll();
        $articles = $articleRepository->findAll();
        return $this->render('public/blog.html.twig', [
            'controller_name' => 'PublicController',
            'articles' => $articles,
            // 'commentaires' => $commentaires,
        ]);
    }

    /**
     * @Route("/applivolleywood", name="applivolleywood")
     */
    public function applivolleywood()
    {
        return $this->render('public/applivolleywood.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription()
    {
        // AFFICHAGE DE LA PAGE
        return $this->render('public/inscription.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/single-blog", name="single-blog")
     */
    public function singleblog()
    {
        return $this->render('public/single-blog.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/tournoi-special-greoux", name="tournoi-special-greoux")
     */
    public function tournoispecialgreoux()
    {
        return $this->render('public/tournoi-special-greoux.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/volleywood-summer", name="volleywood-summer")
     */
    public function volleywoodsummer()
    {
        return $this->render('public/volleywood-summer.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/beachvolleymarathon", name="beachvolleymarathon")
     */
    public function beachvolleymarathon()
    {
        return $this->render('public/beachvolleymarathon.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    
    /**
     * @Route("/athletes-internationaux", name="athletes-internationaux")
     */
    public function athletesinternationaux()
    {
        return $this->render('public/athletes-internationaux.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
        
    /**
     * @Route("/evenement-a-venir", name="evenement-a-venir")
     */
    public function evenementavenir()
    {
        return $this->render('public/evenement-a-venir.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

            
    /**
     * @Route("/tournoi-6x6-telethon", name="tournoi-6x6-telethon")
     */
    public function tournoi6x6telethon()
    {
        return $this->render('public/tournoi-6x6-telethon.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
            
    /**
     * @Route("/shooting", name="shooting")
     */
    public function shooting()
    {
        return $this->render('public/shooting.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
/**
     * @Route("/tournoi-pentecote", name="tournoi-pentecote")
     */
    public function tournoipentecote()
    {
        return $this->render('public/tournoi-pentecote.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/tournoi-mixte-3x3", name="tournoi-mixte-3x3")
     */
    public function tournoimixte3x3()
    {
        return $this->render('public/tournoi-mixte-3x3.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    

    /**
     * @Route("/faireundon", name="faireundon")
     */
    public function faireundon()
    {
        return $this->render('public/faireundon.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/jeuxvideo", name="jeuxvideo")
     */
    public function jeuxvideo()
    {
        return $this->render('public/jeuxvideo.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

        /**
     * @Route("/erreur404", name="erreur404")
     */
    public function erreur404()
    {
        return $this->render('public/erreur404.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
}
