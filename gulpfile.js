var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

	// Application styles
    
    mix
	    .sass('app.scss')
	    .copy('bower_components/bootstrap/fonts', 'public/fonts')
	    .styles([
	    	'/bower_components/bootstrap/dist/css/bootstrap.css',
	    	'/public/css/app.css',
	    ], 'public/css/app-bundle.css', './');

});

elixir(function(mix) {

	// Preview styles
    
    mix
    	.sass('preview.scss', 'public/css/preview.css')
	    .styles([
	    	//'/bower_components/bootstrap/dist/css/bootstrap.css',
	    	'/public/css/preview.css',
	    ], 'public/css/preview-bundle.css', './');

});

elixir(function(mix) {

	// Application scripts

	mix.scripts([
		'/bower_components/jquery/dist/jquery.min.js',
		'/bower_components/bootstrap/dist/js/bootstrap.js',
		'/resources/assets/js/app.js',
	], 'public/js/app-bundle.js', './');

});

elixir(function(mix) {

	// Preview scripts

	mix.scripts([
		'/bower_components/jquery/dist/jquery.min.js',
		'/bower_components/bootstrap/dist/js/bootstrap.js',
		'/bower_components/yamljs/bin/yaml.js'
	], 'public/js/preview-bundle.js', './');

});