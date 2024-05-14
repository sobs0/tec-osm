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

echo do_shortcode(generate_leaflet_shortcode());
?>
