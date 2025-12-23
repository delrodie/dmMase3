<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/espace-adherent')]
class AdherentController extends AbstractController
{
    #[Route('/', name: 'app_frontend_espace_adherent')]
    public function __invoke(): Response
    {
        return $this->render('frontend/adherent.html.twig');
    }
}
