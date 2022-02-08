<?php
/**
 * Template Name: Freepass Template
 */
?>

<style>
    .own-text {
        font-size: 20pt;
        text-align: left;
        width: 380px;
        position: absolute;
        margin-left: 670px;
        margin-top: 80px;
    }
    #page_block_header {
        height: 593px !important;
    }
    .voucher {

    }
    .page {
        background-color: #000 !important;
    }
    @media screen and (max-width: 414px){
        .own-text {
            font-size: 12pt;
            text-align: left;
            width: 380px;
            position: absolute;
            margin-left: 20px;
            margin-top: 220px;
        }
        .voucher {
            width: 94%;
        }
        #page_block_header {
            height: 303px !important;
        }
        #page-block-gami345fk3 {
            margin-top: -1550px;
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

</head>

<div id="i-page" class="page page2 ">
    <div class="notification">
        <div class="notification-overlay"></div>
        <div class="notification-inner">
            <img rel="<?php echo get_template_directory_uri(); ?>/images/loading_circle.svg" src="" class="loading notification-loader" alt="" />
            <span class="message"></span>
        </div>
    </div>

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
    <div class="page-block" id="page_block_header">
        <div class="color-overlay"></div>
        <div class="border-holder">
            <div class="">
                <a href="https://vivagym.co.za/wp-content/uploads/2019/06/your-free-pass.pdf" target="_blank">
                    <img class="voucher" src="<?php echo get_template_directory_uri() ?>/images/free-pass-download.jpg" style="width: 100%;"/>
                </a>
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

                    <div class="contents"><p style="text-align: center;  "><font color="#ffffff">© 2019 Viva Gym</font></p></div>
                </div>

            </div>
        </div>
    </div>
</div>