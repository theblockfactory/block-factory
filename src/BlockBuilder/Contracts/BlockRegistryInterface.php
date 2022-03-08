<?php

namespace BlockFactory\BlockBuilder\Contracts;

use BlockFactory\BlockBuilder\Models\Block;

/**
 * @since 1.0.0
 */
interface BlockRegistryInterface
{
	public function __invoke(): Block;
}
