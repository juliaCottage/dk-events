<?php
/*
Plugin Name:       Klein New Media Events
Plugin URI:        https://github.com/juliaCottage/dk-events
Description:       Events Plugin for Klein New Media Sites
Version:           0.0.5
Author:            Klein New Media
Author URI:        http://kleinnewmedia.com
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Domain Path:       /languages
Text Domain:       dk-events
GitHub Plugin URI: https://github.com/juliaCottage/dk-events
*/


//Add settings link to 'Plugins' page
add_filter( 'plugin_action_links', 'dk_events_plugin_settings_link', 10, 2 );
function dk_events_plugin_settings_link( $links, $file ) {
    if ( $file == 'dk-events/dk-events.php' ) {
        /* Insert the link at the end*/
        $links[ 'settings' ] = sprintf( '<a href="%s"> %s </a>', admin_url( 'admin.php?page=dk-events' ), __( 'Settings', 'plugin_domain' ) );
    }
    return $links;
}

//Add sidebar menu items
function dk_events_add_menu_page() {
  add_menu_page( 'Klein New Media Events', 'Events', 'edit_pages', 'dk-events', 'dk_events_render_admin', 'dashicons-calendar-alt', 21 );
  add_submenu_page( 'dk-events', 'Create Event', 'Create Event', 'edit_pages', 'dk-create-event', 'dk_events_render_create_event' );
}
add_action( 'admin_menu', 'dk_events_add_menu_page' );

//Add contextual help



//Admin pages
function dk_events_render_admin() {
  echo 'This is our admin screen';
}

function dk_events_render_create_event() {
include '/inc/new-event.php';
}