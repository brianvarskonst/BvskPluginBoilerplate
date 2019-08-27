<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Controller\SalesChannel;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExampleSalesChannelController
{
    /**
     * @Route("/sales-channel-api/v1/boilerplate/example-sales-channel-api-action", name="sales-channel-api.action.boilerplate.example-sales-channel-api-action", methods={"GET"})
     */
    public function exampleApi(): JsonResponse
    {
        return new JsonResponse(['You successfully created your first SalesChannel-API controller route']);
    }
}