<?php

namespace App\Controller;

use App\Entity\Structures;
use App\Form\StructuresType;
use App\Repository\StructuresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StructuresController extends AbstractController
{
    #[Route('/structures', name: 'structures.index')]
    public function index(StructuresRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $structures = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*numero de page*/
            5 /*nombre par page*/
        );
        return $this->render('structures/index.html.twig', [
            'structures' => $structures
        ]);
    }

    #[Route('/structures/creation', 'structures.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $structures = new Structures();
        $form = $this->createForm(StructuresType::class, $structures);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $structures = $form->getData();

            $manager->persist($structures);
            $manager->flush();
            $this->addFlash('success', 'La structure a bien été créé');

            return $this->redirectToRoute('structures.index');
        }

        return $this->render('structures/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/structures/edition/{id}', 'structures.edit', methods: ['GET', 'POST'])]
    public function edit(Structures $structures, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(FStructuresType::class, $structures);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $structures = $form->getData();

            $manager->persist($structures);
            $manager->flush();
            $this->addFlash('success', 'La structure a bien été modifié');

            return $this->redirectToRoute('structures.index');
        }

        return $this->render('structures/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/structures/suppression/{id}', 'structures.delete', methods: ['GET', 'POST'])]
    public function delete(Structures $structures, EntityManagerInterface $manager): Response
    {
        if (!$structures) {
            $this->addFlash('success', 'Cette structure n\'existe pas');
            return $this->redirectToRoute('structures.index');
        }
        $manager->remove($structures);
        $manager->flush();
        $this->addFlash('success', 'La structure a bien été supprimé');

        return $this->redirectToRoute('structures.index');
    }

}
