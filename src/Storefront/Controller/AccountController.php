<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Storefront\Controller;

use Bvsk\PluginBoilerplate\Storefront\Page\AccountPageLoader;
use Shopware\Core\PlatformRequest;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Shopware\Storefront\Framework\Routing\StorefrontRouteScope;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE => [StorefrontRouteScope::ID]])]
class AccountController extends StorefrontController
{
    /**
     * @var AccountPageLoader
     */
    private $accountPageLoader;

    public function __construct(AccountPageLoader $accountPageLoader)
    {
        $this->accountPageLoader = $accountPageLoader;
    }

    #[Route(path: '/account/boilerplate', name: 'frontend.account.boilerplate.page', options: ['seo' => false], defaults: [PlatformRequest::ATTRIBUTE_LOGIN_REQUIRED => true], methods: ['GET'])]
    public function overview(Request $request, SalesChannelContext $context): Response
    {
        $page = $this->accountPageLoader->load($request, $context);

        return $this->renderStorefront('@Storefront/boilerplate/account/index.html.twig', [
            'page' => $page
        ]);
    }
}