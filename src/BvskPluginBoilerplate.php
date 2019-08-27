<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate;

use Shopware\Core\Framework\Plugin;
use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class BvskPluginBoilerplate extends Plugin
{
    public const PLUGIN_TABLE = 'boilerplate';
    public const PLUGIN_TEMPORARY_REDIRECT_TABLE = 'boilerplate_redirect';
    public const PLUGIN_CUSTOM_ENTITY_TABLE = 'custom_entity';
    public const PLUGIN_CUSTOM_ENTITY_TRANSLATION_TABLE = 'custom_entity_translation';

    public function build(ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/DependencyInjection'));
        $loader->load('services.xml');

        parent::build($container);
    }

    public function Install(InstallContext $context): void
    {
        parent::Install($context);
    }

    public function activate(ActivateContext $activateContext): void
    {
        parent::activate($activateContext);
    }

    public function deactivate(DeactivateContext $deactivateContext): void
    {
        parent::deactivate($deactivateContext);
    }

    public function uninstall(UninstallContext $context): void
    {
        parent::uninstall($context);

        if ($context->keepUserData()) {
            return;
        }

        $connection = $this->container->get(Connection::class);

        $connection->executeQuery('DROP TABLE IF EXISTS `' . self::PLUGIN_TABLE . '`');
        $connection->executeQuery('DROP TABLE IF EXISTS `' . self::PLUGIN_TEMPORARY_REDIRECT_TABLE . '`');

        // While the foreign key checks are disabled the tables can be dropped now, the checks are then turned back on to keep the integrity of the table structure
        $connection->executeQuery('SET foreign_key_checks = 0;');
        $connection->executeQuery('DROP TABLE IF EXISTS `' . self::PLUGIN_CUSTOM_ENTITY_TABLE . '`');
        $connection->executeQuery('DROP TABLE IF EXISTS `' . self::PLUGIN_CUSTOM_ENTITY_TRANSLATION_TABLE . '`');
        $connection->executeQuery('SET foreign_key_checks = 1;');
    }
}
