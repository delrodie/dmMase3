<?php

namespace App\Controller\Backend;

use App\Entity\Chiffre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChiffreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chiffre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addColumn('col-md-4 offset-md-4 mt-5'),
            NumberField::new('adherente', "Nombre d'entreprises adhérentes"),
            NumberField::new('certifiee', 'Nombre d\'entreprises certifiées'),
            BooleanField::new('actif')
        ];
    }

}
