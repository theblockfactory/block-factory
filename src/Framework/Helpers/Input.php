<?php

namespace BlockFactory\Framework\Helpers;

use InvalidArgumentException;

/**
 * Input helper class
 * @since 1.0.0
 *
 * @method static get(string $name, string $filter = '', array|int $options = 0)
 * @method static post(string $name, string $filter = '', array|int $options = 0)
 * @method static cookie(string $name, string $filter = '', array|int $options = 0)
 * @method static server(string $name, string $filter = '', array|int $options = 0)
 * @method static env(string $name, string $filter = '', array|int $options = 0)
 */
class Input
{
	/**
	 * Get filtered input value
	 *
	 * @return string|bool|null
	 *
	 * @since 1.0.0
	 *
	 */
	public static function __callStatic(string $name, array $args)
	{
		static $instance = null;

		if (is_null($instance)) {
			$instance = new static();
		}

		return $instance->filter($name, $args);
	}

	/**
	 * Filter input value
	 *
	 * @param  string  $name
	 * @param  array  $args
	 *
	 * @return string|bool|null
	 *
	 * @since 1.0.0
	 *
	 */
	private function filter(string $name, array $args)
	{
		[$parameter, $filter, $options] = array_pad($args, 3, null);

		return filter_input(
			$this->getMethod($name),
			$parameter,
			$this->getFilter($filter ?? ''),
			$options
		);
	}

	/**
	 * Get input method
	 *
	 * @param  string  $name
	 *
	 * @return int
	 *
	 * @since 1.0.0
	 */
	private function getMethod(string $name): int
	{
		switch ($name) {
			case 'get':
                return INPUT_GET;
			case 'post':
				return INPUT_POST;
			case 'cookie':
				return INPUT_COOKIE;
			case 'server':
				return INPUT_SERVER;
			case 'env':
				return INPUT_ENV;
			default:
                throw new InvalidArgumentException("Method {$name} is not supported");
		}
	}


	/**
	 * Get filter
	 *
	 * @see http://php.net/manual/en/function.filter-list.php
	 *
	 * @param  string  $name
	 *
	 * @return int
	 *
	 * @since 1.0.0
	 */
	private function getFilter(string $name): int
	{
		if (in_array($name, filter_list(), true)) {
			return filter_id($name);
		}

		return FILTER_SANITIZE_STRING;
	}

}
