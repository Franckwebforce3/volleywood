<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/admin/photo")
 */
class PhotoController extends AbstractController
{
    /**
     * @Route("/", name="photo_index", methods={"GET"})
     */
    public function index(PhotoRepository $photoRepository): Response
    {
        return $this->render('photo/index.html.twig', [
            'photos' => $photoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="photo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $photoController = new Photo();
        $form = $this->createForm(PhotoType::class, $photoController);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // IL FAUT GERER LE FICHIER UPLOADE AVEC photo
            // https://symfony.com/doc/current/controller/upload_file.html
            $photo = $form->get('nom')->getData();
            if ($photo)
            {
                // ON A UN FICHIER UPLOADE
                // https://www.php.net/manual/fr/transliterator.transliterate.php
                $originalFilename   = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                //$safeFilename = \Transliterator::transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $safeFilename       =  $originalFilename;
                $fileName           = $safeFilename . '-' . uniqid() . '.' . $photo->guessExtension();

                // ON VA STOCKER CE NOM EN BASE DE DONNEES
                $photoController->setNom($fileName);

                // ON VA STOCKER LE FICHIER
                $projectDir     = $this->getParameter("kernel.project_dir");
                $cheminDossier  = "$projectDir/public/assets/img/produits/";
                dump($projectDir);

                $photo->move($cheminDossier, $fileName);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($photoController);
            $entityManager->flush();

            return $this->redirectToRoute('photo_index');
        }

        return $this->render('photo/new.html.twig', [
            'photo' => $photoController,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_show", methods={"GET"})
     */
    public function show(Photo $photo): Response
    {
        return $this->render('photo/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="photo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Photo $photo): Response
    {
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_index');
        }

        return $this->render('photo/edit.html.twig', [
            'photo' => $photo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Photo $photo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($photo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('photo_index');
    }
}
