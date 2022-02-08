<?php
/*
	Template Name: Example page
*/
get_header(); ?>
	
	<div class="singlepage">
		
		<?php if (have_posts()) { while (have_posts()) { the_post(); ?>
			
			<!-- start post -->
			<div class="post">
				
				<h2><?php the_title(); ?></h2>
				
				<p class="date">Posted on <?php the_time('F jS, Y') ?> by <?php the_author() ?></p>
				
				<div class="postcopy">
					
					<?php the_content(); ?>
					
				</div>
				
				<p class="posted">Posted in <?php the_category(', ') ?></p>
				
			</div>
			<!-- end post -->
			
		<?php } } ?>
		
	</div>
	
	<?php get_sidebar(); ?>
	
<?php get_footer(); ?>