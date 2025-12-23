<?php

namespace App\Controller\Backend;

use App\Entity\Historique;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HistoriqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Historique::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['annee' => 'ASC'])
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addColumn('col-md-10 offset-md-1 mt-5'),
            NumberField::new('annee')
                ->setColumns('col-md-4')
            ,
            TextEditorField::new('contenu')
                ->setTemplatePath('backend/fields/contenu.html.twig')
            ,
            BooleanField::new('statut'),
        ];
    }

}
