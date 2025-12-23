<?php

namespace App\Controller\Backend;

use App\Entity\Actualite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActualiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualite::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des actualités')
            ->setPageTitle('new', "Enregistrement d'une nouvelle actualité")
            ->setPageTitle('edit', fn(Actualite $actualite) => sprintf('Modification de <b>%s</b>', $actualite->getTitre()))
            ->overrideTemplate('crud/detail', 'backend/actualite_details.html.twig')
            ->setAutofocusSearch(true)
            ->setDefaultSort(['createdAt' => 'DESC', 'updatedAt' => 'DESC'])
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            FormField::addColumn('col-md-10 offset-md-1 mt-5'),
            TextField::new('Titre', 'Titre')
                ->setRequired(true)
            ,
            TextEditorField::new('contenu', 'Contenu')
                ->setTemplatePath('backend/fields/contenu.html.twig')
                ->setRequired(true)
                ->hideOnIndex()
            ,
            ImageField::new('media', 'Télécharger l\'illustration')
                ->setUploadDir('public/uploads/pages/')
                ->setBasePath('uploads/pages')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired(true)
            ,
            BooleanField::new('actif'),
            DateTimeField::new('createdAt', "Création")
                ->setFormat('Y-m-d H:i:s')
                ->hideOnForm()
            ,
            DateTimeField::new('updatedAt', "Modification")
                ->setFormat('Y-m-d H:i:s')
                ->hideOnForm()
            ,
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }
}
