<?php

namespace BlockFactory\BlockBuilder;

use BlockFactory\BlockBuilder\Actions\LoadAssets;
use BlockFactory\BlockBuilder\Actions\RegisterPostMeta;
use BlockFactory\BlockBuilder\Actions\RegisterPostType;
use BlockFactory\Framework\Helpers\Hooks;

/**
 * BlockBuilder service provider class
 * @since 1.0.0
 */
class ServiceProvider extends \BlockFactory\Framework\Contracts\ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        // Post and post meta
        Hooks::addAction('init', RegisterPostType::class);
        Hooks::addAction('init', RegisterPostMeta::class);
        // Assets
        Hooks::addAction('enqueue_block_editor_assets', LoadAssets::class);
    }
}
