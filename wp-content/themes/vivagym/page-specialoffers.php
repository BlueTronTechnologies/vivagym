<?php 
	/*Template name: Special Offers*/
	get_header(); 

	if (have_posts()) { while (have_posts()) { the_post();  

?>
        <style>
            .banner.free_pass .block .overlay {
                background: rgba(0,0,0,0);
            }
            .banner.spec1 .grid .col_right {
                padding: 34px 75px 24px;
            }
        </style>

		<div class="section banner spec1 free_pass">
			<div class="row">
				<div class="grid col_2_1">
					<div class="block col_left" style="background: url(<?php echo (get_field('banner_image')) ? get_field('banner_image') : ''; ?>) no-repeat 0 0 / cover; ">
						<div class="overlay"></div>
						<div class="title_main">
							<h1><?php echo (get_field('page_title')) ? get_field('page_title') : ''; ?></h1>
						</div>
					</div>
                    <div class="col_right lightblue-background">
                        <div class="frm_forms " id="frm_form_7_container">
                            <div class="frm-show-form free_pass frm_pro_form  frm_ajax_submit  frm-admin-viewing ">
                                <div class="frm_form_fields ">
                                    <h3 class="frm_form_title">Free Pass</h3>
                                    <div class="frm_description"><p style="font-size: 15px;">Want to join in for just a day? Train in our world-class facility! Pop your details in the form below and a member of staff will contact you.</p>
                                    </div>

                                    <!-- SharpSpring Form for Free Pass  -->
<!--                                    <script type="text/javascript">-->
<!--                                        var ss_form = {'account': 'MzawMDE3NDAxAwA', 'formID': 's0gxTTNMMbfUNUgxsNA1SUk21bU0sLDQTU1OMQLyUlONDI0B'};-->
<!--                                        ss_form.width = '100%';-->
<!--                                        ss_form.height = '1000';-->
<!--                                        ss_form.domain = 'app-3QNGCC2JLC.marketingautomation.services';-->
<!--                                        ss_form.hidden = {'_usePlaceholders': true};-->
<!--                                        // ss_form.hidden = {'Company': 'Anon'}; // Modify this for sending hidden variables, or overriding values-->
<!--                                    </script>-->
<!--                                    <script type="text/javascript" src="https://koi-3QNGCC2JLC.marketingautomation.services/client/form.js?ver=1.1.1"></script>-->

                                    <?php echo do_shortcode('[contact-form-7 id="4480" title="Free Pass"]'); ?>
                                </div>
                            </div>
                        </div>

                        <!--						--><?php //echo (get_sub_field('hero_form')) ? do_shortcode(get_sub_field('hero_form')) : ''; ?>
                    </div>
				</div>
			</div>
		</div>
		<div class="section main_content">
			<div class="row wmax">
				<div class="grid main_content col_2_1 free_pass">
					<div class="main_column post_content">
						<div class="content_inner">
							
								<?php include "partials/blocks.php"; ?>
							
						</div>
					</div>
					<?php get_template_part( 'partials/page', 'sidebar' ); ?>
				</div>
			</div>
		</div>

	<?php } } ?>

<?php get_footer(); ?>