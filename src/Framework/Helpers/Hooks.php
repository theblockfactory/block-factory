<?php

namespace BlockFactory\Framework\Helpers;

use InvalidArgumentException;

class Hooks
{
	/**
	 * Add action
	 *
	 * @param  string  $hook
	 * @param  string  $class
	 * @param  string  $method
	 * @param  int  $priority
	 * @param  int  $args
	 *
	 * @since 1.0.0
	 */
	public static function addAction(
		string $hook,
		string $class,
		string $method = '__invoke',
		int $priority = 10,
		int $args = 1
	): void {
		if ( ! method_exists($class, $method)) {
			throw new InvalidArgumentException(
				sprintf('The method %s does not exist on %s', $method, $class)
			);
		}

		add_action(
			$hook,
			function () use ($class, $method) {
				call_user_func_array([BlockFactory($class), $method], func_get_args());
			},
			$priority,
			$args
		);
	}

	/**
	 * Add filter
	 *
	 * @param  string  $hook
	 * @param  string  $class
	 * @param  string  $method
	 * @param  int  $priority
	 * @param  int  $args
	 *
	 * @since 1.0.0
	 */
	public static function addFilter(
		string $hook,
		string $class,
		string $method = '__invoke',
		int $priority = 10,
		int $args = 1
	): void {
		if ( ! method_exists($class, $method)) {
			throw new InvalidArgumentException(
				sprintf('The method %s does not exist on %s', $method, $class)
			);
		}

		add_filter(
			$hook,
			function () use ($class, $method) {
				call_user_func_array([BlockFactory($class), $method], func_get_args());
			},
			$priority,
			$args
		);
	}
}
