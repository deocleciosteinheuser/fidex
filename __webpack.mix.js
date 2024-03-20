const { JSDOM } = require('jsdom');
let jquery  = require('jquery');
let laravelmix  = require('laravel-mix');

const { window   } = new JSDOM( "<html></html>" );
$ = jquery( window );

laravelmix
// Compile the JavaScript files and output to 'public/js'
    .js('resources/js/app.js', 'public/js')
// Compile the CSS files and output to 'public/scc'
    .css('resources/css/app.css', 'public/css');
