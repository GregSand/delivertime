<?php

namespace App\Service;

use App\Entity\ShippingPeriod;
use App\Repository\{DeliveryTimeRepository, ShippingPeriodRepository};
use Doctrine\ORM\NonUniqueResultException;

/**
 * class CalculateDeliveryService.
 */
class CalculateDeliveryService
{
    /**
     * @var ShippingPeriodRepository
     */
    private $shippingPeriodRepository;

    /**
     * @var DeliveryTimeRepository
     */
    private $deliveryTimeRepository;

    /**
     * @var array
     */
    private $weekDays = [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday',
    ];

    /**
     * CalculateDeliveryService constructor.
     *
     * @param ShippingPeriodRepository $shippingPeriodRepository
     * @param DeliveryTimeRepository   $deliveryTimeRepository
     */
    public function __construct(
        ShippingPeriodRepository $shippingPeriodRepository,
        DeliveryTimeRepository $deliveryTimeRepository
    ) {
        $this->shippingPeriodRepository = $shippingPeriodRepository;
        $this->deliveryTimeRepository = $deliveryTimeRepository;
    }

    /**
     * Calculate the delivery date based on various criteria.
     *
     * @param array $request
     */
    public function calculateDeliveryEta(array $request): ?array
    {
        $deliveryData = $this->getDeliveryInformation($request);
        if (empty($deliveryData)) {
            return ['Error' => 'A delivery time could not be calculated. Please check your request parameters.'];
        }

        $deliveryStartDate = date(
            'd-m-Y',
            strtotime('next ' . $this->weekDays[$deliveryData['deliveryDay']])
        );

        $daysToDelivery = $deliveryData['daysToDeliver'];
        for ($i = 0; $i <= $daysToDelivery; $i++) {
            $deliveryDayToCheck = date('N', strtotime($deliveryStartDate . '+ ' . $i . ' day'));
            if (!in_array($deliveryDayToCheck, $deliveryData['supplierDeliveryDays'])) {
                $daysToDelivery++;
            }
        }

        return [
            'Delivery Date' => date('d-m-Y', strtotime($deliveryStartDate . ' + ' . $daysToDelivery . ' days')),
        ];
    }

    /**
     * Get information required to perform delivery calculations.
     *
     * @param array $request
     */
    private function getDeliveryInformation(array $request): array
    {
        $requestSupplier = (int) $request['supplier'] ?? 0;
        $requestDay = (int) $request['day'] ?? 0;
        $requestLocation = (int) $request['location'] ?? 0;
        $requestTime = $request['time'] ?? 0;

        $shippingPeriods = $this->shippingPeriodRepository->getShippingPeriods(
            [
                'supplier_id' => $requestSupplier,
            ]
        );

        try {
            $deliveryTime = $this->deliveryTimeRepository->getDeliveryTime(
                [
                    'supplier_id' => $requestSupplier,
                    'region_id' => $requestLocation,
                ]
            );
        } catch (NonUniqueResultException $e) {
            $deliveryTime = [];
        }

        if (empty($shippingPeriods) || empty($deliveryTime)) {
            return [];
        }

        $nextIterationIsValue = false;
        /** @var ShippingPeriod $period */
        foreach ($shippingPeriods as $id => $period) {
            $supplierDeliveryDays[$id] = $period->getDeliveryDay();

            if ($nextIterationIsValue) {
                $shippingPeriod = $period;
                $nextIterationIsValue = false;
            }
            if ($requestDay === $period->getDeliveryDay()) {
                if (strtotime($requestTime) < strtotime($period->getEndTime()->format('H:i:s'))) {
                    $shippingPeriod = $period;
                } elseif ($requestDay === max($shippingPeriods)->getDeliveryDay()) {
                    $shippingPeriod = min($shippingPeriods);
                } else {
                    $nextIterationIsValue = true;
                }
            }
        }

        return [
            'startTime' => $shippingPeriod->getStartTime()->format('H:i:s'),
            'endTime' => $shippingPeriod->getEndTime()->format('H:i:s'),
            'deliveryDay' => $shippingPeriod->getDeliveryDay(),
            'daysToDeliver' => $deliveryTime->getDaysToDeliver(),
            'supplierDeliveryDays' => $supplierDeliveryDays,
        ];
    }
}