<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/comments')]
class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function indexComment(CommentRepository $commentRepository, Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($offset);
        if ($request->query->get('offset') === null) {
            return $this->render('tricks/single_trick.html.twig', [
                'user' => $this->getUser(),
                'comments' => $paginator,
                'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
            ]);
        } else {
            $commentData = [];
            foreach ($paginator as $comment) {
                $commentData[] = [
                    'id' => $comment->getId(),
                    'trickId' => $comment->getTrickId(),
                    'author' => $comment->getAuthor(),
                    'content' => $comment->getContent()
                ];
            }
            
            return new JsonResponse([
                'comments' => $commentData,
                'next' => min(count($paginator), $offset + commentRepository::PAGINATOR_PER_PAGE),
            ]);
        }
    }

    #[Route('/delete/{id}', name: 'app_comment_delete')]
    public function delete(Comment $comment, CommentRepository $commentRepository): Response
    {
        $trickId = $comment->getTrick()->getId();
        $commentRepository->remove($comment, true);
        return $this->redirectToRoute('app_tricks_show', ['id' => $trickId], Response::HTTP_SEE_OTHER);
    }
}
