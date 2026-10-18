<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation\CustomEntityTranslationCollection;

class CustomEntity extends Entity
{
    use EntityIdTrait;
    /**
     * @var string
     */
    protected $technicalName;

    /**
     * @var string|null
     */
    protected $label;

    /**
     * @var CustomEntityTranslationCollection|null
     */
    protected $translations;

    public function getTechnicalName(): string
    {
        return $this->technicalName;
    }

    public function setTechnicalName(string $technicalName): void
    {
        $this->technicalName = $technicalName;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function getTranslations(): ?CustomEntityTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(CustomEntityTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }
}