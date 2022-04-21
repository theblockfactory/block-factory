<?php

namespace BlockFactory\BlockBuilder\Repositories;

use BlockFactory\BlockBuilder\Actions\RegisterPostType as BlockPostType;
use BlockFactory\BlockBuilder\Models\Dynamic as Block;

/**
 * Block Repository class
 */
class BlocksRepository
{
    /**
     * @return Block[]
     * @since 1.0.0
     */
    public function getBlocks(): array
    {
        $blocks = [];

        $posts = get_posts([
            'post_type'   => BlockPostType::SLUG,
            'numberposts' => -1,
            'post_status' => 'publish'
        ]);

        foreach ($posts as $post) {
            $blocks[] = Block::make([
                'name'    => sprintf('block-factory/%s', sanitize_title($post->post_title)),
                'title'   => $post->post_title,
                'content' => $post->post_content,
                'meta'    => [
                    'bf_LockedLayout' => get_post_meta($post->ID, 'bf_LockedLayout', true)
                ]
            ]);
        }

        return $blocks;
    }
}
