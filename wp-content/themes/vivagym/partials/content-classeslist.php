<?php global $nf; ?>
						<div class="grid block_container has_3_cols">

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
									<?php the_excerpt(); ?>
								</div>
							</div>

							<?php
								endwhile;
								endif;
								// Reset Post Data
								wp_reset_postdata();
							?>

						</div>
						<div class="facility_statement">
							<?php echo (get_sub_field('footer_statement')) ? get_sub_field('footer_statement') : ''; ?>
						</div>