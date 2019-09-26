<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ArticleType;
use  App\Entity\Article;
use  App\Repository\ArticleRepository;

/**
     * @Route("/article", name="article.")
     */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ArticleRepository $ArticleRepository)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $articles = $ArticleRepository->findBy(['user' => $user]);
        //dump( $this->get('security.token_storage')->getToken()->getUser());
        //$articles = $ArticleRepository->findAll();
        dump($user);
        return $this->render('article/index.html.twig', ['articles'=>$articles]);
    }

    /**
     * @Route("/show/{id?}", name="show")
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
    public function create(Request $Request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $article = new Article;
        $article->setUser($user);
        $ArticleForm = $this->createForm(ArticleType::class, $article);
        $ArticleForm->handleRequest($Request);

        // wait for changes to be submitted
        if($ArticleForm->isSubmitted()){

            //dump($ArticleForm);
            $EntityManager = $this->getDoctrine()->getManager();
            $EntityManager->persist($article);
            $EntityManager->flush();

            return $this->redirectToRoute('article.index');
        } else {
            return $this->render('article/create.html.twig', ['ArticleForm'=> $ArticleForm->createView() ]);
        }
    }

    
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Request $Request, ArticleRepository $ArticleRepository)
    {
        $id = $Request->get('id');
        $toRemove = $ArticleRepository->find($id);
        $articles = $ArticleRepository->findAll();
        //dump($articles);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($toRemove);
        $entityManager->flush();

        return $this->redirectToRoute('article.index');
    }
}
