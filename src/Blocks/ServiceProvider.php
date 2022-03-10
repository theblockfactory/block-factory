<?php

namespace BlockFactory\Blocks;

use BlockFactory\BlockBuilder\Registry\BlocksRegistry;
use BlockFactory\Blocks\Container\ContainerBlock;

/**
 * Service Provider responsible for loading Block Factory blocks
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
    }
}
