<?php
/**
 * Plugin Name: WP Shell
 * Description: Adds a WordPress admin page with a PHP shell app powered by [p0wny-shell](https://github.com/flozz/p0wny-shell).
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
        ?>
        <div class="wrap">
            <h2>WP Shell</h2>
            <iframe style="width: 100%; height: 450px;"
                    src="/wp-admin/tools.php?page=wp-shell&p0wnyshell">
            </iframe>
            <!-- <a href="/wp-admin/tools.php?page=wp-shell&p0wnyshell" target="_blank">
                Open in new tab.
            </a> -->
            <button id="popup-shell">Open in new window</button>
            <script>
                !(function(){
                    'use strict';
                    jQuery(document).ready(function($){
                        $('#popup-shell').click(function(){
                            let params = [
                                'scrollbars=no',
                                'resizable=no',
                                'toolbar=no',
                                'menubar=no',
                                'height=350',
                                'top=0',
                                'bottom=0'
                            ];
                            open(
                                '/wp-admin/tools.php?page=wp-shell&p0wnyshell', 
                                'WP Shell', 
                                params.join(',')
                            );
                        });
                    });
                })();
            </script>
            <p>Developed by Juan Pablo Juliao 
                <a target="_blank" href="//twitter.com/jpjuliaor">@jpjuliaor</a>
            </p>
        </div>
        <?php
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