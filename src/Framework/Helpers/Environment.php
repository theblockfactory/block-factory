<?php

namespace BlockFactory\Framework\Helpers;

/**
 * Environment helper class
 *
 * @since 1.0.0
 */
class Environment
{
	/**
	 * Check if environment is running min. required PHP version
	 *
	 * @param  string  $version
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 */
	public static function runningRequiredVersion(string $version): bool
	{
		return version_compare(PHP_VERSION, $version, '>=');
	}

	/**
	 * @return bool
	 * @since 1.0.0
	 */
	public static function isBlockEditorEnabled(): bool
	{
		return function_exists('register_block_type');
	}

	/**
	 * @return bool
	 * @since 1.0.0
	 */
	public static function isBlockEditorScreen(): bool
	{
		return get_current_screen()->is_block_editor;
	}
}
