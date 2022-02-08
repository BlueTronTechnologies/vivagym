<?php
/*Template name: Download Timetable*/
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
				$html .= '<div class="bottom">';
				$html .= '<div class="class_container"><div id="class'.$result->ID.'" class="modal hfp-hide"><div class="modal_content clearfix">';
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

<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">

		<title><?php bloginfo('name'); ?> <?php wp_title('|', true, 'left'); ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="SKYPE_TOOLBAR" CONTENT="SKYPE_TOOLBAR_PARSER_COMPATIBLE">


		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.png" type="image/png">

		<link rel="stylesheet" href="https://use.typekit.net/srm5cti.css">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/main.css">


	<?php wp_head(); ?>
	</head>
	<body class="download">

		<div class="timetables" id="capture" style="margin: 0 auto;width: 1200px;">
			<div class="section header">
				<div class="row" style="justify-content: center;">
					<div class="site_logo">
						<a href="<?php bloginfo('url'); ?>"><?php include TEMPLATEPATH . "/images/svg/web_logo.svg"; ?></a>
					</div>
				</div>
			</div>

				<?php
					if($gymid != ''){
						echo '<div class="timetables__container clearfix">';
						foreach($daysArrray as $day){
							echo getClasses($gymid,$day);
						}
						echo '</div>';
					}
				?>


		</div>

	<?php wp_footer(); ?>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/dist/js/scripts.js"></script>
	<script>

		html2canvas(document.querySelector("#capture")).then(canvas => {
		//document.body.appendChild(canvas)

			//var canvasimg = document.getElementById("mycanvas");
			var img = canvas.toDataURL("image/png");

			var timetableWidth = $('#capture').width();

			timetableWidth = timetableWidth * 0.75;

			var timetableHeight = $('#capture').height();

			timetableHeight = timetableHeight * 0.75;

			//var doc = new jsPDF();
			var doc = new jsPDF({   orientation: 'portrait',   unit: 'pt',   format: [timetableWidth, timetableHeight], compressPdf: true });

			doc.addImage(img, 'PNG', 10, 10, timetableWidth - 20, timetableHeight - 20, '', 'FAST');

			doc.save('download.pdf');

		});

	</script>

	</body>
</html>

