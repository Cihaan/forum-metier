<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\AtelierType;
use App\Form\ConnexionType;
use App\Repository\AtelierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/connexion')]
class ConnexionController extends AbstractController
{
    #[Route('/', name: 'app_connexion_index', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(ConnexionType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // $entityManager->persist($utilisateur);
            // $entityManager->flush();

            $user = $entityManager->getRepository(Utilisateur::class)->findBy(['email' => $utilisateur->getEmail()]);

            if (!$user) {
                echo "User not found.";
                return $this->redirectToRoute('app_connexion_index', [], Response::HTTP_SEE_OTHER);
            }

            $user = $user[0];
            $storedHashedPassword = $user->getPassword();
            $userEnteredPassword = $utilisateur->getPassword();

            // var_dump($utilisateur);

            if (password_verify($userEnteredPassword, $storedHashedPassword)) {
                echo "Password is valid.";

            } else {
                echo "Password is invalid.";
            }

            return $this->redirectToRoute('app_connexion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('connexion/index.html.twig', [
            'form' => $form,
        ]);
    }
}
