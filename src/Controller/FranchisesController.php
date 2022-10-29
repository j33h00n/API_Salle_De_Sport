<?php

namespace App\Controller;

use App\Entity\Franchises;
use App\Form\FranchisesType;
use App\Repository\FranchisesRepository;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/franchises', name: 'franchises.index', methods: ['GET'])]
    public function index(FranchisesRepository $repository, PaginatorInterface $paginator, Request $request): Response
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
            $this->addFlash('success', 'La franchise a bien été créé');

            return $this->redirectToRoute('franchises.index');
        }

        return $this->render('franchises/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
        #[Route('/franchises/edition/{id}', 'franchises.edit', methods: ['GET', 'POST'])]
        public function edit(Franchises $franchises, Request $request, EntityManagerInterface $manager): Response
        {
    
            $form = $this->createForm(FranchisesType::class, $franchises);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $franchises = $form->getData();
    
                $manager->persist($franchises);
                $manager->flush();
                $this->addFlash('success', 'La franchise a bien été modifié');
    
                return $this->redirectToRoute('franchises.index');
            }
    
            return $this->render('franchises/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    
  
        #[Route('/franchises/suppression/{id}', 'franchises.delete', methods: ['GET', 'POST'])]
        public function delete(Franchises $franchises, EntityManagerInterface $manager): Response
        {
            if (!$franchises) {
                $this->addFlash('success', 'Cette franchise n\'existe pas');
                return $this->redirectToRoute('franchises.index');
            }
            $manager->remove($franchises);
            $manager->flush();
            $this->addFlash('success', 'La franchise a bien été supprimé');
    
            return $this->redirectToRoute('franchises.index');
        }


    
} 
