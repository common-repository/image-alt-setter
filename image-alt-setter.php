<?php
/*
 * Plugin Name:       Image Alt Setter
 * Plugin URI:        https://wordpress.org/plugins/image-alt-setter/
 * Description:       Sets alternative text for all images in WordPress if not available.
 * Version:           1.1
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Dhrumil Kumbhani
 * Author URI:        https://in.linkedin.com/in/dhrumil-kumbhani-707b7b179?original_referer=https%3A%2F%2Fwww.google.com%2F
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       image-alt-setter
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

// Set alternative text for all images
function IAS_set_all_image_alt_text() {
    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => -1,
    );

    $attachments = get_posts($args);

    foreach ($attachments as $attachment) {
        if (empty(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true))) {
            // Set the alt text to the image title
            update_post_meta($attachment->ID, '_wp_attachment_image_alt', $attachment->post_title);
        }
    }
}
add_action('wp_loaded', 'IAS_set_all_image_alt_text');
