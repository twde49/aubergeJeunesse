<?php

namespace App\Repository;

use App\Entity\Dorm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dorm>
 *
 * @method Dorm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dorm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dorm[]    findAll()
 * @method Dorm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dorm::class);
    }

//    /**
//     * @return Dorm[] Returns an array of Dorm objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Dorm
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
