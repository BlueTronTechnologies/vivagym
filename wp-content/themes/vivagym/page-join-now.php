<?php 
	/*
	Template name: Join Now Page
	*/
	get_header(); 
	if (have_posts()) { while (have_posts()) { the_post();  

?>

		<div class="section main_content">
			<div class="row">
				<div class="grid signup_col">
					<div class="main_column">
						<h2>choose <span>your gym</span></h2>
						<?php the_content(); ?>	
							

<!--						<div class="bottom">-->
<!--							<div class="modals_container">-->
<!--								<div id="join_nowpop" class="modal hfp-hide">-->
<!--									<div class="modal_content clearfix">-->
<!--										--><?php //the_field('join_now_popup_text', 'option'); ?>
<!--										<button title="Close (Esc)" type="button" class="mfp-close">×</button>-->
<!--									</div>-->
<!--									</div> modal -->
<!--								</div>-->
<!--							</div>	-->
					</div>
				</div>			
			</div>
		</div>

	<?php } } ?>
	
	
<?php get_footer(); ?>