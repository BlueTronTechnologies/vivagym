<?php
/**
 * Template Name: Survey
 */
?>

<?php get_header(); ?>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <link rel='stylesheet' href='<?php echo get_template_directory_uri() ?>/css/bootstrap.css'>
    <link rel='stylesheet' href='<?php echo get_template_directory_uri() ?>/css/campaign.css'>
<style>
    .container.survey {
        position: relative;
        z-index: 10;
    }
    .survey img.survey-logo {
        margin-top: 0;
        width: 300px;
        height: auto;
        position: absolute;
        right: 104px;
        top: 400px;
    }
    .survey-footer img {
        width: 100%;
        position: absolute;
        bottom: -197px;
        z-index: -1;
    }
</style>
</head>


<div id="i-page" class="page page2 ">
    <div class="notification">
        <div class="notification-overlay"></div>
        <div class="notification-inner">
            <img rel="<?php echo get_template_directory_uri(); ?>/images/loading_circle.svg" src="" class="loading notification-loader" alt="" />
            <span class="message"></span>
        </div>
    </div>

    <div class="container survey" style="position: relative">
        <img class="survey-logo" src="https://vivagym.co.za/wp-content/uploads/2018/11/campaign-logo.jpg" style="margin-top: 0px;" alt="" />

        <!-- SharpSpring Form for Survey  -->
<!--        <script type="text/javascript">-->
<!--            var ss_form = {'account': 'MzawMDE3NDAxAwA', 'formID': 'M7FIMjYzMTbQTbVIS9E1SbQ00bVMtkzStTA3SzEyMze1ME00AwA'};-->
<!--            ss_form.width = '100%';-->
<!--            ss_form.height = '1000';-->
<!--            ss_form.domain = 'app-3QNGCC2JLC.marketingautomation.services';-->
<!--            ss_form.hidden = {'_usePlaceholders': true};-->
<!--            // ss_form.hidden = {'Company': 'Anon'}; // Modify this for sending hidden variables, or overriding values-->
<!--        </script>-->
<!--        <script type="text/javascript" src="https://koi-3QNGCC2JLC.marketingautomation.services/client/form.js?ver=1.1.1"></script>-->

        <br><br>
        <?php echo do_shortcode('[contact-form-7 id="4547" title="Survey"]'); ?>
        <br><br>

        <div class="survey-footer">
            <img src="http://vivagym.co.za/wp-content/themes/vivagym/images/footer-survey.png">
        </div>
    </div>


</div>
<?php get_footer(); ?>

