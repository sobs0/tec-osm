<?php
// Function to create and display leaflet shortcode, takes an array of options
function generate_leaflet_shortcode($options = array()) {
    $shortcode = '';

	
	if (in_array('all-venues', $options)) {
		// Create general map that will show all venues
		$shortcode .= '[leaflet-map zoomcontrol fitbounds]';
			
		// Get all venues
		$venues = get_posts(array('post_type' => Tribe__Events__Main::VENUE_POST_TYPE, 'posts_per_page' => -1));
		
		// Iterate through venues to create markers
        foreach ($venues as $venue) {
            $coordinates = tribe_get_coordinates($venue->ID);
			
			if ($coordinates['lat'] != 0 && $coordinates['lng'] != 0) {
                // Append marker to shortcode
                $shortcode .= '[leaflet-marker lat="' . $coordinates['lat'] . '" lng="' . $coordinates['lng'] . '"]
                    <a href="' . get_permalink($venue->ID) . '">' . $venue->post_title . '</a>
                [/leaflet-marker]';
            }
		}
		
		
	} else {
		// Get coordinates of venue
		$coordinates = tribe_get_coordinates($venue_id);
		if ($coordinates['lat'] != 0 && $coordinates['lng'] != 0) {
			$shortcode .= '[leaflet-map zoomcontrol lat="' . $coordinates['lat'] . '" lng="' . $coordinates['lng'] . '" zoom="14"]';
			$shortcode .= '[leaflet-marker lat="' . $coordinates['lat'] . '" lng="' . $coordinates['lng'] . '"]';	
		}
	}
	
    return $shortcode;
}
