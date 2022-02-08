<?php global $nf; ?>
						<div class="grid block_container has_4_cols team_landing">


							<?php

							// check if the repeater field has rows of data
							if( isset($_GET['gympageid']) && have_rows('trainers',$_GET['gympageid']) ):

							 	// loop through the rows of data
							    while ( have_rows('trainers',$_GET['gympageid']) ) : the_row();

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
												<a href="mailto:<?php echo (get_sub_field('email')) ? get_sub_field('email') : ''; ?>"><?php echo (get_sub_field('email')) ? get_sub_field('email') : ''; ?></a>
											</div>
										</div>
										
								

							        <?php

							    endwhile;

							else :

							   echo '<p>No Trainers found.</p>';

							endif;

							?>


						</div>