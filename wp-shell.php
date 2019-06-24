<?php
/**
 * Plugin Name: WP Shell
 * Author: Juan Pablo Juliao
 * Author URI: jpjuliao.com
 * Version: 1.0
 */

if ( !defined('ABSPATH') ) exit;

class Jpjuliao_WP_Shell {
 
    /**
     * Autoload method
     * @return void
     */
    public function __construct() {
        add_action( 'admin_menu', array(&$this, 'register_sub_menu') );
        add_action( 'current_screen', array(&$this, 'shell_page') );
    }
 
    /**
     * Register submenu
     * @return void
     */
    public function register_sub_menu() {
        add_submenu_page( 
            'tools.php', 
            'WP Shell', 
            'WP Shell', 
            'manage_options', 
            'wp-shell', 
            array(&$this, 'submenu_page_callback')
        );
    }
 
    /**
     * Render submenu
     * @return void
     */
    public function submenu_page_callback() {
        echo '<div class="wrap">';
        echo '<h2>WP Shell</h2>';
        echo '<iframe src="/?shell">';
        include 'p0wny-shell/shell.php';
        echo '</div>';
    }

    /**
     * Render shell page
     * @return void
     */
    public function shell_page($screen) {
        if (!isset($_GET['shell'])) return;
        var_dump($screen);
    }
 
}
 
new Jpjuliao_WP_Shell();