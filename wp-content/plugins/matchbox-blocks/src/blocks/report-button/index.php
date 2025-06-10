<?php

/**
 * Registers the 'kindling/report-button' block.
 */
function Kindling_Register_Report_Button_Block() {
	register_block_type( __DIR__ );
}
add_action( 'init', 'Kindling_Register_Report_Button_Block' );

/**
 * Renders the 'kindling/report-button' block.
 *
 * @param array    $attributes The block attributes.
 * @param string   $content The block content.
 * @param WP_Block $block The block instance.
 * @return string The rendered block HTML.
 */
function kindling_render_report_button_block( $attributes, $content, $block ) {
	// Get afterburn_report ACF field using postId from block context when inside a Post Template block
	$btnUrl = get_field( 'afterburn_report', $block->context['postId'] );
	// Get Event Title from postId from block context when inside a Post Template block
	$btnText = 'More Details';

	if ( ! $btnUrl ) {
		return '<div role="alert"></div><p>This event doesn\'t have a link.</p></div>';
	}

	// Output a the event link on the frontend with the title of the event.
	return '<div class="kindling-report-button"><a class="btn-textlink" href="' . esc_url( $btnUrl ) . '">' . ( $btnText ) . '</a></div>';
}
