<?php
/**
 * Renders the 'kindling/report-button' block.
 *
 * @param array    $attributes The block attributes.
 * @param string   $content The block content.
 * @param WP_Block $block The block instance.
 * @return string The rendered block HTML.
 */
function kindling_render_report_button_block( $attributes, $content, $block ) {
	// Get afterburn_report ACF field using postId from block context when inside a Post Template block.
	$btn_url  = get_field( 'afterburn_report', $block->context['postId'] );
	$btn_text = 'More Details';

	if ( ! $btn_url ) {
		return '<div role="alert"></div><p>This event doesn\'t have a link.</p></div>';
	}

	// Output the report link on the frontend.
	return '<div class="kindling-report-button"><a class="btn-textlink" href="' . esc_url( $btn_url ) . '">' . ( $btn_text ) . '</a></div>';
}
