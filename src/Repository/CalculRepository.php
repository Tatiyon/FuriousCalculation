<?php

namespace App\Repository;

use App\Entity\Calcul;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Calcul|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calcul|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calcul[]    findAll()
 * @method Calcul[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalculRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Calcul::class);
    }

//    /**
//     * @return Calcul[] Returns an array of Calcul objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Calcul
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
