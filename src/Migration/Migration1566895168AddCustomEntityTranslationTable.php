<?php declare(strict_types = 1);

namespace Bvsk\PluginBoilerplate\Migration;

use Bvsk\PluginBoilerplate\BvskPluginBoilerplate;
use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1566895168AddCustomEntityTranslationTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1566895168;
    }

    public function update(Connection $connection): void
    {
        $createCustomEntityTranslationTableQuery = '
            CREATE TABLE IF NOT EXISTS `' . BvskPluginBoilerplate::PLUGIN_CUSTOM_ENTITY_TRANSLATION_TABLE . '` (
                `custom_entity_id` BINARY(16) NOT NULL,
                `language_id` BINARY(16) NOT NULL,
                `label` VARCHAR(255) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3),
                  PRIMARY KEY (`custom_entity_id`, `language_id`),
                  CONSTRAINT `fk.custom_entity_translation.language_id` FOREIGN KEY (`language_id`)
                    REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                  CONSTRAINT `fk.custom_entity_translation.custom_entity_id` FOREIGN KEY (`custom_entity_id`)
                    REFERENCES `custom_entity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            )
            ENGINE = InnoDB
            DEFAULT CHARSET = utf8mb4
            COLLATE = utf8mb4_unicode_ci;
        ';

        $connection->executeQuery($createCustomEntityTranslationTableQuery);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
