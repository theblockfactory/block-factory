<?php

namespace BlockFactory\BlockBuilder\Contracts;

use BlockFactory\BlockBuilder\Models\Block;

/**
 * @since 1.0.0
 */
interface BlockInterface
{
	public function __invoke(): Block;
}
