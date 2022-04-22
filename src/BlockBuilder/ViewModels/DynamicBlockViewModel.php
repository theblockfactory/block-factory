<?php

namespace BlockFactory\BlockBuilder\ViewModels;

use BlockFactory\BlockBuilder\Models\Dynamic;
use BlockFactory\Framework\Contracts\Arrayable;

/**
 * Dynamic Block view model
 *
 * @since 1.0.0
 */
class DynamicBlockViewModel implements Arrayable
{
    private Dynamic $block;

    /**
     * @param  Dynamic  $block
     */
    public function __construct(Dynamic $block)
    {
        $this->block = $block;
    }

    /**
     * @since 1.0.0
     */
    public function toArray() : array
    {
        $data = $this->block->toArray();
        // Prepare block data for block editor
        unset($data[ 'render_callback' ]);
        $data['category'] = $data['category']['slug'];

        return $data;
    }
}
