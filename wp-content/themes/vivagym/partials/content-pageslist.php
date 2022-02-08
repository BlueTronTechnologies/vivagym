<?php global $nf; ?>
						<div class="grid block_container has_3_cols">

							<?php 
						
																// check if the repeater field has rows of data
								if( have_rows('pages') ):

								 	// loop through the rows of data
								    while ( have_rows('pages') ) : the_row();

								        // display a sub field value
								       $post_object = get_sub_field('page');
								       // override $post
										$post = $post_object;
										setup_postdata( $post ); 
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

							wp_reset_postdata();
							
								    endwhile;

									else :

									    // no rows found

									endif;


							?>

						</div>
