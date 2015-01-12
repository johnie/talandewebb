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
     * Languages codes.
     * @var array
     */
    protected $languages = array(
        'sv-SE' => 'se',
        'nb-NO' => 'no',
        'fi'    => 'fi',
        'de-DE' => 'de',
        'en-GB' => 'uk',
        'en-US' => 'en'
    );
    
    /**
     * The default language.
     * @var string
     */
    protected $defaultLanguage = 'se';

    /**
     * Add plugin settings menu
     * @access public
     */
    function _tw_settings_menu() {
      add_options_page( __( $this->name, $this->tag ), __( $this->name, $this->tag ), 'manage_options', 'tw-plugin-options', array( $this, '_tw_render_plugin_options' ) );
    }


    /**
     * Render plugin settings page
     * @access public
     */
    function _tw_render_plugin_options() {
      include_once __DIR__ . '/views/plugin-options.php';
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
        add_action( 'wp_head', array( $this, '_tw_enqueue') );
      endif;

      if ( is_admin() ):
        // Add options page
        add_action( 'admin_menu', array( $this, '_tw_settings_menu') );
      endif;

      // Add shortcode
      add_shortcode( $this->tag, array( $this, '_tw_shortcode' ) );

    }


    /**
     * Allow the talandewebb shortcode to be used.
     *
     * @access public
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function _tw_shortcode( $atts, $content = null ) {

      extract( shortcode_atts( array(
        'class' => false
      ), $atts ) );

      // Build the list of class names
      $classes = array(
        $this->tag
      );

      if ( ! empty( $class ) ) {
        $classes[] = esc_attr( $class );
      }

      // Output the terminal
      ob_start();
      ?>
        <a href="#" class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>" onclick="toggleBar();"><?php echo $content; ?></a>
      <?php
      return ob_get_clean();

    }


    /**
     * Enqueue the required scripts.
     *
     * @access public
     */
    public function _tw_enqueue() {

      $lang = get_bloginfo( 'language' );
      
      if ( isset( $this->language[$lang] ) ) {
        $lang = $this->language[$lang];
      } else {
        $lang = $this->defaultLanguage;
      }

      echo '<script type="text/javascript">var _baLocale = "' . $lang . '", _baMode = " ";</script>';
      echo '<script type="text/javascript" src="https://www.browsealoud.com/plus/scripts/ba.js"></script>';

    }

  }

  new TalandeWebb();

}
