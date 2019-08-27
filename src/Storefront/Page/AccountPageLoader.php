<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Storefront\Page;

use Shopware\Core\Checkout\Cart\Exception\CustomerNotLoggedInException;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoader;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class AccountPageLoader
{
    /** @var GenericPageLoader */
    private $genericLoader;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    public function __construct(GenericPageLoader $genericLoader, EventDispatcherInterface $eventDispatcher)
    {
        $this->genericLoader = $genericLoader;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function load(Request $request, SalesChannelContext $context): AccountPage
    {
        if (!$context->getCustomer()) {
            throw new CustomerNotLoggedInException();
        }

        $page = AccountPage::createFrom(
            $this->genericLoader->load($request, $context)
        );

        $event = new AccountPageLoadedEvent($page, $context, $request);
        $this->eventDispatcher->dispatch($event, AccountPageLoadedEvent::NAME);

        return $page;
    }
}