<?php
/**
 * Class WPCF7_Redirect_Settings file.
 *
 * @package cf7r
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Class WPCF7R_post_types
* Create a post type that will act as a container for the form actions
* This post type is invisible to all users and displayed only on the cf7 tab
*
* @version  1.0.0
*/
class WPCF7R_post_types{
    public function __construct(){
        add_action( 'init', array( $this , 'wpcf7r_post_type') );

		add_action( 'add_meta_boxes', array( $this , 'wporg_add_custom_box' ) );
    }

    // Register Custom Post Type
    function wpcf7r_post_type() {

        $labels = array(
            'name'                  => _x( 'wpcf7r_actions', 'Post Type General Name', 'wpcf7-redirect' ),
            'singular_name'         => _x( 'wpcf7r_action', 'Post Type Singular Name', 'wpcf7-redirect' ),
            'menu_name'             => __( 'wpcf7r_actions', 'wpcf7-redirect' ),
            'name_admin_bar'        => __( 'Post Type', 'wpcf7-redirect' ),
            'archives'              => __( 'Item Archives', 'wpcf7-redirect' ),
            'attributes'            => __( 'Item Attributes', 'wpcf7-redirect' ),
            'parent_item_colon'     => __( 'Parent Item:', 'wpcf7-redirect' ),
            'all_items'             => __( 'All Items', 'wpcf7-redirect' ),
            'add_new_item'          => __( 'Add New Item', 'wpcf7-redirect' ),
            'add_new'               => __( 'Add New', 'wpcf7-redirect' ),
            'new_item'              => __( 'New Item', 'wpcf7-redirect' ),
            'edit_item'             => __( 'Edit Item', 'wpcf7-redirect' ),
            'update_item'           => __( 'Update Item', 'wpcf7-redirect' ),
            'view_item'             => __( 'View Item', 'wpcf7-redirect' ),
            'view_items'            => __( 'View Items', 'wpcf7-redirect' ),
            'search_items'          => __( 'Search Item', 'wpcf7-redirect' ),
            'not_found'             => __( 'Not found', 'wpcf7-redirect' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'wpcf7-redirect' ),
            'featured_image'        => __( 'Featured Image', 'wpcf7-redirect' ),
            'set_featured_image'    => __( 'Set featured image', 'wpcf7-redirect' ),
            'remove_featured_image' => __( 'Remove featured image', 'wpcf7-redirect' ),
            'use_featured_image'    => __( 'Use as featured image', 'wpcf7-redirect' ),
            'insert_into_item'      => __( 'Insert into item', 'wpcf7-redirect' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpcf7-redirect' ),
            'items_list'            => __( 'Items list', 'wpcf7-redirect' ),
            'items_list_navigation' => __( 'Items list navigation', 'wpcf7-redirect' ),
            'filter_items_list'     => __( 'Filter items list', 'wpcf7-redirect' ),
        );
        $args = array(
            'label'                 => __( 'wpcf7r_action', 'wpcf7-redirect' ),
            'description'           => __( 'wpcf7r_actions', 'wpcf7-redirect' ),
            'labels'                => $labels,
            'supports'              => array('title' ,'custom_fields' , 'custom-fields'),
            'hierarchical'          => true,
            'public'                => CF7_REDIRECT_DEBUG,
            'show_ui'               => CF7_REDIRECT_DEBUG,
            'show_in_menu'          => CF7_REDIRECT_DEBUG,
            'menu_position'         => 5,
            'show_in_admin_bar'     => CF7_REDIRECT_DEBUG,
            'show_in_nav_menus'     => CF7_REDIRECT_DEBUG,
            'can_export'            => CF7_REDIRECT_DEBUG,
            'has_archive'           => CF7_REDIRECT_DEBUG,
            'exclude_from_search'   => CF7_REDIRECT_DEBUG,
            'publicly_queryable'    => CF7_REDIRECT_DEBUG,
            'rewrite'               => CF7_REDIRECT_DEBUG,
            'capability_type'       => 'page',
            'show_in_rest'          => CF7_REDIRECT_DEBUG,
        );
        register_post_type( 'wpcf7r_action' , $args );

        add_post_type_support( 'wpcf7r_action', 'custom-fields' );

		$labels = array(
			'name'                  => _x( 'wpcf7r_lead', 'Post Type General Name', 'wpcf7-redirect' ),
			'singular_name'         => _x( 'wpcf7r_lead', 'Post Type Singular Name', 'wpcf7-redirect' ),
			'menu_name'             => __( 'Leads', 'wpcf7-redirect' ),
			'name_admin_bar'        => __( 'Post Type', 'wpcf7-redirect' ),
			'archives'              => __( 'Item Archives', 'wpcf7-redirect' ),
			'attributes'            => __( 'Item Attributes', 'wpcf7-redirect' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wpcf7-redirect' ),
			'all_items'             => __( 'All Items', 'wpcf7-redirect' ),
			'add_new_item'          => __( 'Add New Item', 'wpcf7-redirect' ),
			'add_new'               => __( 'Add New', 'wpcf7-redirect' ),
			'new_item'              => __( 'New Item', 'wpcf7-redirect' ),
			'edit_item'             => __( 'Edit Item', 'wpcf7-redirect' ),
			'update_item'           => __( 'Update Item', 'wpcf7-redirect' ),
			'view_item'             => __( 'View Item', 'wpcf7-redirect' ),
			'view_items'            => __( 'View Items', 'wpcf7-redirect' ),
			'search_items'          => __( 'Search Item', 'wpcf7-redirect' ),
			'not_found'             => __( 'Not found', 'wpcf7-redirect' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wpcf7-redirect' ),
			'featured_image'        => __( 'Featured Image', 'wpcf7-redirect' ),
			'set_featured_image'    => __( 'Set featured image', 'wpcf7-redirect' ),
			'remove_featured_image' => __( 'Remove featured image', 'wpcf7-redirect' ),
			'use_featured_image'    => __( 'Use as featured image', 'wpcf7-redirect' ),
			'insert_into_item'      => __( 'Insert into item', 'wpcf7-redirect' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpcf7-redirect' ),
			'items_list'            => __( 'Items list', 'wpcf7-redirect' ),
			'items_list_navigation' => __( 'Items list navigation', 'wpcf7-redirect' ),
			'filter_items_list'     => __( 'Filter items list', 'wpcf7-redirect' ),
		);
		$args = array(
			'label'                 => __( 'wpcf7r_leads', 'wpcf7-redirect' ),
			'description'           => __( 'wpcf7r_leads', 'wpcf7-redirect' ),
			'labels'                => $labels,
			'supports'              => array('title' ,'custom_fields' , 'custom-fields'),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => 'admin.php?page=wpcf7',
			'menu_position'         => 5,
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => false,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => false,
			'rewrite'               => false,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);
		register_post_type( 'wpcf7r_leads' , $args );

		add_post_type_support( 'wpcf7r_leads', 'custom-fields' );

		add_action('admin_menu', 'my_admin_menu');
		function my_admin_menu() {
		    add_submenu_page('wpcf7', 'Leads', 'Leads', 'manage_options', 'edit.php?post_type=wpcf7r_leads');
			add_submenu_page('wpcf7', 'New lead', 'New lead', 'manage_options', 'post-new.php?post_type=wpcf7r_leads');
		}
    }

	function wporg_add_custom_box(){
	    $screens = array('wpcf7r_action');

		if( is_wpcf7r_debug() ){
			$screens[] = 'wpcf7r_leads';
		}
	    foreach ($screens as $screen) {
	        add_meta_box(
	            'wpcf7r_action_meta',           // Unique ID
	            'Custom Meta Box Title',  // Box title
	            array( $this , 'debug_helper' ),  // Content callback, must be of type callable
	            $screen                   // Post type
	        );
	    }

		add_meta_box(
			'wpcf7r_leads',  // Unique ID
			__('Lead details' , 'wpcf7-redirect'),  // Box title
			array( $this , 'lead_fields_html' ),  // Content callback, must be of type callable
			'wpcf7r_leads'     // Post type
		);
	}
	/**
	 * Get the meta html
	 * @param  [type] $post [description]
	 * @return [type]       [description]
	 */
	function lead_fields_html( $post ){
		$lead = new WPCF7R_Lead( $post->ID );

		$fields = $lead->get_lead_fields();

		unset($fields['_edit_lock']);
		foreach( $fields as $field ){
			switch( $field['name'] ){
				case 'action-save_lead':
					$field['value'] = $field['value']['data']['lead_id'];
					break;
				case 'action-mailchimp':
					if( is_wp_error($field['value']) ){
						$field['value'] = $field['value']->get_error_message();
					}
					break;
			}

			WPCF7R_html::render_field( $field , $field['prefix'] );
		}
	}

	function debug_helper(){
		echo "<pre>";
		print_r( get_post_custom());
		echo "</pre>";
	}
}
