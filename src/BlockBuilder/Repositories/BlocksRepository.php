<?php

namespace BlockFactory\BlockBuilder\Repositories;

use BlockFactory\BlockBuilder\Actions\RegisterPostType as BlockPostType;
use BlockFactory\BlockBuilder\Models\Dynamic as Block;

class BlocksRepository
{
	/**
	 * @return Block[]
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
				'name'    => sprintf('block-factory/%s', $post->post_name),
				'title'   => $post->post_title,
				'content' => $post->post_content,
				// ADD meta
			]);
		}

		return $blocks;
	}
}
