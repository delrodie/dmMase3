<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/', name: 'app_frontend_comment')]
    public function __invoke(CommentRepository $commentRepository): Response
    {
        return $this->render('frontend/comment.html.twig',[
            'article' => $commentRepository->findOneBy(['actif' => true], ['id' => "DESC"])
        ]);
    }
}
