<?php

namespace App\Controller;

use App\Entity\Franchises;
use App\Form\FranchisesType;
use App\Repository\FranchisesRepository;
use App\Repository\StructuresRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FranchisesController extends AbstractController
{
    /**
     * Cette fonction permet d'afficher la liste des franchises
     * 
     * @param FranchisesRepository $repository
     * @param StructuresRepository $structures
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/franchises', name: 'franchises.index', methods: ['GET'])]
    public function index(FranchisesRepository $repository, UsersRepository $usersRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $franchises = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*numero de page*/
            5 /*nombre par page*/
        );


        return $this->render('franchises/index.html.twig', [
            'franchises' => $franchises
        ]);
    }

    /**
     * Cette fonction permet d'afficher le formulaire d'ajout d'une franchise
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/franchises/creation', 'franchises.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $franchises = new Franchises();
        $form = $this->createForm(FranchisesType::class, $franchises);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $franchises = $form->getData();

            $manager->persist($franchises);
            $manager->flush();
            $this->addFlash('success', 'La franchise a bien ??t?? cr????');

            return $this->redirectToRoute('franchises.index');
        }

        return $this->render('franchises/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette fonction permet d'afficher le formulaire d'??dition d'une franchise
     * 
     * @param Franchises $franchises
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/franchises/edition/{id}', 'franchises.edit', methods: ['GET', 'POST'])]
    public function edit(Franchises $franchises, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(FranchisesType::class, $franchises);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $franchises = $form->getData();

            $manager->persist($franchises);
            $manager->flush();
            $this->addFlash('success', 'La franchise a bien ??t?? modifi??');

            return $this->redirectToRoute('franchises.index');
        }

        return $this->render('franchises/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette fonction permet de supprimer une franchise
     * 
     * @param Franchises $franchises
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/franchises/suppression/{id}', 'franchises.delete', methods: ['GET', 'POST'])]
    public function delete(Franchises $franchises, EntityManagerInterface $manager): Response
    {
        if (!$franchises) {
            $this->addFlash('success', 'Cette franchise n\'existe pas');
            return $this->redirectToRoute('franchises.index');
        }
        $manager->remove($franchises);
        $manager->flush();
        $this->addFlash('success', 'La franchise a bien ??t?? supprim??');

        return $this->redirectToRoute('franchises.index');
    }

    #[Route('/franchises/fiche', name: 'franchises.fiche', methods: ['GET'])]
    public function fiche(FranchisesRepository $repository, UsersRepository $usersRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $franchises = $paginator->paginate(
            $repository->findAll(),

        );

        return $this->render('franchises/fiche.html.twig', [
            'franchises' => $franchises
        ]);
    }
}
