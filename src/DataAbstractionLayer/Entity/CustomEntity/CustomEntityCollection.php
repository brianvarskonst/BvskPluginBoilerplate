<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<CustomEntity>
 */
class CustomEntityCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return CustomEntity::class;
    }
}