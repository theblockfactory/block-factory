const path = require('path');
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	resolve: {
		alias: {
			'@blockfactory': path.resolve(__dirname, 'src/BlockBuilder/resources/js/'),
		},
	},
};
