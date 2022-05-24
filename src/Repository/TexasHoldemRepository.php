<?php

namespace App\Repository;

use App\Entity\TexasHoldem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TexasHoldem>
 *
 * @method TexasHoldem|null find($id, $lockMode = null, $lockVersion = null)
 * @method TexasHoldem|null findOneBy(array $criteria, array $orderBy = null)
 * @method TexasHoldem[]    findAll()
 * @method TexasHoldem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TexasHoldemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TexasHoldem::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TexasHoldem $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(TexasHoldem $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return TexasHoldem[] Returns an array of TexasHoldem objects
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
    public function findOneBySomeField($value): ?TexasHoldem
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
