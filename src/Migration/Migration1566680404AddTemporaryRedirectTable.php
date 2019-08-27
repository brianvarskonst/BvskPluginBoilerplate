<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;
use Bvsk\PluginBoilerplate\BvskPluginBoilerplate;

class Migration1566680404AddTemporaryRedirectTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1566680404;
    }

    public function update(Connection $connection): void
    {
        $query = '
            CREATE TABLE IF NOT EXISTS `' . BvskPluginBoilerplate::PLUGIN_TEMPORARY_REDIRECT_TABLE . '` (
                `id` binary(16) NOT NULL PRIMARY KEY,
                `hash` text NOT NULL,
                `url` text NOT NULL                    
            ) 
            ENGINE=InnoDB 
            DEFAULT CHARSET=utf8mb4 
            COLLATE=utf8mb4_unicode_ci;
        ';

        $connection->executeQuery($query);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
