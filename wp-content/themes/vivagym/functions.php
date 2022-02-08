<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );


	/**
	 * Project Functions
	 */


	/**
	 * WordPress Functions
	 */


	// disable admin bar
	//show_admin_bar(false);


	// enable custom menu support
	if (function_exists('add_theme_support')) {
		add_theme_support( 'menus' );
	}


	// custom admin styles
	add_action('admin_head', 'my_custom_styles');
	function my_custom_styles() {
		echo '
			<style type="text/css">

				#wp-version-message {
					display: none;
				}

			</style>
		';
	}

	if( function_exists('acf_add_options_page') ) {

		acf_add_options_page();

	}

add_action('template_redirect','remove_wpseo');

function remove_wpseo(){
    if (is_page_template('page-viva-gym-promotion-new.php')) {
        global $wpseo_front;
        if(defined($wpseo_front)){
            remove_action('wp_head',array($wpseo_front,'head'),1);
        }
        else {
            $wp_thing = WPSEO_Frontend::get_instance();
            remove_action('wp_head',array($wp_thing,'head'),1);
        }
    }
}

//
// Add options pages
//
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Promo Page',
        'menu_title'	=> 'Promo Page',
        'menu_slug' 	=> 'promo-page',
        'capability'	=> 'edit_posts',
        'redirect'		=> true,
        'icon_url'      => 'dashicons-universal-access',
        'position'      => 2
    ));

    acf_add_options_page(array(
        'page_title' 	=> 'Promo Banners',
        'menu_title'	=> 'Promo Banners',
        'menu_slug' 	=> 'promo-banners',
        'capability'	=> 'edit_posts',
        'redirect'		=> true,
        'icon_url'      => 'dashicons-universal-access',
        'position'      => 3
    ));
}

?>