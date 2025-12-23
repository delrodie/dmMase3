<?php

namespace App\Controller\Backend;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des comments')
            ->setPageTitle('new', "Enregistrement d'un nouveau comment")
            ->setPageTitle('edit', fn(Comment $comment) => sprintf('Modification de <b>%s</b>', $comment->getTitre()))

            ->setAutofocusSearch(true)
//            ->setDefaultSort(['lastConnectedAt' => 'DESC'])
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            FormField::addColumn('col-md-10 offset-md-1 mt-5'),
            TextField::new('Titre', 'Titre')
                ->setRequired(true)
            ,
            TextEditorField::new('contenu', 'Contenu')
                ->setTemplatePath('backend/fields/contenu.html.twig')
                ->setRequired(true)
            ,
            ImageField::new('media', 'Télécharger l\'illustration')
                ->setUploadDir('public/uploads/pages/')
                ->setBasePath('uploads/pages')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired(false)
            ,
            BooleanField::new('actif'),
        ];
    }
}
