<?php

namespace BlockFactory\BlockBuilder\Registry;

use BlockFactory\BlockBuilder\Contracts\BlockRegistryInterface;
use BlockFactory\BlockBuilder\Models\Model;
use BlockFactory\BlockBuilder\Models\Dynamic;
use InvalidArgumentException;

/**
 * @since 1.0.0
 */
class BlocksRegistry
{
	/**
	 * @var Model[]
	 */
	private array $blocks = [];

	public function addBlock(Model $block): void
	{
		if (isset($this->blocks[ $block->name ])) {
			throw new InvalidArgumentException(
				sprintf('Block %s is already added', $block->name)
			);
		}

		$this->blocks[ $block->name ] = $block;
	}

	/**
	 * Pass an array of FQCN
	 *
	 * @param  string[]  $blockClasses
	 */
	public function addBlocks(array $blockClasses): void
	{
		foreach ($blockClasses as $blockClass) {
			if ( ! is_subclass_of($blockClass, BlockRegistryInterface::class)) {
				throw new InvalidArgumentException(
					sprintf('Block class %s must implement %s interface', $blockClass, BlockRegistryInterface::class)
				);
			}

			$this->addBlock(
				BlockFactory($blockClass)()
			);
		}
	}

	/**
	 * @return Model[]
	 */
	public function getBlocks(): array
	{
		return $this->blocks;
	}

	public function getDynamicBlocksArray(): array
	{
		$blocks = [];

		foreach ($this->blocks as $block) {
			if ( ! $block instanceof Dynamic) {
				continue;
			}

			$data = $block->toArray();
			unset($data[ 'render_callback' ]);
			$blocks[] = $data;
		}

		return $blocks;
	}

	public function registerBlocks(): void
	{
		foreach ($this->getBlocks() as $block) {
			register_block_type($block->name, $block->toArray());
		}
	}
}
