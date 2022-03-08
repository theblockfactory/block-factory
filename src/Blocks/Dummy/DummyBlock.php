<?php

namespace BlockFactory\Blocks\Dummy;

use BlockFactory\BlockBuilder\Models\Block;
use BlockFactory\BlockBuilder\Contracts\BlockRegistryInterface;

class DummyBlock implements BlockRegistryInterface
{
	public function __invoke(): Block
	{
		return Block::make([
			'name'   => __DIR__,
			'render' => function ($attributes, $content) {
				var_dump($attributes, $content);
			}
		]);
	}
}
