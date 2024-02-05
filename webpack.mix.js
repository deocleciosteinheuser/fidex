const { JSDOM } = require( "jsdom" );
const { window   } = new JSDOM( "<html></html>" );
$ = require( "jquery" )( window );
// Import the 'laravel-mix' library
let mix = require('laravel-mix');

// Compile the JavaScript files and output to 'public/js'
mix.js('resources/js/app.js', 'public/js')

// Compile the CSS files and output to 'public/scc'
    .css('resources/css/app.css', 'public/css');
