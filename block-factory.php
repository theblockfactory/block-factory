<?php
/**
 * Plugin Name:         Block Factory
 * Plugin URI:          https://blockfactory.io/
 * Description:         Visual builder for Gutenberg blocks
 * Version:             1.0.0
 * Requires at least:   5.8
 * Requires PHP:        7.4
 * Author:              Block Factory
 * Author URI:          https://blockfactory.io/
 * Text Domain:         block-factory
 * Domain Path:         /languages
 */
require __DIR__ . '/vendor/autoload.php';

define('BF_VERSION', '1.0.0');
define('BF_PLUGIN_FILE', __FILE__);
define('BF_PLUGIN_DIR', plugin_dir_path(BF_PLUGIN_FILE));
define('BF_PLUGIN_URL', plugin_dir_url(BF_PLUGIN_FILE));

BlockFactory()->boot();
