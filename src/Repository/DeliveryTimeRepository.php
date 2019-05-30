<?php

namespace App\Repository;

use App\Entity\DeliveryTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class DeliveryTimeRepository.
 */
class DeliveryTimeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DeliveryTime::class);
    }

    /**
     * @param array $criteria
     *
     * @throws NonUniqueResultException
     */
    public function getDeliveryTime(array $criteria = []): ?DeliveryTime
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('dt')
            ->from($this->_entityName, 'dt');

        foreach ($criteria as $field => $value) {
            if (!empty($field) && !empty($value)) {
                $qb
                    ->andWhere('dt.' . $field . ' = :' . $field)
                    ->setParameter(':' . $field, $value);
            }
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
