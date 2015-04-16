<?php
// load the API Client library
  include dirname(dirname(__FILE__)) . '/libraries/eventbrite/Eventbrite.php';

  // Initialize the API client
  //  Eventbrite API / Application key (REQUIRED)
  //   http://www.eventbrite.com/api/key/
  $api_key = 'E47AYMF35YRIXKWX2S';
  //  Eventbrite user_key (OPTIONAL, only needed for reading/writing private user data)
  //   http://www.eventbrite.com/userkeyapi
  $user_key = '1423494773134672332572'; ?>

<div class="wrap">
  <h2>Create Event</h2>

  <form action="" method="post" name="myForm" id="create-event">

    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="title">Event Title*</label></th>
          <td><input id="name" type="text" name="name" />
            <p class="description">Give you event a short, distinct name.</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="description">Description</label></th>
          <td><textarea id="description" name="description" form="create-event" rows="8" cols="100"/></textarea>
            <p class="description">Tell people what's special about this event.</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="start-date">Start*</label></th>
          <td><input id="start-date" type="text" name="start-date" class="datepicker"/>
            <p class="description">When does this event start?</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="end-date">End*</label></th>
          <td><input id="end-date" type="text" name="end-date" class="datepicker"/>
            <p class="description">When does it end?</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="zone">Time Zone*</label></th>
          <td><input id="zone" type="text" name="zone" value="<?php echo get_option('timezone_string'); ?>" />
            <p class="description">Specify a time zone.</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="privacy">Privacy*</label></th>
          <td><input id="privacy" type="text" name="privacy" />
            <p class="description">Should this event be private?</p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="description">URL</label></th>
          <td><input id="url" type="text" name="url" />
            <p class="description">Enter a custom URL for your event.</p>
          </td>
        </tr>
      </tbody>
    </table>
    <?php submit_button(
      __( 'Create Event', 'dk-shortcodes' ),
      'primary',
      'submit'
      ); ?>
    </form>
  </div>

  <?php
  // define variables and set to empty values

  $name = $description = $start_date = $end_date = $zone = $privacy = $url = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = test_input($_POST["name"]);
     $description = test_input($_POST["description"]);
     $start_date = test_input($_POST["start-date"]);
     $end_date = test_input($_POST["end-date"]);
     $zone = test_input($_POST["zone"]);
     $privacy = test_input($_POST["privacy"]);
     $url = test_input($_POST["url"]);
  }

  function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }





  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //see http://developer.eventbrite.com/doc/events/event_update/ for a
  // description of the available event_update parameters:
  $event_new_params = array(
      'title' => $name,
      'description' => $description,
      'start_date' => $start_date, // "YYYY-MM-DD HH:MM:SS"
      'end_date' => $end_date, // "YYYY-MM-DD HH:MM:SS"
      'privacy' => $privacy,  // zero for private (not available in search), 1 for public (available in search)
      'timezone' => $zone
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
  // print var_dump($response);
 }
  ?>