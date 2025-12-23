<?php

namespace App\Controller\Backend;

use App\Entity\Management;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ManagementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Management::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addColumn('col-md-10 offset-md-1 mt-5'),
            TextField::new('Titre', 'Titre'),
            TextEditorField::new('contenu', 'Contenu'),
            ImageField::new('media', 'Télécharger l\'illustration')
                ->setUploadDir('public/uploads/qsn/')
                ->setBasePath('uploads/qsn')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
//                ->setColumns('col-md-8')
            ,
            BooleanField::new('statut'),
        ];
    }

}
