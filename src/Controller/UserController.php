<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserEditType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            ///////////////////////////// MODIF BY JEJ/////////////////////////////////////////////////

            // BRICOLAGE POUR RATTRAPER LE PROBLEME SUR roles
            $user->setRoles(["ROLE_USER"]);

            // HASHAGE DU MOT DE PASSE
            $passwordNonHashe = $user->getPassword();
            $passwordHashe    = password_hash($passwordNonHashe, PASSWORD_BCRYPT);
            $user->setPassword($passwordHashe);

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // IL FAUT ENVOYER UN EMAIL

            return $this->redirectToRoute('public');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
        ////////////////////////////////////////// FIN DE MODIF/////////////////////////////////////
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {

        return $this->redirectToRoute('admin');
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $avatar = $form['newAvatar']->getData();
            if ($avatar != '') {
            $originalFilename = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    //$safeFilename = \Transliterator::transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $safeFilename =  $originalFilename;
                    $fileName = $safeFilename . '-' . uniqid() . '.' . $avatar->guessExtension();
                    // ON VA STOCKER CE NOM EN BASE DE DONNEES
                    // $article->setPhoto($fileName);
                    $user->setAvatar($fileName);

                    // ON VA STOCKER LE FICHIER
                    $projectDir = $this->getParameter("kernel.project_dir");
                    $cheminDossier = "$projectDir/public/assets/img/avatar";
                    //dump($projectDir);

                    $avatar->move($cheminDossier, $fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin');
    }
}
