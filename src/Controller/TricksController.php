<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\TrickType;
use App\Repository\CategoryRepository;
use App\Repository\TricksRepository;
use App\Repository\UserRepository;
use App\Service\PictureService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/tricks')]
class TricksController extends AbstractController
{

    #[Route('/new', name: 'app_tricks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TricksRepository $trickRepository, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $trick = new Tricks();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $now = new DateTimeImmutable();
            $trick->setUpdateAt($now);
            $trick->setSlug($slugger->slug($trick->getName()));

            $images = $form->get('images')->getData();
            foreach ($images as $image) {
                $folder = 'tricks';
                $fichier = $pictureService->add($image, $folder, 300, 300);
                die;
            }

            $trickRepository->save($trick, true);
            $this->addFlash(
                'notice',
                'le trick a bien été enregistré'
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
        $trickId = $request->query->get('id');
        $trick = $trickRepository->find($trickId);
        $category = $trick->getCategory();
        $category = $categoryRepository->find($category);
        $user = $trick->getAuthor();
        $user = $userRepository->find($user);
        $date = $trick->getUpdateAt()->format('d-m-Y H:i');

        return  $this->render('tricks/single_trick.html.twig', [
            'trick' => $trick,
            'user' => $user,
            'category' => $category,
            'date' => $date
            ]
        );
    }
}
