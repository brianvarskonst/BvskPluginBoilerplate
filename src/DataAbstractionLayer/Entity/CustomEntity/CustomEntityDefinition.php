<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation\CustomEntityTranslationDefinition;

class CustomEntityDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'custom_entity';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return CustomEntityCollection::class;
    }

    public function getEntityClass(): string
    {
        return CustomEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            new StringField('technical_name', 'technicalName'),
            new TranslatedField('label'),
            (new TranslationsAssociationField(CustomEntityTranslationDefinition::class, 'custom_entity_id'))->addFlags(new Required()),
        ]);
    }
}