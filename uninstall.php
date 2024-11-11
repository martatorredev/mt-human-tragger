<?php

// If uninstall.php is not called by WordPress, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Delete the plugin option from the database
delete_option( 'human_tagger_humans_text' );

// Delete the humans.txt file from the root directory
$file_path = ABSPATH . 'humans.txt';
if ( file_exists( $file_path ) ) {
    unlink( $file_path );
}

