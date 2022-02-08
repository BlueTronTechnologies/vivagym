<?php 
    /* Template Name: Home Template */
    get_header();
?>

<?php if( have_rows('hero_banner') ): ?>
    <?php while( have_rows('hero_banner') ): the_row(); ?>

            <?php if( get_sub_field('video') ): ?>
            <div id="hero" >
                <video class="fullscreen"  type="video/mp4" src="<?php the_sub_field('video'); ?> " playsinline autoplay muted loop></video>
                <div class="hero-content">
                        <div class="row">

                            <div class="col-sx-12 col-sm-6 col-md-6 vcenter-hero-item">
                                <div class="hero-info">
                                    <h1><?php the_sub_field('heading'); ?></h1>
                                    <p><?php the_sub_field('caption'); ?></p>
                                </div> 
                            </div>
                            <div class="col-sx-12 col-sm-6 col-md-6">
                                <div class="col_right white-background">
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
            </div>
            <?php else: ?>
                <div id="hero" style="background-image:url('<?php the_sub_field('image'); ?>')">
                    <div class="hero-content">
                        <div class="row">

                            <div class="col-sx-12 col-sm-6 col-md-6 vcenter-hero-item">
                                <div class="hero-info">
                                    <h1><?php the_sub_field('heading'); ?></h1>
                                    <p><?php the_sub_field('caption'); ?></p>
                                </div> 
                            </div>
                            <div class="col-sx-12 col-sm-6 col-md-6">
                                <div class="col_right white-background">
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
                </div>
            <?php endif; ?>


    <?php endwhile; ?>
<?php endif; ?>

<div class="section main_content">
    <div class="gym-locations-block">
        <div class="row">
            <div class="col-sm-6">
                <h2>GYMS LOCATIONS</h2>
                <p>We have gyms in seven locations across South Africa.</p>
            </div>
            <div class="col-sm-6 btn-container">
                <a href="" class="blue_button_2">VIEW ALL TIMETABLES</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php if( have_rows('slider') ): ?>
                    <div class="fsbanner" id="demo-3">
                        <?php while( have_rows('slider') ): the_row();?>
                            <div style="background-image:url('<?php the_sub_field('image'); ?>')">
                                <span class="name"><?php the_sub_field('name'); ?></span>
                                <span class="location">
                                    <h2><?php the_sub_field('name'); ?></h2>
                                    <p><?php the_sub_field('location'); ?></p>
                                    <a href="<?php the_sub_field('location'); ?>" class="yellow-background big_button slider_button">Find out more</a>
                                </span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
        <div class="gym_info_wrapper">
            <div class="row gym_info">
                <?php if( have_rows('gym_info') ): ?>
                    <?php while( have_rows('gym_info') ): the_row(); ?>
                    <div class="col-sm-6">
                        <?php if( have_rows('drop_down') ): ?>
                            <h2>Happiest & Healthiest Gym In Your Neighbourhood</h2>                        
                            <div class="tabs">
                                <?php while( have_rows('drop_down') ): the_row();?>
                                <div class="tab">
                                    <input type="radio" id="<?php the_sub_field('title'); ?>" name="rd">
                                    <label class="tab-label" for="<?php the_sub_field('title'); ?>"><?php the_sub_field('title'); ?></label>
                                    <div class="tab-content">
                                        <p><?php the_sub_field('body'); ?></p>
                                        <a href="<?php the_sub_field('link'); ?>">Find Out More</a>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-6 gym_info_img_wrapper">
                        <img class="img-fluid gym_info_img" src="<?php the_sub_field('image'); ?>" alt="" >
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

</div>



<?php 
    get_footer(); 
?>