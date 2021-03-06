<?php

namespace App\Repository;

use App\Entity\ChampionnatMasculinSenior;
use App\Entity\Club;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Club|null find($id, $lockMode = null, $lockVersion = null)
 * @method Club|null findOneBy(array $criteria, array $orderBy = null)
 * @method Club[]    findAll()
 * @method Club[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Club::class);
    }

    public function getByWordInName1($word)
    {
        $queryBuilder = $this->createQueryBuilder('club');

        $query = $queryBuilder->select('club')
            ->where('club.code_postal LIKE :word')
            ->orwhere('club.nom LIKE :word')
            ->orwhere('club.ville LIKE :word')


            //permet de sécuriser très important
            ->setParameter('word', '%' . $word . '%')
            ->getQuery();

        $results = $query->getResult();

        return $results;


    }
//SELECT id, nom FROM club INNER JOIN championnatmasculinsenior ON club.id = championnatmasculinsenior.club_id
//FROM club
//INNER JOIN championnatmasculinsenior ON club.id = championnatmasculinsenior.club_id

    // /**
    //  * @return Club[] Returns an array of Club objects
    //  */
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
    public function findOneBySomeField($value): ?Club
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
