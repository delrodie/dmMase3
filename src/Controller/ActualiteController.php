<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ActualiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/actualite')]
class ActualiteController extends AbstractController
{
    public function __construct(
        private readonly ActualiteRepository $actualiteRepository
    )
    {
    }

    #[Route('/', name:'app_frontend_actualite_list')]
    public function list(): Response
    {
        return $this->render('frontend/actualites.html.twig',[
            'actualites' => $this->actualiteRepository->findBy(['actif' => true], ['id' => 'DESC']),
        ]);
    }

    #[Route('/{slug}', name: 'app_frontend_actualite_show', methods: ['GET'])]
    public function show($slug)
    {
        return $this->render('frontend/actualite_show.html.twig', [
            'actualite' => $this->actualiteRepository->findOneBy(['slug' => $slug]),
        ]);
    }
}
