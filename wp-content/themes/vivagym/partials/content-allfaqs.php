		


	<?php 

	$_terms = get_terms( array('faqscat') );
	foreach ($_terms as $term) {

		echo '<h2 style="margin-bottom:30px;display:block;">'.$term->name.'</h2>';
		echo '<div id="accordion" class="accordion-container">';

		$term_slug = $term->slug;
		$args = array( 
			'post_type' => 'faqs',
			'posts_per_page' => -1,
			'tax_query' => array(
                    array(
                        'taxonomy' => 'faqscat',
                        'field'    => 'slug',
                        'terms'    => $term_slug,
                    ),
                ),
		);
		$the_query = new WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();

?>

			<div class="accordion_row">
				<h5 class="accord_title"><?php the_title(); ?></h5>
				<div class="accord_content">
					<?php the_content(); ?>
				</div>
			</div>

	<?php 
		endwhile;
		endif;
		// Reset Post Data
		wp_reset_postdata();

		echo '</div>';

	}//foreach
	?>



		