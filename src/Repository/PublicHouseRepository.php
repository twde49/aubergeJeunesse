<?php

namespace App\Repository;

use App\Entity\PublicHouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PublicHouse>
 *
 * @method PublicHouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublicHouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublicHouse[]    findAll()
 * @method PublicHouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicHouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PublicHouse::class);
    }

//    /**
//     * @return PublicHouse[] Returns an array of PublicHouse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.name = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PublicHouse
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
