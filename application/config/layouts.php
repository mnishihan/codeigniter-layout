<?php

/*
|--------------------------------------------------------------------------
| Layout: Templates.
|--------------------------------------------------------------------------
|
| This array contains a list of templates that are available to the layout
| library. The primary array key must be the name used to identify the
| template, the value contains an array of CodeIgniter named views that
| will be rendered in sequence.
|
| Use '-YIELD-' to load the primary view that is passed to the layout
| library at run time.
|
| For example :
|
|	'my_template'	=>	array(
|		'header_template',
|		'-YIELD-',
|		'footer_template'
|	)



*/

$layout['templates'] = array(

	// default template
	'main'	=>	array(
		'template/html_head',
		'-YIELD-',
		'template/html_foot'
	)
);


/*
|--------------------------------------------------------------------------
| Layout: CSS Prefix.
|--------------------------------------------------------------------------
|
| This prefix will be prepended to your requested CSS files, and can be
| used to specify a global location for your CSS files.
|
*/

$layout['css_prefix'] = 'public/css/';

/*
|--------------------------------------------------------------------------
| Layout: JS Prefix.
|--------------------------------------------------------------------------
|
| This prefix will be prepended to your requested JS files, and can be
| used to specify a global location for your JS files.
|
*/

$layout['js_prefix'] = 'public/js/';

/*
|--------------------------------------------------------------------------
| Layout: Default Values
|--------------------------------------------------------------------------
|
| These default values will be available to all views loaded using the
| layout library. You may use the bind() method to overwrite them at
| run time.
|
*/

$layout['default_values'] = array(
	// format 'key' => 'value',
);