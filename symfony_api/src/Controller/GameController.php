<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validation;


class GameController extends AbstractFOSRestController
{
    /**
     * @REST\Route("/game", methods={"GET"})
     */
   // #[Route('/game', name: 'game')]
    public function index(GameRepository $gameRepository): Response
    {
        $view = $this->view($gameRepository->findAll());

        $response = new Response();



        return $this->handleView($view);
    }

    /**
     * Create a new game.
     * @Rest\Route("/game", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);

        $validator = Validation::createValidator();

        $groups = new Assert\GroupSequence(['Default', 'custom']);

        $constraint = new Assert\Collection([
            'name'=> new Assert\Length(['min' => 3]),
            'releasedate'=>new Assert\NotBlank(),
            'developer'=> new Assert\Length(['min' => 3]),
            'genre'=> new Assert\Length(['min' => 3]),

        ]);

        $requestData = json_decode($request->getContent(),true);

        $violations = $validator->validate($requestData,$constraint,$groups);


            if(count($violations)>0){
                $response = new Response(
                'inserted data is invalid',
                Response::HTTP_I_AM_A_TEAPOT);
                return $response;
            }

            $game->setName($requestData['name']);
            $game->setReleasedate(\DateTime::createFromFormat('Y-m-d',$requestData["releasedate"]));
            $game->setGenre($requestData['genre']);
            $game->setDeveloper($requestData['developer']);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($game);
            $manager->flush();

            $view = $this->view($game);
            return $this->handleView($view);



    }


    /**
     * Get a single game.
     * @Rest\Route("/game/{id}", methods={"GET"})
     */
    public function read(int $id, GameRepository $GameRepository): Response
    {
        $game = $GameRepository->find($id);
        $view = $this->view($game);
        return $this->handleView($view);
    }


    /**
     * Update a supplier.
     *
     * @Rest\Route("/game/{id}", methods={"PUT"})
     *
     * @param int $id
     *   The supplier id.
     */
    public function update(int $id, GameRepository $GameRepository, Request $request): Response
    {


        $game = $GameRepository->find($id);

        $requestData = json_decode($request->getContent(),true);

        $validator = Validation::createValidator();

        $groups = new Assert\GroupSequence(['Default', 'custom']);

        $constraint = new Assert\Collection([
            'name'=> new Assert\Length(['min' => 3]),
            'releasedate'=>new Assert\NotBlank(),
            'developer'=> new Assert\Length(['min' => 3]),
            'genre'=> new Assert\Length(['min' => 3]),

        ]);

        $violations = $validator->validate($requestData,$constraint,$groups);

        if(count($violations)>0){
            $response = new Response(
                'inserted data is invalid',
                Response::HTTP_I_AM_A_TEAPOT);
            return $response;
        }


        $game->setName($requestData['name']);
        $game->setReleasedate(\DateTime::createFromFormat('Y-m-d',$requestData["releasedate"]));
        $game->setGenre($requestData['genre']);
        $game->setDeveloper($requestData['developer']);

        $this->getDoctrine()->getManager()->flush();

        $view = $this->view($game);
        return $this->handleView($view);
    }

    /**
     * Delete a game.
     *
     * @Rest\Route("/game/{id}", methods={"DELETE"})
     */
    public function delete(int $id, GameRepository $GameRepository): JsonResponse
    {
        $game = $GameRepository->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($game);
        $manager->flush();
        return $this->json([
            'message' => 'Game with ID ' . $id . ' has been deleted.'
        ]);
    }
}


