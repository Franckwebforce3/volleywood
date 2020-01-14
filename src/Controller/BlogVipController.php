<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
    
class BlogVipController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        return $this->render('blog_vip/index.html.twig', [
            'controller_name' => 'BlogVipController',
        ]);
    }

    /**
     * @Route("/membre/blogMembre", name="blogMembre")
     */
    public function blog_membre()
    {
        return $this->render('blog_vip/indexMembre.html.twig', [
            'controller_name' => 'BlogVipController',
        ]);
    }

    /**
     * @Route("/admin/blogAdmin", name="blogAdmin")
     */
    public function blog_admin()
    {
        return $this->render('blog_vip/indexAdmin.html.twig', [
            'controller_name' => 'BlogVipController',
        ]);
    }
}
