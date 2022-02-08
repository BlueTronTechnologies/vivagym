<?php

	/**
	 * Ninja Frontend Filters Class
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

	class nffFilters {

		/*
		var $var1;
		var $var2;
		var $var3;
		*/

		public function __construct () {

		}

		public function frm_populate_posts($values, $field){
			if($field->id == 80){ //replace 125 with the ID of the field to populate
			   $posts = get_posts( array('post_type' => 'gyms', 'post_status' => array('publish', 'private'), 'numberposts' => 999, 'orderby' => 'title', 'order' => 'ASC'));
			   unset($values['options']);
			   $values['options'] = array(''); //remove this line if you are using a checkbox or radio button field
			   $values['options'][0] = 'gym*';
			   foreach($posts as $p){
			     $values['options'][$p->ID] = $p->post_title;
			   }
			   $values['use_key'] = true; //this will set the field to save the post ID instead of post title
			}
			return $values;
		}

		public function bump_sticky_posts_to_top($posts) {
		    foreach($posts as $i => $post) {
		        if(is_sticky($post->ID))
		        {
		            $stickies[] = $post;
		            unset($posts[$i]);
		        }
		    }

		    if(!empty($stickies))
		        return array_merge($stickies, $posts);

		    return $posts;
		}


	}//nffFilters