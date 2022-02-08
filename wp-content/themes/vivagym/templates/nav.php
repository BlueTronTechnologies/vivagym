<?php global $nf; ?>
<div class="section header">
	<div class="row">
		<div class="site_logo">
			<a href="<?php bloginfo('url'); ?>"><?php echo file_get_contents(TEMPLATEPATH . "/images/svg/web_logo.svg"); ?></a>
		</div>
		<div class="mobi_join">
			<a href="<?php echo (get_field('join_now_link','options')) ? get_field('join_now_link','options') : ''; ?>" class="yellow-background big_button mobile_header_join">JOIN NOW</a>
		</div>
		<div class="mobi_ico">
			<div class="menu_ico">
				<a href="javascript:;" class="btn_menu">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</a>
				<div class="btn_close">
					<div class="bar1"></div>
					<div class="bar3"></div>
				</div>
			</div>
		</div>
		<div class="nav_section">
			<ul id="menu-top-menu" class="menu">
				<li class="<?php if(is_page('our-gyms') || is_singular( 'gyms' )){ echo 'current-menu-item current_page_item'; } ?> hasmega">
					<a href="<?php bloginfo('url'); ?>/our-gyms/" class="link">
						<span class="menu_ico">
							<?php echo file_get_contents(TEMPLATEPATH . "/images/svg/home.svg"); ?>
						</span>
						<span class="menu_title">
							our gyms
						</span>
					</a>

					<div class="mega">
						<div class="inner">
							<div class="mega__content megaclasses">

								<div class="header clearfix">
									<ul>
										<li><strong>Class Timetables: </strong></li>
												<?php
													$args = array(
														'post_type' => 'gyms',
														'posts_per_page' => -1,
														'orderby' => 'title',
														'order' => 'ASC',
													);

													$the_query = new WP_Query( $args );
													// The Loop
													if ( $the_query->have_posts() ) :
													while ( $the_query->have_posts() ) : $the_query->the_post();

												?>
													<li><a href="<?php echo (get_field('club_api_id')) ? get_bloginfo('url').'/timetables/?gymid='.get_field('club_api_id') : ''; ?>"><?php the_title(); ?></a></li>

												<?php
													endwhile;
													endif;
													// Reset Post Data
													wp_reset_postdata();
												?>


									</ul>
								</div>

								<div class="footer clearfix">
									<ul>
										<?php
											$args = array(
												'post_type' => 'gyms',
												'posts_per_page' => -1,
												'orderby' => 'title',
												'order' => 'ASC',
											);

											$the_query = new WP_Query( $args );
											// The Loop
											if ( $the_query->have_posts() ) :
											while ( $the_query->have_posts() ) : $the_query->the_post();

												$featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));

										?>
											<li><a href="<?php the_permalink(); ?>">

													<?php
										if($featimage){
											echo '<img src="'.$nf->image( $featimage, 90, 90).'" alt="">';
										}else{
											echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">';
										}
									?>
									<?php the_title(); ?>
												</a></li>

										<?php
											endwhile;
											endif;
											// Reset Post Data
											wp_reset_postdata();
										?>
									</ul>
								</div>


							</div>
						</div>
					</div>
				</li>
				<li class="<?php if(is_page('our-facilities') || is_singular( 'facilities' )){ echo 'current-menu-item current_page_item'; } ?> hasmega">
					<a href="<?php bloginfo('url'); ?>/our-facilities/"  class="link">
						<span class="menu_ico">
							<?php echo file_get_contents(TEMPLATEPATH . "/images/svg/dumbell.svg"); ?>
						</span>
						<span class="menu_title">
							our facilities
						</span>
					</a>

					<div class="mega mega--onerow">
						<div class="inner">
							<div class="mega__content gridlist clearfix">

								<?php
									$args = array(
										'post_type' => 'facilities',
										'posts_per_page' => 6
									);

									$the_query = new WP_Query( $args );
									// The Loop
									if ( $the_query->have_posts() ) :
									while ( $the_query->have_posts() ) : $the_query->the_post();
 									$featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
								?>

								<a href="<?php the_permalink(); ?>" class="item clearfix">
									<?php
										if($featimage){
											echo '<img src="'.$nf->image( $featimage, 90, 90).'" alt="">';
										}else{
											echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">';
										}
									?>
									<div class="item_content">
										<h3><?php the_title(); ?></h3>
										<?php
										$content = get_the_content();
										$content = wp_filter_nohtml_kses($content);
										echo $nf->shorter_content(20,$content);
										?>
									</div>
								</a>

								<?php
									endwhile;
									endif;
									// Reset Post Data
									wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</li>
				<li class="<?php if(is_page('fitness-classes') || is_singular( 'classes' )){ echo 'current-menu-item current_page_item'; } ?> hasmega">
					<a href="<?php bloginfo('url'); ?>/fitness-classes/" class="link">
						<span class="menu_ico">
							<?php echo file_get_contents(TEMPLATEPATH . "/images/svg/groups.svg"); ?>
						</span>
						<span class="menu_title">
							group training & timetables
						</span>
					</a>

					<div class="mega mega--extraheight">
						<div class="inner">
							<div class="mega__content megaclasses">

								<div class="header clearfix">
									<ul>
										<li><strong>Class Timetables: </strong></li>
												<?php
													$args = array(
														'post_type' => 'gyms',
														'posts_per_page' => -1,
														'orderby' => 'title',
														'order' => 'ASC',
													);

													$the_query = new WP_Query( $args );
													// The Loop
													if ( $the_query->have_posts() ) :
													while ( $the_query->have_posts() ) : $the_query->the_post();

												?>
													<li><a href="<?php echo (get_field('club_api_id')) ? get_bloginfo('url').'/timetables/?gymid='.get_field('club_api_id') : ''; ?>"><?php the_title(); ?></a></li>

												<?php
													endwhile;
													endif;
													// Reset Post Data
													wp_reset_postdata();
												?>



									</ul>
								</div>

								<div class="footer clearfix">
									<ul>
