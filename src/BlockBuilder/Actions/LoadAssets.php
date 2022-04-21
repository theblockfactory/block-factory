<?php

namespace BlockFactory\BlockBuilder\Actions;

use BlockFactory\BlockBuilder\Registry\BlocksRegistry;

/**
 * Load plugin assets
 *
 * @since 1.0.0
 */
class LoadAssets
{
    public function __invoke()
    {
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
                'blocks' => BlockFactory(BlocksRegistry::class)->getDynamicBlocks(),
            ]
        );

        wp_set_script_translations('block-factory-blocks', 'block-factory');

        wp_enqueue_script('block-factory-blocks');
    }
}
