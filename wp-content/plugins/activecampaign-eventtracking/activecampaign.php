<?php
/**
 * Plugin Name: Active Campaign Event Tracking
 * Plugin URI: http://functionalfunnels.com/event-tracking-active-campaign/
 * Description: Track HTML DOM events with ActiveCampaign
 * Author: FunctionalFunnels
 * Version: 0.2
 * Author URI: http://functionalfunnels.com
 */

//Store email as cookie

add_action( 'init', 'set_ac_email_cookie' );
function set_ac_email_cookie() {
if ( is_user_logged_in() ) {
global $current_user;
get_currentuserinfo();
setcookie( 'email', $current_user->user_email, 30 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
}
}

add_action('init', 'set_this_cookie');
function set_this_cookie() {
  $varname = 'email';
    if( isset($_GET[$varname]) && '' != $_GET[$varname] ) {
		setcookie( 'email', htmlspecialchars($_GET[$varname], ENT_QUOTES), 30 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
	}
}

//ActiveCampaign Integration
require_once('includes/ActiveCampaign.class.php');
define('AC_URL', 'https://vivagymsa.api-us1.com');
define('AC_API_KEY', '13dc6180e2646ef43d63f8ed421566b7f4c763888816af70a9d317f8eb7ad23ce1b32c0c');
define('AC_EVENT_KEY', 'e180526641a5bc05802372dbee53f7db8c2262af');
define('AC_ACTION_ID', '649165765');

add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );
function ajax_test_enqueue_scripts() {
	wp_enqueue_script('activecampaignevent', plugins_url( '/activecampaignevent.js', __FILE__ ), array(), '0.1', true );
	wp_localize_script( 'activecampaignevent', 'activecampaignevent', array( 'ajax_url' => admin_url('admin-ajax.php' )
	));
}

add_action( 'wp_ajax_nopriv_ac_event', 'ac_event' );
add_action( 'wp_ajax_ac_event', 'ac_event' );
function ac_event() {
    // load ac
    $ac = new ActiveCampaignEvent(AC_URL, AC_API_KEY);

    if (!(int)$ac->credentials_test()) {
		echo 'Access denied: Invalid credentials (URL and/or API key).';
		exit();
	}

    // track event
    $ac->track_actid = AC_ACTION_ID;
    $ac->track_key = AC_EVENT_KEY;

    if (isset($_COOKIE['email'])) {
        $ac->track_email = $_COOKIE['email'];
    }
    $response = $ac->api('tracking/log', array(
        'event' => $_REQUEST['event'],
        'eventdata' => $_REQUEST['eventdata'],
    ));

    // send response
    echo json_encode($response);
    die();
}
