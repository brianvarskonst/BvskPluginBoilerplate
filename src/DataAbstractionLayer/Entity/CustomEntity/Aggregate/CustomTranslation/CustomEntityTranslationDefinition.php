<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation;

use Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\CustomEntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class CustomEntityTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'custom_entity_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return CustomEntityTranslationCollection::class;
    }

    public function getEntityClass(): string
    {
        return CustomTranslationEntity::class;
    }

    public function getParentDefinitionClass(): string
    {
        return CustomEntityDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new StringField('label', 'label'),
        ]);
    }
}