<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Controller\SalesChannel;

use Shopware\Core\Framework\Routing\StoreApiRouteScope;
use Shopware\Core\PlatformRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE => [StoreApiRouteScope::ID]])]
class ExampleSalesChannelController extends AbstractController
{
    #[Route(path: '/store-api/boilerplate/example-store-api-action', name: 'store-api.action.boilerplate.example-store-api-action', methods: ['GET'])]
    public function exampleApi(): JsonResponse
    {
        return new JsonResponse(['You successfully created your first Store-API controller route']);
    }
}