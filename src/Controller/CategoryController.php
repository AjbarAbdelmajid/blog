<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
     * @Route("/categories", name="category")
     */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name=".index")
     */
    public function index(CategoryRepository $CategoryRepository)
    {
        $categories = $CategoryRepository->findAll();
        //$art = $categories[1]->getArticles();
        //dump($art);
        
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/create", name=".create")
     */
    public function createCategory()
    {
        $category = new Category;
        //$category->setName('something');
        $CreateCatgForm = $this->createForm(CategoryType::class, $category);
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
            return $this->render('category/index.html.twig', ['CreateCatgForm'=> $CreateCatgForm->createView() ]);
        }
    }
}

       