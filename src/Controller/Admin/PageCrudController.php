<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PageCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) {
            // Champs à afficher dans la liste (index) des entités
            return [
                TextField::new('titre'),
                BooleanField::new('actif'),
                TextField::new('url'),
                ImageField::new('entete_image')
                        ->setBasePath('uploads/images')
                        ->setUploadDir('public/uploads/images'),
                AssociationField::new('blocsPages'),
                AssociationField::new('modele'),
            ];
        } else {   
            // Champs à afficher dans le formualire
            return [
                IdField::new('id')->hideOnForm(),
                ImageField::new('background_image')
                        ->setUploadDir('public/uploads/images'),
                TextField::new('titre'),
                BooleanField::new('actif'),
                AssociationField::new('modele'),
                TextField::new('url'),
                TextField::new('entete_h1'),
                TextareaField::new('entete_h2'),
                TextareaField::new('entete_p'),
                ImageField::new('entete_image')
                        ->setUploadDir('public/uploads/images'),
                TextField::new('entete_bis_h3'),
                TextareaField::new('entete_bis_p'),
                TextareaField::new('entete_bis_p_mini'),
                ImageField::new('entete_bis_image')
                        ->setUploadDir('public/uploads/images'),
            ];
        }
    }

    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['titre' => 'ASC']); // Remplacez 'id' par le nom du champ que vous souhaitez trier et 'ASC' par 'DESC' si vous souhaitez trier par ordre décroissant.
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('actif')
        ;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Page) return;
        
        $entityInstance->setDatecreation(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        if (!$entityInstance instanceof Page) return;
        
        parent::persistEntity($entityManager, $entityInstance);
    }
}
