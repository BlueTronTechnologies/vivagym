<?php 
	get_header(); 

		$page_header_image = get_field('page_header_image');
		$thiscat = $wp_query->get_queried_object();

?>


		<div class="section banner spec3">
			<img src="https://vivagym.co.za/wp-content/uploads/2018/04/club1.png" alt="">
			<div class="overlay"></div><h1><?php echo $thiscat->name; ?></h1>
		</div>
		<div class="section main_content">
			<div class="row">
				<div class="grid main_content">
					<div class="main_column <?php echo (get_field('post_content')) ? 'post_content' : ''; ?>">


							<div class="grid block_container has_3_cols blog_inner">

								<?php 
									
									$args = array( 
										'post_type' => 'post',
										'category_name' => $thiscat->slug,
									);
									$the_query = new WP_Query( $args );
									// The Loop
									if ( $the_query->have_posts() ) :
									while ( $the_query->have_posts() ) : $the_query->the_post();

									$post_categories = wp_get_post_categories( $post->ID );
									if (get_field('mobile_banner')) {
										$featimage = get_field('mobile_banner');
									} else {
										$featimage = $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
									}
									
							?>

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
<!--										--><?php //
//											if($post_categories){
//												echo 'posted';
//												// $catcount = 1;
//												// foreach($post_categories as $c){
//												// 	$cat = get_category( $c );
//								    //             	$catlink = get_category_link( $cat->term_id );
//												// 	echo ' <a href="'.$catlink.'">'.$cat->name.'</a>';
//
//												// 	if(count($post_categories) > $catcount){
//												// 		echo ',';
//												// 	}
//												// 	$catcount++;
//												// }
//											 }
//										 ?>
<!--										on --><?php //the_time('j F Y'); ?>
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
							<div class="button_container">
								<a href="" class="button black_border moreposts" data-paged="1" data-cat="<?php echo $thiscat->slug; ?>">LOAD MORE</a>
							</div>

					</div>

					<?php get_template_part( 'partials/page', 'sidebar' ); ?>

				</div>
				
				<?php get_template_part( 'partials/page', 'footer' ); ?>
				
			</div>
		</div>
	
	
<?php get_footer(); ?>