<?php
/**
 * View: Venue meta - Map
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/venue/map/map.php
 *
 * See more documentation about our views templating system.
 *
 * @link https://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $venue The venue post object.
 * @var object $map_provider Object with data of map provider.
 *
 */

// Check if coordinates are available
if (
	get_post_meta( $venue->ID, '_VenueOverwriteCoords', true )
	&& ! empty( $venue->geolocation->latitude )
	&& ! empty( $venue->geolocation->longitude )
) {
	// Create Leaflet shortcode
	$lat = (float) $venue->geolocation->latitude;
	$lng = (float) $venue->geolocation->longitude;
	$shortcode = '[leaflet-map zoomcontrol lat="' . $lat . '" lng="' . $lng . '" zoom="14"]';
	$shortcode .= '[leaflet-marker lat="' . $lat . '" lng="' . $lng . '"]'; 
	echo do_shortcode($shortcode);
}
?>
