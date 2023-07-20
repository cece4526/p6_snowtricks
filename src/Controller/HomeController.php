<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods:['GET'])]
    public function index(TricksRepository $tricksRepository, Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $tricksRepository->getTrickPaginator($offset);
        return $this->render('tricks/index.html.twig', [
            'user' => $this->getUser(),
            'tricks' => $paginator,
            'previous' => $offset - TricksRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + TricksRepository::PAGINATOR_PER_PAGE),
        ]);
    }
}
