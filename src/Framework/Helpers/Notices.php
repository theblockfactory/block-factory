<?php

namespace BlockFactory\Framework\Helpers;

/**
 * Notices helper class
 * @since 1.0.0
 */
class Notices
{
	/**
	 * @param  string  $type
	 * @param  string|callable  $content
	 * @param  false  $dismissible
	 * @param  int  $priority
	 *
	 * @since 1.0.0
	 */
	public static function add(string $type, $content, bool $dismissible = false, int $priority = 10): void
	{
		$type = in_array($type, ['success', 'warning', 'error', 'info']) ? $type : 'info';

		add_action(
			'admin_notices',
			function () use ($type, $content, $dismissible) {
				View::render('notices/notice', compact('type', 'content', 'dismissible'));
			},
			$priority
		);
	}
}
