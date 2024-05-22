# Extensions to use The Events Calendar maps in compliance with GDPR (+ a few helpful additional customisations)

Save money and offer your users more privacy by replacing GoogleMaps with OpenStreetMaps on websites using The Events Calendar.


### Overview of customization results of this repository:

- Display OpenStreetMap instead of Google Maps on The Events Calendar event detail page and venue page
- New shortcode to display a map of all venues 
- Avoid loading the GoogleMaps API on the website
- Display user approval banner for all OpenStreet Maps created by Leaflet Maps shortcodes
- Host Leaflet js und css files locally
- Display custom global map marker


## Why?

These customisations are mainly designed for European users of The Events Calendar plugin to make it compliant with GDPR rules because of the concerning role of Google APIs and data privacy. 
If your concern is not about data privacy you might sill benefit from this customisation, as OpenStreetMaps is completely free of charge, unlike Google Maps.

Thanks to [Hans-Gerd](https://haurand.com/the-events-calendar-und-openstreetmaps/) and [Gerd Weyhing](https://woyng.com/the-events-calendar-mit-openstreetmaps-statt-google-maps/) for the inspiration.


## Required Plugins
- The Events Calendar (TEC) (https://wordpress.org/plugins/the-events-calendar/)
- The Events Calendar Pro (not required for all, but only tested in combination)
- LeafletMap (https://de.wordpress.org/plugins/leaflet-map/)

## Customisations

### Display OpenStreetMap instead of Google Maps on The Events Calendar event detail page and venue page

We will create a custom function "generate_leaflet_shortcode()" in our child theme and use this functions in TEC templates to display OpenStreetMaps instead of Google Maps using Leaflet shortcodes.

Note: These customisations will not replace Google Maps for the TEC Calendar Map view. 
If you have a solution for that feel free to reach out to me to include this in the repository. 

#### Required child-theme structure/files (replace 'astra-child' with your child theme name):
Note: TEC uses different templates depending on using their provided GoogleMaps API Key or using your own. With these customisations we will cover both options.

- /wp-content/themes/astra-child/tribe-events/modules/meta/map.php
- /wp-content/themes/astra-child/tribe-events/modules/map.php
- /wp-content/themes/astra-child/tribe-events/modules/map-basic.php
- /wp-content/themes/astra-child/tribe/events-pro/v2/venue/meta/map.php (requires TEC pro)
- /wp-content/themes/astra-child/includes/leaflet-functions.php

If directory/files don't exist create them first and then insert the content of the corresponding files of this repository.

### Create shortcode to display all TEC venues on a map

Place this code in your **functions.php** to create a new shortcode called "[tribe_venue_map]".
You can then use this shortcode in your favourite page builder to show a map of all venues with pop-ups of the venue's name and link to the venue page.
To create this shortcode we use our custom function and pass an argument to get a shortcode for all existing venues of this page "generate_leaflet_shortcode(array('all-venues'))".

```
// Import the functions of leaflet-functions.php 
require_once( get_stylesheet_directory() . '/includes/leaflet-functions.php' );

/**
* Create shortcode [tribe_venue_map] to display all venues map on homepage
*/
function all_venues_map_shortcode() {
    echo generate_leaflet_shortcode(array('all-venues'));
}

add_shortcode('tribe_venue_map', 'all_venues_map_shortcode');
```


### Host Leaflet assets locally

Leaflet requires js and css files that are delivered via CDN by default. To avoid asking users for permission we host these files locally.
You can check in your browser developement tools > sources if the assets are loaded through a CDN. 
After following these steps you can check again to make sure it worked.

#### Required steps:

1. Download the latest Leaflet assets on the official website: https://leafletjs.com/download.html
2. Unpack the downloaded .zip folder
3. Upload the unzipped folder called to your "/wp-content/uploads/" directory. In our case the folder name is "leaflet", make sure to adjust this solution if you name it differently.
4. Navigate to the Leaflet Map plugin settings in the Wordpress Dashboard > Leaflet Map > Settings. Scroll down to the bottom until you see two setting options "JavaScript-URL" and "CSS-URL". Make sure to replace "your-website.com" with your domain in the following steps:
6. Replace the JavaScript-URL: https://your-website.com/wp-content/uploads/leaflet/leaflet.js
7. Replace the CSS-URL: https://your-website.com/wp-content/uploads/leaflet/leaflet.css
8. You're done!

Note: You should regularly check for new versions of leaflet on their official website and update your local files.

### Custom global map marker

It is required to host the leaflet assets locally to implement this solution (see step before). 
Another way to show custom markers is to use the Leaflet shortcode option for that, e.g. to display differnet markers on different maps.

In case you want to have a custom marker for your maps and you don't want to rely on Leaflet shortcodes options to specify the custom image for every shortcode, you can replace the image on your locally hosted leaflet assets folder. This will change the marker globaly, so for every map on your site.


#### Required steps:

1. Prepare your images. Make sure you have a proper images prepared that will server as your marker (make sure the file size is very small to avoid longer loading times).
2. Navigate to the place where the default images are stored: "/wp-content/uploads/leaflet/images".
3. You will see two files "marker-icon.png" and "marker-icon-2x.png" that you will have to replace with your own images. In case you want to have a custom shadow replace this image as well.
4. Upload your own images in this folder and name them exactly the same. You can delete the default images or rename them if you want to keep them.
5. Check your maps in the frontend and adjust the images proportions in case you'r not happy yet (might have to play around a bit).

Note: In case you replace the folder with a new leaflet version these changes might be gone. Follow these steps again or do not replace the image directory when updating. 


### User approval banner for all OpenStreet Maps created by Leaflet Maps shortcodes

Note: This solution is only tested in combination with the GDPR plugin "Complianz". This might not work with other cookie consent plugins.

Most cookie consent plugins already provide possibilities to block regular OpenStreetMaps scripts and display an user approval banner to comply with GDPR.
However, using Leaflet shortcodes, this might not be enough, additional steps are reuired to block scripts and show approval banner.
There is an existing mu-plugin that solves this problem.

#### Required steps:

1. Download the file of this GitHub repository (thanks to @rlankhorst): https://github.com/Really-Simple-Plugins/complianz-integrations/blob/9bceb7ddcc126b6fddbe210d9aaabf0608de48b2/Google%20Maps/leaflet-maps.php
2. Navigate to the "mu-plugins" directory: /wp-content/mu-plugins and upload the leaflet-maps.php file there
3. Your done! Check the result in your frontend.

