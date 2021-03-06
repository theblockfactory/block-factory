<?php

namespace BlockFactory\Framework\Contracts;

/**
 * ServiceProvider class
 *
 * @since 1.0.0
 */
abstract class ServiceProvider
{
	/**
	 * Registers the Service Provider
	 */
	public function register() : void
	{
	}

	/**
	 * Boots the Service Provider
	 */
	public function boot() : void
	{
	}
}
