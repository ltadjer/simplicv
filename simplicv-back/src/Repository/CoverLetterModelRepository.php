<?php

namespace App\Repository;

use App\Entity\CoverLetterModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoverLetterModel>
 *
 * @method CoverLetterModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoverLetterModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoverLetterModel[]    findAll()
 * @method CoverLetterModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoverLetterModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoverLetterModel::class);
    }

    public function save(CoverLetterModel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CoverLetterModel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CoverLetterModel[] Returns an array of CoverLetterModel objects
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

//    public function findOneBySomeField($value): ?CoverLetterModel
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
