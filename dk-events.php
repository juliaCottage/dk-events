<?php
/*
Plugin Name:       Klein New Media Events
Plugin URI:        https://github.com/juliaCottage/dk-events
Description:       Events Plugin for Klein New Media Sites
Version:           0.0.12
Author:            Klein New Media
Author URI:        http://kleinnewmedia.com
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Domain Path:       /languages
Text Domain:       dk-events
GitHub Plugin URI: https://github.com/juliaCottage/dk-events
*/

function dk_events_enqueue_and_register_my_scripts(){
  wp_enqueue_style( 'jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );

  wp_enqueue_script( 'jquery-ui-datepicker' );

  wp_enqueue_script( 'jquery-ui-slider');

  wp_enqueue_style( 'jquery-ui-time-picker-css', plugins_url( '/lib/jquery-ui-timepicker/jquery-ui-timepicker-addon.css', __FILE__ ) );

  wp_enqueue_script( 'jquery-ui-timepicker', plugins_url( '/lib/jquery-ui-timepicker/jquery-ui-timepicker-addon.js', __FILE__ ), array('jquery-ui-datepicker', 'jquery-ui-slider' ) );



  wp_enqueue_script( 'dk-events-js', plugins_url( '/js/dk-events-dist.js', __FILE__ ), array( 'jquery-ui-timepicker' ), true );
}
add_action( 'admin_enqueue_scripts', 'dk_events_enqueue_and_register_my_scripts' );


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
include dirname(dirname(__FILE__)) . '/dk-events/inc/new-event.php';
}