<!--                                        <li>-->
<!--                                            <a href="/class-finder-tool">-->
<!--                                                <img src="https://vivagym.co.za/wp-content/uploads/2018/08/class-finder-01-01.jpg" alt="">-->
<!--                                                CLASS FINDER-->
<!--                                            </a>-->
<!--                                        </li>-->
										<?php
											$args = array(
												'post_type' => 'classes',
												'posts_per_page' => -1,
												'orderby' => 'title',
												'order' => 'ASC',
											);

											$the_query = new WP_Query( $args );
											// The Loop
											if ( $the_query->have_posts() ) :
											while ( $the_query->have_posts() ) : $the_query->the_post();

												$featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));

										?>
											<li><a href="<?php the_permalink(); ?>">

													<?php
										if($featimage){
											echo '<img src="'.$nf->image( $featimage, 90, 90).'" alt="">';
										}else{
											echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">';
										}
									?>
									<?php the_title(); ?>
												</a></li>

										<?php
											endwhile;
											endif;
											// Reset Post Data
											wp_reset_postdata();
										?>
									</ul>
								</div>
								<a href="/fitness-classes/"><button class="button-three">View all fitness</button></a>

							</div>
						</div>
					</div>
				</li>
				<li class="<?php if(is_page('fitness-library') || is_singular( 'guides' )){ echo 'current-menu-item current_page_item'; } ?>">
					<a href="<?php bloginfo('url'); ?>/fitness-library/" class="link">
						<span class="menu_ico">
							<?php echo file_get_contents(TEMPLATEPATH . "/images/svg/library.svg"); ?>
						</span>
						<span class="menu_title">
							fitness library
						</span>
					</a>

				<!--  ///mega saved in BU_nav.php/// -->
				</li>
				<?php
					$about_items = wp_get_nav_menu_items('about');
					$aboutcurrent = false;
					foreach( $about_items as $about_item ) {
						if($about_item->object_id == $post->ID){
							$aboutcurrent = true;
						}
					}
				?>
				<li class="<?php if(is_page('about-viva-gym') || $aboutcurrent){ echo 'current-menu-item current_page_item'; } ?> hasmega">
					<a href="<?php bloginfo('url'); ?>/about-viva/" class="link">
						<span class="menu_ico">
							<?php echo file_get_contents(TEMPLATEPATH . "/images/svg/viva_ico.svg"); ?>
						</span>
						<span class="menu_title">
							about viva
						</span>
					</a>

					<div class="mega">
						<div class="inner">
							<div class="mega__content gridlist clearfix">


								<?php
								function clean_custom_menu( $menu_slug ) {
									global $nf;
										$menu_items = wp_get_nav_menu_items($menu_slug);

										$menu_list  = '';

										$count = 0;
										$submenu = false;

										foreach( $menu_items as $menu_item ) {

											//print_r($menu_item );

											$link = $menu_item->url;
											$title = $menu_item->title;
											$pid = $menu_item->object_id;
											$featimage = wp_get_attachment_url( get_post_thumbnail_id($pid));

											$menu_list .= '<a href="'.$link.'" class="item clearfix">';
											if($featimage){
												$menu_list .= '<img src="'.$nf->image( $featimage, 90, 90).'" alt="">';
											}else{
												$menu_list .= '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="" width="90px" height="90px">';
											}
											$menu_list .= '<div class="item_content"><h3>'.$title.'</h3>';
											$content_post = get_post($pid);
											$content = $content_post->post_content;
											if($content){
												$content = wp_filter_nohtml_kses($content);
												$menu_list .= $nf->shorter_content(20,$content);
											}
											$menu_list .= '</div></a>';


											$count++;
										}

									echo $menu_list;
								}
								clean_custom_menu('about');
								?>


							</div>
						</div>
					</div>
				</li>
				<?php
					$specials_items = wp_get_nav_menu_items('specials');
					$specialscurrent = false;
					foreach( $specials_items as $specials_item ) {
						if($specials_item->object_id == $post->ID){
							$specialscurrent = true;
						}
					}
				?>
<!--				<li class="--><?php //if(is_page('special-offers-events') || $specialscurrent){ echo 'current-menu-item current_page_item'; } ?><!--">-->
<!--					<a href="--><?php //bloginfo('url'); ?><!--/special-offers-events/" class="link">-->
<!--						<span class="menu_ico">-->
<!--							--><?php //echo file_get_contents(TEMPLATEPATH . "/images/svg/small_cal.svg"); ?>
<!--						</span>-->
<!--						<span class="menu_title">-->
<!--							special offers & events-->
<!--						</span>-->
<!--					</a>-->
<!--				</li>-->
			</ul>

			<div class="member_nav">
                <a href="https://app.vivagym.co.za/login/" class="loginbtn"><?php echo file_get_contents(TEMPLATEPATH . "/images/svg/user.svg"); ?>Login</a>
<!--				<a href="--><?php //echo (get_field('login_link','options')) ? get_field('login_link','options') : ''; ?><!--" class="loginbtn">--><?php //echo file_get_contents(TEMPLATEPATH . "/images/svg/user.svg"); ?><!--Login</a>-->
				<a href="<?php bloginfo('url'); ?>/blog/"><?php echo file_get_contents(TEMPLATEPATH . "/images/svg/chat_box.svg"); ?>Blog</a>
				<a href="<?php echo (get_field('join_now_link','options')) ? get_field('join_now_link','options') : ''; ?>" class="yellow-background big_button">Join Now</a>
			</div>
		</div>

	</div>
</div>