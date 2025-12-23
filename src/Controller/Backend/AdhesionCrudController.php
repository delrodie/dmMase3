<?php

namespace App\Controller\Backend;

use App\Entity\Adhesion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdhesionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adhesion::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('civilite', "Civilité")->setColumns('col-md-3'),
            TextField::new('nom', "Nom de famille")->setColumns('col-md-4'),
            TextField::new('prenom', "Prenoms")->setColumns('col-md-5'),
            TextField::new('email', "Adresse email")->setColumns('col-md-6'),
            TextField::new('telephone', "Téléphone")->setColumns('col-md-6'),
            TextField::new('entreprise', "Entreprise")->setColumns('col-md-6'),
            TextField::new('fonction', "Fonction")->setColumns('col-md-6'),
            TextField::new('pays', "Pays")->setColumns('col-md-6'),
            TextField::new('ville', "Ville")->setColumns('col-md-6'),
            TextareaField::new('message', "Message")->setColumns('col-md-12'),
            DateField::new('createdAt', "Date de creation")
                ->setFormat('dd MMMM Y H:i:s')
                ->setColumns('col-md-12'),
            BooleanField::new('valid', "Validee ?")
        ];
    }

}
