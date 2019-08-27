<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;
use Bvsk\PluginBoilerplate\BvskPluginBoilerplate;

class Migration1566608147AddPluginBoilerplateTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1566608147;
    }

    public function update(Connection $connection): void
    {
        $query = '
            CREATE TABLE IF NOT EXISTS `' . BvskPluginBoilerplate::PLUGIN_TABLE . '` (
                `id` binary(16) NOT NULL PRIMARY KEY,
                
                `sales_channel_id` binary(16) DEFAULT NULL,
                
                `config_key` varchar(255) NOT NULL,
                `config_value` varchar(255) NOT NULL,
                            
                `created_at` datetime(3) NOT NULL,
                `updated_at` datetime(3),
                            
                CONSTRAINT `fk.boilerplate.sales_channel_id`
                        FOREIGN KEY (sales_channel_id) 
                        REFERENCES `sales_channel` (id)
                        ON DELETE CASCADE ON UPDATE CASCADE
            )
            ENGINE = InnoDB
            DEFAULT CHARSET = utf8mb4
            COLLATE = utf8mb4_unicode_ci;
        ';

        $connection->executeQuery($query);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
