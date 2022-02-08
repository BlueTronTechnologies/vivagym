<aside class="right_bar">
	<?php
	// check if the flexible content field has rows of data
	if( have_rows('page_sidebar','options') ):
	// loop through the rows of data
	while ( have_rows('page_sidebar','options') ) : the_row();
	if( get_row_layout() == 'free_pass' ):
	get_template_part( 'partials/sidebar', 'freepass' );
	elseif( get_row_layout() == 'joining_fee' ):
		get_template_part( 'partials/sidebar', 'joiningfee' );
	elseif( get_row_layout() == 'get_our_newsletter' ):
		get_template_part( 'partials/sidebar', 'newsletterform' );
	elseif( get_row_layout() == 'join_us' ):
		get_template_part( 'partials/sidebar', 'joinus' );
	endif;
	endwhile;
	else :
			get_sidebar();
	endif; ?>
	<?php if (is_singular('post') || is_category() || is_page('blog')):  ?>
		<div class="block white club_list categories">
			<h3>Categories</h3>
			<?php 
			$args = array (
				'show_count' => 1,
				'title_li' => " "
			);
			wp_list_categories( $args );
		 	?>
		</div>

		
	<?php endif ?>
</aside>