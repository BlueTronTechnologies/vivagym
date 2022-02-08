<?php

	/**  
	 * All functions exist in Ninja Frontend plugin
	 */

	//custom endpoint method to run custom queries
	function get_custom_data($data){

		if ($data['postid']) {
			$postid = $data['postid'];
		}else{
			$postid = '';
		}

		$result = array();


		if($postid){

				$result['success']['title'] = get_post_field('post_title', $postid);
				$result['success']['content'] = get_post_field('post_content', $postid);
				

		}else{

			$result['error'] = 'there was an error';

		}
		// Reset Post Data
		wp_reset_postdata();


		return $result;

	}

	//a test custom endpoint function
	function my_awesome_func( $data ) {

		//METHODS ON $data
		//$data->get_param( 'solo' );//get val of any GET var
		//$data->get_params();//get all params as object
		// The individual sets of parameters are also available, if needed:
		// $parameters = $request->get_url_params();
		// $parameters = $request->get_query_params();
		// $parameters = $request->get_body_params();
		// $parameters = $request->get_json_params();
		// $parameters = $request->get_default_params();

	  $posts = get_posts( array(
	    'author' => $data['id'],
	  ) );

	  if ( empty( $posts ) ) {
	    return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 404 ) );
	  }

	  if ( empty( $posts ) ) {
	    return null;
	  }
	 
	  return $posts[0];
	}

	add_action( 'rest_api_init', function () {
	  register_rest_route( 'myplugin/v1', '/author/(?P<id>\d+)', array(
	    'methods' => 'POST',
	    'callback' => 'get_custom_data',
	    'args' => array(
	      'id' => array(
	        'validate_callback' => function($param, $request, $key) {
	          return is_numeric( $param );
	        }
	      ),
	    ),
	    'permission_callback' => function () {
	   	  //a nonce needs to be passed in order for this to work
	      return is_user_logged_in();
	    }
	  ) );
	} );

?>