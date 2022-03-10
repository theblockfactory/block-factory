<?php

namespace BlockFactory\BlockBuilder\ViewModels;

use BlockFactory\BlockBuilder\Models\Dynamic;

class DynamicBlockViewModel
{
    private Dynamic $block;

    public function __construct(Dynamic $block)
    {
        $this->block = $block;
    }

    public function toArray() : array
    {
        $data = $this->block->toArray();
        // Prepare block data for block editor
        unset($data[ 'render_callback' ]);
        $data['category'] = $data['category']['slug'];

        return $data;
    }
}
