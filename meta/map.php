<?php
/**
 * Single Event Meta (Map) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/map.php
 *
 * @package TribeEventsCalendar
 * @version 4.4
 */

$map = tribe_get_embedded_map();

if ( empty( $map ) ) {
	return;
}

?>

<div class="tribe-events-venue-map"> 
	<?php
	// Display OpenStreetMap
	// Get venue ID through post ID
    $venue_id = tribe_get_venue_id( $postId );
 	
	// Get lat and lng from post meta data
    if ( class_exists( 'Tribe__Events__Pro__Geo_Loc' ) ) {
        $output[ 'lat' ] = (float) get_post_meta( $venue_id, Tribe__Events__Pro__Geo_Loc::LAT, true );
        $output[ 'lng' ] = (float) get_post_meta( $venue_id, Tribe__Events__Pro__Geo_Loc::LNG, true );
    } else {
        $output = array(
            'lat' => 0,
            'lng' => 0,
        );
    }

    // Create Leaflet shortcode
    $lat = $output['lat'];
    $lng = $output['lng'];
    $shortcode = '[leaflet-map zoomcontrol lat="' . $lat . '" lng="' . $lng . '" zoom="14"]';
    $shortcode .= '[leaflet-marker lat="' . $lat . '" lng="' . $lng . '"]'; 
    echo do_shortcode($shortcode); 
	do_action( 'tribe_events_single_meta_map_section_end' );
	?>
</div>
