<?php

namespace BlockFactory\BlockBuilder\Models;

use InvalidArgumentException;
use JsonException;

/**
 * Regular Block Model
 */
class Block extends Model
{
	/**
	 * @param  array  $data
	 *
	 * @return Block
	 *
	 * @since 1.0.0
	 */
	public static function make(array $data): Block
	{
		$block = new static();

		$block->validateArray($data);
		$block->setPropertiesFromArray($data);

		if ($block->hasJsonFile()) {
			$block->setPropertiesFromJsonFile();
		}

		return $block;
	}


	/**
	 * Use block.json to add block metadata
	 *
	 * @throws InvalidArgumentException
	 * @since 1.0.0
	 *
	 */
	private function setPropertiesFromJsonFile(): void
	{
		try {
			$data = json_decode(file_get_contents($this->name . '/block.json'), true, 512, JSON_THROW_ON_ERROR);
		} catch (JsonException $exception) {
			throw new InvalidArgumentException(
				sprintf('Unable to set properties for %s object. Please provide a valid JSON.', static::class)
			);
		}


		$this->setPropertiesFromArray($data);
	}

	/**
	 * @return bool
	 * @since 1.0.0
	 *
	 */
	private function hasJsonFile(): bool
	{
		return file_exists($this->name . '/block.json');
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
			'render',
		];
	}

	/**
	 * @param  array  $attributes
	 * @param  string  $content
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function renderCallback(array $attributes, string $content): string
	{
		if ( ! is_callable($this->render)) {
			throw new InvalidArgumentException('Please provide valid render callback function for ' . static::class);
		}

		return call_user_func($this->render, $attributes, $content);
	}
}
