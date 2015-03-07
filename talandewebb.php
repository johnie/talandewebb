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

// Require API
require_once(__DIR__ . '/inc/api.php');

if ( ! class_exists( 'TalandeWebb' ) ) {

  class TalandeWebb {

    private static $instance;

    /**
     * Tag identifier used by file includes and selector attributes.
     * @var string
     */

    public $tag;


    /**
     * User friendly name used to identify the plugin.
     * @var string
     */

    public $name;


    /**
     * Current version of the plugin.
     * @var string
     */

    public $version;


    /**
     * Languages codes.
     * @var array
     */

    public $languages;

    /**
     * The default language.
     * @var string
     */

    protected $defaultLanguage;


    /**
     * Talandewebb loader instance.
     *
     * @since 1.2.1
     *
     * @return object
     */

    public static function instance() {
      if ( ! isset( self::$instance ) ) {
         self::$instance = new static;
         self::$instance->setup_globals();
         self::$instance->setup_actions();
      }

      return self::$instance;
    }


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
     * @access private
     */

    private function setup_actions() {

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
     * Global variables
     */

    private function setup_globals() {
      $this->tag = 'talandewebb';
      $this->name = 'Talande Webb Plus';
      $this->description = 'För att Talande Webb Plus ska fungera optimalt för dina besökare lägger du in ett script som sätter en cookie (kaka) på webbplatsen. På sidan där du beskriver hur Talande Webb fungerar lägger du till en förklarande text om Talande Webb Plus och en länk som tänder själva verktygsfältet för Talande Webb Plus.';
      $this->version = '1.2.1';
      $this->languages = array(
          'sv-SE' => 'se',
          'nb-NO' => 'no',
          'fi'    => 'fi',
          'de-DE' => 'de',
          'en-GB' => 'uk',
          'en-US' => 'en'
      );
      $this->defaultLanguage = 'se';
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

      shortcode_atts( array(
        'class' => false
      ), $atts );

      // Build the list of class names
      $classes = array(
        $this->tag
      );

      if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
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

      $activate_talandewebb = talandewebb_get_plugin_option( 'activation' );

      if ( $activate_talandewebb == 'on' ) {
        echo '<script type="text/javascript">var _baLocale = "' . $lang . '", _baMode = " ";</script>';
        echo '<script type="text/javascript" src="https://www.browsealoud.com/plus/scripts/ba.js"></script>';
      }

    }

  }

}

if ( !function_exists( 'talandewebb' ) ) {
  function talandewebb() {
    return TalandeWebb::instance();
  }
}

add_action( 'plugins_loaded', 'talandewebb' );
