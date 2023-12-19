<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Role;
use App\Form\RegisterType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register')]
class RegisterController extends AbstractController
{

    #[Route('/', name: 'app_register_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(RegisterType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = password_hash($utilisateur->getPassword(), PASSWORD_DEFAULT);
            $utilisateur->setPassword($hashedPassword);
            $default_role = $entityManager->getRepository(Role::class)->findBy(['nom' => 'Visiteur']);
            $utilisateur->setRole($default_role[0]);
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_atelier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('register/index.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }
}
