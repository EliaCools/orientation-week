<?php

namespace App\Controller;


use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


     #[Route('/', name: 'home')]
    public function show(): Response
    {

        $albums = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findAll();

        $test = "hello";

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'albums' => $albums,
            'test' => $test
        ]);
    }
}
