<?php

namespace BlockFactory\BlockBuilder;

use BlockFactory\BlockBuilder\Actions\BlockBuilderMetaBox;
use BlockFactory\BlockBuilder\Actions\RegisterPostType as BlockPostType;
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
		BlockFactory(BlockPostType::class)->register();

		Hooks::addAction('admin_init', BlockBuilderMetaBox::class);
	}

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		/**
		 * Register blocks
		 */
		BlockFactory(BlocksRegistry::class)->registerBlocks();
	}
}
