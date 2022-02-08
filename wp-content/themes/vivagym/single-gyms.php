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
			</div>
		</div>

		<div class="section gym-tabs">
			<div class="col-sm-4 gym-tab">
				<a href="<?php bloginfo('url') ?>/timetables/?gymid=<?php echo (get_field('club_api_id')) ? get_field('club_api_id') : ''; ?>"><span class="icon"><?php include "images/svg/big_cal.svg" ?></span> VIEW TIMETABLES</a>
			</div>
			<div class="col-sm-4 gym-tab">
				<a target="_blank" href="<?php echo (get_field('club_map_link')) ? get_field('club_map_link') : ''; ?>"><span class="icon"><?php include "images/svg/map.svg" ?></span>GET DIRECTIONS</a>
			</div>
			<div class="col-sm-4 gym-tab">
				<a href="tel:<?php echo (get_field('club_phone')) ? get_field('club_phone') : ''; ?>"><span class="icon"><?php include "images/svg/phone.svg"; ?></span><?php echo (get_field('club_phone')) ? get_field('club_phone') : ''; ?></a>
			</div>
			<div class="clear"></div>
		</div>


		<div class="section main_content gym-single">

			<div class="row video-block">
				<div class="col-sx-12 col-sm-12 col-md-6">
					<div class="benefits">
						<?php if( have_rows('club_highlight_boxes') ): while ( have_rows('club_highlight_boxes') ) : the_row(); ?>
							<div class="box_content">
								<h2><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h2>
								<h4>FROM ONLY R329 PER MONTH</h4>
								<?php echo (get_sub_field('content')) ? get_sub_field('content') : ''; ?>
								<div class="button_container">
									<a class="black_button" href="<?php echo (get_sub_field('link')) ? get_sub_field('link') : ''; ?>"><?php echo (get_sub_field('link_text')) ? get_sub_field('link_text') : ''; ?></a>
									<a href="<?php echo (get_field('join_now_link')) ? get_field('join_now_link') : ''; ?>" class="yellow_button">SIGN UP</a>
								</div>
							</div>
						<?php endwhile; endif;?>
					</div>
				</div>

				<?php if(get_field('club_video')){ ?>
					<div class="col-sx-12 col-sm-12 col-md-6">
						<div class="video">
							<span class="video-background"></span>
							<div class="videowrapper">
								<span class="placeholder" style="background: url(images/video_snap.jpg) no-repeat 0 0 / cover;">
									<span class="overlay"></span>
									<span class="prompt"><?php include "images/svg/play_single.svg" ?></span>
								</span>
								<?php echo get_field('club_video'); ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>


			<div class="row">
				<div class="col-sm-6">
					<h2>FEATURED PERSONAL <br>TRAINERS</h2>
				</div>
				<div class="col-sm-6"></div>
			</div>

				
					
			<div class="row slider-block">
					<div class="vertical-center-3 slider">
						<?php if( have_rows('trainers') ): while ( have_rows('trainers') ) : the_row();?>
							
								<div class="slider-inner">
									<?php
										$featuredimg = get_sub_field('image');
										if($featuredimg){
											echo '<img src="'.$nf->image( $featuredimg, 309, 288).'" alt="">';
										}else{
											echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">';
										}
									?>
									<div class="slider-content">
										<h5 class="block_title">
											<?php echo (get_sub_field('name')) ? get_sub_field('name') : ''; ?>
										</h5>
										<div class="block_email">
											<a href="mailto:<?php echo (get_sub_field('email')) ? get_sub_field('email') : ''; ?>"><?php echo (get_sub_field('email')) ? get_sub_field('email') : ''; ?></a><br>
											<a href="tel:<?php echo (get_sub_field('cellphone')) ? get_sub_field('cellphone') : ''; ?>"><?php echo (get_sub_field('cellphone')) ? get_sub_field('cellphone') : ''; ?></a>
										</div>
									</div>

								</div>
							
						<?php endwhile; endif;?>
					<div>
			</div>
		</div>
		<div class="space_holder"></div>
 	</div>



	<?php } } ?>


<?php get_footer(); ?>