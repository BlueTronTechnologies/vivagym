<?php get_header(); ?>




	<?php if (have_posts()) { while (have_posts()) { the_post();   ?>


	<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>



		<div class="section banner spec3">
			<?php if($featimage){ echo '<img src="'.$nf->image( $featimage, 930, 303).'" alt="">'; } ?>
			<div class="overlay"></div>
			<div class="row">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="section main_content">
			<div class="row">
				<div class="grid main_content">
					<div class="main_column post_content">
						<?php the_content(); ?>
					</div>

					<?php get_sidebar(); ?>

				</div>

	<?php } } ?>
	

				<hr class="yellow">

				<?php include "templates/latest_blog_general.php"; ?>

			</div>
		</div>

<?php get_footer(); ?>