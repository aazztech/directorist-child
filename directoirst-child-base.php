<?php
/**
 * Plugin Name: Directorist - Child
 * Plugin URI: http://directorist.com/
 * Description: This is a helper plugin to customize Directorist.
 * Version: 1.0.0
 * Author: AazzTech
 * Author URI: http://directorist.com/
 * License: GPLv2 or later
 * Text Domain: directorist-business-hours
 * Domain Path: /languages
 */
// prevent direct access to the file
defined('ABSPATH') || die('No direct script access allowed!');

final class Directorist_Child
{

    /** Singleton *************************************************************/

    /**
     * @var Directorist_Child The one true Directorist_Child
     * @since 1.0
     */
    private static $instance;

    /**
     * Main Directorist_Child Instance.
     *
     * Insures that only one instance of Directorist_Child exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     *
     * @return object|Directorist_Child The one true Directorist_Child
     * @uses Directorist_Child::setup_constants() Setup the constants needed.
     * @uses Directorist_Child::includes() Include the required files.
     * @uses Directorist_Child::load_textdomain() load the language files.
     * @see  Directorist_Child()
     * @since 1.0
     * @static
     * @static_var array $instance
     */
    public static function instance()
    {
        if (!isset(self::$instance) && !(self::$instance instanceof Directorist_Child)) {
            self::$instance = new Directorist_Child;
            add_action('wp_enqueue_scripts', array(self::$instance, 'atbdp_custom_style'));
        }

        return self::$instance;
    }

    public function atbdp_custom_style()
    {
        wp_register_style('atbdp_custom_style', plugin_dir_url(__FILE__) . 'assets/public/style.css');
        wp_register_script('atbdp_custom_js', plugin_dir_url(__FILE__) . 'assets/public/main.js');
        wp_enqueue_script('atbdp_custom_js');
        wp_enqueue_style('atbdp_custom_style');
    }
    private function __construct()
    {
        /*making it private prevents constructing the object*/
    }

    public function __clone()
    {
        // Cloning instances of the class is forbidden.
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'directorist-business-hours'), '1.0');
    }

    public function __wakeup()
    {
        // Unserializing instances of the class is forbidden.
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'directorist-business-hours'), '1.0');
    }

}

/**
 * The main function for that returns Directorist_Child
 *
 * The main function responsible for returning the one true Directorist_Child
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 *
 * @return object|Directorist_Child The one true Directorist_Child Instance.
 * @since 1.0
 */
function Directorist_Child()
{
    return Directorist_Child::instance();
}

Directorist_Child(); // get the plugin running