<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8">
        <?php $current_url = $_SERVER['REQUEST_URI']; ?>

        <?php if ( strpos($current_url, 'fitness-classes') !== false ) { ?>
        <title>Book Fitness Classes Online in South Africa - VIVA Gym</title>
        <?php } else { ?>
        <title><?php bloginfo('name'); ?> <?php wp_title('|', true, 'left'); ?></title>
        <?php } ?>

        <?php if ( strpos($current_url, 'corporate') !== false ) { ?>
        <meta name="HandheldFriendly" content="True" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<?php } else { ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <?php } ?>
        <meta name="SKYPE_TOOLBAR" CONTENT="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
        <?php
        $current_datetime = date("Y-m-d H:i:s", time()+60*60*$diff=2);
        $start_publishing = get_field('start_publishing_promopage','options');
        $finish_publishing = get_field('finish_publishing_promopage','options');
        $header_text_new = wp_strip_all_tags(get_field('header_text','options'));
        $header_text_normal_new = wp_strip_all_tags(get_field('header_text_normal','options'));

        $current_url = $_SERVER['REQUEST_URI'];
        if ( strpos($current_url, 'viva-gym-promotion') !== false ) { ?>

            <meta property="og:locale" content="en_US" />
            <meta property="og:type" content="article" />
            <meta property="og:title" content="Viva Gym | Promotion" />
            <meta property="og:description" content="
<?php if ($current_datetime >= $start_publishing && $current_datetime < $finish_publishing) {
                echo $header_text_new;
            }
            else {
                echo $header_text_normal_new;
            }
            ?>
" />
            <meta property="og:site_name" content="Viva Gym South Africa" />
            <meta property="og:url" content="http://vivagym.co.za/viva-gym-promotion/" />


            <meta property="og:image" content="
 <?php if ($current_datetime >= $start_publishing && $current_datetime < $finish_publishing) {
                the_field('image','options');
            }
            else {
                the_field('image_normal','options');
            }
            ?>
" />
            <meta property="og:image:secure_url" content="
 <?php if ($current_datetime >= $start_publishing && $current_datetime < $finish_publishing) {
                the_field('image','options');
            }
            else {
                the_field('image_normal','options');
            }
            ?>
" />

        <?php }
        else {
            echo "";
        }
        ?>

		
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.png" type="image/png">

		<link rel="stylesheet" href="https://use.typekit.net/srm5cti.css">

        <?php if ( strpos($current_url, 'timetables') !== false ) {
            echo "";
        } else { ?>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <?php } ?>

		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/main.css">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/custom.css?v=12">

        <!-- Hotjar Tracking Code for http://vivagym.test -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:1440287,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
	
	<?php wp_head(); ?>
	</head>
	<body class="<?php if(is_front_page()){ echo 'page_home'; } ?> <?php if(is_page('special-offers-events')){ echo 'wmax'; } ?> <?php if(is_page('timetables')){ echo 'timetables_page'; } ?>">
    <?php
    $current_url = $_SERVER['REQUEST_URI'];
        if ( strpos($current_url, 'viva-gym-promotion') !== false || strpos($current_url, 'survey') !== false || strpos($current_url, 'download-free-pass') !== false || strpos($current_url, 'join-train-get-rewarded') !== false || strpos($current_url, 'corporate') !== false) {

        }
        else {
            include "templates/nav.php";
        }
    ?>

    <div class="premium_main"> <h2>premium upgrade option</h2> <div class="price"> only <div>R69<span>pm</span></div>extra </div> <div class="prem_benefits">  <div> <span class="icon snow"></span> <span>freeze for up to 2 months</span> </div> <div> <span class="icon viva"></span> <span>access to all gyms</span> </div> <div> <span><img src="http://vivagym.test/wp-content/uploads/2019/11/guest-icon.jpg" width="25px"></span> <span>bring a guest 4 x p.m</span> </div> <div> <span><img src="http://vivagym.test/wp-content/uploads/2019/11/inbody-icon.jpg" width="35px"></span> <span>free Inbody assessment</span> </div> </div> <div class="footer_text purple-b">  <span class="box"></span>  <span class="text">upgrade to premium with these awesome benefits</span>  </div> </div>
