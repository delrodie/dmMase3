<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\HistoriqueRepository;
use App\Repository\ManagementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/qui-sommes-nous')]
class QsnController extends AbstractController
{
    #[Route('/', name: 'app_frontend_qsn_management')]
    public function management(ManagementRepository $managementRepository): Response
    {
        return $this->render('frontend/qsn_management.html.twig',[
            'articles' => $managementRepository->findBy(['statut' => true]),
        ]);
    }

    #[Route('/historique', name: 'app_frontend_qsn_historique')]
    public function historique(HistoriqueRepository $historiqueRepository)
    {
        return $this->render('frontend/qsn_historique.html.twig',[
            'articles' => $historiqueRepository->findBy(['statut' => true], ['annee' => 'ASC'])
        ]);
    }
}
