<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Routing\Annotation\Route;

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
    public function blog()
    {
        return $this->render('public/blog.html.twig', [
            'controller_name' => 'PublicController',
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
}
