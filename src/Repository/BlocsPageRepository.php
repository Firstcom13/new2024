<?php

namespace App\Repository;

use App\Entity\BlocsPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlocsPage>
 *
 * @method BlocsPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlocsPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlocsPage[]    findAll()
 * @method BlocsPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocsPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlocsPage::class);
    }

//    /**
//     * @return BlocsPage[] Returns an array of BlocsPage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BlocsPage
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
