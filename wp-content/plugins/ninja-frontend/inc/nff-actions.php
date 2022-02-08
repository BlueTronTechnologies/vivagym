<?php

	/**
	 * Ninja Frontend Actions Class
	 *
	 * @author Ninjas for Hire <info@ninjasforhire.co.za>
	 *
	 * Made in Cape Town :)
	 */

	// define wordpress globals
	global $wpdb;
	global $table_prefix;
	global $menu;
	global $submenu;
	global $bloginfo;

	class nffActions {

		/*
		var $var1;
		var $var2;
		var $var3;
		*/

		public function __construct () {

		}

		public function addClasses($club,$day){

			global $wpdb;

		    $xml = file_get_contents("https://vivagymapi.krscloud.net/Class/ListDailyClubClassesForPerson?clubNo=".$club."&contractPersonId=0&classDate=".$day."T13%3A33%3A43%2B02%3A00");
		    $classesArray = json_decode($xml, true);
		    //echo '<pre>';
		    //print_r($classesArray);
		    if(isset($classesArray)){

		    	foreach($classesArray as $class){

		    		//get data
		    		$id = $class['id'];
					$name = (isset($class['name'])) ? strip_tags($class['name']) : '';
					$classdate = (isset($class['classDate'])) ? date('Y-m-d', strtotime($class['classDate'])) : '';
					$description = (isset($class['description'])) ? strip_tags($class['description']) : '';
					$ptname = (isset($class['ptName'])) ? strip_tags($class['ptName']) : '';
					$startTime = (isset($class['startTime'])) ? strip_tags($class['startTime']) : '';
					$endTime = (isset($class['endTime'])) ? strip_tags($class['endTime']) : '';
					$studiono = $class['studioNo'];
					$clubid = $club;

					//insert class
		    		$insert = $wpdb->insert(
						'viva_timetables',
						array(
							'id' => $id,
							'name' => $name,
							'description' => $description,
							'classdate' => $classdate,
							'ptname' => $ptname,
							'starttime' => $startTime,
							'endtime' => $endTime,
							'studiono' => $studiono,
							'clubid' => $clubid,
						)
					);

		    	}
		    }

	    }//addClasses

	    public function classesForWeek(){

	    		global $wpdb;
	    		$daycount = 1;
				$daysArrray = array();
				$daysArrray[] = date('Y-m-d', strtotime('today'));
				$clubIDs = array(1,2,3,4,5,6,7,8,9);

				//get dates for the next week
				while($daycount < 7) {
				    $date = strtotime("+".$daycount." day");
					$daysArrray[] = date('Y-m-d', $date);
				    $daycount++;
				}

				$wpdb->query("DELETE FROM viva_timetables");

				foreach($daysArrray as $day){
					foreach($clubIDs as $clubID){
						$this->addClasses($clubID,$day);
					}
				}

				return 'Classes updated.';

	    }

		//callback for custom posts endpoint
		public function get_gyms( $data ) {


			if($data['province']){

				$html = '';
				$taxquery = array(
					array(
						'taxonomy' => 'provinces',
						'field'    => 'slug',
						'terms'    => $data['province'],
					),
				);

				$args = array(
					'post_type' => 'gyms',
					'posts_per_page' => -1,
					'tax_query' => $taxquery
				);

				$the_query = new WP_Query( $args );
				// The Loop
				if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) : $the_query->the_post();

							 $html .= '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

					endwhile;

					$result['nextposts'] = $html;

				}else{

					$result['noposts'] = 'No more posts.';

				}
				// Reset Post Data
				wp_reset_postdata();


			}//if paged


			return $result;

		}

		//callback for custom posts endpoint
		public function get_more_posts( $data ) {

			global $nf;

			if ($data['pagedvar']) {
				$pagedvar = $data['pagedvar'];
			}else{
				$pagedvar = 1;
			}

			if ($data['cat']) {
				$cat = $data['cat'];
			}else{
				$cat = '';
			}



			if($pagedvar){

				$html = '';
				$postargs = array(
					'post_type' => 'post',
				    'paged' => $pagedvar,
				);

				if($cat != ''){
					$postargs = array(
						'post_type' => 'post',
					    'paged' => $pagedvar,
					    'category_name' => $cat,
					);
				}


				$the_query = new WP_Query( $postargs );
				// The Loop
				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) : $the_query->the_post();

							$featimage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
							$post_categories = wp_get_post_categories( get_the_ID() );

							$html .= '<div class="block"><div class="block_image">';
							if($featimage){
								$html .= '<img src="'.$nf->image( $featimage, 200, 200).'" alt="">';
							}
							$html .= '</div><h5 class="block_title"><a href="'.get_the_permalink().'">'.get_the_title().'</a>';
							$html .= '</h5><div class="block_meta">';
							if($post_categories){
								$html .= 'posted ';
								$catcount = 1;
							 }
							 $html .= 'on '.get_the_time('j F Y').'</div><div class="block_excerpt">';
							 $html .= get_the_excerpt();
							 $html .= '</div></div>';

					endwhile;

					$result['nextposts'] = $html;

				}else{

					$result['noposts'] = 'No more posts.';

				}
				// Reset Post Data
				wp_reset_postdata();



			}//if paged


			return $result;

		}

		//create custom classes endpint : /wp-json/nff/v1/addclasses/
		public function addclasses_endpoint() {
		  register_rest_route( 'nff/v1', '/addclasses/', array(
			    'methods' => 'GET',
			    'callback' => array($this,'classesForWeek'),
		  ));
		}

		//create custom gyms endpint
		public function gyms_endpoint() {
		  register_rest_route( 'nff/v1', '/gyms/', array(
			    'methods' => 'GET',
			    'callback' => array($this,'get_gyms'),
		  ));
		}

		//create custom posts endpint
		public function posts_endpoint() {
		  register_rest_route( 'nff/v1', '/posts/', array(
			    'methods' => 'GET',
			    'callback' => array($this,'get_more_posts'),
		  ));
		}

		//wordpress init functions
		public function ninja_wp_init_functions() {

			add_theme_support( 'menus' );
			add_theme_support( 'post-thumbnails' );

			// disable admin bar
			show_admin_bar(false);

		}


		//ninja admin styles
		public function ninja_admin_styles() {
			echo '
				<style type="text/css">

					#wp-version-message {
						display: none;
					}

				</style>
			';
		}

		//make wp/php vars available as js object
		public function nfh_scripts() {
		    //makes wp object available to js files in theme_js hook
		    wp_localize_script( 'theme_js', 'wp', array(
		        'root'      => esc_url_raw( rest_url() ),
		        'nonce'     => wp_create_nonce( 'wp_rest' ),
		        'site_name' => get_bloginfo( 'name' ),
		        'template_url' => get_bloginfo('template_url'),
		        'base_url' => get_bloginfo('url')
		    ) );
		}

		// add custom post type - testimonials
		public function testimonialsRegister(){

			$singular = 'Testimonial';
			$plural = 'Testimonials';
			$posttype = 'testimonials';

			$labels = array(
				'name' => _x($plural, 'post type general name'),
				'singular_name' => _x($singular, 'post type singular name'),
				'add_new' => _x('Add New', strtolower($singular)),
				'add_new_item' => __('Add New Issue'),
				'edit_item' => __('Edit '.$singular),
				'new_item' => __('New Issue'),
				'view_item' => __('View Issue'),
				'search_items' => __('Search '.$plural),
				'not_found' => __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title', 'editor', 'thumbnail'),
				"rewrite" => array("with_front" => false),
				'show_in_nav_menus' => true,
				'has_archive' => true
			);

			register_post_type($posttype , $args);

		}

		// add custom post type - gyms
		public function gymsRegister(){

			$singular = 'Gym';
			$plural = 'Gyms';
			$posttype = 'gyms';

			$labels = array(
				'name' => _x($plural, 'post type general name'),
				'singular_name' => _x($singular, 'post type singular name'),
				'add_new' => _x('Add New', strtolower($singular)),
				'add_new_item' => __('Add New '.$singular),
				'edit_item' => __('Edit '.$singular),
				'new_item' => __('New '.$singular),
				'view_item' => __('View '.$singular),
				'search_items' => __('Search '.$plural),
				'not_found' => __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'show_in_rest'       => true,
			    'rest_base'          => 'gyms',
			    'rest_controller_class' => 'WP_REST_Posts_Controller',
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
				"rewrite" => array("with_front" => false),
				'show_in_nav_menus' => true,
				'has_archive' => true
			);

			register_post_type($posttype , $args);

		}

		// add custom post type - facilities
		public function facilitiesRegister(){

			$singular = 'Facility';
			$plural = 'Facilities';
			$posttype = 'facilities';

			$labels = array(
				'name' => _x($plural, 'post type general name'),
				'singular_name' => _x($singular, 'post type singular name'),
				'add_new' => _x('Add New', strtolower($singular)),
				'add_new_item' => __('Add New '.$singular),
				'edit_item' => __('Edit '.$singular),
				'new_item' => __('New '.$singular),
				'view_item' => __('View '.$singular),
				'search_items' => __('Search '.$plural),
				'not_found' => __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
				"rewrite" => array("with_front" => false),
				'show_in_nav_menus' => true,
				'has_archive' => true
			);

			register_post_type($posttype , $args);

		}

		// add custom post type - guides
		public function guidesRegister(){

			$singular = 'Fitness Guide';
			$plural = 'Fitness Guides';
			$posttype = 'guides';

			$labels = array(
				'name' => _x($plural, 'post type general name'),
				'singular_name' => _x($singular, 'post type singular name'),
				'add_new' => _x('Add New', strtolower($singular)),
				'add_new_item' => __('Add New '.$singular),
				'edit_item' => __('Edit '.$singular),
				'new_item' => __('New '.$singular),
				'view_item' => __('View '.$singular),
				'search_items' => __('Search '.$plural),
				'not_found' => __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
				"rewrite" => array("with_front" => false),
				'show_in_nav_menus' => true,
				'has_archive' => true
			);

			register_post_type($posttype , $args);

		}

		// add custom post type - classes
		public function classesRegister(){

			$singular = 'Class';
			$plural = 'Classes';
			$posttype = 'classes';

			$labels = array(
				'name' => _x($plural, 'post type general name'),
				'singular_name' => _x($singular, 'post type singular name'),
				'add_new' => _x('Add New', strtolower($singular)),
				'add_new_item' => __('Add New '.$singular),
				'edit_item' => __('Edit '.$singular),
				'new_item' => __('New '.$singular),
				'view_item' => __('View '.$singular),
				'search_items' => __('Search '.$plural),
				'not_found' => __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
				"rewrite" => array("with_front" => false),
				'show_in_nav_menus' => true,
				'has_archive' => true
			);

			register_post_type($posttype , $args);

		}

		// add custom post type - timetables
		// public function timetablesRegister(){

		// 	$singular = 'Timetable';
		// 	$plural = 'Timetables';
		// 	$posttype = 'timetables';

		// 	$labels = array(
		// 		'name' => _x($plural, 'post type general name'),
		// 		'singular_name' => _x($singular, 'post type singular name'),
		// 		'add_new' => _x('Add New', strtolower($singular)),
		// 		'add_new_item' => __('Add New '.$singular),
		// 		'edit_item' => __('Edit '.$singular),
		// 		'new_item' => __('New '.$singular),
		// 		'view_item' => __('View '.$singular),
		// 		'search_items' => __('Search '.$plural),
		// 		'not_found' => __('Nothing found'),
		// 		'not_found_in_trash' => __('Nothing found in Trash'),
		// 		'parent_item_colon' => ''
		// 	);
		// 	$args = array(
		// 		'labels' => $labels,
		// 		'public' => true,
		// 		'publicly_queryable' => true,
		// 		'show_ui' => true,
		// 		'query_var' => true,
		// 		'capability_type' => 'post',
		// 		'hierarchical' => false,
		// 		'menu_position' => null,
		// 		'supports' => array('title', 'editor', 'thumbnail'),
		// 		'rewrite' => true,
		// 		'show_in_nav_menus' => true,
		// 		'has_archive' => true
		// 	);

		// 	register_post_type($posttype , $args);

		// }

		// add custom post type - faqs
		public function faqsRegister(){

			$singular = 'FAQ';
			$plural = 'FAQs';
			$posttype = 'faqs';

			$labels = array(
				'name' => _x($plural, 'post type general name'),
				'singular_name' => _x($singular, 'post type singular name'),
				'add_new' => _x('Add New', strtolower($singular)),
				'add_new_item' => __('Add New '.$singular),
				'edit_item' => __('Edit '.$singular),
				'new_item' => __('New '.$singular),
				'view_item' => __('View '.$singular),
				'search_items' => __('Search '.$plural),
				'not_found' => __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title', 'editor', 'thumbnail'),
				"rewrite" => array("with_front" => false),
				'show_in_nav_menus' => true,
				'has_archive' => true
			);

			register_post_type($posttype , $args);

		}


		// add custom taxonomy - faqscat
		public function faqscat_taxonomies() {

			$singular = 'FAQ Category';
			$plural = 'FAQ Categories';
			$taxterm = 'faqscat';

			register_taxonomy($taxterm, array('faqs'), array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( $plural, 'taxonomy general name' ),
					'singular_name' => _x( $singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$plural ),
					'all_items' => __( 'All '.$plural ),
					'parent_item' => __( 'Parent '.$singular ),
					'parent_item_colon' => __( 'Parent '.$singular.':' ),
					'edit_item' => __( 'Edit '.$singular ),
					'update_item' => __( 'Update '.$singular ),
					'add_new_item' => __( 'Add New '.$singular ),
					'new_item_name' => __( 'New '.$singular.' Name' ),
					'menu_name' => __( $plural ),
				),
				'rewrite' => array(
					'slug' => $taxterm,
					'with_front' => false,
					'hierarchical' => true
				),
			));
		}

		// add custom taxonomy - locations
		public function locations_taxonomies() {

			$singular = 'Location';
			$plural = 'Locations';
			$taxterm = 'locations';

			register_taxonomy($taxterm, array('gyms','classes','timetables','testimonials','facilities'), array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( $plural, 'taxonomy general name' ),
					'singular_name' => _x( $singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$plural ),
					'all_items' => __( 'All '.$plural ),
					'parent_item' => __( 'Parent '.$singular ),
					'parent_item_colon' => __( 'Parent '.$singular.':' ),
					'edit_item' => __( 'Edit '.$singular ),
					'update_item' => __( 'Update '.$singular ),
					'add_new_item' => __( 'Add New '.$singular ),
					'new_item_name' => __( 'New '.$singular.' Name' ),
					'menu_name' => __( $plural ),
				),
				'rewrite' => array(
					'slug' => $taxterm,
					'with_front' => false,
					'hierarchical' => true
				),
			));
		}

		// add custom taxonomy - provinces
		public function provinces_taxonomies() {

			$singular = 'Province';
			$plural = 'Provinces';
			$taxterm = 'provinces';

			register_taxonomy($taxterm, array('gyms'), array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( $plural, 'taxonomy general name' ),
					'singular_name' => _x( $singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$plural ),
					'all_items' => __( 'All '.$plural ),
					'parent_item' => __( 'Parent '.$singular ),
					'parent_item_colon' => __( 'Parent '.$singular.':' ),
					'edit_item' => __( 'Edit '.$singular ),
					'update_item' => __( 'Update '.$singular ),
					'add_new_item' => __( 'Add New '.$singular ),
					'new_item_name' => __( 'New '.$singular.' Name' ),
					'menu_name' => __( $plural ),
				),
				'rewrite' => array(
					'slug' => $taxterm,
					'with_front' => false,
					'hierarchical' => true
				),
			));
		}

		// add custom taxonomy - intensities
		public function intensities_taxonomies() {

			$singular = 'Intensity';
			$plural = 'Intensities';
			$taxterm = 'intensities';

			register_taxonomy($taxterm, array('guides'), array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( $plural, 'taxonomy general name' ),
					'singular_name' => _x( $singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$plural ),
					'all_items' => __( 'All '.$plural ),
					'parent_item' => __( 'Parent '.$singular ),
					'parent_item_colon' => __( 'Parent '.$singular.':' ),
					'edit_item' => __( 'Edit '.$singular ),
					'update_item' => __( 'Update '.$singular ),
					'add_new_item' => __( 'Add New '.$singular ),
					'new_item_name' => __( 'New '.$singular.' Name' ),
					'menu_name' => __( $plural ),
				),
				'rewrite' => array(
					'slug' => $taxterm,
					'with_front' => false,
					'hierarchical' => true
				),
			));
		}

		// add custom taxonomy - goals
		public function goals_taxonomies() {

			$singular = 'Goal';
			$plural = 'Goals';
			$taxterm = 'goals';

			register_taxonomy($taxterm, array('guides'), array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( $plural, 'taxonomy general name' ),
					'singular_name' => _x( $singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$plural ),
					'all_items' => __( 'All '.$plural ),
					'parent_item' => __( 'Parent '.$singular ),
					'parent_item_colon' => __( 'Parent '.$singular.':' ),
					'edit_item' => __( 'Edit '.$singular ),
					'update_item' => __( 'Update '.$singular ),
					'add_new_item' => __( 'Add New '.$singular ),
					'new_item_name' => __( 'New '.$singular.' Name' ),
					'menu_name' => __( $plural ),
				),
				'rewrite' => array(
					'slug' => $taxterm,
					'with_front' => false,
					'hierarchical' => true
				),
			));
		}

		//superuser access
		public function superUser(){

				$super_users = array('ninjasforhire','hellsbells','Andrew');

				// super user settings
				$current_user = wp_get_current_user();
				$is_super = false;

				foreach($super_users as $super_user){
					if($current_user->user_login == $super_user) {
						$is_super = true;
						break;
					}
				}

				//if not a super user
				if(!$is_super) {

					add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

					add_action('admin_menu', 'remove_menus', 102);
					function remove_menus() {

						global $submenu;

							remove_submenu_page( 'index.php', 'update-core.php' );
							remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );

						//remove_menu_page( 'pods' );

							remove_submenu_page( 'users.php', 'roles' );
							remove_submenu_page( 'users.php', 'role-new' );

						remove_menu_page( 'edit-comments.php' );
						remove_menu_page( 'link-manager.php' );
						remove_menu_page( 'tools.php' );

							remove_submenu_page( 'options-general.php', 'pagenavi' );
							remove_submenu_page( 'options-general.php', 'members-settings' );
							remove_submenu_page( 'options-general.php', 'options-permalink.php' );
							remove_submenu_page( 'options-general.php', 'options-media.php' );
							remove_submenu_page( 'options-general.php', 'options-reading.php' );
							remove_submenu_page( 'options-general.php', 'options-discussion.php' );

						remove_menu_page( 'edit.php?post_type=acf-field-group' );

							remove_submenu_page( 'options-general.php', 'wp-postviews/postviews-options.php' );

						remove_menu_page ( 'themes.php' );
						remove_menu_page ( 'plugins.php' );
						remove_menu_page ( 'duplicator' );

						remove_meta_box( 'tagsdiv-post_tag', 'post', 'Normal' );
						remove_meta_box( 'tagsdiv-post_tag', 'page', 'Normal' );

					}

					// remove updates from admin bar
					function disable_bar_updates() {
						global $wp_admin_bar;
						$wp_admin_bar->remove_menu('updates');
					}
					add_action( 'wp_before_admin_bar_render', 'disable_bar_updates' );

					// Custom Dashboard Function
					function remove_dashboard_widgets() {

						global $wp_meta_boxes;

						unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
						unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
						unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
						unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
						unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

					}

					// unset widgets
					add_action( 'widgets_init', 'my_unregister_widgets' );
					function my_unregister_widgets() {
						unregister_widget( 'WP_Widget_Pages' );
						unregister_widget( 'WP_Widget_Calendar' );
						unregister_widget( 'WP_Widget_Archives' );
						unregister_widget( 'WP_Widget_Links' );
						unregister_widget( 'WP_Widget_Categories' );
						unregister_widget( 'WP_Widget_Recent_Posts' );
						unregister_widget( 'WP_Widget_Search' );
						unregister_widget( 'WP_Widget_Tag_Cloud' );
						unregister_widget( 'WP_Widget_RSS' );
						unregister_widget( 'WP_Widget_Text' );
						unregister_widget( 'WP_Widget_Meta' );
						unregister_widget( 'WP_Widget_Recent_Comments' );
						unregister_widget( 'WP_Nav_Menu_Widget' );
						unregister_widget( 'FrmShowForm' );  //formidable
						unregister_widget( 'FrmListEntries' );  //formidable
					}

					// hide specific pages in back-end
					add_action( 'pre_get_posts' ,'exclude_this_page' );
					function exclude_this_page( $query ) {

						$pagearr = array(534,570,567,532);

						if( !is_admin() ) {
							return $query;
						}

						global $pagenow;

						if( 'edit-pages.php' == $pagenow ) {
							$query->set( 'post__not_in', $pagearr );
						}
						if( 'edit.php' == $pagenow && ( get_query_var('post_type') && 'page' == get_query_var('post_type') ) ) {
							$query->set( 'post__not_in', $pagearr );
						}

						return $query;
					}

					add_action('pre_user_query','admin_pre_user_query');
					function admin_pre_user_query($user_search) {
					  $user = wp_get_current_user();
					  if ($user->ID!=1) {
					    global $wpdb;
					    $user_search->query_where = str_replace('WHERE 1=1',
					      "WHERE 1=1 AND {$wpdb->users}.ID<>1",$user_search->query_where);
					  }
					}

					// hide plugins
					function hide_plugins() {
						global $wp_list_table;
						$hidearr = array(
							'ninja-embed-plugin/ninja_embed_plugin.php',
							'advanced-custom-fields/acf.php',
							'wp-postviews/wp-postviews.php'
						);
						$myplugins = $wp_list_table->items;
						foreach ($myplugins as $key => $val) {
							if (in_array($key,$hidearr)) {
								unset($wp_list_table->items[$key]);
							}
						}
					}
					add_action( 'pre_current_active_plugins', 'hide_plugins' );

					remove_action( 'load-update-core.php', 'wp_update_plugins' );
					add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

				}

		}

	}//nffActions