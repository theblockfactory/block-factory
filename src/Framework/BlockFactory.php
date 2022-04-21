<?php

namespace BlockFactory\Framework;

use BlockFactory\BlockBuilder\ServiceProvider as BlockBuilder;
use BlockFactory\Blocks\ServiceProvider as Blocks;
use BlockFactory\Framework\Contracts\ServiceProvider;
use BlockFactory\Framework\Helpers\Environment;
use BlockFactory\Framework\Helpers\Notices;
use DI\Container;
use InvalidArgumentException;

/**
 * BlockFactory class
 * @since 1.0.0
 */
class BlockFactory extends Container
{
	/**
	 * @var string[]
	 */
	private array $serviceProviders = [
		BlockBuilder::class,
		Blocks::class,
	];

	/**
	 * @var bool
	 */
	private bool $serviceProvidersLoaded = false;

	/**
	 * BlockFactory Bootstrap
	 * @since 1.0.0
	 */
	public function boot(): void
	{
		// Check PHP version
		if ( ! Environment::runningRequiredVersion('7.4.0')) {
			Notices::add(
				'error',
				sprintf(__('minimum required PHP version is 7.4. Your site is running on PHP %s', 'block-factory'), PHP_VERSION)
			);

			return;
		}

		// Check if Block Editor is enabled
		if ( ! Environment::isBlockEditorEnabled()) {
			Notices::add(
				'error',
				__('Block Editor (Gutenberg) is not enabled. Please update your WordPress to the latest version.', 'block-factory')
			);

			return;
		}

		add_action('plugins_loaded', [$this, 'init'], 0);
	}

	/**
	 * Initialize BlockFactory
	 * @since 1.0.0
	 */
	public function init(): void
	{
        /**
         * Fire block factory init action
         */
        do_action('block_factory_init');

		$this->loadTextDomain();
		$this->loadServiceProviders();
	}

	/**
	 * Load service providers
	 * @since 1.0.0
	 */
	private function loadServiceProviders(): void
	{
		if ($this->serviceProvidersLoaded) {
			return;
		}

		$providers = [];

		foreach ($this->serviceProviders as $serviceProvider) {
			if ( ! is_subclass_of($serviceProvider, ServiceProvider::class)) {
				throw new InvalidArgumentException(
					sprintf('%s class must extend the %s class', $serviceProvider, ServiceProvider::class)
				);
			}

			$provider = $this->get($serviceProvider);
			$provider->register();
			$providers[] = $provider;
		}

		foreach ($providers as $provider) {
			$provider->boot();
		}

		$this->serviceProvidersLoaded = true;
	}

	/**
	 * Register Service Provider
	 *
	 * @param  string  $provider
	 *
	 * @since 1.0.0
	 */
	public function registerServiceProvider(string $provider): void
	{
		if ( ! array_key_exists($provider, $this->serviceProviders)) {
			$this->serviceProviders[] = $provider;
		}
	}

	/**
	 * Load plugin textdomain
	 * @since 1.0.0
	 */
	private function loadTextDomain(): void
	{
		load_plugin_textdomain('block-factory', false, BF_PLUGIN_DIR . '/languages');
	}
}
