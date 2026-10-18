<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Controller\Api;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Routing\ApiRouteScope;
use Shopware\Core\PlatformRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE => [ApiRouteScope::ID]])]
class ExampleApiController extends AbstractController
{
    #[Route(path: '/api/_action/boilerplate/example-api-action', name: 'api.action.boilerplate.example-api-action', methods: ['GET'])]
    public function exampleApi(Request $request, Context $context): JsonResponse
    {
        return new JsonResponse(['You successfully created your first controller route']);
    }
}