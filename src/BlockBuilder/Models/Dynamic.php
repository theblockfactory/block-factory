<?php

namespace BlockFactory\BlockBuilder\Models;

use BlockFactory\BlockBuilder\Contracts\Model;

/**
 * Dynamic Block Model
 */
class Dynamic extends Model
{
	/**
	 * @param  array  $data
	 *
	 * @return Dynamic
	 * @since 1.0.0
	 */
	public static function make(array $data): Dynamic
	{
		$block = new static();
		$block->validateArray($data);
		$block->setPropertiesFromArray($data);

		// Set attributes from content!!!!

		return $block;
	}

	/**
	 * @return string[]
	 * @since 1.0.0
	 *
	 */
	public function getRequiredFields(): array
	{
		return [
			'name',
			'content',
		];
	}

	/**
	 * @param  array  $attributes
	 * @param  string  $content
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function renderCallback(array $attributes, string $content): string
	{
		// Just return the content
		return $content;
	}
}
