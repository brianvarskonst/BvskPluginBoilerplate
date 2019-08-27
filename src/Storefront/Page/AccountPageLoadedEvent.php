<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Storefront\Page;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Event\NestedEvent;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\HttpFoundation\Request;

class AccountPageLoadedEvent extends NestedEvent
{
    public const NAME = 'account-boilerplate.page.loaded';

    /** @var AccountPage */
    protected $page;

    /** @var SalesChannelContext */
    protected $context;

    /** @var Request */
    protected $request;

    public function __construct(AccountPage $page, SalesChannelContext $context, Request $request)
    {
        $this->page = $page;
        $this->context = $context;
        $this->request = $request;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): Context
    {
        return $this->context->getContext();
    }

    public function getSalesChannelContext(): SalesChannelContext
    {
        return $this->context;
    }

    public function getPage(): AccountPage
    {
        return $this->page;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}