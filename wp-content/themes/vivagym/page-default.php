<?php 
	/*Template name: Page with Sidebar*/
	get_header(); 

	if (have_posts()) { while (have_posts()) { the_post();  

		$page_header_image = get_field('page_header_image');

?>

		<div class="section banner <?php echo (get_field('page_header_title')) ? 'spec3' : 'spec2'; ?>">
			<?php if($page_header_image){ echo '<img src="'.$page_header_image.'" alt="">'; } ?>
			<?php echo (get_field('page_header_title')) ? '<div class="overlay"></div><h1>'.get_field('page_header_title').'</h1>' : ''; ?>
		</div>
		<div class="section main_content">
			<div class="row">
				<div class="grid main_content">
					<div class="main_column <?php echo (get_field('post_content')) ? 'post_content' : ''; ?>">

							<?php include "partials/blocks.php"; ?>

					</div>

					<?php get_template_part( 'partials/page', 'sidebar' ); ?>

				</div>
				
				<?php get_template_part( 'partials/page', 'footer' ); ?>
				
			</div>
		</div>

	<?php } } ?>
	
	
<?php get_footer(); ?>