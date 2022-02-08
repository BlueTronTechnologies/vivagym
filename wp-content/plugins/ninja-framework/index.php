<?php
/*
 * @link              http://www.ninjasforhire.co.za
 * @since             1.0.9
 * @package           Ninja_Framework
 *
 * @wordpress-plugin
 * Plugin Name:       Ninja Framework
 * Plugin URI:        ninja-framework
 * Description:       Ninjas for Hire: Development framework.
 * Version:           2.0.1
 * Author:            Ninjas for Hire
 * Author URI:        http://www.ninjasforhire.co.za
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ninja-framework
 */

$path = $_SERVER['DOCUMENT_ROOT'];

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// set globals
define('NFHFW_PS', str_replace('/wp-content/themes', '', get_theme_root()));	// site directory
define('NFHFW_PD', plugin_dir_url( __FILE__ ));						// plugin directory

// custom login logo
function loginlogo() {
	echo '
		<style type="text/css">
			#login h1 a {background-image: url('.NFHFW_PD.'/assets/images/ninja-logo.svg) !important; }
		</style>
	';
}
add_action('login_head', 'loginlogo');


// set up
include "inc/nf-image.php";
include "inc/nf-class.php";

$nf = new nf;
