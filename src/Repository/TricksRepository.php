<?php

namespace App\Repository;

use App\Entity\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Tricks>
 *
 * @method Tricks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tricks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tricks[]    findAll()
 * @method Tricks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TricksRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 15;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tricks::class);
    }

    public function save(Tricks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tricks $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getTrickPaginator(int $offset): Paginator
    {
        $query = $this->createQueryBuilder('t')
            ->orderBy('CASE WHEN t.updateAt IS NULL THEN t.createdAt ELSE t.updateAt END', 'DESC')
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
        ;

        return new Paginator($query);
    }

    public function findTrickWithUserAndCategory(int $trickId): ?Tricks
    {
        return $this->createQueryBuilder('t')
            ->select('t', 'u', 'category', 'i', 'comment') // Select trick, user and category
            ->leftJoin('t.author', 'u') // Join with User entity
            ->leftJoin('t.category', 'category') // Join with Category entity
            ->leftJoin('t.comments', 'comment') // Join with Comment entity
            ->leftJoin('t.images', 'i') // Join with Image entity
            ->where('t.id = :trickId')
            ->setParameter('trickId', $trickId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findTrickWithEdit(int $trickId): ?Tricks
    {
        return $this->createQueryBuilder('t')
            ->select('t', 'u', 'category', 'i', 'v') // Select trick, user and category
            ->leftJoin('t.author', 'u') // Join with User entity
            ->leftJoin('t.category', 'category') // Join with Category entity
            ->leftJoin('t.images', 'i') // Join with Image entity
            ->leftJoin('t.videos', 'v') // Join with Video entity
            ->where('t.id = :trickId')
            ->setParameter('trickId', $trickId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
