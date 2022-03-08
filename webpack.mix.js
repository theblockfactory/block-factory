const mix = require('laravel-mix');
const wpPot = require('wp-pot');

mix.setPublicPath('dist')
	.sourceMaps(false)

	// admin assets
	.js('src/Blocks/resources/js/blocks.js', 'dist/js/')
	//.postCss('src/resources/css/block-factory-admin.css', 'public/css')

	// public assets
	// .js('src/resources/js/block-factory.js', 'public/js/')
	// .postCss('src/resources/css/block-factory.css', 'public/css');

mix.webpackConfig({
	externals: {
		$: 'jQuery',
		jquery: 'jQuery',
	},
});

if (mix.inProduction()) {
	wpPot({
		package: 'BlockFactory',
		domain: 'block-factory',
		destFile: 'languages/block-factory.pot',
		relativeTo: './',
		src: 'src/**/*.php',
		bugReport: 'https://blockfactory.io/support',
		team: 'BlockFactory <info@blockfactory.io>',
	});
}
