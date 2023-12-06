<?php

namespace App\Controller\Admin;

use App\Entity\ModelesPage;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ModelesPageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ModelesPage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('url'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort([
                'titre' => 'ASC',
                'url' => 'ASC',
            ]); // Remplacez 'id' par le nom du champ que vous souhaitez trier et 'ASC' par 'DESC' si vous souhaitez trier par ordre décroissant.
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof ModelesPage) return;
        
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        if (!$entityInstance instanceof ModelesPage) return;
        
        parent::persistEntity($entityManager, $entityInstance);
    }
}


