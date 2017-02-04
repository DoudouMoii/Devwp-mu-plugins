<?php
/**
 * Plugin Name: DevWP Filter Contact Form 7
 * Description: Dequeue JS and CSS when contact form 7 is not used
 * Author: Etienne Mommalier
 * Author URI: https://etienne-mommalier.fr
 * Version: 1.0
 */

defined( 'ABSPATH' ) or die();

// Only if contact form 7 is active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {

	/**
	 * @see https://contactform7.com/loading-javascript-and-stylesheet-only-when-it-is-necessary/
	 */

	add_action( 'wp_enqueue_scripts', 'devwp_enqueue_contactform7' );
	function devwp_enqueue_contactform7() {

		add_filter( 'wpcf7_load_js', '__return_false' );
		add_filter( 'wpcf7_load_css', '__return_false' );

		global $post;
		// @author: https://www.creativejuiz.fr/blog/tutoriels/astuce-wordpress-charger-fichiers-js-css-contact-form-7
		if ( strpos( $post->post_content, '[contact-form-7' ) !== false ) {
			if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
			if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
				wpcf7_enqueue_styles();
			}
		}
	}

}