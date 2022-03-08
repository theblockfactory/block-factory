<?php

namespace BlockFactory\Framework\Contracts;

use WP_Error;
use RuntimeException;

abstract class Endpoint
{
	protected string $endpoint;

	/**
	 * @since 1.0.0
	 */
	public function registerRoute(): void
	{
		throw new RuntimeException('This method must be overridden to register the Rest API endpoint');
	}

	/**
	 * Check user permissions
	 *
	 * @return bool|WP_Error
	 *
	 * @since 1.0.0
	 */
	public function permissionsCheck()
	{
		if ( ! current_user_can('manage_options')) {
			return new WP_Error(
				'rest_forbidden',
				esc_html__('You dont have the right permissions to use BlockFactory plugin', 'block-factory'),
				['status' => $this->authorizationStatusCode()]
			);
		}

		return true;
	}

	/**
	 * @return int
	 * @since 1.0.0
	 */
	public function authorizationStatusCode(): int
	{
		if (is_user_logged_in()) {
			return 403;
		}

		return 401;
	}
}
