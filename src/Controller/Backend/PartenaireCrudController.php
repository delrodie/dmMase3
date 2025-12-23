<?php

namespace App\Controller\Backend;

use App\Entity\Partenaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PartenaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Partenaire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des partenaires')
            ->setPageTitle('new', "Enregistrement d'un nouveau partenaire")
            ->setPageTitle('edit', fn(Partenaire $partenaire) => sprintf('Modification de <b>%s</b>', $partenaire->getNom()))

            ->setAutofocusSearch(true)
//            ->setDefaultSort(['lastConnectedAt' => 'DESC'])
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addColumn('col-md-6 offset-md-3 mt-5'),
            TextField::new('nom', 'Nom'),
            ImageField::new('media', 'Télécharger le logo du partenaire')
                ->setUploadDir('public/uploads/partenaires/')
                ->setBasePath('uploads/partenaires')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ,
            BooleanField::new('statut'),
        ];
    }

}
