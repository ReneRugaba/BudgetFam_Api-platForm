<?php

namespace App\Repository;

use App\Entity\TypesRevenus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypesRevenus|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypesRevenus|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypesRevenus[]    findAll()
 * @method TypesRevenus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypesRevenusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypesRevenus::class);
    }

    // /**
    //  * @return TypesRevenus[] Returns an array of TypesRevenus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypesRevenus
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
