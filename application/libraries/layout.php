<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Multi-Template Layout Library
 *
 * This class enables you to render advanced templates consisting of a
 * number of different CodeIgniter style view files.
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
class Layout
{
	// config loaded templates
	private $templates 				= array();

	// values set by the chain
	private $active_template 		= 'main';
	private $assets 				= array();
	private $data 					= array();

	// reference to the codeigniter object
	private $ci;

	// layout config
	private $config;

	public function __construct()
	{
		// get the config
		include(APPPATH.'config/layout.php');

		// save the config for later
		$this->config = $layout;

		// set the templates from the config
		$this->templates = $this->config['templates'];

		// get hold of the codeigniter object
		$this->ci =& get_instance();
	}

	// --------------------------------------------------------------------	

	/**
	 * Render the view.
	 * 
	 * @access public
	 * @param string The view to display.
	 * @param array Data to provide to the view.
	 * @return void
	 */
	public function show($view, $data = null)
	{
		// if we have been given data, merge it
		if($data != null && is_array($data))
		{
			$this->data = array_merge($this->data, $data);
		}

		// fill the blanks!
		$this->data = $this->_prepare($this->data);

		if(! isset($this->templates[$this->active_template]))
		{
			// if the template doesnt exist, show an error
			echo "Template '{$this->active_template}' not found.";
			return false;
		}

		// loop through each template view
		foreach($this->templates[$this->active_template] as $temp)
		{
			// yield inserts the main content
			if($temp === '-YIELD-')
			{
				$this->ci->load->view($view, $this->data);
			}
			else
			{
				// load the view with the class data array
				$this->ci->load->view($temp, $this->data);
			}
			
		}

		// reset the chain, clankety clank
		$this->_cleanup();
	}

	// --------------------------------------------------------------------	

	/**
	 * Select a different template.
	 * 
	 * @access public
	 * @param string The name of the template.
	 * @return Layout
	 */
	public function template($template)
	{
		// set the template to use, defaults to the first
		$this->active_template = $template;

		return $this;
	}

	// --------------------------------------------------------------------	

	/**
	 * Attach a JavaScript to this view.
	 * 
	 * @access public
	 * @param mixed The name of the javascript file, or array.
	 * @param boolean Add the javascript prefix?
	 * @return Layout
	 */	
	public function js($asset, $prefix = true)
	{
		// check to see if we have an array of assets
		if(is_array($asset))
		{
			// loop the given array passing back to this method
			foreach ($asset as $a)
			{
				$this->js($a, $prefix);
			}
		}
		else
		{
			// add the asset to the assets array
			if($prefix) $asset = $this->config['js_prefix'] . $asset;
			$this->assets['js'][] = $asset;
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Attach a CSS stylesheet to this view.
	 * 
	 * @access public
	 * @param mixed The name of the stylesheet file, or array.
	 * @param boolean Add the CSS prefix?
	 * @return Layout
	 */		
	public function css($asset, $prefix = true)
	{
		// check to see if we have an array of assets
		if(is_array($asset))
		{
			// loop the given array passing back to this method
			foreach ($asset as $a)
			{
				$this->css($a, $prefix);
			}
		}
		else
		{
			// add the asset to the assets array
			if($prefix) $asset = $this->config['css_prefix'] . $asset;
			$this->assets['css'][] = $asset;
		}

		return $this;	
	}

	// --------------------------------------------------------------------	

	/**
	 * Bind a value to the view.
	 * 
	 * @access public
	 * @param string The variable name.
	 * @param mixed The value.
	 * @return Layout
	 */		
	public function bind($key, $value)
	{
		// add the value to our data array
		$this->data[$key] = $value;

		return $this;
	}

	// --------------------------------------------------------------------	

	/**
	 * Bind a value to the view.
	 * 
	 * @access private
	 * @param array The view data array.
	 * @return array The Modified view data array.
	 */	
	private function _prepare($data)
	{
		// bind our assets
		$data['assets'] = $this->assets;

		// add our default values, but existing ones take priority
		$data = array_merge($this->config['default_values'], $data);

		return $data;
	}

	// --------------------------------------------------------------------	

	/**
	 * Reset all values after a chain trigger.
	 * 
	 * @access private
	 */	
	private function _cleanup()
	{
		// reset the chain using default values
		$this->active_template = 'main';
		$this->assets = array();
		$this->data = array();		
	}
}