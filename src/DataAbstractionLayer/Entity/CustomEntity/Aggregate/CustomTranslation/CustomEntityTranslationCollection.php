<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                         add(CustomTranslationEntity $entity)
 * @method void                         set(string $key, CustomTranslationEntity $entity)
 * @method CustomTranslationEntity[]    getIterator()
 * @method CustomTranslationEntity[]    getElements()
 * @method CustomTranslationEntity|null get(string $key)
 * @method CustomTranslationEntity|null first()
 * @method CustomTranslationEntity|null last()
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