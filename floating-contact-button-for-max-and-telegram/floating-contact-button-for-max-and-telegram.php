<?php
/**
 * Plugin Name: Floating Contact Button for MAX and Telegram
 * Plugin URI:  https://cryptolamer.ru/support-the-plugin-floating-contact-button-for-max-and-telegram-eng/
 * Description: Floating Contact Button (Telegram, WhatsApp, Facebook Messenger, MAX). From Russia with love.
 * Version:     1.2.1
 * Author:      alexwp12
 * License:     GPLv2 or later
 * Text Domain: floating-contact-button-for-max-and-telegram
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MAX_BUTTON_PLUGIN_FILE', __FILE__ );

// add settings
require_once plugin_dir_path( __FILE__ ) . 'includes/helpers.php';

// frontend (styles + render)
require_once plugin_dir_path( __FILE__ ) . 'includes/frontend.php';


// admin
require_once plugin_dir_path( __FILE__ ) . 'includes/admin.php';

/**
 * Add Settings link on Plugins page.
 */
add_filter(
    'plugin_action_links_' . plugin_basename( MAX_BUTTON_PLUGIN_FILE ),
    function ( $links ) {
        $settings_link = '<a href="' . admin_url( 'options-general.php?page=max-button' ) . '">' .
            esc_html__( 'Settings', 'floating-contact-button-for-max-and-telegram' ) .
        '</a>';

        array_unshift( $links, $settings_link );
        return $links;
    }
);

add_filter(
    'plugin_row_meta',
    function ( $links, $file ) {

        if ( $file !== plugin_basename( MAX_BUTTON_PLUGIN_FILE ) ) {
            return $links;
        }

        // Quick link to WP.org reviews
        $rating_link = '<a href="https://wordpress.org/support/plugin/floating-contact-button-for-max-and-telegram/reviews/#new-post" target="_blank" rel="noopener noreferrer" title="Leave a review" aria-label="Leave a five-star review" style="color:#ffb900;text-decoration:none;font-size:14px;">&#9733;&#9733;&#9733;&#9733;&#9733;</a>';

        $locale = get_locale();
        $is_ru  = ( strpos( $locale, 'ru_' ) === 0 );

        $pro_url = $is_ru
            ? 'https://cryptolamer.ru/airtheme-contact-button-pro/'
            : 'https://cryptolamer.ru/airtheme-contact-button-pro-eng/';

        // Link to PRO addon
        $pro_link = '<a href="' . esc_url( $pro_url ) . '" target="_blank" rel="noopener noreferrer">Contact Button PRO</a>';

        $links[] = $rating_link;
        $links[] = $pro_link;

        return $links;
    },
    10,
    2
);
