<?php

namespace App\Repository;

use App\Entity\ShippingPeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ShippingPeriodRepository.
 */
class ShippingPeriodRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ShippingPeriod::class);
    }

    /**
     * Get all shipping periods
     *
     * @param array $criteria
     */
    public function getShippingPeriods(array $criteria = []): ?array
    {
        $qb = $this->createQueryBuilder('sp');

        foreach ($criteria as $field => $value) {
            if (!empty($field) && !empty($value)) {
                $qb
                    ->andWhere('sp.' . $field . ' = :' . $field)
                    ->setParameter(':' . $field, $value);
            }
        }

        return $qb->getQuery()->getResult();
    }
}
