<?php

namespace BlockFactory\Blocks;

use BlockFactory\BlockBuilder\Registry\BlocksRegistry;
use BlockFactory\BlockBuilder\Repositories\BlocksRepository;
use BlockFactory\Blocks\Container\ContainerBlock;

/**
 * Service Provider responsible for loading Block Factory blocks
 *
 * @since 1.0.0
 */
class ServiceProvider extends \BlockFactory\Framework\Contracts\ServiceProvider
{
    private BlocksRegistry $blockRegistry;
    private BlocksRepository $blockRepository;

    public function __construct(
        BlocksRegistry $register,
        BlocksRepository $repository
    ) {
        $this->blockRegistry = $register;
        $this->blockRepository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        // Dynamic blocks
        foreach ($this->blockRepository->getBlocks() as $block) {
            $this->blockRegistry->addBlock($block);
        }

        // Regular blocks
        $this->blockRegistry->addBlocks([
            ContainerBlock::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        /**
         * Enqueue assets
         */
        add_action('enqueue_block_editor_assets', function () {
            $assets = require(BF_PLUGIN_DIR . '/build/index.asset.php');

            wp_register_script(
                'block-factory-blocks',
                BF_PLUGIN_URL . '/build/index.js',
                $assets[ 'dependencies' ],
                $assets[ 'version' ]
            );

            wp_localize_script(
                'block-factory-blocks',
                'BlockFactory',
                [
                    'blocks' => $this->blockRegistry->getDynamicBlocks(),
                ]
            );

            wp_set_script_translations('block-factory-blocks', 'block-factory');

            wp_enqueue_script('block-factory-blocks');
        });
    }
}
