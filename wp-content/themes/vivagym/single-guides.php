<?php get_header(); ?>

<style>
    @media screen and (max-width: 767px){
        .guidetop .right {
            display: block;
            width: 100%;
            padding: 30px 0;
            text-align: center;
        }
        .banner.spec1--guide .free_pass {
            padding: 10px 32px !important;
        }
    }

</style>

	<?php if (have_posts()) { while (have_posts()) { the_post();   ?>


	<?php 
		$featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
		$guide_download = get_field('guide_download');
	?>


		<div class="section banner spec1 spec1--guide">
			<div class="row">
				<div class="guidetop">
					<div class="left">
						<div class="img"><?php echo ($featimage) ? '<img src="'.$nf->image($featimage,450).'" />' : ''; ?></div>
					</div>
					<div class="right">
						<h1><?php the_title(); ?></h1>
						<h2><?php echo (get_field('guide_submenu')) ? get_field('guide_submenu') : ''; ?></h2>
						<ul>
							<?php

							// check if the repeater field has rows of data
							if( have_rows('guide_highlights') ):

							 	// loop through the rows of data
							    while ( have_rows('guide_highlights') ) : the_row();

							        echo '<li>'.get_sub_field('text').'</li>';

							    endwhile;

							else :

							    // no rows found

							endif;

							?>

						</ul>

                        <!-- Form Implementations -->
                        <div class="frm_forms free_pass" id="frm_form_9_container" style="background: #414042; padding: 10px 50px;">
                            <div class="frm_form_fields ">
                                    <h3 class="frm_form_title">Download This Guide</h3>
                                    <div class="frm_description"><p>Leave us your details, and download this free guide.</p>
                                    </div>
                                <div class="frm_fields_container">
                                    <?php if (is_single(772)) { ?>
                                    <!-- Form for Get Fit - Your First 6 Week Guide -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4482" title="Get Fit - First 6 Week"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(3719)) { ?>
                                    <!-- Form for Get Fit - Low -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4484" title="Get Fit - Low"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(775)) { ?>
                                    <!-- Form for Burn Calories - Low -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4501" title="Burn Calories - Low"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(778)) { ?>
                                    <!-- Form for Build Muscle - Low -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4531" title="Build Muscle - Low"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(3720)) { ?>
                                    <!-- Form for Burn Calories - Your First 6 Week Guide -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4498" title="Burn Calories - First 6 Week"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(773)) { ?>
                                    <!-- Form for Get Fit - Medium -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4489" title="Get Fit - Medium"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(776)) { ?>
                                    <!-- Form for Burn Calories - Medium -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4504" title="Burn Calories - Medium"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(779)) { ?>
                                    <!-- Form for Build Muscle - Medium -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4534" title="Build Muscle - Medium"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(3721)) { ?>
                                    <!-- Form for Build Muscle - Your First 6 Week Guide -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4528" title="Build Muscle - First 6 Week"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(774)) { ?>
                                    <!-- Form for Get Fit - High -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4492" title="Get Fit - High"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(777)) { ?>
                                    <!-- Form for Burn Calories - High -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4507" title="Burn Calories - High"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(780)) { ?>
                                    <!-- Form for Build Muscle - High -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4537" title="Build Muscle - High"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4250)) { ?>
                                    <!-- Form for Get Fit - Dale at Sunningdale  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4495" title="Get Fit - Dale at Sunningdale"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4252)) { ?>
                                    <!-- Form for Burn Calories - Brian at Sunningdale  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4510" title="Burn Calories - Brian at Sunningdale"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4254)) { ?>
                                    <!-- Form for Burn Calories - Liza at Sunningdale  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4513" title="Burn Calories - Liza at Sunningdale"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4256)) { ?>
                                    <!-- Form for Burn Calories - Marc at Sunningdale  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4516" title="Burn Calories - Marc at Sunningdale"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4258)) { ?>
                                    <!-- Form for Burn Calories - Morne at Hillfox  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4519" title="Burn Calories - Morne at Hillfox"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4260)) { ?>
                                    <!-- Form for Burn Calories - Watson at Hillfox  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4522" title="Burn Calories - Watson at Hillfox"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4262)) { ?>
                                    <!-- Form for Burn Calories - Wesley at Hillfox  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4525" title="Burn Calories - Wesley at Hillfox"]'); ?>
                                        </div>
                                    <?php } elseif (is_single(4264)) { ?>
                                    <!-- Form for Build Muscle - Luciano at Sunningdale  -->
                                        <div class="form-fitness">
                                            <?php echo do_shortcode('[contact-form-7 id="4540" title="Build Muscle - Luciano at Sunningdale"]'); ?>
                                        </div>
                                    <?php } else {
                                        echo "";
                                    } ?>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
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

				<?php get_template_part( 'partials/footer', 'guides' ); ?>

			</div>
		</div>

<?php get_footer(); ?>


<?php 
	//triggers download
	if(isset($_GET['download'])){
		$candownload = $_GET['download'];
	}else{
		$candownload = false;
	}

	if($candownload && $guide_download){
?>

	<a href="<?php echo $guide_download; ?>" class="startdownload" style="display:none;" download>download</a>
	<script>
		$('.startdownload')[0].click();
	</script>

<?php } ?>