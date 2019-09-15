<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;

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
        dump($categories);
        return $this->render('category/index.html.twig', [
            'controller_name' => $categories[0]->getid(),
        ]);
    }
    /**
     * @Route("/create", name=".create")
     */
    public function createCategory()
    {
        $category = new Category;
        $category->setName('fun');

        //entity manager
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->flush();
        return new Response('is created');
    }
}
