<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\TrickType;
use App\Repository\TricksRepository;
use App\Service\PictureService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/tricks')]
class TricksController extends AbstractController
{
    #[Route('/', name: 'app_tricks')]
    public function index(): Response
    {
        return $this->render('tricks/index.html.twig', [
            'controller_name' => 'TricksController',
        ]);
    }

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
}
