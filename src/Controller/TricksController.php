<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Tricks;
use App\Form\TrickType;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\CategoryRepository;
use App\Repository\TricksRepository;
use App\Repository\UserRepository;
use App\Service\PictureService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;


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
            if ($images ==! null) {
                foreach ($images as $image) {
                    $folder = 'tricks';
                    $fichier = $pictureService->add($image, $folder, 300, 300);
                    $img = new Image();
                    $img->setName($fichier);
                    if ($trick->getMainImageName() === null || $fichier ==! null) {
                        $trick->setMainImageName($fichier);
                    }
                    $trick->addImage($img);
                }
            }  else {
                $trick->setMainImageName('default.webp');
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

    #[Route('/single', name: 'app_tricks_show', methods: ['GET', 'POST'])]
    public function show(Request $request, TricksRepository $trickRepository, UserRepository $userRepository, CategoryRepository $categoryRepository, EntityManagerInterface $em): Response
    {
        // I retrieve attribute in the get then I replace it in object
        $trickId = $request->query->get('id');
        $trick = $trickRepository->findTrickWithUserAndCategory($trickId);
        $comment = new Comment(); // Create a new Comment instance
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request); // Handle form submission

        if ($form->isSubmitted() && $form->isValid()) {
            // ... Handle form submission and persist comment to the database
            $comment->setCreatedAt(new DateTimeImmutable());
            $comment->setAuthor($this->getUser());
            $comment->setTrick($trick);

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Le commentaire a bien été enregistré.');
            // Redirect or do whatever you need after successful comment submission
        }

        // I return it in my view for use
        return $this->render('tricks/single_trick.html.twig', [
            'form' => $form->createView(),
            'trick' => $trick,
        ]);
    }


    #[Route('/edition/{id}', name: 'app_trick_edit', methods: ['GET', 'POST'])]
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
            $images = $form->get('images')->getData();
            if ($images ==! null) {
                foreach ($images as $image) {
                    $folder = 'tricks';
                    $fichier = $pictureService->add($image, $folder, 300, 300);
                    $img = new Image();
                    $img->setName($fichier);
                    if ($trick->getMainImageName() === null || $fichier ==! null) {
                        $trick->setMainImageName($fichier);
                    }
                    $trick->addImage($img);
                }
            }  else {
                $trick->setMainImageName('default.webp');
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

        return $this->render('tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'app_trick_delete')]
    public function delete(Request $request, Tricks $trick, TricksRepository $trickRepository): Response
    {
        $this->denyAccessUnlessGranted('TRICK_DELETE', $trick);
        $trickRepository->remove($trick, true);
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/suppression/image/{id}', name: 'app_trick_delete_image', methods: ['DELETE'])]
    public function deleteImage(Request $request, Image $image, EntityManagerInterface $em, PictureService $pictureService): JsonResponse
    {
        $data  = json_decode($request->getContent(), true);
        if ($this->isCsrfTokenValid('delete'. $image->getId(), $data['_token'])) {
            $nom = $image->getName();

            if ($pictureService->deletePicture($nom, 'tricks', 300,  300)) {
                $em->remove($image);
                $em->flush();

                return new JsonResponse(['succes' => true], 200);
            }
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }
        return new JsonResponse(['error' => 'token invalide'], 400);
    }

    #[Route('/suppression/imagePrincipal/{id}', name: 'app_trick_delete_principal', methods: ['DELETE'])]
    public function deleteImagePrincipal(Request $request, Image $image, EntityManagerInterface $em, PictureService $pictureService): JsonResponse
    {
        $data  = json_decode($request->getContent(), true);
        if ($this->isCsrfTokenValid('delete'. $image->getId(), $data['_token'])) {
            $nom = $image->getName();
            $trick = new Tricks;
            if ($pictureService->deletePicture($nom, 'tricks', 300,  300)) {
                $em->remove($image);
                $trick->setMainImageName('null');
                $em->flush();

                return new JsonResponse(['succes' => true], 200);
            }
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }
        return new JsonResponse(['error' => 'token invalide'], 400);
    }

    #[Route('/edit/imagePrincipal/{id}', name: 'app_trick_edit_principal', methods: ['POST'])]
    public function editImagePrincipal(Request $request,Image $image,TricksRepository $trickRepository, EntityManagerInterface $em): JsonResponse
    {
        $data  = json_decode($request->getContent(), true);
        if ($this->isCsrfTokenValid('edit', $data['_token'])) {
            $nom = $image->getName();
            $trick = new Tricks;
            $trick = $trickRepository->find($image->getTrick());
            if ($nom !== $trick->getMainImageName()) {
                $trick->setMainImageName($nom);
                $em->flush();
                return new JsonResponse(['success' => true], 200);
            }
            return new JsonResponse(['error' => 'Erreur de la modification de l image'], 400);
        }
        return new JsonResponse(['error' => 'token invalide'], 400);
    }
}
