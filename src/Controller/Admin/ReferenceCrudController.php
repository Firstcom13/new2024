<?php

namespace App\Controller\Admin;

use App\Entity\Reference;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReferenceCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';
    public static function getEntityFqcn(): string
    {
        return Reference::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) {
            // Champs à afficher dans la liste (index) des entités
            return [
                TextField::new('titre'),
                BooleanField::new('actif'),
                TextField::new('url'),
                AssociationField::new('categorie'),
                ImageField::new('image')
                        ->setBasePath('uploads/images')
                        ->setUploadDir('public/uploads/images'),
            ];
        } else {   
            return [
                IdField::new('id')->hideOnForm(), //cache le champ à la fois dans editet dans newles pages
                TextField::new('titre'),
                TextareaField::new('descriptif'),
                BooleanField::new('actif'),
                ImageField::new('image')
                        ->setUploadDir('public/uploads/images'),
                UrlField::new('url'),
                AssociationField::new('categorie'),
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
            ->add('categorie')
        ;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Reference) return;
        
        $entityInstance->setDateCreation(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        if (!$entityInstance instanceof Reference) return;
        
        //$entityInstance->setDateModification(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
