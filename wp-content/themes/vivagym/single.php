<?php 
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
} ?>
<?php get_header(); ?>
	<?php if (have_posts()) { while (have_posts()) { the_post();
		$post_categories = wp_get_post_categories( $post->ID );
	?>
	<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
	<?php $featimage_mobile = get_field('mobile_banner'); ?>


		<div class="section main_content">
			<div class="row">
				<div class="grid main_content">
					<div class="main_column post_content">
						<div class="single_inline_banner">
							<div class="banner_image">
								<?php 
								if(isMobile()){
								   if($featimage_mobile){ echo '<img src="'.$nf->image( $featimage_mobile, 500, 500).'" alt="">'; }
								}
								else {
								    if($featimage){ echo '<img src="'.$nf->image( $featimage, 930, 303).'" alt="">'; }
								} ?>
								<?php  ?>
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
													echo '<h1 style="transform: rotate('.$deg.');">'.$piece.'</h1> <h1 style="transform: rotate(0);">';
													break;

													default:
													$deg = '0';
													echo $piece.' ';
													break;

												}

												$piececount++;
											}
											echo '</h1>';
										}
									?>
								</div>
								<div class="button_container">
<!--									<span class="yellow-background big_button">-->
<!--										--><?php
//										if($post_categories){
//											echo 'posted in';
//											$catcount = 1;
//											foreach($post_categories as $c){
//												$cat = get_category( $c );
//												$catlink = get_category_link( $cat->term_id );
//												echo ' <a href="'.$catlink.'">'.$cat->name.'</a>';
//
//												if(count($post_categories) > $catcount){
//													echo ',';
//												}
//												$catcount++;
//											}
//										}
//										?>
<!--										on --><?php //the_time('j F Y'); ?>
<!---->
<!--									</span>-->
								</div>
							</div>
						</div>

						<?php the_content(); ?>

						<div id="comments" class="comments-area">		
							<?php comments_template(); ?>
						</div>


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