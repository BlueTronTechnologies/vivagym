<?php 

	get_header(); 

		$page_header_image = get_field('page_header_image');

?>

		<div class="section banner spec3">
			<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2018/04/club1.png" alt="">			
			<div class="overlay"></div><h1>404</h1>		
		</div>
		<div class="section main_content">
			<div class="row">
				<div class="grid main_content">
					<div class="main_column">

						<div class="section_title">
							<?php echo (get_field('404_page_copy','options')) ? get_field('404_page_copy','options') : ''; ?>
						</div>

					</div>

					<?php get_template_part( 'partials/page', 'sidebar' ); ?>

				</div>
				
				<?php get_template_part( 'partials/page', 'footer' ); ?>
				
			</div>
		</div>
	
<?php get_footer(); ?>