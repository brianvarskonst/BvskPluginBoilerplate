<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Controller\Api;

use Shopware\Core\Framework\Context;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExampleApiController extends AbstractController
{
    /**
     * @Route("/api/v{version}/boilerplate/example-api-action", name="api.action.boilerplate.example-api-action", methods={"GET"})
     */
    public function exampleApi(Request $request, Context $context): JsonResponse
    {
        return new JsonResponse(['You successfully created your first controller route']);
    }
}