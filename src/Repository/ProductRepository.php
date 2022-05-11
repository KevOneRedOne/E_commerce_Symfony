<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Product $entity, bool $flush = true): void
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
    public function remove(Product $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getProductByName($input)
    {
        // creatQueryBuilder() permet de créer une requête SQL
        // Elle prend en paramètre un alias qui représente la table.
        return $this->createQueryBuilder('p')
                    ->andWhere('p.NAME LIKE :val')
                    ->setParameter('val',"%$input%")
                    // xxx% : Doit commencer par 'xxx'
                    // %xxx : Doit finir par 'xxx'
                    // %xxx% : Doit contenir 'xxx'
                    ->orderBy('p.NAME', 'ASC')
                    ->getQuery()
                    ->getResult();
    }

    // public function getProductByUserID($userID)
    // {
    //     // $user.getId();
    //     return $this->createQueryBuilder('p')
    //                 ->innerJoin('p.user', 'u')
    //                 ->where('u.id = p.user_id')
    //                 ->andWhere('p.user_id LIKE :val ')
    //                 ->setParameter('val',$userID)
    //                 ->orderBy('p.NAME', 'ASC')
    //                 ->getQuery()
    //                 ->getResult();
    // }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
