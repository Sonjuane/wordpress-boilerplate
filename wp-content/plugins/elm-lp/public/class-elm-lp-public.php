<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://arclabs.ca
 * @since      2.0.0
 *
 * @package    Elm_Lp
 * @subpackage Elm_Lp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elm_Lp
 * @subpackage Elm_Lp/public
 * @author     ARC Labs | Applied Research Concepts <info@arclabs.ca>
 */
class Elm_Lp_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Elm_Lp_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Elm_Lp_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/elm-lp-public.css', array(), $this->version, 'all');
        wp_enqueue_style('elmp-lp-chunk-css', plugin_dir_url(__FILE__) . 'css/chunk-vendors.817bcdd8.css', array(), $this->version, 'all');
        wp_enqueue_style('elm-lp-css', plugin_dir_url(__FILE__) . 'css/app.ec1cb6f9.css', array(), $this->version, 'all');
        wp_enqueue_style('gotham-bold-font', plugin_dir_url(__FILE__) . 'fonts/gothambold1.87677e6a.woff');
        wp_enqueue_style('google-roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900');
        wp_enqueue_style('google-material-icons', 'https://fonts.googleapis.com/css?family=Material+Icons');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Elm_Lp_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Elm_Lp_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/elm-lp-public.js', array('jquery'), $this->version, false);
        wp_enqueue_script('elm-lp-app', plugin_dir_url(__FILE__) . 'js/app.ac4cf88c.js', array(), $this->version, false);
        wp_enqueue_script('elm-lp-chunk-vendors', plugin_dir_url(__FILE__) . 'js/chunk-vendors.f448a7d7.js', array(), $this->version, false);

    }

}