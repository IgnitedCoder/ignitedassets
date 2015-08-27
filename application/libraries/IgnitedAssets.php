<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: brendanrehman
 * Date: 8/24/15
 * Time: 12:14 PM
 */
class IgnitedAssets
{
    var $scripts;
    var $styles;
    var $asset_vars = array();
    protected $CI;
    /**
     * __construct()
     *
     * Constructor	PHP 5+	NOTE: Not needed if not setting values!
     *
     * @access	public
     * @return	void
     */
    public function __construct($config = null)
    {
        $this->asset_vars['styles'] = array();
        $this->asset_vars['scripts'] = array();
        $this->CI =& get_instance();
        $this->CI->config->load($config);
        $this->_add_styles($this->CI->config->item('styles'));
        $this->_add_scripts($this->CI->config->item('scripts'));

    }

    /*
    * Instead of adding a style in the view ...
    * you can add it in the controller so it is easier to manage.
    */
    public function _add_styles($styles)
    {
        if (!is_array($styles)) {
            $style = $styles;
            $styles = array($style);
        }

        $this->asset_vars['styles'] = array_merge($this->asset_vars['styles'], $styles);

    }

    /*
    * Instead of adding a script in the view ...
    * you can add it in the controller so it is easier to manage.
    * @return void
    */
    public function _add_scripts($scripts)
    {
        if (!is_array($scripts)) {
            $script = $scripts;
            $scripts = array($script);
        }

        $this->asset_vars['scripts'] = array_merge($this->asset_vars['scripts'], $scripts);
    }


    /*
    * Set all Styles and Scripts in the Main Template ...
    * @return void
    */
    public function _initialize_style_scripts()
    {

        $processed_styles = '';
        $processed_scripts = '';

        foreach ($this->asset_vars['styles'] as $style) {
            $processed_styles .= link_tag($style);
        }

        foreach ($this->asset_vars['scripts'] as $script) {
            $processed_scripts .= '<script src="'.($script) .'"></script>'."\n";
        }

        $this->asset_vars['styles'] = $processed_styles;
        $this->asset_vars['scripts'] = $processed_scripts;

        $this->CI->load->vars($this->asset_vars);

    }

}