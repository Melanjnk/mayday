<?php


namespace App\Filtering\Mayday;


use App\Filtering\AbstractFilterDefinition;
use App\Filtering\FilterDefinitionInterface;
use App\Filtering\SortableFilterDefinitionInterface;

/**
 * Class MaydayFilterDefinition
 * @package App\Filtering\Store
 */
class MaydayFilterDefinition extends AbstractFilterDefinition implements FilterDefinitionInterface, SortableFilterDefinitionInterface
{
    /**
     * @var null|string
     */
    protected $source;

    /**
     * MaydayFilterDefinition constructor.
     * @param string|null $source
     */
    public function __construct(?string $source = null)
    {
        $this->source = $source;
    }

    public function getParameters(): array
    {
        return get_object_vars($this);
    }

    public function getSortByQuery(): ?string
    {
        // TODO: Implement getSortByQuery() method.
        // no needs to have a lot of sorts now;
    }

    public function getSortByArray(): ?array
    {
        // TODO: Implement getSortByArray() method.
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

}