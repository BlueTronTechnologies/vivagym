	
<?php 
$img = '<img src="'.get_bloginfo('template_url').'/images/special_joining_fee.png" alt="" style="width:320px;">';
if(get_sub_field('image')){
	$img = '<img src="'.get_sub_field('image').'" alt="" style="width:320px;">';
}
?>

	<div class="block block--joinfee <?php echo (get_sub_field('colors') && get_sub_field('colors') != 'default') ? get_sub_field('colors') : 'black'; ?>">
		<a href="/viva-gym-promotion/">
            <img src="
            <?php if( have_rows('sidebar_promo_banner','options') ): ?>
                <?php
                while( have_rows('sidebar_promo_banner','options') ): the_row();

                    // vars
                    $current_datetime = date("Y-m-d H:i:s", time()+60*60*$diff=2);
                    $start_publishing_sidebar_promo = get_sub_field('start_publishing_sidebar_promo','options');
                    $finish_publishing_sidebar_promo = get_sub_field('finish_publishing_sidebar_promo','options');

                    if ($current_datetime >= $start_publishing_sidebar_promo && $current_datetime < $finish_publishing_sidebar_promo) {
                        the_sub_field('image_sidebar_promo_schedule','options');
                    }
                    else {
                        the_sub_field('image_sidebar_promo_normal','options');
                    }

                endwhile; ?>
            <?php endif; ?>
            ">
        </a>
	</div>