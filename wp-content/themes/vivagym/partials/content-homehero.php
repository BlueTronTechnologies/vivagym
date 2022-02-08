<style>
    .banner.spec1 .grid .col_right {
        padding: 34px 75px 24px;
    }
    .home-banner {
        position: relative;
    }
    .videoInsert {
        position: absolute;
        left: 0;
        top: 0;
        width: 101%;
        height: 100%;
        z-index: -100;
        background-size: cover;
        overflow: hidden;
        background: #000;
        /*object-fit: fill;*/
    }
</style>

<?php if( have_rows('home_page_top_banner','options') ): ?>
    <div class="section banner spec1">
			<div class="row">
				<div class="grid">

                    <?php while( have_rows('home_page_top_banner','options') ): the_row();
                    $banner_url = get_sub_field('banner_url', 'options');
                    ?>
                    <?php if ($banner_url){ ?>
                        <a href="<?php echo $banner_url; ?>">
                    <?php } ?>

                    <div class="col_left home-banner" style="background: url(

                    <?php
                        // vars
                        $current_datetime = date("Y-m-d H:i:s", time()+60*60*$diff=2);
                        $start_publishing_home_top = get_sub_field('start_publishing_home_top','options');
                        $finish_publishing_home_top = get_sub_field('finish_publishing_home_top','options');
                        $banner_video = get_sub_field('video', 'options');

                        if (!$banner_video) {
                            if ($current_datetime >= $start_publishing_home_top && $current_datetime < $finish_publishing_home_top) {
                                the_sub_field('image_home_top_schedule', 'options');
                            } else {
                                the_sub_field('image_home_top_normal', 'options');
                            }
                        }
                        ?>) no-repeat 0 0 / cover; height: 100%;">

                        <?php if ($banner_video){ ?>
                            <video class="videoInsert" autoplay muted loop>
                                <source src="<?php echo $banner_video; ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php } ?>

                    </div>

                    <?php if ($banner_url){ ?>
                            </a>
                    <?php } ?>

                    <?php endwhile; ?>

					<div class="col_right lightblue-background">
                        <div class="frm_forms " id="frm_form_7_container">
                            <div class="frm-show-form free_pass frm_pro_form  frm_ajax_submit  frm-admin-viewing ">
                                <div class="frm_form_fields ">
                                    <h3 class="frm_form_title">Free Pass</h3>
                                    <div class="frm_description"><p style="font-size: 15px;">Want to join in for just a day? Train in our world-class facility! Pop your details in the form below and a member of staff will contact you.</p>
                                    </div>
                                    <?php echo do_shortcode('[contact-form-7 id="4480" title="Free Pass"]'); ?>
                                </div>
                            </div>
                        </div>

					</div>
				</div>
			</div>
    </div>
<?php endif; ?>