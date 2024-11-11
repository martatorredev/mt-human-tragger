<?php

// Security check to prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Function to create or update the humans.txt file
function human_tagger_generate_humans_txt() {
    // Get the content from the plugin settings
    $humans_content = get_option( 'human_tagger_humans_text', '' );

    // Define the path to the humans.txt file
    $file_path = ABSPATH . 'humans.txt';

    // Use the WP Filesystem API to handle file writing
    if ( ! function_exists( 'WP_Filesystem' ) ) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
    }

    WP_Filesystem();
    global $wp_filesystem;

    // Check if the content is being fetched correctly
    error_log( 'Humans.txt Content: ' . $humans_content ); // Log the content

    // Write the content to humans.txt
    $result = $wp_filesystem->put_contents( $file_path, $humans_content, FS_CHMOD_FILE );

    if ( $result ) {
        error_log( "humans.txt file created successfully!" );  // Debug log
        return true;
    } else {
        error_log( "Failed to create humans.txt." );  // Debug log
        return false;
    }
}


// Hook to update humans.txt when the option is saved
function human_tagger_update_humans_txt_on_save( $option ) {
    if ( $option === 'human_tagger_humans_text' ) {
        human_tagger_generate_humans_txt();
    }
}
add_action( 'update_option_human_tagger_humans_text', 'human_tagger_update_humans_txt_on_save' );

