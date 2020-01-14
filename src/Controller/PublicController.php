<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
