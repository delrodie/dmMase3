<?php

namespace App\Controller\Backend;

use App\Entity\Coordonnee;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CoordonneeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coordonnee::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des coordonnées')
            ->setPageTitle('new', "Enregistrement d'une nouvelle coordonnée")
//            ->setPageTitle('edit', fn(Coordonnee $coordonnee) => sprintf('Modification de <b>%s</b>', $comment->getTitre()))

            ->setAutofocusSearch(true)
//            ->setDefaultSort(['lastConnectedAt' => 'DESC'])
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addColumn('col-md-6 offset-md-3 mt-5'),
            TextField::new('lieu', 'Adresse géographique'),
            TextField::new('bp', "Boîte Postale"),
            TelephoneField::new('tel', "Téléphone"),
            TelephoneField::new('phone', "Mobile"),
            EmailField::new('email', 'Email'),
        ];
    }

}
