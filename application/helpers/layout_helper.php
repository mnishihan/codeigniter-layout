<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2006 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Multi-Template Layout Library (Helper)
 *
 * This helper provide ease-of-use methods for interacting with the Layout
 * library.
 *
 * @package		Layout
 * @subpackage	Libraries
 * @version     0.9 beta
 * @category	Libraries
 * @copyright	Copyright (c) 2011 Dayle Rees.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		https://github.com/daylerees/layout
 * @author		Dayle Rees
 * @link
 */

// ------------------------------------------------------------------------

if ( ! function_exists('get_css'))
{
	function get_css($wrap = '<link rel="stylesheet" href="$1">')
	{
		$ci =& get_instance();

		$assets = $ci->load->get_var('assets');

		if(! isset($assets['css'])) return null;

		foreach($assets['css'] as $css)
		{
			echo str_replace('$1', $css, $wrap) . "\n";
		}
	}
}

if ( ! function_exists('get_js'))
{
	function get_js($wrap = '<script src="$1"></script>')
	{
		$ci =& get_instance();

		$assets = $ci->load->get_var('assets');

		if(! isset($assets['js'])) return null;

		foreach($assets['js'] as $js)
		{
			echo str_replace('$1', $js, $wrap) . "\n";
		}
	}
}