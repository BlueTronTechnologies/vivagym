<?php

global $nf;

if(isset($_GET['gymid'])){
	$gymid = $_GET['gymid'];
}else{
	$gymid = '';
}

	//sort classes by startTime
	function date_compare($a, $b)
	{
		$t1 = strtotime($a->StartTime);
		$t2 = strtotime($b->StartTime);
		return $t1 - $t2;
	}


    function getClasses($club,$day){


    	global $wpdb;

    	$nameOfDay = date('D', strtotime($day));
    	$html = '<div class="row"><span class="heading">'.$nameOfDay.'</span>';

    	$results = $wpdb->get_results(
	    	$wpdb->prepare( "
		        SELECT * FROM viva_timetables
		        WHERE clubid = %d
		        AND classdate = '$day'
		        ",
		        $club
		    )
		);

		if(isset($results)){

			usort($results, 'date_compare');

			// echo '<pre>';
			// print_r($results);


			foreach($results as $result){
				//print_r($result);
				$html .= '<div class="item"><div class="top"><h3>'.$result->Name.'</h3><span>'.$result->StartTime.' - '.$result->EndTime.'</span></div>';
				$html .= '<div class="bottom"><a href="#class'.$result->ID.'" class="popup"><img src="'.get_bloginfo('template_url').'/images/info.png" alt=""></a>';
				$html .= '<div class="modals_container"><div id="class'.$result->ID.'" class="modal hfp-hide"><div class="modal_content clearfix">';
				$html .= '<h4>'.$result->Name.'</h4>';
				$html .= '<p>'.$result->Description.'</p>';
				$html .= '<p>Instructor name: <span class="instructor">'.$result->PTName.'</span></p>';
				$html .= '<button title="Close (Esc)" type="button" class="mfp-close">×</button></div></div><!-- modal --></div></div></div><!-- item -->';
			}
		}

		$html .= '</div><!-- row -->';

		return $html;

    }//getClasses

	$daycount = 1;
	$daysArrray = array();
	$daysArrray[] = date('Y-m-d', strtotime('today'));

	//get dates for the next week
	while($daycount < 7) {
	    $date = strtotime("+".$daycount." day");
		$daysArrray[] = date('Y-m-d', $date);
	    $daycount++;
	}

	$page_header_image = get_field('page_header_image');


?>

<div class="timetables">

		<?php
		if($gymid != ''){

			$args = array(
				'post_type' => 'gyms',
				'posts_per_page' => -1,
			);
			$currentgym = '';

			$the_query = new WP_Query( $args );
			// The Loop
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();

				if(get_field('club_api_id')){
					if(get_field('club_api_id') == $gymid){
						$currentgym = get_the_title();
					}
				}


			endwhile;
			endif;
			// Reset Post Data
			wp_reset_postdata();

		?>
		<header>
		<h1><?php echo $currentgym; ?> - Classes & Info</h1>
		<?php the_content(); ?>
		<div class="gymnav">
			<span class="current"><?php echo $currentgym; ?></span>
			<ul>
				<?php
					$args = array(
						'post_type' => 'gyms',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
					);

					$the_query = new WP_Query( $args );
					// The Loop
					if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();

				?>

				<li><a href="<?php bloginfo('url') ?>/timetables/?gymid=<?php echo (get_field('club_api_id')) ? get_field('club_api_id') : ''; ?>"><?php the_title(); ?></a></li>

				<?php
					endwhile;
					endif;
					// Reset Post Data
					wp_reset_postdata();
				?>

			</ul>
		</div>
		<?php if(isset($_GET['gymid'])){ ?>
		<a href="<?php echo get_option('home'); ?>/download-timetable/?gymid=<?php echo $_GET['gymid']; ?>" class="pdf_dl" target="_blank">Download PDF</a>
		<?php } ?>
		</header>
		<?php }else{ ?>

		<?php } ?>


		<?php
			if($gymid != ''){
				echo '<div class="timetables__container clearfix">';
				foreach($daysArrray as $day){
					echo getClasses($gymid,$day);
				}
				echo '</div>';
			}else{

				//display links for all clubs
				?>

						<div class="grid block_container has_3_cols clubs">

							<?php
								$args = array(
									'post_type' => 'gyms',
									'posts_per_page' => -1,
									'orderby' => 'title',
									'order' => 'ASC',
								);

								$the_query = new WP_Query( $args );
								// The Loop
								if ( $the_query->have_posts() ) :
								while ( $the_query->have_posts() ) : $the_query->the_post();

							?>

							<?php $featimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>

							<div class="block">
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
									<a href="<?php bloginfo('url') ?>/timetables/?gymid=<?php echo (get_field('club_api_id')) ? get_field('club_api_id') : ''; ?>"><?php the_title(); ?></a>
								</h5>
							</div>

							<?php
								endwhile;
								endif;
								// Reset Post Data
								wp_reset_postdata();
							?>

						</div>

		<?php	}//display all clubs list ?>


</div>

