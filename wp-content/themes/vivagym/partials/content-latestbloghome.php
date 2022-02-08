<?php global $nf; ?>
<div class="section latest_blog home">
	<div class="row">
		<div class="row_header">
			<h2><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h2>
			<div class="row_tag" style="transform: rotate(-3deg);"><?php echo (get_sub_field('sub_title')) ? get_sub_field('sub_title') : ''; ?></div>
		</div>
		<div class="grid">
			<div class="blog_inner">

				<?php 
					$args = array( 
						'post_type' => 'post',
						'posts_per_page' => 3
					);

					$the_query = new WP_Query( $args );
					// The Loop
					if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();

						$post_categories = wp_get_post_categories( $post->ID );
				?>

				<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>

				<div class="block">
					<a href="<?php the_permalink(); ?>">
						<div class="block_image">
							<?php if($featimage){ echo '<img src="'.$nf->image( $featimage, 200, 200).'" alt="">'; } ?>
						</div>
						<h5 class="block_title">
						<?php the_title(); ?>
						</h5>
					</a>
					<div class="block_meta">
<!--						--><?php //
//							if($post_categories){
//								echo 'posted in';
//								$catcount = 1;
//								foreach($post_categories as $c){
//									$cat = get_category( $c );
//				                	$catlink = get_category_link( $cat->term_id );
//									echo ' <a href="'.$catlink.'">'.$cat->name.'</a>';
//
//									if(count($post_categories) > $catcount){
//										echo ',';
//									}
//									$catcount++;
//								}
//							 }
//						 ?>
<!--						on --><?php //the_time('j F Y'); ?>
					</div> 
					<div class="block_excerpt">
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
		</div>
		<div class="button_container">
			<a href="<?php bloginfo('url'); ?>/blog/" class="button black_border">VIEW OUR BLOG</a>
		</div>
	</div>
</div>