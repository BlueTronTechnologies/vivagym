<?php get_header(); ?>

	<?php if (have_posts()) { while (have_posts()) { the_post();  

		$post_categories = wp_get_post_categories( $post->ID );

	?>

	<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>


		<div class="section main_content">
			<div class="row">
				<div class="grid main_content">
					<div class="main_column post_content">
						<div class="single_inline_banner">
							<div class="banner_image">
								<?php if($featimage){ echo '<img src="'.$nf->image( $featimage, 930, 303).'" alt="">'; } ?>
							</div>
							<div class="banner_body">
								<div class="title_main">
									<?php 
										if(get_the_title()){
											$piececount = 1;
											$pieces = explode(" ", get_the_title());
											foreach($pieces as $piece){
												switch ($piececount){

													case 1:
													$deg = '-10deg';
													break;

													case 2:
													$deg = '-6deg';
													break;

													case 3:
													$deg = '-2deg';
													break;

													case 4:
													$deg = '-2deg';
													break;

													default:
													$deg = '0';
													break;
													
												}
												
												echo '<h1 style="transform: rotate('.$deg.');">'.$piece.'</h1>';
												$piececount++;
											}
										}
									?>
								</div>
							</div>
						</div>

						<?php the_content(); ?>
						
					</div>
					<?php get_sidebar(); ?>
				</div>
				<hr class="yellow">
				<?php include "templates/related_posts.php"; ?>
			</div>
		</div>


	<?php } } ?>
	

		
	</div>
	
	<?php get_sidebar(); ?>
	
<?php get_footer(); ?>