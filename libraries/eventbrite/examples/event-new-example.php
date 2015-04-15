<?php
// load the API Client library
include "../Eventbrite.php";

// Initialize the API client
//  Eventbrite API / Application key (REQUIRED)
//   http://www.eventbrite.com/api/key/
$api_key = 'E47AYMF35YRIXKWX2S';
//  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
//   http://www.eventbrite.com/userkeyapi
$user_key = '1423494773134672332572';

//see http://developer.eventbrite.com/doc/events/event_update/ for a
// description of the available event_update parameters:
$event_new_params = array(
    'title' => 'my new event jvw',
    'start_date' => '2015-11-01 22:30:00', // "YYYY-MM-DD HH:MM:SS"
    'end_date' => '2015-11-02 23:30:00', // "YYYY-MM-DD HH:MM:SS"
    'privacy' => 0,  // zero for private (not available in search), 1 for public (available in search)
    'timezone' => 'America/Los_Angeles'
);

// initialize the API client
$eb_client = new Eventbrite(array('app_key'  => $api_key,
                                  'user_key' => $user_key));
// Create your event:
try{
    // http_post_fields("https://www.eventbriteapi.com/v3/events/",$eb_client->event_new($event_new_params)->event);
    // For more information about the API calls that are available
    // on Eventbrite API clients, see http://developer.eventbrite.com/doc/
    $response = $eb_client->event_new($event_new_params)->event;
    echo "hurray";
}catch( Exception $e ){
    // application-specific error handling goes here:
    $response = $e->error;
    echo "darn";
}
print var_dump($response);
?>
