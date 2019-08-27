<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Migration;

use Bvsk\PluginBoilerplate\BvskPluginBoilerplate;
use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1566802025AddCustomEntityTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1566802025;
    }

    public function update(Connection $connection): void
    {
        $createCustomEntityTableQuery = '
            CREATE TABLE IF NOT EXISTS `' . BvskPluginBoilerplate::PLUGIN_CUSTOM_ENTITY_TABLE . '` (
                `id` BINARY(16) NOT NULL,
                `technical_name` VARCHAR(255) COLLATE utf8mb4_unicode_ci,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3),
                PRIMARY KEY (`id`)
            )
            ENGINE = InnoDB
            DEFAULT CHARSET = utf8mb4
            COLLATE = utf8mb4_unicode_ci;
        ';

        $connection->executeQuery($createCustomEntityTableQuery);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
