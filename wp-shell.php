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
        echo '
        <div class="wrap">
            <h2>WP Shell</h2>
            <iframe style="width: 100%; height: 450px;"
                    src="/wp-admin/tools.php?page=wp-shell&p0wnyshell">
            </iframe>
            <a href="/wp-admin/tools.php?page=wp-shell&p0wnyshell" target="_blank">
                Open in new tab.
            </a>
            <p>Developed by Juan Pablo Juliao <a href="//twitter.com/jpjuliaor">@jpjuliaor</a></p>
        </div>';
    }

    /**
     * Render shell page
     * @return void
     */
    public function shell_page($screen) {
        if (
            $screen->id != 'tools_page_wp-shell'
            || !isset($_GET['p0wnyshell'])
        ) {
            return;
        };
        include 'p0wny-shell/shell.php';
        exit;
    }
 
}
 
new Jpjuliao_WP_Shell();