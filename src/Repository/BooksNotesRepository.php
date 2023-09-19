<?php

namespace App\Repository;

use App\Entity\BooksNotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BooksNotes>
 *
 * @method BooksNotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method BooksNotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method BooksNotes[]    findAll()
 * @method BooksNotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksNotesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BooksNotes::class);
    }

//    /**
//     * @return BooksNotes[] Returns an array of BooksNotes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BooksNotes
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
