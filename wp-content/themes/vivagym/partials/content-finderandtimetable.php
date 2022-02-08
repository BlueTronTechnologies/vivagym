		<div class="section banner_nav">
			<div class="row">
				<div class="grid">
					<div class="box1">
						<h3>Gym Finder</h3>
						<div class="button_container">
							<a href="<?php bloginfo('url'); ?>/our-gyms/" class="button white_border">Find a gym</a>
						</div>
					</div>
					<a href="https://vivagym.co.za/timetables/" class="box2">
						<div class="ico"><?php echo file_get_contents(TEMPLATEPATH . "/images/svg/big_cal.svg"); ?></div>
						<h3>View <br>Timetables</h3>
					</a>
                    <a href="/viva-gym-promotion/" class="box3" style="background-image: url(
                    <?php if( have_rows('home_page_promo_banner','options') ): ?>
                        <?php
                        while( have_rows('home_page_promo_banner','options') ): the_row();

                            // vars
                            $current_datetime = date("Y-m-d H:i:s", time()+60*60*$diff=2);
                            $start_publishing_home_promo_banner = get_sub_field('start_publishing_home_promo_banner_new','options');
                            $finish_publishing_home_promo_banner = get_sub_field('finish_publishing_home_promo_banner_new','options');

                            if ($current_datetime >= $start_publishing_home_promo_banner && $current_datetime < $finish_publishing_home_promo_banner) {
                                the_sub_field('image_home_promo_banner_schedule','options');
                            }
                            else {
                                the_sub_field('image_home_promo_banner_normal','options');
                            }

                        endwhile; ?>
                    <?php endif; ?>
                    );"></a>
                </div>
			</div>
		</div>