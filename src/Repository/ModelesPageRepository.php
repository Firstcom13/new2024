<?php

namespace App\Repository;

use App\Entity\ModelesPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModelesPage>
 *
 * @method ModelesPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelesPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelesPage[]    findAll()
 * @method ModelesPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelesPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelesPage::class);
    }

//    /**
//     * @return ModelesPage[] Returns an array of ModelesPage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModelesPage
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
