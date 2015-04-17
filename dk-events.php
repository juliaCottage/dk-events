<?php
/*
Plugin Name:       Klein New Media Events
Plugin URI:        https://github.com/juliaCottage/dk-events
Description:       Events Plugin for Klein New Media Sites
Version:           0.0.32
Author:            Klein New Media
Author URI:        http://kleinnewmedia.com
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Domain Path:       /languages
Text Domain:       dk-events
GitHub Plugin URI: https://github.com/juliaCottage/dk-events
*/

function dk_events_enqueue_and_register_my_scripts(){
  wp_enqueue_style( 'jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );

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

  global $create_event_hook;

  $create_event_hook = add_submenu_page( 'dk-events', 'Create Event', 'Create Event', 'edit_pages', 'dk-create-event', 'dk_events_render_create_event' );

  add_action("load-$create_event_hook", 'my_plugin_add_help');
}
add_action( 'admin_menu', 'dk_events_add_menu_page' );

//Add contextual help

function my_plugin_add_help() {

  global $create_event_hook;
  // We are in the correct screen because we are taking advantage of the load-* action (below)

  $screen = get_current_screen();

  //$screen->remove_help_tabs();

  $screen->add_help_tab( array(
    'id'       => 'dk-create-event',
    'title'    => __('Using the Plugin', 'dk'),
    'content' => dk_event_help_tab_content('dk-help')
  ));
}

function dk_event_help_tab_content($tab = 'dk-usage') {
  if($tab == 'dk-help') {
    ob_start(); ?>
      <h3><?php _e('Getting Started with the Events Plugin', 'dk'); ?></h3>
      <p>In scelerisque, placerat nec urna in pulvinar rhoncus vut dolor tincidunt dapibus in ac massa sit tristique egestas? Non, integer dis massa egestas eros! Elementum vel rhoncus! Et lorem sed lundium nascetur amet! Et scelerisque sit. Egestas tincidunt, quis enim urna arcu mattis rhoncus nisi nec enim tincidunt! Augue magnis.</p>

      <p>In scelerisque, placerat nec urna in pulvinar rhoncus vut dolor tincidunt dapibus in ac massa sit tristique egestas? Non, integer dis massa egestas eros! Elementum vel rhoncus! Et lorem sed lundium nascetur amet! Et scelerisque sit. Egestas tincidunt, quis enim urna arcu mattis rhoncus nisi nec enim tincidunt! Augue magnis.</p>
    <?php
    return ob_get_clean();
  }
}

//Admin pages
function dk_events_render_admin() {
  echo 'This is our admin screen';
}

function dk_events_render_create_event() {
include dirname(dirname(__FILE__)) . '/dk-events/inc/new-event.php';
}