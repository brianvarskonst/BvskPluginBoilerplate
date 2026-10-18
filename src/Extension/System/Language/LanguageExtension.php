<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Extension\System\Language;

use Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation\CustomEntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Language\LanguageDefinition;

class LanguageExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('bvskCustomEntityTranslations', CustomEntityTranslationDefinition::class, 'language_id')
        );
    }

    public function getEntityName(): string
    {
        return LanguageDefinition::ENTITY_NAME;
    }
}
