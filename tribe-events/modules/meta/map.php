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

?>

<div class="tribe-events-venue-map"> 
	<?php
	 
    echo do_shortcode(generate_leaflet_shortcode()); 
	do_action( 'tribe_events_single_meta_map_section_end' );
	?>
</div>
