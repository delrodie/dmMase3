<?php

namespace App\Controller\Backend;

use App\Entity\Slide;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SlideCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slide::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des slides')
            ->setPageTitle('new', "Enregistrement d'un nouveau slide")

            ->setAutofocusSearch(true)
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addColumn('col-md-6 offset-md-3 mt-5'),
            ImageField::new('media', 'Télécharger la photo')
                ->setUploadDir('public/uploads/slides/')
                ->setBasePath('uploads/slides')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ,
            ChoiceField::new('ordre')
                ->setLabel('Ordre d\'affichage')
                ->setChoices([
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                    6 => 6,
                ]),
            BooleanField::new('statut'),
        ];
    }

}
