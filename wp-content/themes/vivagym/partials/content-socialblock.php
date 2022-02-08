<?php global $nf; ?>	

<div class="section">
			<div class="row">			
				<!-- Section -->
				<div class="row_header">
					<h2><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h2>
					<div class="row_tag" style="transform: rotate(-3deg);"><?php echo (get_sub_field('sub_title')) ? get_sub_field('sub_title') : ''; ?></div>
				</div>
				<div class="grid social_proof">
					<div class="qt_l">
						<?php include TEMPLATEPATH . "/images/svg/left_quote.svg"; ?>
					</div>
					<div class="grid social_proof_inner">

						<?php 
							$args = array(
								'post_type' => 'testimonials',
								'posts_per_page' => 3,
								'orderby' => 'rand'
							);
							$the_query = new WP_Query( $args );
							// The Loop
							if ( $the_query->have_posts() ) :
							while ( $the_query->have_posts() ) : $the_query->the_post();
						?>

						<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>

						<div class="box box1">
							<div class="box_image">
								<?php if($featimage){ echo '<img src="'.$nf->image( $featimage, 94, 94).'" alt="">'; } ?>
							</div>
							<h5><?php the_title(); ?></h5>
							<?php the_content(); ?>
							<?php echo (get_field('testimonial_author')) ? '<span class="yellow_link">'.get_field('testimonial_author').'</span>' : ''; ?>
						</div>

						<?php
							endwhile;
							endif;
							// Reset Post Data
							wp_reset_postdata();
						?>

					</div>
					<div class="qt_r">
						<?php include TEMPLATEPATH . "/images/svg/right_quote.svg"; ?>
					</div>
				</div>
			</div>
		</div>