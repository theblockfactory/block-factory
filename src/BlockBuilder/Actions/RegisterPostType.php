<?php

namespace BlockFactory\BlockBuilder\Actions;

/**
 * @since 1.0.0
 */
class RegisterPostType
{
	public const SLUG = 'bf_blocks';

	/**
	 * Register CPT
	 *
	 * @since 1.0.0
	 */
	public function register(): void
	{
		$labels = [
			'name'               => __('Blocks', 'block-factory'),
			'singular_name'      => __('Block Builder', 'block-factory'),
			'add_new'            => __('Add Block', 'block-factory'),
			'add_new_item'       => __('Add New Block', 'block-factory'),
			'edit_item'          => __('Edit Block', 'block-factory'),
			'new_item'           => __('New Block', 'block-factory'),
			'all_items'          => __('All Blocks', 'block-factory'),
			'view_item'          => __('View Block', 'block-factory'),
			'search_items'       => __('Search Blocks', 'block-factory'),
			'not_found'          => __('No blocks found.', 'block-factory'),
			'not_found_in_trash' => __('No blocks found in Trash.', 'block-factory'),
			'parent_item_colon'  => '',
			'menu_name'          => __('Block Factory', 'block-factory'),
			'name_admin_bar'     => __('Block Factory', 'block-factory'),
		];

		$args = [
			'label'           => __('Block', 'block-factory'),
			'labels'          => $labels,
			'supports'        => [
				'title',
				'editor'
			],
			'show_in_rest'    => true,
			'show_ui'         => true,
			'public'          => false,
			'has_archive'     => false,
			'hierarchical'    => false,
			'capability_type' => 'post',
			'menu_icon'       => 'dashicons-layout'
		];

		register_post_type(self::SLUG, $args);
	}
}
