<?php
/*
Plugin Name: Human Tagger
Plugin URI: https://github.com/martatorredev/Human-Tagger
Description: A WordPress plugin that creates a humans.txt file and links it in the site's meta, fully compatible with the Site Editor (FSE).
Version: 1.0.0
Author: Marta Torre
Author URI: https://martatorre.dev/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: human-tagger
Domain Path: /languages
*/

// Security check to prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'HUMAN_TAGGER_VERSION', '1.0.0' );
define( 'HUMAN_TAGGER_PATH', plugin_dir_path( __FILE__ ) );
define( 'HUMAN_TAGGER_URL', plugin_dir_url( __FILE__ ) );

// Include required files
require_once HUMAN_TAGGER_PATH . 'includes/admin-settings.php';
require_once HUMAN_TAGGER_PATH . 'includes/humans-txt-generator.php';

// Hook to add the <link> tag to the <head> section
function human_tagger_add_meta_tag() {
    echo '<link rel="author" href="' . esc_url( site_url( '/humans.txt' ) ) . '">';
}
add_action( 'wp_head', 'human_tagger_add_meta_tag' );

// Load text domain for translations
function human_tagger_load_textdomain() {
    load_plugin_textdomain( 'human-tagger', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'human_tagger_load_textdomain' );

