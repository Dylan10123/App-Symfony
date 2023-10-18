<?php

namespace App\Repository;

use App\Entity\Cristalizacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cristalizacion>
 *
 * @method Cristalizacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cristalizacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cristalizacion[]    findAll()
 * @method Cristalizacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CristalizacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cristalizacion::class);
    }

//    /**
//     * @return Cristalizacion[] Returns an array of Cristalizacion objects
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

//    public function findOneBySomeField($value): ?Cristalizacion
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
