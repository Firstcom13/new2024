<?php

namespace App\Controller\Admin;

use App\Entity\ArticlesBlog;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class ArticlesBlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticlesBlog::class;
    }


    public function configureFields(string $pageName): iterable
    {

        if (Crud::PAGE_INDEX === $pageName) {
            // Champs à afficher dans la liste (index) des entités
            return [
                TextField::new('titre'),
                TextEditorField::new('description_courte ', 'Description Courte'),
                TextEditorField::new('contenu'),
                ImageField::new('img_contenu', 'Image Contenu')
                    ->setBasePath('uploads/images')
                    ->setUploadDir('public/uploads/images'),
                ImageField::new('img_s', 'Petite Image')
                    ->setBasePath('uploads/images')
                    ->setUploadDir('public/uploads/images'),
                ImageField::new('img_xl', 'Grande Image')
                    ->setBasePath('uploads/images')
                    ->setUploadDir('public/uploads/images'),
                DateTimeField::new('date_creation', 'Date de Publication')
                    ->setFormat('dd/MM/YYYY HH:mm'),
                BooleanField::new('publication', 'Publié'),
            ];
        } else {
            return [
                FormField::addColumn('col-12 col-lg-8'),
                TextEditorField::new('titre'),
                CodeEditorField::new('description_courte', 'Description Courte'),
                TextEditorField::new('meta_description')
                ->setRequired(false),
                CodeEditorField::new('contenu'),
                ImageField::new('img_contenu', 'Image du contenu de l\'article')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images'),
                CodeEditorField::new('contenu2', 'Contenu 2')
                ->setRequired(false),


                FormField::addColumn('col-12 col-lg-4'),
                ImageField::new('img_s', 'Petite Image')
                    ->setBasePath('uploads/images')
                    ->setUploadDir('public/uploads/images'),
                ImageField::new('img_xl', 'Grande Image')
                    ->setBasePath('uploads/images')
                    ->setUploadDir('public/uploads/images'),
                DateTimeField::new('date_creation', 'Date de Publication')
                    ->setFormat('dd/MM/YYYY HH:mm'),
                AssociationField::new('categorie', 'Catégories')
                ->setFormTypeOptions([
                    'by_reference' => false, // Important pour les relations ManyToMany
                ])
                ->setCrudController(CategorieCrudController::class)
                ->autocomplete(), // Si beaucoup de catégories
            ];
        }
    }
}
