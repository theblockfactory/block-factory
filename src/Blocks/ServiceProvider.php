<?php

namespace BlockFactory\Blocks;

use BlockFactory\BlockBuilder\Registry\BlocksRegistry;
use BlockFactory\BlockBuilder\Repositories\BlocksRepository;
use BlockFactory\Blocks\Container\ContainerBlock;
use BlockFactory\Framework\Helpers\Hooks;

/**
 * Service Provider responsible for loading Block Factory blocks
 *
 * @since 1.0.0
 */
class ServiceProvider extends \BlockFactory\Framework\Contracts\ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        // Regular blocks
        BlockFactory(BlocksRegistry::class)->addBlocks([
            ContainerBlock::class
        ]);

        // Dynamic blocks
        foreach (BlockFactory(BlocksRepository::class)->getBlocks() as $block) {
            BlockFactory(BlocksRegistry::class)->addBlock($block);
        }
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        Hooks::addAction('init', BlocksRegistry::class, 'registerBlocks');
        Hooks::addFilter('block_categories_all', BlocksRegistry::class, 'registerBlocksCategories');
    }
}
