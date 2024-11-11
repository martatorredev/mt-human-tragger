<?php

// Security check to prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add an options page for the plugin in the Settings menu
function human_tagger_add_admin_menu() {
    add_options_page(
        __('Human Tagger Settings', 'human-tagger'),
        __('Human Tagger', 'human-tagger'),
        'manage_options',
        'human-tagger',
        'human_tagger_settings_page'
    );
}
add_action( 'admin_menu', 'human_tagger_add_admin_menu' );

// Display the settings page
function human_tagger_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e( 'Human Tagger Settings', 'human-tagger' ); ?></h1>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'human_tagger_settings' );
                do_settings_sections( 'human-tagger' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register the settings, section, and field
function human_tagger_settings_init() {
    register_setting( 'human_tagger_settings', 'human_tagger_humans_text' );

    add_settings_section(
        'human_tagger_section',
        __( 'Customize your humans.txt content', 'human-tagger' ),
        'human_tagger_section_callback',
        'human-tagger'
    );

    add_settings_field(
        'human_tagger_humans_text',
        __( 'humans.txt Content', 'human-tagger' ),
        'human_tagger_humans_text_render',
        'human-tagger',
        'human_tagger_section'
    );
}
add_action( 'admin_init', 'human_tagger_settings_init' );

// Callback function for the settings section description
function human_tagger_section_callback() {
    echo __( 'Enter the information you want to include in your humans.txt file below.', 'human-tagger' );
}

// Render the textarea for the humans.txt content
function human_tagger_humans_text_render() {
    $humans_text = get_option( 'human_tagger_humans_text', '' );
    echo '<textarea name="human_tagger_humans_text" rows="10" cols="50" class="large-text code">' . esc_textarea( $humans_text ) . '</textarea>';
}

