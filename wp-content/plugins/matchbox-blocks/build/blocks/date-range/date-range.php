<?php
/**
 * Renders ACF dates in a range.
 *
 * @package MatchboxBlocks
 */

// phpcs:disable

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'mwb-date-range';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

// Get ACF field.
$dates = get_field( 'dates', get_the_ID() );

// Bail early if no data.
if ( empty( $dates ) || empty( $dates['date_start'] ) || empty( $dates['date_end'] ) ) {
	return;
}

$date_start = $dates['date_start'];
$date_end   = $dates['date_end'];

// Optional: Handle edge cases where format might be invalid.
$date_obj_start = DateTime::createFromFormat( 'd/m/Y', $date_start );
$date_obj_end   = DateTime::createFromFormat( 'd/m/Y', $date_end );

if ( ! $date_obj_start || ! $date_obj_end ) {
	return;
}

// Optional: set style variable if used.
$style = isset( $style ) ? $style : '';

?>
<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $style ); ?>">
	<div class="date-range__dates">
		<span class="date-range__date-start">
			<?php echo esc_html( $date_obj_start->format( 'F j, Y' ) ); ?>
		</span>
		-
		<span class="date-range__date-end">
			<?php echo esc_html( $date_obj_end->format( 'F j, Y' ) ); ?>
		</span>
	</div>
	<div class="date-range__content">
		<?php echo isset( $content ) ? $content : ''; ?>
	</div>
</div>
