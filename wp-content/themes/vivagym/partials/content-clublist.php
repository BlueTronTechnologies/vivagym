<?php global $nf; ?>
						<div class="filter"><?php include TEMPLATEPATH . "/templates/filter.php"; ?></div>
						<div class="grid block_container has_3_cols clubs">

							<?php 
								if(isset($_GET['province'])){
									$province = $_GET['province'];
								}else{
									$province = '';
								}
								$taxquery = array(
									array(
										'taxonomy' => 'provinces',
										'field'    => 'slug',
										'terms'    => $province,
									),
								);
								if($province != ''){
									$args = array( 
										'post_type' => 'gyms',
										'posts_per_page' => -1,
										'tax_query' => $taxquery,
										'orderby' => 'title',
										'order' => 'ASC',
									);
								}else{
									$args = array( 
										'post_type' => 'gyms',
										'posts_per_page' => -1,
										'orderby' => 'title',
										'order' => 'ASC',
									);
								}
								
								$the_query = new WP_Query( $args );
								// The Loop
								if ( $the_query->have_posts() ) :
								while ( $the_query->have_posts() ) : $the_query->the_post();

							?>

							<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>

							<div class="block">
								<a href="<?php the_permalink(); ?>">
									<div class="block_image">
										
										<?php 
											if($featimage){ 
												echo '<img src="'.$nf->image( $featimage, 309, 288).'" alt="">'; 
											}else{ 
												echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">'; 
											} 
										?>
									</div>
									<h5 class="block_title">
										<?php the_title(); ?>
									</h5>
								</a>
								<div class="block_description">
									<?php echo (get_field('club_address')) ? get_field('club_address') : ''; ?>
								</div>
								<div class="block_meta club">
									<?php if(get_field('club_phone')){ ?>
									<div class="contact">
										<i class="phone"><?php include TEMPLATEPATH . "/images/svg/phone.svg" ?></i>
										<a href="tel:<?php echo get_field('club_phone'); ?>"><?php echo get_field('club_phone'); ?></a>
									</div>
									<?php } ?>
									<?php if(get_field('club_map_link')){ ?>
									<div class="map">
										<i class="map"><?php include TEMPLATEPATH . "/images/svg/map.svg" ?></i>
										<a href="<?php echo get_field('club_map_link'); ?>" target="_blank">map link</a>
									</div>
									<?php } ?>
								</div>
							</div>

							<?php
								endwhile;
								endif;
								// Reset Post Data
								wp_reset_postdata();
							?>

						</div>