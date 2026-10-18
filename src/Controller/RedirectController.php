<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Controller;

use Bvsk\PluginBoilerplate\Component\RedirectHandler\RedirectHandler;
use Shopware\Core\PlatformRequest;
use Shopware\Storefront\Framework\Routing\StorefrontRouteScope;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE => [StorefrontRouteScope::ID]])]
class RedirectController
{
    /**
     * @var RedirectHandler
     */
    private $redirectHandler;

    public function __construct(RedirectHandler $redirectHandler)
    {
        $this->redirectHandler = $redirectHandler;
    }

    #[Route(path: '/boilerplate/redirect', name: 'boilerplate_redirect', methods: ['GET'])]
    public function execute(Request $request): Response
    {
        $hash = $request->get('hash');

        if (empty($hash)) {
            throw new NotFoundHttpException();
        }

        try {
            $target = $this->redirectHandler->decode($hash);
        } catch (Throwable $exception) {
            throw new NotFoundHttpException();
        }

        return new RedirectResponse($target);
    }

}