<?php 
    /* Template Name: Promotion Template New */ 
    get_header();
?>

<?php if( have_rows('hero_section') ): ?>
    <?php while( have_rows('hero_section') ): the_row(); ?>
        <div class="col-sx-12 col-sm-6 col-md-6 promo-hero-content-wrapper">
            <div class="promo-hero-content">
                <img src="<?php the_sub_field('logo'); ?>" />
                <h1><?php the_sub_field('header'); ?></h1>
                <p><?php the_sub_field('content'); ?></p>
                <div class="promo-hero-btn">
                    <a href="<?php echo (get_field('sign_up_link')) ? get_field('sign_up_link') : ''; ?>" class="yellow_button">SIGN UP</a>
                </div>
            </div>
        </div>
        <div class="col-sx-12 col-sm-6 col-md-6 promo-hero-img" style="background-image:url('<?php the_sub_field('image'); ?>')">
        </div>
    <div class="clear"></div>
    <?php endwhile; ?>
<?php endif; ?>

<div class="gym_info_wrapper">
    <div class="row promo-body-section">
        <div class="col-sx-12 col-sm-6 col-md-6">
            <?php if( have_rows('body_section') ): ?>
                <?php while( have_rows('body_section') ): the_row(); ?>
                <div class="promo-img-wrapper">
                    <img class="promo-img" src="<?php the_sub_field('image'); ?>" />
                    <span class="promo-background"></span>
                </div>

                <div class="promo-content">
                    <h4><?php the_sub_field('heading'); ?></h4>
                    <h1><?php the_sub_field('sub_heading'); ?></h1>
                    <p><?php the_sub_field('content'); ?></p>
                    <a href="<?php echo (get_field('sign_up_link')) ? get_field('sign_up_link') : ''; ?>" class="yellow_button">SIGN UP</a>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="col-sx-12 col-sm-6 col-md-6">
            <div class="col-sx-12 promo-form-wrapper">
                <?php if( have_rows('form_section') ): ?>
                    <?php while( have_rows('form_section') ): the_row(); ?>
                    <div class="promo-form-content">
                        <h1><?php the_sub_field('heading'); ?></h1>
                        <p><?php the_sub_field('body'); ?></p>
                    </div>
                        <?php echo do_shortcode('[contact-form-7 id="4545" title="Promotion"]'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="promo-footer">
    <?php if( have_rows('footer_section') ): ?>
        <?php while( have_rows('footer_section') ): the_row(); ?>
            <div class="footer-img-wrapper">
                <img src="<?php the_sub_field('logo'); ?>" />
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

