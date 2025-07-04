<?php // phpcs:disable

/**
 * Renders the 'kindling/report-button' block.
 *
 * @param array    $attributes The block attributes.
 * @param string   $content The block content.
 * @param WP_Block $block The block instance.
 * @return string The rendered block HTML.
 */

if ( ! function_exists( 'kindling_render_report_button_block' ) ) {

	function kindling_render_report_button_block( $attributes, $content, $block ) {

		// Debug: Check if ACF is available
		if ( ! function_exists( 'get_field' ) ) {
			return '<div role="alert"><p>ACF plugin not available.</p></div>';
		}

		// Debug: Check block context and try multiple ways to get post ID
		$post_id = null;

		// Method 1: Try block context
		if ( isset( $block->context['postId'] ) ) {
			$post_id = $block->context['postId'];
		} else {
			error_log( 'Report Button: postId not found in block context' );
		}

		// Method 2: Try global post
		if ( ! $post_id && in_the_loop() ) {
			$post_id = get_the_ID();
		}

		// Method 3: Try current post
		if ( ! $post_id ) {
			global $post;
			if ( $post ) {
				$post_id = $post->ID;
			}
		}

		// If we still don't have a post ID, return error
		if ( ! $post_id ) {
			return '<div role="alert"><p>Post ID not available in block context.</p></div>';
		}

		// Get afterburn_report ACF field using postId
		$btnUrl = get_field( 'afterburn_report', $post_id );

		// Get Event Title from postId from block context when inside a Post Template block
		$btnText = $attributes['text'] ?? 'More Details';

		if ( ! $btnUrl ) {
			return '';
		}

		// Output a the event link on the frontend with the title of the event.
		return '<div class="kindling-report-button"><a class="btn btn-textlink btn-download" href="' . esc_url( $btnUrl ) . '" download>' . esc_html( $btnText ) . '</a></div>';
	}
}
