<?php
	get_header();

	if (have_posts()) { while (have_posts()) { the_post();

?>

		<div class="section banner spec4 gyms-banner">
			<?php echo (get_field('header_image')) ? '<img src="'.$nf->image(get_field('header_image'),1700,434).'" alt="">' : '';?>
			<div class="overlay"></div>
			<div class="row">
				<div class="col-sm-6">
					<h1><?php echo (get_field('club_heading')) ? get_field('club_heading') : get_the_title(); ?></h1>
					<p><?php echo (get_field('club_sub_heading')) ? get_field('club_sub_heading') : ''; ?></p>

					<div class="button_container">
						<a href="<?php echo (get_field('join_now_link')) ? get_field('join_now_link') : ''; ?>" class="button">JOIN NOW</a>
					</div>
				</div>
				<!-- <div class="button_container">
					<a href="" class="button white_border">SEE HOW</a>
				</div> -->
			</div>
		</div>

		<div class="section gym-tabs">
				<div class="col-sm-4 gym-tab">
					<a href="<?php bloginfo('url') ?>/timetables/?gymid=<?php echo (get_field('club_api_id')) ? get_field('club_api_id') : ''; ?>">VIEW TIMETABLES</a>
				</div>
				<div class="col-sm-4 gym-tab">
					<a target="_blank" href="<?php echo (get_field('club_map_link')) ? get_field('club_map_link') : ''; ?>">GET DIRECTIONS</a>
				</div>
				<div class="col-sm-4 gym-tab">
					<a href="tel:<?php echo (get_field('club_phone')) ? get_field('club_phone') : ''; ?>"><?php echo (get_field('club_phone')) ? get_field('club_phone') : ''; ?></a>
				</div>
				<div class="clear"></div>
		</div>

		<div class="section main_content">
			<div class="row">
				<!-- <?php //include "templates/clubs_timetable.php"; ?> -->
				<div class="grid main_content single_club">
					<div class="main_column">
						<?php if(get_field('club_video')){ ?>

						<div class="row_header">
							<h2><?php echo (get_field('club_video_title')) ? get_field('club_video_title') : ''; ?></h2>
							<div class="row_tag" style="transform: rotate(-3deg);"><?php echo (get_field('club_video_sub_title')) ? get_field('club_video_sub_title') : ''; ?></div>
						</div>

						<div class="video">
							<div class="videowrapper">
								<span class="placeholder" style="background: url(images/video_snap.jpg) no-repeat 0 0 / cover;">
									<span class="overlay"></span>
									<span class="prompt"><?php include "images/svg/play_single.svg" ?></span>
								</span>
								<?php echo get_field('club_video'); ?>
							</div>
						</div>
						<?php } ?>
						<div class="grid benefits">

							<?php

							// check if the repeater field has rows of data
							if( have_rows('club_highlight_boxes') ):

							 	// loop through the rows of data
							    while ( have_rows('club_highlight_boxes') ) : the_row();

							        ?>

									<div class="box box1" style="background: url(<?php echo (get_sub_field('image')) ? get_sub_field('image') : ''; ?>) no-repeat 0 0 / cover;">
										<div class="overlay"></div>
										<div class="box_content">
											<h4><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h4>
											<?php echo (get_sub_field('content')) ? get_sub_field('content') : ''; ?>
											<div class="button_container">
												<a class="blue_button" href="<?php echo (get_sub_field('link')) ? get_sub_field('link') : ''; ?>"><?php echo (get_sub_field('link_text')) ? get_sub_field('link_text') : ''; ?></a>
											</div>
										</div>

									</div>

							        <?php

							    endwhile;

							else :

							    // no rows found

							endif;

							?>



						</div>

						<div class="inline_banner black">
							<h4><?php echo (get_field('join_now_title')) ? get_field('join_now_title') : ''; ?></h4>
							<?php echo (get_field('join_now_content')) ? get_field('join_now_content') : ''; ?>
							<div class="button_container">
								<a href="<?php echo (get_field('join_now_link')) ? get_field('join_now_link') : ''; ?>" class="button white_border">JOIN NOW</a>
							</div>
						</div>

						<div class="block_container pt">
							<div class="row_header">
								<h2>FEATURED PERSONAL <br>TRAINERS</h2>
							</div>
							<div class="grid trainers">


							<?php

							// check if the repeater field has rows of data
							if( have_rows('trainers') ):

							 	// loop through the rows of data
							    while ( have_rows('trainers') ) : the_row();

							        ?>

										<div class="block <?php echo (get_sub_field('featured')) ? 'featured' : ''; ?>">
											<div class="block_image">

												<?php
													$featuredimg = get_sub_field('image');
													if($featuredimg){
														echo '<img src="'.$nf->image( $featuredimg, 309, 288).'" alt="">';
													}else{
														echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">';
													}
												?>
											</div>
											<h5 class="block_title">
												<?php echo (get_sub_field('name')) ? get_sub_field('name') : ''; ?>
											</h5>
											<div class="block_email">
												<a href="mailto:<?php echo (get_sub_field('email')) ? get_sub_field('email') : ''; ?>"><?php echo (get_sub_field('email')) ? get_sub_field('email') : ''; ?></a><br>
												<a href="tel:<?php echo (get_sub_field('cellphone')) ? get_sub_field('cellphone') : ''; ?>"><?php echo (get_sub_field('cellphone')) ? get_sub_field('cellphone') : ''; ?></a>
											</div>
										</div>



							        <?php

							    endwhile;

							else :

							    // no rows found

							endif;

							?>


							</div>
							<!-- <div class="button_container">
								<a href="<?php //bloginfo('url'); ?>/meet-the-team/?gympageid=<?php //echo $post->ID; ?>" class="button black_border viewalltrainers">VIEW ALL TRAINERS</a>
							</div> -->
						</div>

						<div class="row_header">
							<h2>MEMBER COMMENTS</h2>
							<div class="row_tag" style="transform: rotate(-3deg);">(What peeps are saying)</div>
						</div>
						<div class="member_comments">

							<?php
								$terms = wp_get_post_terms( $post->ID, array( 'locations' ) );

								if($terms){
									$taxquery = array(
									array(
										'taxonomy' => 'locations',
										'field'    => 'slug',
										'terms'    => $terms[0]->slug,
									),
								);
								}else{
									$taxquery = array();
								}

								$args = array(
									'post_type' => 'testimonials',
									'tax_query' => $taxquery
								);
								$the_query = new WP_Query( $args );
								// The Loop
								if ( $the_query->have_posts() ) :
								while ( $the_query->have_posts() ) : $the_query->the_post();
							?>

							<div class="comment_row">
								<?php the_content(); ?>
								<div class="comment_by">
									- <?php echo (get_field('testimonial_author')) ? get_field('testimonial_author') : ''; ?>
								</div>
							</div>

							<?php
								endwhile;
								endif;
								// Reset Post Data
								wp_reset_postdata();
							?>

						</div>

						


					</div>
					<aside class="right_bar">
							<div class="block block--joinfee <?php echo (get_field('joinfee_colors') && get_field('joinfee_colors') != 'default') ? get_field('joinfee_colors') : 'black'; ?>">
                                <a href="/viva-gym-promotion/">
                                    <img src="
            <?php if( have_rows('sidebar_promo_banner','options') ): ?>
                <?php
                                        while( have_rows('sidebar_promo_banner','options') ): the_row();

                                            // vars
                                            $current_datetime = date("Y-m-d H:i:s", time()+60*60*$diff=2);
                                            $start_publishing_sidebar_promo = get_sub_field('start_publishing_sidebar_promo','options');
                                            $finish_publishing_sidebar_promo = get_sub_field('finish_publishing_sidebar_promo','options');

                                            if ($current_datetime >= $start_publishing_sidebar_promo && $current_datetime < $finish_publishing_sidebar_promo) {
                                                the_sub_field('image_sidebar_promo_schedule','options');
                                            }
                                            else {
                                                the_sub_field('image_sidebar_promo_normal','options');
                                            }

                                        endwhile; ?>
            <?php endif; ?>
            ">
                                </a>
							</div>
						<div class="block yellow">
							<a href="<?php bloginfo('url') ?>/timetables/?gymid=<?php echo (get_field('club_api_id')) ? get_field('club_api_id') : ''; ?>">
								<div class="ico"><?php include "images/svg/big_cal.svg" ?></div>
								<h3>View Timetables</h3>
							</a>
						</div>
						<div class="block map">
							<?php echo (get_field('gym_google_map')) ? get_field('gym_google_map') : ''; ?>
						</div>
						<div class="block charcoal">
							<h3>MEET THE <br>MANAGER</h3>
							<div class="profile_image">

								<?php echo (get_field('manager_photo')) ? '<img src="'.get_field('manager_photo').'" alt="">' : ''; ?>
							</div>
							<h5><?php echo (get_field('manager_name')) ? get_field('manager_name') : ''; ?></h5>
							<ul class="aside_social">
								<?php echo (get_field('manager_facebook')) ? '<li><a href="'.get_field('manager_facebook').'"><img src="'.get_bloginfo('template_url').'/images/svg/fb_foot.svg" /></a></li>' : ''; ?>
								<?php echo (get_field('manager_twitter')) ? '<li><a href="'.get_field('manager_twitter').'"><img src="'.get_bloginfo('template_url').'/images/svg/twit_foot.svg" /></a></li>' : ''; ?>
								<?php echo (get_field('manager_instagram')) ? '<li><a href="'.get_field('manager_instagram').'"><img src="'.get_bloginfo('template_url').'/images/svg/insta_foot.svg" /></a></li>' : ''; ?>
								<?php echo (get_field('manager_linkedin')) ? '<li><a href="'.get_field('manager_linkedin').'"><img src="'.get_bloginfo('template_url').'/images/svg/lin.svg" /></a></li>' : ''; ?>

							</ul>
						</div>
						<div class="block blue">
							<h3>GENERAL INFO</h3>
							<div class="club_info">
								<div>
									<span class="icon"><?php include "images/svg/phone.svg"; ?></span>
									<a href="tel:<?php echo (get_field('club_phone')) ? get_field('club_phone') : ''; ?>"><?php echo (get_field('club_phone')) ? get_field('club_phone') : ''; ?></a>
								</div>
								<div>
									<span class="icon"><?php include "images/svg/mail.svg"; ?></span>
									<a href="tel:<?php echo (get_field('club_email')) ? get_field('club_email') : ''; ?>"><?php echo (get_field('club_email')) ? get_field('club_email') : ''; ?></a>
								</div>
								<div>
									<span class="icon"><?php include "images/svg/map.svg"; ?></span>
									<a href="<?php echo (get_field('club_map_link')) ? get_field('club_map_link') : ''; ?>">map link</a>
								</div>
								<div>
									<span class="icon"><?php include "images/svg/money_bag.svg"; ?></span>
									<div class="rate_box">
										<?php echo (get_field('cost_per_month')) ? get_field('cost_per_month') : ''; ?> <br>
										<?php echo (get_field('cost_per_12_months')) ? get_field('cost_per_12_months') : ''; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="block yellow">
                                <div class="frm_forms " id="frm_form_6_container">
                                    <div class="frm-show-form free_pass frm_js_validate  frm_pro_form  frm_ajax_submit  frm-admin-viewing ">
                                        <div class="frm_form_fields ">
                                            <h3 class="frm_form_title">Get Our Newsletter</h3>
                                            <div class="frm_description"><p>Sign up to awesomeness! Get our newsletter with everything from workout playlists, healthy recipes, wellness articles and Viva news.</p>
                                            </div><div class="frm_fields_container">
                                                <!-- SharpSpring Form for Newsletter  -->
<!--                                                <script type="text/javascript">-->
<!--                                                    var ss_form = {'account': 'MzawMDE3NDAxAwA', 'formID': 'M041NzJMSk7TNTI1Mdc1SUs00rW0MDDQNbVINQeKJ6cZJJkAAA'};-->
<!--                                                    ss_form.width = '100%';-->
<!--                                                    ss_form.height = '1000';-->
<!--                                                    ss_form.domain = 'app-3QNGCC2JLC.marketingautomation.services';-->
<!--                                                    ss_form.hidden = {'_usePlaceholders': true};-->
<!--                                                    // ss_form.hidden = {'Company': 'Anon'}; // Modify this for sending hidden variables, or overriding values-->
<!--                                                </script>-->
<!--                                                <script type="text/javascript" src="https://koi-3QNGCC2JLC.marketingautomation.services/client/form.js?ver=1.1.1"></script>-->

                                                <?php echo do_shortcode('[contact-form-7 id="4543" title="Newsletter"]'); ?>
                                            </div>
                                        </div>
                                    </div>
<!--								--><?php // echo do_shortcode('[formidable id=6]'); ?>
						</div>
						</div>
					</aside>
				</div>

<!--                --><?php
//                $current_url = $_SERVER['REQUEST_URI'];
//                if ( strpos($current_url, 'fourways-johannesburg') !== false ) { ?>
<!--                    <div class="gym-classes">-->
<!--						<h3><b>Which classes are available at Fourways Johannesburg Gym</b></h3>-->
<!--						<p> If you are interested in signing up at Fourways Gym, you can also enjoy the following classes</p><br>-->
<!---->
<!--						<span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-and-mind-classes/">Body & Mind <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-conditioning-classes/">Body Conditioning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/bootcamp-training/">Bootcamp<span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/dance-fitness/">Dance Fitness <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/functional-training-classes/">Functional training <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/kickboxing-classes/">Kickboxing <span style="color: #ffc90d;">&gt;   </span></a></span> <span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/les-mills/">Les Mills <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/spinning-classes/">Spinning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/step-classes/">Step Classes <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/strength-training/">Strength <span style="color: #ffc90d;">&gt;   </span></a></span>-->
<!--						<br>-->
<!--						<a href="/fitness-classes/"><button class="button-two">See all fitness classes</button></a>-->
<!--						<br>-->
<!--						<a href="/class-finder-tool/"><button class="button-four">Find a class for you</button></a>-->
<!--                    </div>-->
<!--                --><?php //}
//                else if (strpos($current_url, 'hillfox-johannesburg') !== false) { ?>
<!--                    <div class="gym-classes">-->
<!--						<h3><b>Which classes are available at Fourways Johannesburg Gym</b></h3>-->
<!--						<p> If you are interested in signing up at Fourways Gym, you can also enjoy the following classes</p><br>-->
<!---->
<!--						<span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-and-mind-classes/">Body & Mind <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-conditioning-classes/">Body Conditioning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/bootcamp-training/">Bootcamp<span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/dance-fitness/">Dance Fitness <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/functional-training-classes/">Functional training <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/les-mills/">Les Mills <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/spinning-classes/">Spinning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/step-classes/">Step Classes <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/strength-training/">Strength <span style="color: #ffc90d;">&gt;   </span></a></span>-->
<!--						<br>-->
<!--						<a href="/fitness-classes/"><button class="button-two">See all fitness classes</button></a>-->
<!--						<br>-->
<!--						<a href="/class-finder-tool/"><button class="button-four">Find a class for you</button></a>-->
<!--                    </div>-->
<!--                --><?php //}
//                else if (strpos($current_url, 'montana-pretoria') !== false) { ?>
<!--                    <div class="gym-classes">-->
<!--						<h3><b>Which classes are available at Fourways Johannesburg Gym</b></h3>-->
<!--						<p> If you are interested in signing up at Fourways Gym, you can also enjoy the following classes</p><br>-->
<!---->
<!--						<span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-and-mind-classes/">Body & Mind <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-conditioning-classes/">Body Conditioning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/bootcamp-training/">Bootcamp<span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/dance-fitness/">Dance Fitness <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/functional-training-classes/">Functional training <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/kickboxing-classes/">Kickboxing <span style="color: #ffc90d;">&gt;   </span></a></span> <span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/spinning-classes/">Spinning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/step-classes/">Step Classes <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/strength-training/">Strength <span style="color: #ffc90d;">&gt;   </span></a></span>-->
<!--						<br>-->
<!--						<a href="/fitness-classes/"><button class="button-two">See all fitness classes</button></a>-->
<!--						<br>-->
<!--						<a href="/class-finder-tool/"><button class="button-four">Find a class for you</button></a>-->
<!--                    </div>-->
<!--                --><?php //}
//                else if (strpos($current_url, 'oakdene-johannesburg') !== false) { ?>
<!--                    <div class="gym-classes">-->
<!--						<h3><b>Which classes are available at Fourways Johannesburg Gym</b></h3>-->
<!--						<p> If you are interested in signing up at Fourways Gym, you can also enjoy the following classes</p><br>-->
<!---->
<!--						<span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-and-mind-classes/">Body & Mind <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-conditioning-classes/">Body Conditioning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/bootcamp-training/">Bootcamp<span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/dance-fitness/">Dance Fitness <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/kickboxing-classes/">Kickboxing <span style="color: #ffc90d;">&gt;   </span></a></span> <span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/les-mills/">Les Mills <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/spinning-classes/">Spinning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/step-classes/">Step Classes <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/strength-training/">Strength <span style="color: #ffc90d;">&gt;   </span></a></span>-->
<!--						<br>-->
<!--						<a href="/fitness-classes/"><button class="button-two">See all fitness classes</button></a>-->
<!--						<br>-->
<!--						<a href="/class-finder-tool/"><button class="button-four">Find a class for you</button></a>-->
<!--                    </div>-->
<!--                --><?php //}
//
//                else if (strpos($current_url, 'rosebank-johannesburg') !== false) { ?>
<!--                    <div class="gym-classes">-->
<!--						<h3><b>Which classes are available at Fourways Johannesburg Gym</b></h3>-->
<!--						<p> If you are interested in signing up at Fourways Gym, you can also enjoy the following classes</p><br>-->
<!---->
<!--						<span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-and-mind-classes/">Body & Mind <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-conditioning-classes/">Body Conditioning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/bootcamp-training/">Bootcamp<span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/dance-fitness/">Dance Fitness <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/kickboxing-classes/">Kickboxing <span style="color: #ffc90d;">&gt;   </span></a></span> <span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/les-mills/">Les Mills <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/spinning-classes/">Spinning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/step-classes/">Step Classes <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/strength-training/">Strength <span style="color: #ffc90d;">&gt;   </span></a></span>-->
<!--						<br>-->
<!--						<a href="/fitness-classes/"><button class="button-two">See all fitness classes</button></a>-->
<!--						<br>-->
<!--						<a href="/class-finder-tool/"><button class="button-four">Find a class for you</button></a>-->
<!--                    </div>-->
<!--                --><?php //}
//                else if (strpos($current_url, 'sunningdale-cape-town') !== false) { ?>
<!--                    <div class="gym-classes">-->
<!--						<h3><b>Which classes are available at Fourways Johannesburg Gym</b></h3>-->
<!--						<p> If you are interested in signing up at Fourways Gym, you can also enjoy the following classes</p><br>-->
<!---->
<!--						<span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-and-mind-classes/">Body & Mind <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-conditioning-classes/">Body Conditioning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/bootcamp-training/">Bootcamp<span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/dance-fitness/">Dance Fitness <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/les-mills/">Les Mills <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/spinning-classes/">Spinning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/step-classes/">Step Classes <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/strength-training/">Strength <span style="color: #ffc90d;">&gt;   </span></a></span>-->
<!--						<br>-->
<!--						<a href="/fitness-classes/"><button class="button-two">See all fitness classes</button></a>-->
<!--						<br>-->
<!--						<a href="/class-finder-tool/"><button class="button-four">Find a class for you</button></a>-->
<!--                    </div>-->
<!--                --><?php //}
//                else if (strpos($current_url, 'walmer-port-elizabeth') !== false) { ?>
<!--                    <div class="gym-classes">-->
<!--						<h3><b>Which classes are available at Fourways Johannesburg Gym</b></h3>-->
<!--						<p> If you are interested in signing up at Fourways Gym, you can also enjoy the following classes</p><br>-->
<!---->
<!--						<span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/body-and-mind-classes/">Body & Mind <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="classes/body-conditioning-classes/">Body Conditioning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/bootcamp-training/">Bootcamp<span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/dance-fitness/">Dance Fitness <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/functional-training-classes/">Functional training <span style="color: #ffc90d;">&gt;</span></a>   </span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/kickboxing-classes/">Kickboxing <span style="color: #ffc90d;">&gt;   </span></a></span> <span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/les-mills/">Les Mills <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/spinning-classes/">Spinning <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/step-classes/">Step Classes <span style="color: #ffc90d;">&gt;   </span></a></span><span style="text-decoration: none !important; font-weight: 400; color: #000000;"><a style="text-decoration: none !important; color: #000000;" href="/classes/strength-training/">Strength <span style="color: #ffc90d;">&gt;   </span></a></span>-->
<!--						<br>-->
<!--						<a href="/fitness-classes/"><button class="button-two">See all fitness classes</button></a>-->
<!--						<br>-->
<!--						<a href="/class-finder-tool/"><button class="button-four">Find a class for you</button></a>-->
<!--                    </div>-->
<!--                --><?php //}
//                 else {
//                     echo "";
//                 }
//                ?>



				<hr class="yellow">
				<?php include "templates/latest_blog_general.php"; ?>
			</div>
		</div>




	<?php } } ?>


<?php get_footer(); ?>