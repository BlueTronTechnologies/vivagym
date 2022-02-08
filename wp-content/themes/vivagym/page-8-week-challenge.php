<?php
/**
 * Template Name: 8 Week Challenge
 */
?>

<?php get_header(); ?>

<style>
.header_challenge_img img {
    width: 100%;
}
.col6 {
    background-color:#6fc8c6;
    padding: 60px;
}
.col7 {
    background-color:#ffffff;
    text-align: center !important;
    padding: 0;
    height: auto;
            padding: 60px !important;
}
.col7 img {
    margin: auto;
    display:block;
    max-width: 70%;

}
.weekChallengeForm {
    display: grid;
    text-align: center;
}
.weekChallengeForm h1 {
    color: #ffffff;
    padding-bottom: 10px;
}
.weekChallengeForm input {
    background-color: #fff;
    border: solid 1px #fff;
    width: 200px;
    margin: 0 auto;
}
.weekChallengeForm p {
    width: 90%;
    margin: 0 auto;
    color: #fff;
    margin-top: 0px;
}
.weekChallengeForm p a {
    text-decoration: underline;
    color: #fff;
}
.weekChallengeForm button {
    padding:10px;
    background-color: transparent;
    border: solid #ffffff 2px;
    color: #ffffff;
    font-weight: 600;
    width: 170px;
    margin: 0 auto;
    margin-top: 20px;
}

::-webkit-input-placeholder { /* Edge */
  color: #cccccc !important;
  padding-left:10px;
  font-weight: 400 !important;
    font-family: aniversregular,sans-serif;
    font-style: normal;
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #cccccc !important;
  padding-left:10px;
  font-weight: 400 !important;
    font-family: aniversregular,sans-serif;
    font-style: normal;
}

::placeholder {
  color: #cccccc !important;
  padding-left:10px;
  font-weight: 400 !important;
    font-family: aniversregular,sans-serif;
    font-style: normal;
}
.challenge8WeekInfo {
    text-align: center;
    padding-top: 50px;
    padding-bottom: 50px;
}

h2{
    padding: 0 0 60px;
    font-family: aniversbold,sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 38px;
    text-transform: uppercase;
}

.info1 h1 {
    padding: 30px 0px;
}
.info2 h1 {
    padding: 80px 0px 30px 0px;
}
.info3 h1 {
    padding: 80px 0px 30px 0px;
}
.col8 {
    background-color:#ffca10;
    text-align: left !important;
    padding: 60px;
}
.col8 h1 {
    color: #000;
    font-weight: 900;
    width: 250px;
    font-size: 50px !important;
    font-family: 'ProximaNova-Bold' !important;
}
.col8 p {
    color: #000;
}
.col8 ul {
    margin-top:10px;
}
.col8 ul li {
    list-style: disc !important;
}
.col9 {
    background-color:#000;
    text-align: left !important;
    padding: 60px;
}
.col9 h1 {
    color: #ffca10;
    font-weight: 900;
    width: 200px;
    font-size: 50px !important;
    font-family: 'ProximaNova-Bold' !important;
}
.col9 h3 {
    color: #fff;
    margin-top: 36px;
}
.col9 .winSpacing {
    margin-top: 50px;
}
.infoChallenge {
    margin-top: 30px;
    margin-bottom: 100px;
}
p {
    font-size: 16px;
}
span.allcaps {
    text-transform: uppercase;
}
.wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 select, .wpcf7 textarea {
    border: 1px solid #fff;
    font-size: 18px;
    height: 41px;
    color: #414042 !important;
    font-weight: bold;
    padding: 0 10px;
    outline: none !important;
    width: 100%;
    margin-bottom: 6px;
}
.wpcf7 select {
    color: #cccccc !important;
    padding-left: 20px;
    font-weight: 400 !important;
    border: solid 1px #FFF !important;
    background-color: #FFF !important;
    font-size: 17px !important;
}
.wpcf7-submit {
margin: 10px !important;
    left: 0;
    line-height: 15px;
    transform: none;
}
div.wpcf7 .ajax-loader {
    margin: 0 0 0 -23px;
}

.info1 {
    text-align: left;
    padding-bottom: 40px;
    border-bottom: 20px solid #fcc601;
        margin-bottom: 40px;
}

.info2 h2{
        color: #6fc8c6;
}

.info2-body {
    text-align: left;
    margin-bottom: 80px;
}

.info2-second {
    text-align: left;
}

ol {
    margin-top: 20px;
    padding-left: 15px;
}

ol li {
    margin-top: 20px;
    font-weight: bold;
    list-style: auto; 
    text-transform: uppercase;
}

