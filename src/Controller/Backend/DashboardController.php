<?php

namespace App\Controller\Backend;

use App\Entity\Historique;
use App\Entity\Management;
use App\Entity\Partenaire;
use App\Entity\Slide;
use App\Entity\User;
use App\Services\GoogleAnalyticsService;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/backend', routeName: 'app_backend')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private readonly GoogleAnalyticsService $gaService,
        private readonly string $gaPropertyId,
    )
    {
    }

    public function index(): Response
    {
        // Récupération des données Google Anlaytics
        $visitors30days = $this->gaService->getVisitors($this->gaPropertyId);
        $visitorsByDay = $this->gaService->getVisitorsByDay($this->gaPropertyId, 30);

        // Calculer les visiteurs des 7 derniers jours pour comparaison
        $visitors7days = array_sum(array_slice($visitorsByDay, -7, 7, true));

        //Calcluler le pourcentage de changement (optionnel)
        $previousWeek = array_sum(array_slice($visitorsByDay, -14, 7, true));
        $percentageChange = $previousWeek > 0
            ? round((($visitors7days - $previousWeek) / $previousWeek) * 100, 1)
            : 0;
         return $this->render('backend/dashboard.html.twig',[
             'visitors_30_days' => $visitors30days,
             'visitors_7_days' => $visitors7days,
             'visitors_by_day' => $visitorsByDay,
             'percentage_change' => $percentageChange
         ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mase - BackOffice');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        // <i class="fa-solid fa-gears"></i>

        yield MenuItem::section('');
        yield MenuItem::section('Rubrique');
        yield MenuItem::linkToCrud('Slide', 'fa-solid fa-images', Slide::class);
        yield MenuItem::linkToCrud('Partenaire', 'fa-regular fa-handshake', Partenaire::class);

        yield MenuItem::subMenu('Qui sommes-nous', 'fa-solid fa-person-chalkboard')->setSubItems([
                MenuItem::linkToCrud('Système de management', 'fa-solid fa-gears', Management::class),
                MenuItem::linkToCrud('Historique', 'fa-solid fa-clock-rotate-left', Historique::class),
            ]);

        yield MenuItem::section('');
        yield MenuItem::section('Sécurité');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
    }
}
