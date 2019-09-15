<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ArticleType;
use  App\Entity\Article;
use  App\Repository\ArticleRepository;

/**
     * @Route("/", name="article.")
     */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ArticleRepository $ArticleRepository)
    {
        $articles = $ArticleRepository->findAll();
        return $this->render('article/index.html.twig', ['articles'=>$articles]);

    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(ArticleRepository $ArticleRepository, Request $Request)
    {
        $id = $Request->get('id');
        $article = $ArticleRepository->find($id);
        return $this->render('article/show.html.twig', ['article'=>$article]);

    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $Request, ArticleRepository $ArticleRepository)
    {
        $article = new Article;

        $ArticleForm = $this->createForm(ArticleType::class, $article);
        $ArticleForm->handleRequest($Request);

        // wait for changes to be submitted
        if($ArticleForm->isSubmitted()){

            //dump($ArticleForm);
            $EntityManager = $this->getDoctrine()->getManager();
            $EntityManager->persist($article);
            $EntityManager->flush();

            return $this->show($ArticleRepository);
        } else {
            return $this->render('article/create.html.twig', ['ArticleForm'=> $ArticleForm->createView() ]);
        }

         

    }
}
