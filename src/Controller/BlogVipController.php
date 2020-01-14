<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogVipController extends AbstractController
{
    /**
     * @Route("/blog/vip", name="blog_vip")
     */
    public function index()
    {
        return $this->render('blog_vip/index.html.twig', [
            'controller_name' => 'BlogVipController',
        ]);
    }
}
