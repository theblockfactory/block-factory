<?php

namespace BlockFactory\Blocks\Container;

use BlockFactory\BlockBuilder\Models\Block;
use BlockFactory\BlockBuilder\Contracts\BlockInterface;
use BlockFactory\Framework\Helpers\View;

/**
 * Container Block
 *
 * @since 1.0.0
 */
class ContainerBlock implements BlockInterface
{
	/**
	 * @return Block
	 */
	public function __invoke(): Block
	{
		return Block::make([
			'name' => __DIR__,
			'render' => function ($attributes, $content) {
				return View::load(
					'Blocks/Container.container-block',
					[
						'attributes' => $attributes,
						'content'    => $content
					]
				);
			}
		]);
	}
}
