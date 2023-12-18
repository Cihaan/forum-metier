<?php

namespace App\Controller;

use App\Entity\Test1;
use App\Form\Test1Type;
use App\Repository\Test1Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test1')]
class Test1Controller extends AbstractController
{
    #[Route('/', name: 'app_test1_index', methods: ['GET'])]
    public function index(Test1Repository $test1Repository): Response
    {
        return $this->render('test1/index.html.twig', [
            'test1s' => $test1Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_test1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $test1 = new Test1();
        $form = $this->createForm(Test1Type::class, $test1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($test1);
            $entityManager->flush();

            return $this->redirectToRoute('app_test1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('test1/new.html.twig', [
            'test1' => $test1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test1_show', methods: ['GET'])]
    public function show(Test1 $test1): Response
    {
        return $this->render('test1/show.html.twig', [
            'test1' => $test1,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_test1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Test1 $test1, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Test1Type::class, $test1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_test1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('test1/edit.html.twig', [
            'test1' => $test1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test1_delete', methods: ['POST'])]
    public function delete(Request $request, Test1 $test1, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$test1->getId(), $request->request->get('_token'))) {
            $entityManager->remove($test1);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_test1_index', [], Response::HTTP_SEE_OTHER);
    }
}
