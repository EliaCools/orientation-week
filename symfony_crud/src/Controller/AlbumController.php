<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AlbumController extends AbstractController
{

    #[Route('/album', name: 'album')]
    public function new(Request $request, ValidatorInterface $validator): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $album = new Album();

        $releasedaterequired=1<2 ? true : false;



        $form = $this->createForm(AlbumFormType::class, $album,[
            'require_release_date' => $releasedaterequired,]);


        $form->handleRequest($request);
        // $form = $this->get('form.factory')->createNamed('',AlbumFormType::class,$album);

        if ($form->isSubmitted() && $form->isValid()) {

            $album = $form->getData();
            $entityManager->persist($album);
            $entityManager->flush();

            $errors = $validator->validate($album);
            if (count($errors) > 0) {
                return new Response((string) $errors, 400);
            }
            return $this->redirectToRoute('home');
        }

        return $this->render('album/index.html.twig', [
            'controller_name' => 'AlbumController',
            'form' => $form->createView()
        ]);
    }
            //@todo how to reduce dublicate code
         #[Route('album/edit/{id}', name: 'albumEdit')]
         public function update($id,Request $request, ValidatorInterface $validator): Response{

             $entityManager = $this->getDoctrine()->getManager();
               $album = $entityManager->getRepository(Album::class)->find($id);

             $form = $this->createForm(AlbumFormType::class, $album,[
                 'method' => 'put']);

             $form->handleRequest($request);

             if ($form->isSubmitted() && $form->isValid()) {

                 $album = $form->getData();
                 $entityManager->persist($album);
                 $entityManager->flush();

                 $errors = $validator->validate($album);
                 if (count($errors) > 0) {
                     return new Response((string) $errors, 400);
                 }
                 return $this->redirectToRoute('home');
             }

             return $this->render('album/index.html.twig', [
                 'controller_name' => 'AlbumController',
                 'form' => $form->createView()
             ]);

         }

         #[Route('album/delete/{id}', name: 'albumDelete')]
         public function delete($id,Request $request, ValidatorInterface $validator): Response{

             $entityManager = $this->getDoctrine()->getManager();
             $album = $entityManager->getRepository(Album::class)->find($id);

             $entityManager->remove($album);
             $entityManager->flush();
             return $this->redirectToRoute('home');

         }

}
