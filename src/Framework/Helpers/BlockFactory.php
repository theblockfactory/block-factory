<?php

use BlockFactory\Framework\BlockFactory;

/**
 * @param  string|null  $concrete
 *
 * @return BlockFactory|object
 *
 * @since 1.0.0
 */
function BlockFactory(string $concrete = null)
{
	static $instance = null;

	if (is_null($instance)) {
		$instance = new BlockFactory();
	}

	try {
		return is_null($concrete) ? $instance : $instance->get($concrete);
	} catch (Throwable $e) {
		return null;
	}
}


