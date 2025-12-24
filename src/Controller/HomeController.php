<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ActualiteRepository;
use App\Repository\ChiffreRepository;
use App\Repository\MaintenanceRepository;
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
        private readonly ChiffreRepository $chiffreRepository,
        private readonly MaintenanceRepository $maintenanceRepository
    )
    {
    }

    #[Route('/', name: "app_home")]
    public function index(): Response
    {
        $maintenance = $this->maintenanceRepository->findOneBy(['statut' => true],['id' => "DESC"]);
        if ($maintenance)
            return $this->redirectToRoute('app_frontend_maintenance');


        return $this->render('frontend/home.html.twig', [
            'slides' => $this->slideRepository->findBy(['statut' => true], ['ordre' => 'ASC']),
            'partenaires' => $this->partenaireRepository->findBy(['statut' => true]),
            'management' => $this->managementRepository->findOneBy(['statut' => true],['id' => "DESC"]),
            'actualites' => $this->actualiteRepository->findBy(['actif' => true], ['id' => "DESC"]),
            'chiffre' => $this->chiffreRepository->findOneBy(['actif' => true], ['id' => "DESC"])
        ]);
    }

    #[Route('/maintenance', name: 'app_frontend_maintenance')]
    public function maintenance(): Response
    {
        $maintenance = $this->maintenanceRepository->findOneBy(['statut' => true],['id' => "DESC"]);
        if (!$maintenance)
            return $this->redirectToRoute('app_home');

        return $this->render('maintenance.html.twig');
    }
}
