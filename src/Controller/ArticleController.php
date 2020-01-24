<?php

namespace App\Controller;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/admin/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $photos = [];
            $photo  = $form['photo']->getData();
            $photo2 = $form['photo2']->getData();
            $photo3 = $form['photo3']->getData();
            $photo4 = $form['photo4']->getData();
            $apercu = $form['apercu']->getData();

            $photos["setPhoto"] = $photo;
            $photos["setPhoto2"] = $photo2;
            $photos["setPhoto3"] = $photo3;
            $photos["setPhoto4"] = $photo4;
            $photos["setApercu"] = $apercu;
            // var_dump($photos);
            // die;
            // // JE DOIS LE FAIRE SUR 4 CHAMPS
            foreach($photos as $nomMethode => $photo){
            // // IL FAUT GERER LE FICHIER UPLOADE AVEC photo
            // // https://symfony.com/doc/current/controller/upload_file.html
            
                if ($photo)
                {
                    // ON A UN FICHIER UPLOADE
                    // https://www.php.net/manual/fr/transliterator.transliterate.php
                    $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                    //$safeFilename = \Transliterator::transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $safeFilename =  $originalFilename;
                    $fileName = $safeFilename . '-' . uniqid() . '.' . $photo->guessExtension();
                    // ON VA STOCKER CE NOM EN BASE DE DONNEES
                    // $article->setPhoto($fileName);
                    $article->$nomMethode($fileName);

                    // ON VA STOCKER LE FICHIER
                    $projectDir = $this->getParameter("kernel.project_dir");
                    $cheminDossier = "$projectDir/public/assets/img/article";
                    dump($projectDir);

                    $photo->move($cheminDossier, $fileName);
                }
            }

            $article->setDatePublication(new \DateTime);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET","POST"})
     */
    public function show(Article $article, Request $request): Response
    {
        // AJOUT JEJE a partir d'ici avec les use correspondant
        
        $commentaire = New Commentaire();
        $commentForm = $this->createForm(CommentaireType::class, $commentaire);
        
        $user = $this->getUser();

        
        $commentForm->handleRequest($request);



        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

            $commentaire->setDatePublication(new \DateTime);
            $commentaire->setUsers($user);
            $commentaire->addArticle($article);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();
        }
        // FIN
        return $this->render('article/show.html.twig', [
            'article' => $article,

            'commentForm' => $commentForm->createView() // ajout de cette ligne
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin');
    }
}
