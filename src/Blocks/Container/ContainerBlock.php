<?php

namespace BlockFactory\Blocks\Container;

use BlockFactory\BlockBuilder\Models\Block;
use BlockFactory\BlockBuilder\Contracts\BlockRegistryInterface;
use BlockFactory\Framework\Helpers\View;

class ContainerBlock implements BlockRegistryInterface
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