ol li a{
    text-decoration: underline;
}

.campaign-logo img{
        max-width: 300px;
    margin: 80px auto 40px;
}

@media screen and (max-width: 767px){
    .col6 {
        background-color: #6fc8c6;
        padding: 30px;
    }
}
</style>

<div class="container">
    <div class="header_challenge_img">
        <img src="https://vivagym.co.za/wp-content/uploads/2021/08/Viva-image-2.jpg" />
    </div>
</div>

<div class="container">
    <div class="col-md-6 col6">
        <div class="weekChallengeForm">
            <h1>SIGN UP TO START</h1>
            <p>*You must be a member at Viva Gym to qualify to win the grand prize</p>
            <?php echo do_shortcode('[contact-form-7 id="4613" title="8 Week Challenge"]') ?>
        </div>
    </div>
    <div class="col-md-6 col7">
        <h2>8 Week Wellness Competition</h2>
        <h2>Measure . Train . Win</h2>
        <img src="https://vivagym.co.za/wp-content/uploads/2021/08/Viva-image-1.png" />  
    </div>
</div>

<div class="container challenge8WeekInfo">
    <div class="info1">
        <p>Before completing this form, please ensure that you have done your Inbody assessment at Your Gym. Our friendly staff at Viva Gym are happy to help you get this measurement. You then have 8 weeks to improve your Inbody overall score out of 100. Your last Inbody score must be taken within 8 weeks from your first measurement. Good Luck!</p>
    </div>

    <div class="info2">
        <h2>Viva gym wants to increase your chances of winning the grand prize of R25 000</h2>
        <div class="info2-body">
            <p>Once you have your first Inbody measure, and you have started your 8 week wellness journey, Viva Gym has many tools to help you achieve great results. Below are 4 special offerings to help you on this wellness journey.</p>
            <ol>
                <li><p><strong>Find and train with a personal trainer at <a href="https://vivagym.co.za/our-gyms/">your gym</a></strong></p></li>
                <li><p><strong>15% off your 1st consultation + meal plan with our dietician, caylin <a href="https://vivagym.co.za/gyms/fourways-johannesburg/">contact her here</a></strong></p></li>
                <li><p><strong>Download a free Viva Gym Workout plan <a href="https://vivagym.co.za/fitness-library/">Here</a></strong></p></li>
                <li><p><strong>Book your spot in a group exercise class by <a href="https://app.vivagym.co.za/login/">logging in to your members area</a> online</strong></p></li>
            </ol>
        </div>

        <div class="info2-second">
            <p>This competition will run until 30 November 2021. Winner(s) of the grand total prize R25 000 will be notified in December. Just in time for an extra bit of Christmas cheer! </p>
        </div>

        <div class="campaign-logo">
            <img src="https://vivagym.co.za/wp-content/uploads/2018/11/campaign-logo.jpg">
        </div>
    </div>

    <!-- <div class="info3">
        <h1>HOW CAN I ACHIEVE MY GOAL?</h1>
        <p> <strong>VISITS:</strong> Visit the gym 24 times (only 1 visit per day will count) in the 8 week period. <br><br></p>
        <p> <strong>COUNT YOUR CALORIES:</strong> Use any smartwatch, HRM or ﬁtness activity tracker to show how your<br>exercise activities burned more than 12000 active calories in the set time frame. <br><br></p>
        <p> <strong>IMPROVING YOUR BODY COMPOSITION:</strong> Book an appointment at the gym for an Inbody assessment.<br>Improve on your Inbody score by achieving your goal workout via the Inbody matrix.<br>Inbody assessment must be done within 7 days of your sign up and the last 7 days of the 8 week challenge. </p>
    </div> -->
</div>


<!-- <div class="container infoChallenge">
    <div class="col-md-6 col8">
        <h1> WHAT ARE THE RULES? </h1>
        
        <ul>
            <li>Only 1 entry per member.</li>
            <li>Only 1 visit per day to count and dwell time will be monitored to avoid gamiﬁcation.</li>
            <li>Members must enter the competition via the online joining form to qualify for a prize.</li>
            <li>Activity calories will be inspected for validity.</li>
            <li>Any activity calorie tracking app can be used as long as it is a reputable device or app.*</li>
            <li>Rewards are subject to stock availability.</li>
        </ul>
    </div>
    <div class="col-md-6 col9"> 
        <h1> WHAT CAN I WIN? </h1>

        <h3>A unique Under Armour back pack or a gift voucher worth R500 from Under Armour.</h3>
        <h3 class="winSpacing" >In-gym spot prizes available during the course of the 1st quarter of 2020.</h3>
    </div>
</div> -->

<?php get_footer(); ?>
