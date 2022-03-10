<?php

namespace BlockFactory\BlockBuilder;

use BlockFactory\BlockBuilder\Actions\LoadAssets;
use BlockFactory\BlockBuilder\Actions\RegisterPostMeta;
use BlockFactory\BlockBuilder\Actions\RegisterPostType;
use BlockFactory\BlockBuilder\Registry\BlocksRegistry;
use BlockFactory\BlockBuilder\Repositories\BlocksRepository;
use BlockFactory\Framework\Helpers\Hooks;

class ServiceProvider extends \BlockFactory\Framework\Contracts\ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        // Register dynamic blocks
        foreach (BlockFactory(BlocksRepository::class)->getBlocks() as $block) {
            BlockFactory(BlocksRegistry::class)->addBlock($block);
        }
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        // Post and post meta
        Hooks::addAction('init', RegisterPostType::class);
        Hooks::addAction('init', RegisterPostMeta::class);
        // Blocks
        Hooks::addAction('init', BlocksRegistry::class, 'registerBlocks');
        Hooks::addFilter('block_categories_all', BlocksRegistry::class, 'registerBlocksCategories');
        // Assets
        Hooks::addAction('enqueue_block_editor_assets', LoadAssets::class);
    }
}
