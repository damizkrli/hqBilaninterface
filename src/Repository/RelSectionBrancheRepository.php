<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\RelSectionBranche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
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

    /**
     * Récupère les secteurs en lien avec une recherche.
     *
     * @return RelSectionBranche[]
     */
    public function findBySearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('s')
        ;

        if (!empty($search->q)) {
            $query = $query
                ->where('s.libelle LIKE :q')
                ->orWhere('s.horsect LIKE :q')
                ->setParameter('q', "%{$search->q}%")

            ;
        }

        if (!empty($search->branches)) {
            $query = $query
                ->andWhere('s.branche IN (:id)')
                ->setParameter('id', $search->branches)
            ;
        }

        return $query->getQuery()->getResult();
    }
}
