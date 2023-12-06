<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use Symfony\Component\PasswordHasher\PasswordHasherFactory;

class UserCrudController extends AbstractCrudController
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
      
        if (Crud::PAGE_INDEX === $pageName) {
            // Champs à afficher dans la liste (index) des entités
                    return [
                        TextField::new('firstName'),
                        TextField::new('lastName'),
                        EmailField::new('email'),
                        ArrayField::new('roles'),
                    ];
        } else {
                    return [
                        IdField::new('id')->hideOnForm(),
                        TextField::new('firstName'),
                        TextField::new('lastName'),
                        EmailField::new('email'),
                        Field::new('password', 'Password')
                            ->setFormType(PasswordType::class)
                            ->onlyOnForms(), // afficher seulement dans les formulaires de création et d'édition
                    ];
        }
    }

    
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof User) return;
        
        $entityInstance->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
        $entityInstance->setPassword($hashedPassword);

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        if (!$entityInstance instanceof User) return;
        
        $entityInstance->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
        $entityInstance->setPassword($hashedPassword);

        parent::persistEntity($entityManager, $entityInstance);
    }
    
}
