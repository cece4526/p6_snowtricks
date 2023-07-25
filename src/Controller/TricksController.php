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
        //I create my form
        $trick = new Tricks();
        $form = $this->createForm(TrickType::class, $trick);

        //I get the values there
        $form->handleRequest($request);

        //I check if I have a form and that it is valid
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
        //I retrieve attribute in the get then I replace it in object
        $trickId = $request->query->get('id');
        $trick = $trickRepository->find($trickId);

        //I retrieve the category of the trick
        $category = $trick->getCategory();
        $category = $categoryRepository->find($category);
      
        //I retrieve the User author of the trick
        $user = $trick->getAuthor();
        $user = $userRepository->find($user);

        //I format the dateTimeImmutable
        $date = $trick->getUpdateAt()->format('d-m-Y H:i');

        //I return it in my view for use
        return  $this->render('tricks/single_trick.html.twig', [
            'trick' => $trick,
            'user' => $user,
            'category' => $category,
            'date' => $date
            ]
        );
    }

    #[Route('/{id}', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Tricks $trick, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'. $trick->getId(), $request->request->get('_token'))) {
            $userRepository->remove($trick, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
