<?php global $nf; ?>
<style>
    .form_cont div label span {
        border: 1px solid #FFF !important;
    }
</style>

<?php

								$goal1 = (isset($_GET['goal1'])) ? $_GET['goal1'] : '';
								$goal2 = (isset($_GET['goal2'])) ? $_GET['goal2'] : '';
								$goal3 = (isset($_GET['goal3'])) ? $_GET['goal3'] : '';

								if($goal1 != '' || $goal2 != '' || $goal3 != ''){
									$goals = array($goal1,$goal2,$goal3);
								}else{
									$goals = '';
								}

								$intensity1 = (isset($_GET['intensity1'])) ? $_GET['intensity1'] : '';
								$intensity2 = (isset($_GET['intensity2'])) ? $_GET['intensity2'] : '';
								$intensity3 = (isset($_GET['intensity3'])) ? $_GET['intensity3'] : '';

								if($intensity1 != '' || $intensity2 != '' || $intensity3 != ''){
									$intensitys = array($intensity1,$intensity2,$intensity3);
								}else{
									$intensitys = '';
								}

								if($goals != '' && $intensitys == ''){
									$taxquery = array(
										array(
											'taxonomy' => 'goals',
											'field'    => 'slug',
											'terms'    => $goals,
										),
									);
								}elseif($goals == '' && $intensitys != ''){
									$taxquery = array(
										array(
											'taxonomy' => 'intensities',
											'field'    => 'slug',
											'terms'    => $intensitys,
										),
									);
								}elseif($goals != '' && $intensitys != ''){
									$taxquery = array(
										array(
											'taxonomy' => 'intensities',
											'field'    => 'slug',
											'terms'    => $intensitys,
										),
										array(
											'taxonomy' => 'goals',
											'field'    => 'slug',
											'terms'    => $goals,
										)
									);
								}else{
									$taxquery = array();
								}

								$args_custom = array(
                                    'orderby' => 'date',
                                    'order'   => 'DESC',
									'post_type' => 'guides',
									'posts_per_page' => -1,
									'tax_query' => $taxquery
								);


								$the_query_custom = new WP_Query( $args_custom );


                                $url = parse_url($_SERVER['REQUEST_URI']); ?>

                        <div class="section_title">
                            <p><strong>REFINE YOUR GOAL TO FIT YOUR INTENSITY LEVEL BELOW:</strong></p>
                        </div>
                        <div class="filter" style="background: #000; color: #FFF;"><?php include TEMPLATEPATH . "/templates/filter_library.php"; ?></div>

						<div class="grid block_container has_3_cols" style="position: relative; margin-top: 40px;">
                            <?php
                                if(isset($url['query'])){

								// The Loop
								if ( $the_query_custom->have_posts() ) :
								while ( $the_query_custom->have_posts() ) : $the_query_custom->the_post();
							?>

							<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>



							<a href="<?php the_permalink(); ?>" class="block">
								<div class="block_image">
									<?php
										if($featimage){
											echo '<img src="'.$nf->image( $featimage, 309, 288).'" alt="">';
										}else{
											echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">';
										}
									?>
								</div>
								<h5 class="block_title">
								<?php the_title(); ?>
								</h5>
							</a>

							<?php
								endwhile;
								endif;
								// Reset Post Data
								wp_reset_postdata();
								}
								 else {
                                    echo ""; ?>

                                       <?php


								// The Loop
								if ( $the_query_custom->have_posts() ) :
								while ( $the_query_custom->have_posts() ) : $the_query_custom->the_post();
								?>

							    <?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>



                                <a href="<?php the_permalink(); ?>" class="block">
                                    <div class="block_image">
                                        <?php
                                            if($featimage){
                                                echo '<img src="'.$nf->image( $featimage, 309, 288).'" alt="">';
                                            }else{
                                                echo '<img src="'.get_bloginfo('template_url').'/images/block_tmp.png" alt="">';
                                            }
                                        ?>
                                    </div>
                                    <h5 class="block_title">
                                    <?php the_title(); ?>
                                    </h5>
                                </a>

							<?php
								endwhile;
								endif;
								// Reset Post Data
								wp_reset_postdata();
								} 
							?>

						</div>




<div class="section_title">
<p><strong>Before commencing any exercise programme, it is highly recommended that you visit your doctor and get medical clearance to exercise, especially if you have any risk factors. Risk factors include:</strong></p>
<ul>
    <li>Family History: Any heart related disease of a direct family member.</li>
    <li>Cigarette smoking</li>
    <li>High Blood Pressure</li>
    <li>High Cholesterol</li>
    <li>High Blood Glucose Levels</li>
    <li>Obesity i.e. Body Mass Index (BMI) &gt; 30kg.m2</li>
    <li>Sedentary Lifestyle</li>
</ul>
</div>
<div class="section_title">
    <p>Please take note that the programme prescribed is designed for healthy and non-injured individuals. If you have any injuries, consult a ﬁtness specialist to advise which exercises may aggravate your injury, and what alternative exercises you can do.</p>
</div>