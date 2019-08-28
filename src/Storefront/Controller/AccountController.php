<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Storefront\Controller;

use Bvsk\PluginBoilerplate\Storefront\Page\AccountPageLoader;
use Shopware\Core\Checkout\Cart\Exception\CustomerNotLoggedInException;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    /**
     * @Route("/account/boilerplate", name="frontend.account.boilerplate.page", options={"seo": "false"}, methods={"GET"})
     *
     * @throws CustomerNotLoggedInException
     */
    public function overview(Request $request, SalesChannelContext $context): Response
    {
        $this->denyAccessUnlessLoggedIn();

        $page = $this->accountPageLoader->load($request, $context);

        return $this->renderStorefront('@Storefront/boilerplate/account/index.html.twig', [
            'page' => $page
        ]);
    }
}