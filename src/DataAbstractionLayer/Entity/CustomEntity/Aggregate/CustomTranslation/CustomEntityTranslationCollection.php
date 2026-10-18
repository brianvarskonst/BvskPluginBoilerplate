<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<CustomTranslationEntity>
 */
class CustomEntityTranslationCollection extends EntityCollection
{
    public function filterByLanguageId(string $id): self
    {
        return $this->filter(function (CustomTranslationEntity $customTranslationEntity) use ($id) {
            return $customTranslationEntity->getLanguageId() === $id;
        });
    }

    protected function getExpectedClass(): string
    {
        return CustomTranslationEntity::class;
    }
}