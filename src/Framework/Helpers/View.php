<?php

namespace BlockFactory\Framework\Helpers;

use InvalidArgumentException;

/**
 * View helper class
 * @since 1.0.0
 */
class View
{
	/**
	 * @param  string  $path
	 * @param  array  $args
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	public static function load(string $path, array $args = []): string
	{
		$template = self::getTemplatePath($path);

		if ( ! file_exists($template)) {
			throw new InvalidArgumentException("Template file {$template} does not exist");
		}

		ob_start();

		if ( ! empty($args)) {
			extract($args, EXTR_OVERWRITE);
		}

		include $template;

		return ob_get_clean();
	}

	/**
	 * @param  string  $path
	 * @param  array  $args
	 *
	 * @since 1.0.0
	 *
	 */
	public static function render(string $path, array $args = []): void
	{
		echo static::load($path, $args);
	}

	/**
	 * @param  string  $path
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	private static function getTemplatePath(string $path): string
	{
		if (strpos($path, '.')) {
			[$domain, $file] = explode('.', $path, 2);

			return BF_PLUGIN_DIR . "src/{$domain}/resources/views/{$file}.php";
		}

		return BF_PLUGIN_DIR . "src/resources/views/{$path}.php";
	}
}
