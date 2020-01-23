<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET","POST"})
     */
    public function index(ArticleRepository $articleRepository, UserRepository $userRepository, CommentaireRepository $commentaireRepository): Response
    {   
        $articles = $articleRepository->findAll();
        $users = $userRepository->findAll();
        $commentaires = $commentaireRepository->findAll();
        // $commentaires = $articles->getCommentaires();

        return $this->render('article/index.html.twig', [
            // 'controller_name' => 'ArticleController',
            'articles' => $articles,
            'users'    => $users,
            'commentaires' => $commentaires,
        ]);
    }
}