<?php

namespace BlockFactory\BlockBuilder\Actions;

use BlockFactory\Framework\Helpers\Input;
use BlockFactory\Framework\Helpers\View;
use WP_Post;

class BlockBuilderMetaBox
{
	/**
	 * @since 1.0.0
	 */
	public function __invoke(): void
	{
		// Register block builder meta box
		add_action('add_meta_boxes', function () {
			add_meta_box(
				'block-factory-document',
				__('Block settings', 'block-factory'),
				[$this, 'renderBlockMetaBox'],
				RegisterPostType::SLUG,
				'side'
			);
		});

		// Register action to save block meta
		add_action('save_post', [$this, 'saveBlockMeta']);
	}

	/**
	 * @return void
	 * @since 1.0.0
	 */
	public function renderBlockMetaBox(): void
	{
		View::render('BlockBuilder.settings-metabox');
	}

	/**
	 * @param  int  $postId
	 * @param  WP_Post  $post
	 *
	 * @since 1.0.0
	 */
	public function saveBlockMeta(int $postId, WP_Post $post): void
	{
		if ($post->post_type !== RegisterPostType::SLUG) {
			return;
		}

		update_post_meta($postId, 'lock_template', Input::post('bf-lock-template', 'boolean'));
	}
}
