<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryFormType;

/**
     * @Route("/categories", name="category")
     */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name=".index")
     */
    public function index(CategoryRepository $CategoryRepository, Request $Request)
    {
        $category = new Category;

        //$category->setName('something');
        $CreateCatgForm = $this->createForm(CategoryFormType::class, $category);
        $CreateCatgForm->handleRequest($Request);

        // wait for changes to be submitted
        if($CreateCatgForm->isSubmitted()){

            //entity manager
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category.index');
        } else {
            $categories = $CategoryRepository->findAll();
        
            return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'CreateCatgForm'=> $CreateCatgForm->createView()]);
        }
    }

    /**
     * @Route("/create", name=".create")
     */
    public function createCategory(Request $Request)
    {
        $category = new Category;
        //$category->setName('something');
        $CreateCatgForm = $this->createForm(CategoryFormType::class, $category);
        $CreateCatgForm->handleRequest($Request);
        // wait for changes to be submitted
        if($CreateCatgForm->isSubmitted()){
            //entity manager
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('article.index');
        }
        else {
            return $this->redirectToRoute('category.index', ['CreateCatgForm'=> $CreateCatgForm->createView() ]);
        }
    }
}

       