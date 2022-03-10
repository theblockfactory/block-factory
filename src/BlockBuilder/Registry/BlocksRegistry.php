<?php

namespace BlockFactory\BlockBuilder\Registry;

use BlockFactory\BlockBuilder\Contracts\BlockInterface;
use BlockFactory\BlockBuilder\Models\Block;
use BlockFactory\BlockBuilder\Models\Model;
use BlockFactory\BlockBuilder\Models\Dynamic;
use BlockFactory\BlockBuilder\ViewModels\DynamicBlockViewModel;
use InvalidArgumentException;

/**
 * @since 1.0.0
 */
class BlocksRegistry
{
    /**
     * @var Block[]
     */
    private array $blocks = [];

    public function addBlock(Model $block): void
    {
        if (isset($this->blocks[ $block->name ])) {
            throw new InvalidArgumentException(
                sprintf('Block %s is already added', $block->name)
            );
        }

        $this->blocks[ $block->name ] = $block;
    }

    /**
     * Pass an array of FQCN
     *
     * @param  string[]  $blockClasses
     */
    public function addBlocks(array $blockClasses): void
    {
        foreach ($blockClasses as $blockClass) {
            if ( ! is_subclass_of($blockClass, BlockInterface::class)) {
                throw new InvalidArgumentException(
                    sprintf('Block class %s must implement %s interface', $blockClass, BlockInterface::class)
                );
            }

            $this->addBlock(
                BlockFactory($blockClass)()
            );
        }
    }

    /**
     * @return Model[]
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    public function getDynamicBlocks(): array
    {
        $blocks = [];

        foreach ($this->blocks as $block) {
            if ($block instanceof Dynamic) {
                $blocks[] = (new DynamicBlockViewModel($block))->toArray();
            }
        }

        return $blocks;
    }

    public function registerBlocks(): void
    {
        foreach ($this->blocks as $block) {
            register_block_type($block->name, $block->toArray());
        }
    }

    public function registerBlocksCategories(array $registeredCategories): array
    {
        $categories = [];

        foreach ($this->blocks as $block) {
            $categories[] = $block->toArray()[ 'category' ];
        }

        $filtered = array_intersect_key(
            $categories,
            array_unique(array_column($categories, 'slug'))
        );

        return array_merge( $filtered, $registeredCategories);
    }
}
