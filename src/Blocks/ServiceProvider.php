<?php

namespace BlockFactory\Blocks;

use BlockFactory\BlockBuilder\Registry\BlocksRegistry;
use BlockFactory\BlockBuilder\Repositories\BlocksRepository;
use BlockFactory\Blocks\Container\ContainerBlock;
use BlockFactory\Blocks\Dummy\DummyBlock;

/**
 * Service Provider responsible to load blocks
 *
 * @since 1.0.0
 */
class ServiceProvider extends \BlockFactory\Framework\Contracts\ServiceProvider
{
	private BlocksRegistry $blockRegistry;
	private BlocksRepository $blockRepository;

	public function __construct(
		BlocksRegistry $register,
		BlocksRepository $repository
	) {
		$this->blockRegistry   = $register;
		$this->blockRepository = $repository;
	}

	/**
	 * @inheritDoc
	 */
	public function register() : void
	{
		// Dynamic blocks
		foreach ($this->blockRepository->getBlocks() as $block) {
			$this->blockRegistry->addBlock($block);
		}

		// Regular blocks
		$this->blockRegistry->addBlocks([
			ContainerBlock::class,
			DummyBlock::class,
		]);
	}

	/**
	 * @inheritDoc
	 */
	public function boot() : void
	{
		/**
		 * Enqueue assets
		 */
		add_action('enqueue_block_editor_assets', function () {
			wp_enqueue_script(
				'block-factory-blocks',
				BF_PLUGIN_URL . 'dist/js/blocks.js',
				[
					'wp-i18n',
					'wp-element',
					'wp-blocks',
					'wp-components',
					'wp-compose',
					'wp-editor',
					'wp-data'
				],
				BF_VERSION
			);

			wp_localize_script(
				'block-factory-blocks',
				'BlockFactory',
				[
					'blocks' => $this->blockRegistry->getDynamicBlocksArray(),
				]
			);
		});
	}
}
