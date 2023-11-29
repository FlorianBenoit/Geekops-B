<?php

namespace App\Repository;

use App\Entity\Wod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wod>
 *
 * @method Wod|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wod|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wod[]    findAll()
 * @method Wod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wod::class);
    }

    public function add(Wod $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Wod $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Find all Exercices related to a Wod by Wod ID
     *
     * @param int $wodId
     * @return array
     */
    public function findExercicesByWodId(int $wodId): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
             FROM App\Entity\Exercice e
             WHERE e.wod = :wodId'
        )->setParameter('wodId', $wodId);

        return $query->getResult();
    }


//    /**
//     * @return Wod[] Returns an array of Wod objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Wod
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
