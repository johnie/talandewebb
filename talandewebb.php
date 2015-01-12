<?php
/*
* Plugin Name: Talande Webb
* Plugin URI: https://github.com/johnie/talandewebb
* Description: WordPress plugin for FunkaNU screen reader application Talande Webb
* Version: 1.0.0
* Author: Johnie Hjelm
* Author URI: http://johnie.se
* License: GPL2
*/

/*  
    Copyright 2015 Johnie Hjelm <johniehjelm@me.com> (http://johnie.se)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! class_exists( 'TalandeWebb' ) ) {

  class TalandeWebb {

    /**
     * Tag identifier used by file includes and selector attributes.
     * @var string
     */
    protected $tag = 'talandewebb';

    /**
     * User friendly name used to identify the plugin.
     * @var string
     */
    protected $name = 'Talande Webb Plus';

    /**
     * Current version of the plugin.
     * @var string
     */
    protected $version = '1.0.0';


    /**
     * Add plugin settings menu
     * @access public
     */
    function _tw_settings_menu() {
      add_theme_page( __( $name, $tag ), __( $name, $tag ), 'manage_options', 'tw-plugin-options', '_tw_render_plugin_options' );
    }


    /**
     * Render plugin settings page
     * @access public
     */
    function _tw_render_plugin_options() {
      include_once dirname( __FILE__ ) . '/views/plugin-options.php';
    }


    /**
     * Initiate the plugin by setting the default values and assigning any
     * required actions and filters.
     *
     * @access public
     */
    function __construct() {

      // Don't load Talande Webb in admin
      if ( ! is_admin() ):
        add_action( 'wp_head', array( $this, 'register_tw_script') );
      endif;

      // Add options page
      add_action( 'admin_menu', '_tw_settings_menu' );

    }


    /**
     * Enqueue the required scripts.
     *
     * @access public
     */
    public function register_tw_script() {

      echo '<script type="text/javascript">var _baLocale = "se", _baMode = " ";</script>';
      echo '<script type="text/javascript" src="https://www.browsealoud.com/plus/scripts/ba.js"></script>';

    }

  }

  new TalandeWebb();

}
