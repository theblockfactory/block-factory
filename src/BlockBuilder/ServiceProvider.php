<?php

namespace BlockFactory\BlockBuilder;

use BlockFactory\BlockBuilder\Actions\RegisterPostMeta;
use BlockFactory\BlockBuilder\Actions\RegisterPostType;
use BlockFactory\BlockBuilder\Registry\BlocksRegistry;
use BlockFactory\Framework\Helpers\Hooks;

class ServiceProvider extends \BlockFactory\Framework\Contracts\ServiceProvider
{
	/**
	 * @inheritDoc
	 */
	public function register(): void
	{
		/**
		 * Register post type
		 */
		BlockFactory(RegisterPostType::class)->register();
		BlockFactory(RegisterPostMeta::class)->register();
	}

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		/**
		 * Register blocks and blocks categories
		 */
        Hooks::addAction('block_factory_init', BlocksRegistry::class, 'registerBlocks');
        Hooks::addAction('block_categories_all', BlocksRegistry::class, 'registerBlocksCategories');
	}
}
