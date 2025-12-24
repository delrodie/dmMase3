<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ActualiteRepository;
use App\Repository\ChiffreRepository;
use App\Repository\ManagementRepository;
use App\Repository\PartenaireRepository;
use App\Repository\SlideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly SlideRepository $slideRepository,
        private readonly ManagementRepository $managementRepository,
        private readonly ActualiteRepository $actualiteRepository,
        private readonly PartenaireRepository $partenaireRepository,
        private readonly ChiffreRepository $chiffreRepository
    )
    {
    }

    #[Route('/', name: "app_home")]
    public function index(): Response
    {
        return $this->render('frontend/home.html.twig', [
            'slides' => $this->slideRepository->findBy(['statut' => true], ['ordre' => 'ASC']),
            'partenaires' => $this->partenaireRepository->findBy(['statut' => true]),
            'management' => $this->managementRepository->findOneBy(['statut' => true],['id' => "DESC"]),
            'actualites' => $this->actualiteRepository->findBy(['actif' => true], ['id' => "DESC"]),
            'chiffre' => $this->chiffreRepository->findOneBy(['actif' => true], ['id' => "DESC"])
        ]);
    }
}
