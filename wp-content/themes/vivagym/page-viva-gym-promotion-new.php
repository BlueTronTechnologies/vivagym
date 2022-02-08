<?php
/**
 * Template Name: Promotion Template
 */
?>

<style>
    @media screen and (max-width: 414px){
    #element-732 .contents img
    {
        width: 100% !important;
        margin-left: -5px !important;
    }
    .header-text {
        width: 360px !important;
    }
    .text-block-1 {
        width: 360px !important;
    }
    .contents .heart-logo {
        width: 50% !important;
        height: 50% !important;
        margin-top: 300px !important;
        margin-left: 60px;
    }
    .text-block-2 {
        width: 360px !important;
        margin-top: -30px !important;
    }
    #element-687 {
        width: 330px !important;
    }
    .box {
        width: 100% !important;
    }
    .circle {
        width: 83% !important;
        height: 83% !important;
    }
    #element-340 .contents img
    {
        margin-top:-10px !important;
        margin-left: -10px !important;
    }
    #element-331 .contents p {
        text-align: left !important;

    }
    #element-343 .contents img {
        width: 90% !important;
    }
    #element-344 .contents img {
        width: 90% !important;
    }
    #element-345 .contents img {
        width: 90% !important;
    }
}
</style>

<?php get_header();
$current_datetime = date("Y-m-d H:i:s", time()+60*60*$diff=2);
$start_publishing = get_field('start_publishing_promopage','options');
$finish_publishing = get_field('finish_publishing_promopage','options');
$header_text_new = wp_strip_all_tags(get_field('header_text','options'));
$header_text_normal_new = wp_strip_all_tags(get_field('header_text_normal','options'));
?>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <link rel='stylesheet' href='<?php echo get_template_directory_uri() ?>/css/bootstrap.css'>
    <link rel='stylesheet' href='<?php echo get_template_directory_uri() ?>/css/campaign.css'>

    <script data-cfasync="false"  type='text/javascript'>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    </script>
    <script data-cfasync="false"  type='text/javascript'>
        ga( 'create', 'UA-67877640-1', 'auto', 'IPTracker' );
        ga( 'IPTracker.send', 'pageview' );
    </script>

    <!-- Facebook Pixel Code -->
    <script data-cfasync="false" >
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '191954184656473');
        fbq('track', "PageView");
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=191954184656473&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Google Tag Manager -->
    <script data-cfasync="false" >(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MFD6GRG' );</script>
    <!-- End Google Tag Manager -->
</head>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFD6GRG"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="i-page" class="page page2 ">
    <div class="notification">
        <div class="notification-overlay"></div>
        <div class="notification-inner">
            <img rel="<?php echo get_template_directory_uri(); ?>/images/loading_circle.svg" src="" class="loading notification-loader" alt="" />
            <span class="message"></span>
        </div>
    </div>
<!--    --><?php //echo $current_datetime; ?><!--<br>-->
<!--    --><?php //echo $start_publishing; ?><!--<br>-->
<!--    --><?php //echo $finish_publishing; ?>
    <div class="page-block" id="page-block-et90gublfqp">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
                <div
                        class="page-element widget-container page-element-type-image widget-image "
                        id="element-656"
                >

                    <div class="contents">
                        <a
                                href="https://vivagym.co.za"
                                style="width: 100%; height: 100%;"
                        >
                            <img
                                    src="https://vivagym.co.za/wp-content/uploads/2018/11/campaign-logo.jpg"
                                    style="margin-top: 0px;"
                                    alt=""
                            />

                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="page-block" id="page-block-4i9brtir186">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
            </div>
        </div>
    </div>
    <div class="page-block viva-gym-promotion" id="page_block_header">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
                <div
                        class="page-element widget-container page-element-type-box widget-box "
                        id="element-725"
                >


                    <div class="box" style="width: 100%; height: 100%; background-color: #71c8c6; border: 1px solid rgba(0,0,0,0); border-radius: px px px px; background-repeat: repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-position: top left;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-form widget-form "
                        id="element-687"
                >



                    <div id="element-687"  class="widget-container widget-form promotion">
                        <div class="contents">

                            <!-- SharpSpring Form for Campaign  -->
<!--                            <script type="text/javascript">-->
<!--                                var ss_form = {'account': 'MzawMDE3NDAxAwA', 'formID': 's0xJSUwyTTHQTTQwStY1STU11bVMskzUtTQ3Tk1LTLRITTWwBAA'};-->
<!--                                ss_form.width = '100%';-->
<!--                                ss_form.height = '1000';-->
<!--                                ss_form.domain = 'app-3QNGCC2JLC.marketingautomation.services';-->
<!--                                // ss_form.hidden = {'Company': 'Anon'}; // Modify this for sending hidden variables, or overriding values-->
<!--                            </script>-->
<!--                            <script type="text/javascript" src="https://koi-3QNGCC2JLC.marketingautomation.services/client/form.js?ver=1.1.1"></script>-->

                        <?php echo do_shortcode('[contact-form-7 id="4545" title="Promotion"]'); ?>

                        </div>
                        <div style="clear: both"></div>
                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-image widget-image "
                        id="element-712"
                >

                    <div class="page-element widget-container page-element-type-button widget-button " id="element-370">



                    </div>
                    <div class="contents">
                        <img
                                src="https://vivagym.co.za/wp-content/uploads/2018/11/33764341-0-heart-01.png"
                                style="margin-top: 113px;"
                                alt=""
                        class="heart-logo"/>

                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-headline widget-headline "
                        id="element-724"
                >


                    <div class="contents text-block-1"><h4>
                            <?php if ($current_datetime >= $start_publishing && $current_datetime < $finish_publishing) {
                                the_field('text_block_1','options');
                            }
                            else {
                                the_field('text_block_1_normal','options');
                            }
                            ?>
                        </h4>
                        <a href="https://vivagym.co.za/join-now/"><button class="button">JOIN NOW</button></a>
                    </div>



                </div>



                <div
                        class="page-element widget-container page-element-type-headline widget-headline "
                        id="element-726"
                >


                    <div class="contents text-block-2"><h4>
                            <?php if ($current_datetime >= $start_publishing && $current_datetime < $finish_publishing) {
                                the_field('text_block_2','options');
                            }
                            else {
                                the_field('text_block_2_normal','options');
                            }
                            ?>
                        </h4><br><br><br></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-headline widget-headline "
                        id="element-672"
                >


                    <div class="contents header-text"><h4>
                            <?php if ($current_datetime >= $start_publishing && $current_datetime < $finish_publishing) {
                                the_field('header_text','options');
                            }
                            else {
                                the_field('header_text_normal','options');
                            }
                            ?>
                        </h4></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-image widget-image "
                        id="element-732"
                >


                    <div class="contents">
                        <img
                                src="

                                <?php if ($current_datetime >= $start_publishing && $current_datetime < $finish_publishing) {
                                    the_field('image','options');
                                }
                                else {
                                    the_field('image_normal','options');
                                }
                                ?>
"
                                style="margin-top: 0px;"
                                alt=""
                        />

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="page-block" id="page-block-xe6re02h63o">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
            </div>
        </div>
    </div>
    <div class="page-block" id="page-block-54qe3rtg0it">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
                <div
                        class="page-element widget-container page-element-type-box widget-box "
                        id="element-323"
                >


                    <div class="box" style="width: 100%; height: 100%; background-color: #6fc6c4; border-radius: 0px 0px 0px 0px; opacity: 1; filter:alpha(opacity=100); background-repeat: repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-position: top left;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-circle widget-circle "
                        id="element-324"
                >


                    <div class="circle" style="box-sizing: border-box;width: 100%; height: 100%; background-color: #ffcd02; opacity: 1; filter:alpha(opacity=100); background-repeat: repeat; background-position: top left; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-325"
                >

                    <div class="contents"><p style="text-align: center;  ">CONFIDENCE</p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-circle widget-circle "
                        id="element-326"
                >


                    <div class="circle" style="box-sizing: border-box;width: 100%; height: 100%; background-color: #ffcd02; opacity: 1; filter:alpha(opacity=100); background-image: url('https://vivagym.co.za/wp-content/uploads/2018/11/15270821-0-mobility.png'); background-repeat: no-repeat; background-position: center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-327"
                >

                    <div class="contents"><p style="text-align: justify;  ">Whether it's toight abs, a bangin' booty, or the ability to do push ups with one hand and high five a bad guy in the face at the same time, exercise can do wonders for your confidence.</p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-box widget-box "
                        id="element-328"
                >


                    <div class="box" style="width: 100%; height: 100%; background-color: #000000; border-radius: 0px 0px 0px 0px; opacity: 1; filter:alpha(opacity=100); background-repeat: repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-position: top left;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-circle widget-circle "
                        id="element-329"
                >


                    <div class="circle" style="box-sizing: border-box;width: 100%; height: 100%; background-color: #ffcd02; opacity: 1; filter:alpha(opacity=100); background-repeat: repeat; background-position: top left; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-330"
                >

                    <div class="contents"><p style="text-align: center;  ">NATURAL HIGH</p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-331"
                >

                    <div class="contents"><p style="text-align: justify;  ">Endorphins, do you have them? These happy hormones are released whenever you exercise, creating great moods. You'll also sleep better...and also be able to eat a bit more!</p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-box widget-box "
                        id="element-332"
                >


                    <div class="box" style="width: 100%; height: 100%; background-color: #6fc6c4; border-radius: 0px 0px 0px 0px; opacity: 1; filter:alpha(opacity=100); background-repeat: repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-position: top left;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-333"
                >

                    <div class="contents"><p style="text-align: center;  ">COMMUNITY</p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-334"
                >

                    <div class="contents"><p style="text-align: justify;  ">We're not just saying it. At Viva we truly believe we have the best community spirit a gym can have. We love our members and they love us! See for yourself!</p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-circle widget-circle "
                        id="element-335"
                >


                    <div class="circle" style="box-sizing: border-box;width: 100%; height: 100%; background-color: #ffcd02; opacity: 1; filter:alpha(opacity=100); background-repeat: repeat; background-position: top left; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-circle widget-circle "
                        id="element-336"
                >


                    <div class="circle" style="box-sizing: border-box;width: 100%; height: 100%; background-color: #ffcd02; opacity: 1; filter:alpha(opacity=100); background-image: url('https://vivagym.co.za/wp-content/uploads/2018/11/15270816-0-endurance.png'); background-repeat: no-repeat; background-position: center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-line-horizontal widget-line-horizontal "
                        id="element-337"
                >

                    <div class="line-horizontal" style="width: auto; height: 10px; border-bottom: 3px solid #ffcd02;"></div>

                </div>

                <div
                        class="page-element widget-container page-element-type-line-horizontal widget-line-horizontal "
                        id="element-338"
                >

                    <div class="line-horizontal" style="width: auto; height: 10px; border-bottom: 3px solid #ffcd02;"></div>

                </div>

                <div
                        class="page-element widget-container page-element-type-line-horizontal widget-line-horizontal "
                        id="element-339"
                >

                    <div class="line-horizontal" style="width: auto; height: 10px; border-bottom: 3px solid #ffcd02;"></div>

                </div>

                <div
                        class="page-element widget-container page-element-type-image widget-image "
                        id="element-340"
                >


                    <div class="contents">
                        <img
                                src="https://vivagym.co.za/wp-content/uploads/2018/11/16706461-0-heart.png"
                                style="margin-top: 0px;"
                                alt=""
                        />

                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-headline widget-headline "
                        id="element-341"
                >


                    <div class="contents"><h1><p style="text-align: center;  "><font color="#0c0c0c">SO WHY</font> <font color="#6fc6c4">DO THIS GYM</font> <font color="#000000">THING?</font></p></h1></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-line-horizontal widget-line-horizontal "
                        id="element-342"
                >

                    <div class="line-horizontal" style="width: auto; height: 10px; border-bottom: 3px solid #ffcd02;"></div>

                </div>

            </div>
        </div>
    </div>
    <div class="page-block" id="page-block-9eb2y1qncol">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
                <div
                        class="page-element widget-container page-element-type-image widget-image "
                        id="element-343"
                >


                    <div class="contents">
                        <img
                                src="https://vivagym.co.za/wp-content/uploads/2018/11/15273676-0-DSC-5747.jpg"
                                style="margin-top: 0px;"
                                alt=""
                        />

                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-image widget-image "
                        id="element-344"
                >


                    <div class="contents">
                        <img
                                src="https://vivagym.co.za/wp-content/uploads/2018/11/15273691-0-DSC-5616.jpg"
                                style="margin-top: 0px;"
                                alt=""
                        />

                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-image widget-image "
                        id="element-345"
                >


                    <div class="contents">
                        <img
                                src="https://vivagym.co.za/wp-content/uploads/2018/11/15273826-0-DSC-5668.jpg"
                                style="margin-top: 0px;"
                                alt=""
                        />

                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-346"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">NO CONTRACT!</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-347"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#000000">At Viva, we're so sure you'll like us that we're sure you'll want to stay as long as you can afford to, but we won't force you to stay if you can't, because that's life.</font></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-348"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">AWESOME CLASSES!</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-349"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#000000">Sweating is a Social sport! Try out our cardio dance, spinning, or yoga classes, to name just a few. World-class Les Mills classes too!</font></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-350"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">WORLD CLASS STUFF</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-351"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#000000">From our spacious gym floors to our state of the art cardio equipment, to plentiful weights for the strong of heart who want to be strong in body, Viva has it all.</font></p></div>
                </div>

            </div>
        </div>
    </div>
    <div class="page-block" id="page-block-s054rnrr0iq">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
                <div
                        class="page-element widget-container page-element-type-video widget-video "
                        id="element-359"
                >


                    <div
                            class="video_wrapper contents"
                    >
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/KkAL9Wnb48Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-headline widget-headline "
                        id="element-363"
                >


                    <div class="contents"><h1><p style="text-align: center;  "><font color="#000000">TAKE A</font> <font color="#6fc6c4">LOOK</font></p></h1></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-line-horizontal widget-line-horizontal "
                        id="element-364"
                >

                    <div class="line-horizontal" style="width: auto; height: 10px; border-bottom: 3px solid #6fc6c4;"></div>

                </div>

                <div
                        class="page-element widget-container page-element-type-button widget-button "
                        id="element-370"
                >


                    <div class="conversion_wrapper">
                        <a
                                href="#element-687"
                                class="on-page-scroll"
                                style="width: 321px; height: 60px;"
                                data-wid="370"
                        >
                            <div
                                    class="btn submit-button button_submit dynamic-button  shadow  "
                            >Request a Call Back</div>
                        </a>
                    </div>
                </div>

                <div
                        class="page-element widget-container page-element-type-headline widget-headline "
                        id="element-371"
                >


                    <div class="contents"><h4><p style="text-align: center;  "><font color="#000000">Neat, huh? Why don't you make the first move?</font></p></h4></div>
                </div>

            </div>
        </div>
    </div>

    <div class="page-block" id="page-block-gami345fk3">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-361"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">ROSEBANK:</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-362"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#ffffff">The Zone @ Rosebank
                            </font></p><p style="text-align: left;  "><font color="#ffffff">117 Oxford Street
                            </font></p><p style="text-align: left;  "><font color="#ffffff">Rosebank
                            </font></p><p style="text-align: left;  "><font color="#ffffff">Johannesburg
                            </font></p><p style="text-align: left;  "><font color="#ffffff">2196</font></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-579"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">OAKDENE:</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-580"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#ffffff">Cnr Comaro St &amp; Boundary Ln</font></p><p style="text-align: left;  "><font color="#ffffff">Ground Floor, Camaro Crossing&nbsp;</font></p><p style="text-align: left;  "><span style="color: rgb(255, 255, 255);">Oakdene</span><br></p><p style="text-align: left;  "><font color="#ffffff">Johannesburg South&nbsp;</font></p><p style="text-align: left;  "><font color="#ffffff">2190</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-582"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">FOURWAYS:</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-583"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#ffffff">Cnr William Nicol Dr &amp; Sunrise Blvd</font></p><p style="text-align: left;  "><font color="#ffffff">Shop G22, Upper Level</font></p><p style="text-align: left;  "><font color="#ffffff">Fourways Crossing, Lone Hill</font></p><p style="text-align: left;  "><font color="#ffffff">Johannesburg</font></p><p style="text-align: left;  "><font color="#ffffff">2191</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-584"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">MONTANA:</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-585"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#ffffff">Cnr of Dirk &amp; Veronica<br>Zambezi Drive<br></font></p><p style="text-align: left;  "><font color="#ffffff">Montana Crossing</font></p><p style="text-align: left;  "><font color="#ffffff">Montana</font></p><p style="text-align: left;  "><font color="#ffffff">Pretoria</font></p><p style="text-align: left;  "><font color="#ffffff">0182</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-586"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">WALMER:</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-587"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#ffffff">Cnr Martin Rd &amp; 17th Ave</font></p><p style="text-align: left;  "><font color="#ffffff">Shop 12, 17th Quarter Shopping Centre Greenshields Park&nbsp;</font></p><p style="text-align: left;  "><font color="#ffffff">Port Elizabeth</font></p><p style="text-align: left;  "><font color="#ffffff">6070</font></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-588"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">HILLFOX:</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-589"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#ffffff">Cnr Hendrik Potgieter Rd &amp; Albert St</font></p><p style="text-align: left;  "><font color="#ffffff">Hillfox Value Centre</font></p><p style="text-align: left;  "><font color="#ffffff">Weltevreden Park</font></p><p style="text-align: left;  "><font color="#ffffff">Johannesburg</font></p><p style="text-align: left;  "><font color="#ffffff">1709</font></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-590"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#6fc6c4">SUNNINGDALE:</font></p><p style="text-align: left;  "><br></p></div>
                </div>

                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-591"
                >

                    <div class="contents"><p style="text-align: left;  "><font color="#ffffff">104 Sunningdale Dr&nbsp;</font></p><p style="text-align: left;  "><font color="#ffffff">Milnerton Rural&nbsp;</font></p><p style="text-align: left;  "><font color="#ffffff">Cape Town</font></p><p style="text-align: left;  "><font color="#ffffff">7441</font></p></div>
                </div>

            </div>
        </div>
    </div>
    <div class="page-block" id="page-block-ocuvx7ualfr5p14i">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="block-inner">
                <div
                        class="page-element widget-container page-element-type-text widget-text "
                        id="element-54"
                >

                    <div class="contents"><p style="text-align: center;  "><font color="#ffffff">© <?php echo date("Y"); ?> Viva Gym</font></p></div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- No ReCaptcha enabled -->
<div id="fb-root"></div>

<?php get_footer(); ?>

