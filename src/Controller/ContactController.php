<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Adhesion;
use App\Form\AdhesionType;
use App\Repository\CoordonneeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact')]
class ContactController extends AbstractController
{
    #[Route('/', name:'app_frontend_adhesion', methods: ['GET','POST'])]
    public function adhesion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adhesion = new Adhesion();
        $form = $this->createForm(AdhesionType::class, $adhesion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($adhesion);
            $entityManager->flush();

            $this->addFlash('success', "Votre demande d'adhésion a été envoyée avec succès!");

            return $this->redirectToRoute('app_frontend_adhesion');
        }

        return $this->render('frontend/contact_adhesion.html.twig',[
            'adhesion' => $adhesion,
            'form' => $form
        ]);
    }

    #[Route('/coordonnee', name: 'app_frontend_coordonnee')]
    public function coordonnee(CoordonneeRepository $coordonneeRepository): Response
    {
        return $this->render('frontend/contact_coordonnee.html.twig',[
            'coordonnee' => $coordonneeRepository->findOneBy([],['id' => 'DESC'])
        ]);
    }
}
