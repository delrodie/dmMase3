<?php

namespace App\Controller\Backend;

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
    }
}
