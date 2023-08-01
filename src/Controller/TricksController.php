<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Tricks;
use App\Form\TrickType;
use App\Repository\CategoryRepository;
use App\Repository\TricksRepository;
use App\Repository\UserRepository;
use App\Service\PictureService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/tricks')]
class TricksController extends AbstractController
{

    #[Route('/new', name: 'app_tricks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TricksRepository $trickRepository,EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {

        //I create my form for new trick
        $trick = new Tricks();
        $this->denyAccessUnlessGranted('TRICK_CREATE', $trick);
        $form = $this->createForm(TrickType::class, $trick);
        $user = $this->getUser();
        //the form request is processed
        $form->handleRequest($request);

        if ($user === null) {
            
            $this->addFlash('danger', 'Veuillez vous connecter pour ajouter un trick');
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        //I check if I have a form and that it is valid
        if ($form->isSubmitted() && $form->isValid()) {
            $now = new DateTimeImmutable();
            $trick->setCreatedAt($now);
            $trick->setSlug($slugger->slug($trick->getSlug()));
            $trick->setAuthor($user);
            $images = $form->get('images')->getData();
            foreach ($images as $image) {
                $folder = 'tricks';
                $fichier = $pictureService->add($image, $folder, 300, 300);
                $img = new Image();
                $img->setName($fichier);
                if ($trick->getMainImageName() === null) {
                    $trick->setMainImageName($fichier);
                }
                $trick->addImage($img);
            }
            $em->persist($trick);
            $em->flush();

            $trickRepository->save($trick, true);
            $this->addFlash(
                'succes',
                'Le trick a bien été enregistré'
            );

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    #[Route('/singletrick', name: 'app_tricks_show', methods: ['GET'])]
    public function show(Request $request, TricksRepository $trickRepository, UserRepository $userRepository, CategoryRepository $categoryRepository): Response
    {
        //I retrieve attribute in the get then I replace it in object
        $trickId = $request->query->get('id');
        $trick = $trickRepository->find($trickId);

        //I retrieve the category of the trick
        $category = $trick->getCategory();
        $category = $categoryRepository->find($category);
      
        //I retrieve the User author of the trick
        $user = $trick->getAuthor();
        $user = $userRepository->find($user);

        //I return it in my view for use
        return  $this->render('tricks/single_trick.html.twig', [
            'trick' => $trick,
            'user' => $user,
            'category' => $category,
            ]
        );
    }

    #[Route('/edition/{id}', name: 'app_tricks_edit', methods: ['GET', 'POST'])]
    public function edit(Tricks $trick, Request $request, TricksRepository $trickRepository,EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('TRICK_EDIT', $trick);
        //I create my form for edit trick
        $form = $this->createForm(TrickType::class, $trick);
        $user = $this->getUser();
        //the form request is processed
        $form->handleRequest($request);

        if ($user === null) {
            
            $this->addFlash('danger', 'Veuillez vous connecter pour ajouter un trick');
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        //I check if I have a form and that it is valid
        if ($form->isSubmitted() && $form->isValid()) {
            $now = new DateTimeImmutable();
            $trick->setUpdateAt($now);
            $trick->setSlug($slugger->slug($trick->getSlug()));
            $trick->setAuthor($user);
            // $images = $form->get('images')->getData();
            // foreach ($images as $image) {
            //     $folder = 'tricks';
            //     $fichier = $pictureService->add($image, $folder, 300, 300);
            //     die;
            // }
            $em->persist($trick);
            $em->flush();

            $trickRepository->save($trick, true);
            $this->addFlash(
                'succes',
                'Le trick a bien été enregistré'
            );

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Tricks $trick, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'. $trick->getId(), $request->request->get('_token'))) {
            $userRepository->remove($trick, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
