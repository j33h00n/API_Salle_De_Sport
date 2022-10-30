<?php

namespace App\Controller;

use App\Entity\Modules;
use App\Form\ModulesType;
use App\Repository\ModulesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModulesController extends AbstractController
{
    /**
     * Cette fonction permet d'afficher la liste des modules
     * 
     * @param ModulesRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/modules', name: 'modules.index', methods: ['GET'])]
    public function index(ModulesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $modules = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*numero de page*/
            5 /*nombre par page*/
        );

        return $this->render('modules/index.html.twig', [
            'modules' => $modules

        ]);
    }


    /**
     * Cette fonction permet d'afficher le formulaire d'ajout d'un module
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    
    #[Route('/modules/creation', 'modules.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $modules = new Modules();
        $form = $this->createForm(ModulesType::class, $modules);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $modules = $form->getData();

            $manager->persist($modules);
            $manager->flush();
            $this->addFlash('success', 'Le module a bien été créé');

            return $this->redirectToRoute('modules.index');
        }

        return $this->render('modules/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * Cette fonction permet d'afficher le détail d'un module
     * 
     * @param Modules $modules
     * @return Response
     * 
     */

    #[Route('/modules/edition/{id}', 'modules.edit', methods: ['GET', 'POST'])]
    public function edit(Modules $modules, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(ModulesType::class, $modules);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $modules = $form->getData();

            $manager->persist($modules);
            $manager->flush();
            $this->addFlash('success', 'Le module a bien été modifié');

            return $this->redirectToRoute('modules.index');
        }

        return $this->render('modules/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * Cette fonction permet de supprimer un module
     * 
     * @param Modules $modules
     * @param EntityManagerInterface $manager
     * @return Response
     */

    #[Route('/modules/suppression/{id}', 'modules.delete', methods: ['GET', 'POST'])]
    public function delete(Modules $modules, EntityManagerInterface $manager): Response
    {
        if (!$modules) {
            $this->addFlash('success', 'Le module n\'existe pas');
            return $this->redirectToRoute('modules.index');
        }
        $manager->remove($modules);
        $manager->flush();
        $this->addFlash('success', 'Le module a bien été supprimé');

        return $this->redirectToRoute('modules.index');
    }
}
