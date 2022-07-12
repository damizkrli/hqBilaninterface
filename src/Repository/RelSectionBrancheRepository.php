<?php

namespace App\Repository;

use App\Entity\RelSectionBranche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RelSectionBranche>
 *
 * @method RelSectionBranche|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelSectionBranche|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelSectionBranche[]    findAll()
 * @method RelSectionBranche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelSectionBrancheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelSectionBranche::class);
    }

    public function add(RelSectionBranche $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RelSectionBranche $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RelSectionBranche[] Returns an array of RelSectionBranche objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RelSectionBranche
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
