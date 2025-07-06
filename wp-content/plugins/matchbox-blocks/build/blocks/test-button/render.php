<?php // phpcs:ignoreFile
/**
 * Test Button Block Render.
 *
 * @package Matchbox_Blocks
 * @category Blocks
 * @author  Your Name
 * @license GPL-2.0-or-later
 * @link    https://example.com
 */

/**
 * Dynamically render the button link on front end.
 *
 * @param array $attributes Block attributes.
 *
 * @return string Rendered HTML.
 */
function kindling_dynamic_button_render( $attributes ) {

	$label     = $attributes['label'] ?? 'Click me';
	$site_id   = $attributes['siteId'] ?? 0;
	$meta_key  = $attributes['metaKey'] ?? '';
	$post_id   = $attributes['postId'] ?? 0;
	$className = $attributes['className'] ?? '';

	// Get the URL from the specified site and post.
	$url = '';
	if ( $site_id && $meta_key && $post_id ) {
		// Switch to the specified site if in multisite.
		if ( is_multisite() && $site_id !== get_current_blog_id() ) {
			switch_to_blog( $site_id );
		}

		// Get the meta value.
		$url = get_field( $meta_key, $post_id );


		// Restore to current site if we switched.
		if ( is_multisite() && $site_id !== get_current_blog_id() ) {
			restore_current_blog();
		}
	}

	// If no URL found, return empty or placeholder.
	if ( empty( $url ) ) {
		return '<div class="wp-block-kindling-dynamic-button ' . esc_attr( $className ) . '">' .
				'<span class="button-placeholder">' . esc_html( $label ) . '</span>' .
				'</div>';
	}

	// Build the button HTML.
	$button_html = '<a href="' . esc_url( $url ) . '" class="button" target="_blank" rel="noopener">' .
					esc_html( $label ) .
					'</a>';

	return '<div class="wp-block-kindling-dynamic-button ' . esc_attr( $className ) . '">' .
			$button_html .
			'</div>';
}

return kindling_dynamic_button_render( $attributes );
