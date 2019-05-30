<?php

namespace App\Controller;

use App\Service\CalculateDeliveryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;

/**
 * class CalculateDeliveryController.
 */
class CalculateDeliveryController extends AbstractController
{
    /**
     * @var string[]
     */
    private $expectedParams = [
        'supplier',
        'day',
        'time',
        'location',
    ];

    /**
     * @var CalculateDeliveryService
     */
    private $calculateDeliveryService;

    /**
     * CalculateDeliveryController constructor.
     *
     * @param CalculateDeliveryService $calculateDeliveryService
     */
    public function __construct(CalculateDeliveryService $calculateDeliveryService)
    {
        $this->calculateDeliveryService = $calculateDeliveryService;
    }

    /**
     * @Route("/delivery-time", name="deliveryTime")
     *
     * @param Request $request
     */
    public function geDeliveryTime(Request $request): Response
    {
        $requestParams = $request->query->all();
        $requestErrors = $this->getRequestErrors($requestParams);
        if (!empty($requestErrors)) {
            return new Response($this->json($requestErrors));
        }

        $deliveryTime = $this->calculateDeliveryService->calculateDeliveryEta($requestParams);

        return new Response($this->json($deliveryTime));
    }

    /**
     * Check the validity of the request params.
     *
     * @param $requestData
     */
    private function getRequestErrors($requestData): array
    {
        foreach ($this->expectedParams as $param) {
            if (empty($requestData[$param])) {
                return ['Error' => 'Missing parameters or data'];
            }
        }

        return [];
    }
}
