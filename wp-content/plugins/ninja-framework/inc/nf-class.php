<?php

	/**
	 * Ninja Framework Class
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

	class nf {

		/**
		 * WordPress Extending Functions
		 */

		// split content into coliumns with shortcode [columnbreak]
		function columns($content) {

			$columns = strpos($content, '[columnbreak]');
			if ( $columns == true ) {
				$content = '<div class="ninja_columns"><div class="ninja_col">'.$content;
				$content .= '</div></div>';

				$content = str_replace('<p>[columnbreak]</p>', '</div><div class="ninja_col">', $content);
				$content = str_replace('[columnbreak]', '</div><div class="ninja_col">', $content);
			}

			return $content;

		}


		// image crop
		function image($image, $width = 0, $height = 0, $quality = 80) {

			$params = array(
				'width' => $width,
				'height' => $height,
				'quality' => $quality
			);
			$imgurl = nf_image( $image, $params );

			return $imgurl;
		}
		function bfi($image, $width = 0, $height = 0, $quality = 80) {
			return $this->image($image, $width, $height, $quality);
		}


		// is page tree
		function is_tree($pid) {
			global $post;
			$anc = get_post_ancestors( $post->ID );
			foreach($anc as $ancestor) {
				if(is_page() && $ancestor == $pid) {
					return true;
				}
			}
			if(is_page()&&(is_page($pid))) {
				return true;
			} else {
				return false;
			}
		}


		// get the slug
		function get_the_slug() {

			global $post;

			if ( is_single() || is_page() ) {
				return $post->post_name;
			} else {
				return "";
			}

		}


		// exclude pages from search
		function exclude_pages() {

			function excludePages($query) {
				if ($query->is_search) {
					$query->set('post_type', 'post');
				}
				return $query;
			}
			add_filter('pre_get_posts','excludePages');

		}


		// get current page url
		function current_url() {

			$pageURL = 'http';

			if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on")) {
				$pageURL .= "s";
			}

			$pageURL .= "://";

			if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
				$pageURL .= $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			}
			return $pageURL;
		}


		// enable svg uploads
		function enable_svg() {

			function cc_mime_types($mimes) {
				$mimes['svg'] = 'image/svg+xml';
				return $mimes;
			}
			add_filter('upload_mimes', 'cc_mime_types');

		}


		/**
		 * Ninja Framework Functions
		 */

		// get file size from file URL and format output into human readable units
		function filesize($fileurl) {

			$head = array_change_key_case(get_headers($fileurl, TRUE));
			$filesize = $head['content-length'];

			$bytes = floatval($filesize);
			$arBytes = array(
				0 => array(
					"UNIT" => "TB",
					"VALUE" => pow(1024, 4)
				),
				1 => array(
					"UNIT" => "GB",
					"VALUE" => pow(1024, 3)
				),
				2 => array(
					"UNIT" => "MB",
					"VALUE" => pow(1024, 2)
				),
				3 => array(
					"UNIT" => "KB",
					"VALUE" => 1024
				),
				4 => array(
					"UNIT" => "B",
					"VALUE" => 1
				),
			);

			foreach($arBytes as $arItem) {
				if($bytes >= $arItem["VALUE"]) {
					$result = $bytes / $arItem["VALUE"];
					$result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
					break;
				}
			}

			return $result;
		}


		// turns linux timestamp into 'x hours ago'
		function ago($time) {
			$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
			$lengths = array("60","60","24","7","4.35","12","10");

			$now = time();

			$difference     = $now - $time;
			$tense          = "ago";

			for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
				$difference /= $lengths[$j];
			}

			$difference = round($difference);

			if($difference != 1) {
				$periods[$j].= "s";
			}

			return "$difference $periods[$j] ago";
		}


		// fix links
		function fix_link($link) {
			$pos = strpos($link, 'http://');
			$pos_s = strpos($link, 'https://');
			$pos_m = strpos($link, 'mailto:');
			if( ($pos === false) && ($pos_s === false) && ($pos_m === false) ) {
				$link = 'http://' . $link;
			}
			return $link;
		}


		// filter tweets for links
		function tweet_link($tweet, $new = 1) {

			if ($new == 1) {
				$target = ' target="_blank"';
			} else {
				$target = '';
			}

			$regex_url = '@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@';
			$regex_user = '/(^|\s)@(\w+)/';
			$regex_tag = '/(^|\s)#(\w+)/';

			$tweet = preg_replace($regex_url, ' <a href="$1" class="twlink_link"'.$target.'>$1</a>', $tweet);
			$tweet = preg_replace($regex_user, '<a href="http://www.twitter.com/\2" class="twlink_at"'.$target.'>\1@\2</a>', $tweet);
			$tweet = preg_replace($regex_tag, '<a href="http://search.twitter.com/search?q=%23\2" class="twlink_hash"'.$target.'>\1#\2</a>', $tweet);

			return $tweet;
		}


		// return limited the_content length
		function shorter_content($wordlimit, $content = "", $ellipses = "...") {

			$content = explode(' ', $content, $wordlimit+1);

			if (count($content)>=$wordlimit) {
				array_pop($content);
				$content = implode(" ",$content).$ellipses;
			}
			else {
				$content = implode(" ",$content);
			}

			$content = preg_replace('/\[.+\]/','', $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);

			return $content;
		}


		// filter url for provider
		// print embed of media
		function embed_media($mediaurl, $container=true, $width=560, $height=315) {

			$pos = strpos($mediaurl, 'http://');
			$pos_s = strpos($mediaurl, 'https://');
			if( ($pos === false) && ($pos_s === false) ) {
				$mediaurl = 'http://' . $mediaurl;
			}

			$media_source = explode('/', $mediaurl);
			$media_source = explode('.', $media_source[2]);

			// vimeo
			if ((($media_source[0] == 'www') && ($media_source[1] == 'vimeo')) || ($media_source[0] == 'vimeo')) {

				$vimeo_key = explode('.com/', $mediaurl);
				$vimeo_key = explode('?', $vimeo_key[1]);

				$output_string = '<iframe src="http://player.vimeo.com/video/'.$vimeo_key[0].'?title=0&amp;byline=0&amp;share=0&amp;portrait=0&amp;color=6fde9f" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

				if(!$container || $container == 'false') {
					echo $output_string;
				} else {
					echo '<div class="media_post">'.$output_string.'</div>';
				}


			}
			// youtube
			else if ((($media_source[0] == 'www') && ($media_source[1] == 'youtube')) || ($media_source[0] == 'youtu') ) {

				if(strpos($mediaurl, "&v") || strpos($mediaurl, "?v")) {
					$youtube_key = explode('/', $mediaurl);
					$youtube_key = explode('v=', $youtube_key[3]);
					$youtube_key = explode('&', $youtube_key[1]);
				} else {
					$youtube_key = explode('?', $mediaurl);
					$youtube_key[0] = substr($youtube_key[0], -11);
				}

				$output_string = '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$youtube_key[0].'?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>';

				if (!$container || $container == 'false') {
					echo $output_string;
				} else {
					echo '<div class="media_post">'.$output_string.'</div>';
				}

			} else {

				echo '<p>Sorry, this media provider is not currently supported.</p>';

			}

		}


		// return clean array
		function clean_array($arr, $valid = null) {

			$return = array();

			foreach ( $arr as $key => $value ) {
				if ( !is_null($valid) && is_array($valid) && !in_array($key, $valid) ) {
					continue;
				}
				$return[$key] = addslashes(trim(strip_tags(stripslashes($value))));
			}
			return $return;

		}


		// return random value
		function random_value($length=10) {

			$values1 = 'aeiouAEIOU1234567890';
			$values2 = 'bcdfghjklmnpqrstvwxyzBCDFGHJLMNPQRSTVWXYZ';
			$randomstring = '';
			$alt = time() % 2;

			for ($i = 0; $i < $length; $i++) {

				if ($alt == 1) {
					$randomstring .= $values2[(rand() % strlen($values2))];
					$alt = 0;
				} else {
					$randomstring .= $values1[(rand() % strlen($values1))];
					$alt = 1;
				}

			}
			return $randomstring;

		}


		// return datetime value
		function get_datetime($format='Y-m-d H:i:s') {

			return date($format, time());

		}


		// print pagination
		function pagination($pages = '', $range = 2) {

			$showitems = ($range * 2)+1;

			global $paged;
			if(empty($paged)) $paged = 1;

			if($pages == '') {

				global $wp_query;
				$pages = $wp_query->max_num_pages;

				if(!$pages) {
					$pages = 1;
				}

			}

			if(1 != $pages) {

				echo '<div class="pagination">';
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'" class="page_prev">&#139;&#139;</a>';
				if($paged > 1 && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged - 1).'" class="page_prev">&#139;</a>';

				for ($i=1; $i <= $pages; $i++) {

					if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
						echo ($paged == $i)? '<a href="javascript:;" class="current">'.$i.'</a>':"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
					}

				}

				if ($paged < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged + 1).'" class="page_next">&#155;</a>';
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($pages).'" class="page_next">&#155;&#155;</a>';
				echo "</div>\n";

			}

		}


		// get page id by slug
		function id_by_slug($page_slug) {
			$page = get_page_by_path($page_slug);
			if ($page) {
				return $page->ID;
			} else {
				return null;
			}
		}


		// returns all published post ids from specific post type by post date
		function all_id_output($posttype) {
			global $wpdb;

			$results = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s and post_status = 'publish' ORDER BY post_date DESC", $posttype ), ARRAY_A );

			if ( !$results ) {
				return;
			}

			$output = [];
			foreach( $results as $index => $post ) {
				$output[] = $post['ID'];
			}

			return $output;
		}


		// super user filter
		/*function super_user() {

			get_currentuserinfo();
			if($current_user->user_login != 'ninjasforhire') {

				add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

				add_action('admin_menu', 'remove_menus', 102);
				function remove_menus() {

					global $submenu;

						remove_submenu_page( 'index.php', 'update-core.php' );
						remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );

					remove_menu_page( 'pods' );

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

						remove_submenu_page ( 'themes.php', 'themes.php' );
						remove_submenu_page ( 'themes.php', 'widgets.php' );
						remove_submenu_page ( 'themes.php', 'theme-editor.php' );

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

		}*/

	}