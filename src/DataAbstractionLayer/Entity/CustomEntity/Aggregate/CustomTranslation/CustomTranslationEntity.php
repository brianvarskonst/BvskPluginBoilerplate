<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation;

use Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\CustomEntity;
use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;

class CustomTranslationEntity extends TranslationEntity
{
    /**
     * @var string
     */
    protected $customEntityId;
    /**
     * @var string|null
     */
    protected $label;
    /**
     * @var CustomEntity|null
     */
    protected $custom;

    /**
     * @return string
     */
    public function getCustomEntityId(): string
    {
        return $this->customEntityId;
    }

    /**
     * @param string $customEntityId
     */
    public function setCustomEntityId(string $customEntityId): void
    {
        $this->customEntityId = $customEntityId;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return CustomEntity|null
     */
    public function getCustom(): ?CustomEntity
    {
        return $this->custom;
    }

    /**
     * @param CustomEntity|null $custom
     */
    public function setCustom(CustomEntity $custom): void
    {
        $this->custom = $custom;
    }
}