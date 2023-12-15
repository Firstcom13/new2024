<?php

namespace App\Controller\Admin;

use App\Entity\BlocsPage;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class BlocsPageCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';
    
    public static function getEntityFqcn(): string
    {
        return BlocsPage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) {
            // Champs à afficher dans la liste (index) des entités
            return [
                // IntegerField::new('id'),
                TextField::new('bloc_h3'),
                BooleanField::new('actif'),
                IntegerField::new('ordre_affichage'),
                TextField::new('bloc_color'),
                ImageField::new('bloc_image')
                        ->setBasePath('uploads/images')
                        ->setUploadDir('public/uploads/images'),
                AssociationField::new('page')
                        ->setLabel('Titre de la page')
                        ->formatValue(function ($value, $entity) {
                            if ($value) {
                                $page = $entity->getPage();
                                if ($page) {
                                    return $page->getTitre();
                                }
                            }
                            return null;
                        }),
                        
            ];
        } else {   
            return [
                IdField::new('id')->hideOnForm(),
                BooleanField::new('actif'),
                IntegerField::new('ordre_affichage'),
                TextField::new('bloc_color'),
                TextField::new('bloc_h3'),
                TextareaField::new('bloc_p'),
                TextareaField::new('bloc_p_mini'),
                TextField::new('bloc_lien_text'),
                TextField::new('bloc_lien_url'),
                ImageField::new('bloc_image')
                        ->setUploadDir('public/uploads/images')
                        ->setUploadedFileNamePattern('[year][month][day][name].[extension]'),
                AssociationField::new('page')->autocomplete(),
            ];
        }
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort([
                    'page' => 'ASC',
                    'ordre_affichage' => 'ASC',
                ]); // Remplacez 'id' par le nom du champ que vous souhaitez trier et 'ASC' par 'DESC' si vous souhaitez trier par ordre décroissant.
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('actif')
            ->add('page', null, [
                'field_type' => TextFilter::class,
                'label' => 'Titre de la page',
                'property' => 'titre',
                'format' => '%s',
                'field_options' => [
                    'attr' => [
                        'placeholder' => 'Rechercher par titre de page',
                    ],
                ],
            ]);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof BlocsPage) return;
        
        $entityInstance->setDatecreation(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }


    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        if (!$entityInstance instanceof BlocsPage) return;
        
        //$entityInstance->setDateModification(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }

    
    

}    



