<?php

	/**  
	 * Ninja Frontend Class
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

	class nff {
		

		public function __construct () {

			global $nffActions;
			global $nffFilters;

			//action hooks
			add_action( 'rest_api_init', array($nffActions, 'addclasses_endpoint'));
			add_action( 'rest_api_init', array($nffActions, 'gyms_endpoint'));
			add_action( 'rest_api_init', array($nffActions, 'posts_endpoint'));
			add_action('init', array($nffActions, 'ninja_wp_init_functions'));
			add_action('admin_head', array($nffActions, 'ninja_admin_styles'));
			add_action( 'wp_enqueue_scripts', array($nffActions, 'nfh_scripts'));
			///post types
			add_action('init', array($nffActions, 'testimonialsRegister'));
			add_action('init', array($nffActions, 'gymsRegister'));
			add_action('init', array($nffActions, 'facilitiesRegister'));
			add_action('init', array($nffActions, 'guidesRegister'));
			add_action('init', array($nffActions, 'classesRegister'));
			//add_action('init', array($nffActions, 'timetablesRegister'));
			add_action('init', array($nffActions, 'faqsRegister'));
			///taxonomies
			add_action( 'init', array($nffActions, 'faqscat_taxonomies'), 0 );
			add_action( 'init', array($nffActions, 'locations_taxonomies'), 0 );
			add_action( 'init', array($nffActions, 'provinces_taxonomies'), 0 );
			add_action( 'init', array($nffActions, 'intensities_taxonomies'), 0 );
			add_action( 'init', array($nffActions, 'goals_taxonomies'), 0 );
			///superuser
			add_action( 'init', array($nffActions, 'superUser'));
			
			//filter hooks
			add_filter('frm_setup_new_fields_vars', array($nffFilters, 'frm_populate_posts'), 20, 2);
			add_filter('frm_setup_edit_fields_vars', array($nffFilters, 'frm_populate_posts'), 20, 2);
			add_filter('the_posts', array($nffFilters, 'bump_sticky_posts_to_top'));

		}

		public function excerptLength($limit) {
		      $excerpt = explode(' ', get_the_excerpt(), $limit);

		      if (count($excerpt) >= $limit) {
		          array_pop($excerpt);
		          $excerpt = implode(" ", $excerpt) . '...';
		      } else {
		          $excerpt = implode(" ", $excerpt);
		      }

		      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

		      return $excerpt;
		}
		
	}//nff

	//required files
	require_once 'nff-actions.php';
	require_once 'nff-filters.php';

	//instantiate classes
	$nffActions = new nffActions;
	$nffFilters = new nffFilters;