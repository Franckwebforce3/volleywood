<?php

namespace App\Controller;

use App\Entity\CommandeProduit;
use App\Form\CommandeProduitType;
use App\Repository\CommandeProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commandeProduit")
 */
class CommandeProduitController extends AbstractController
{
    /**
     * @Route("/", name="commande_produit_index", methods={"GET"})
     */
    public function index(CommandeProduitRepository $commandeProduitRepository): Response
    {
        return $this->render('commande_produit/index.html.twig', [
            'commande_produits' => $commandeProduitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commande_produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandeProduit = new CommandeProduit();
        $form = $this->createForm(CommandeProduitType::class, $commandeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commandeProduit);
            $entityManager->flush();

            return $this->redirectToRoute('commande_produit_index');
        }

        return $this->render('commande_produit/new.html.twig', [
            'commande_produit' => $commandeProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_produit_show", methods={"GET"})
     */
    public function show(CommandeProduit $commandeProduit): Response
    {
        return $this->render('commande_produit/show.html.twig', [
            'commande_produit' => $commandeProduit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandeProduit $commandeProduit): Response
    {
        $form = $this->createForm(CommandeProduitType::class, $commandeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_produit_index');
        }

        return $this->render('commande_produit/edit.html.twig', [
            'commande_produit' => $commandeProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandeProduit $commandeProduit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeProduit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_produit_index');
    }
}
