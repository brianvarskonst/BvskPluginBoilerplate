<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\Aggregate\CustomTranslation;

use Bvsk\PluginBoilerplate\DataAbstractionLayer\Entity\CustomEntity\CustomEntity;
use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;

class CustomTranslationEntity extends TranslationEntity
{
    /**
     * @var string
     */
    protected $bvskCustomEntityId;
    /**
     * @var string|null
     */
    protected $label;
    /**
     * @var CustomEntity|null
     */
    protected $bvskCustomEntity;

    /**
     * @return string
     */
    public function getBvskCustomEntityId(): string
    {
        return $this->bvskCustomEntityId;
    }

    /**
     * @param string $bvskCustomEntityId
     */
    public function setBvskCustomEntityId(string $bvskCustomEntityId): void
    {
        $this->bvskCustomEntityId = $bvskCustomEntityId;
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
    public function getBvskCustomEntity(): ?CustomEntity
    {
        return $this->bvskCustomEntity;
    }

    /**
     * @param CustomEntity|null $bvskCustomEntity
     */
    public function setBvskCustomEntity(?CustomEntity $bvskCustomEntity): void
    {
        $this->bvskCustomEntity = $bvskCustomEntity;
    }
}