<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) {
            // Champs à afficher dans la liste (index) des entités
                    return [
                        TextField::new('name')
                                ->setLabel('Nom'),
                        TextField::new('firstName')
                                ->setLabel('Prénom'),
                        TextField::new('society')
                                ->setLabel('Société'),
                        TelephoneField::new('tel'),
                        EmailField::new('email'),
                    ];
            } else {
                    return [
                        IdField::new('id')->hideOnForm(),
                        TextField::new('name')
                            ->setLabel('Nom'),
                        TextField::new('firstName')
                            ->setLabel('Prénom'),
                        TextField::new('society')
                             ->setLabel('Société'),
                        TelephoneField::new('tel'),
                        EmailField::new('email'),
                        TextareaField::new('message'),
                        BooleanField::new('agree'),
                        BooleanField::new('autorisation'),
                    ];
            }
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort([
                'name' => 'ASC',
                'firstname' => 'ASC',
            ]); // Remplacez 'id' par le nom du champ que vous souhaitez trier et 'ASC' par 'DESC' si vous souhaitez trier par ordre décroissant.
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Contact) return;
        
        // $entityInstance->setDateCreation(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        if (!$entityInstance instanceof Contact) return;
        
        //$entityInstance->setDateModification(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
