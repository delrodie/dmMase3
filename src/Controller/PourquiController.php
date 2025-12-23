<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PourQuiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pourqui')]
class PourquiController extends AbstractController
{
    #[Route('/', name:'app_frontend_pourqui')]
    public function __invoke(PourQuiRepository $quiRepository): Response
    {
        return $this->render('frontend/pourqui.html.twig',[
            'article' => $quiRepository->findOneBy(['actif' => true], ['id' => "DESC"]),
        ]);
    }
}
