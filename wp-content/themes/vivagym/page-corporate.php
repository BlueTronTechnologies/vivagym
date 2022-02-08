<?php
/**
 * Template Name: Corporate
 */
?>

<?php get_header(); ?>

<div class="spring-campaign corporate">
    <div class="notification">
        <div class="notification-overlay"></div>
        <div class="notification-inner">
            <img rel="<?php echo get_template_directory_uri(); ?>/images/loading_circle.svg" src="" class="loading notification-loader" alt="" />
            <span class="message"></span>
        </div>
    </div>

    <div class="header" style="position: relative">
        <img class="logo" src="https://vivagym.co.za/wp-content/uploads/2018/11/campaign-logo.jpg" alt="" />
    </div>
    <div class="" style="position: relative">
        <div class="header-img"></div>
        <div class="header-text"><img src="https://vivagym.co.za/wp-content/uploads/2019/09/header-text.png" alt="" /></div>
    </div>

    <div class="body-content">

        <div class="container">
            <div class="">
                <span class="description">
                    <strong>
                        At Viva Gym we strive to live a happier and healthier life. We found some facts about your employees
                        that you may find interesting and why we believe that living an active lifestyle is important even
                        in the workplace:
                    </strong>
                    <ul>
                        <li>70% of South African women are overweight</li>
                        <li>39% of South African men are overweight</li>
                        <li>45 mins of vigorous exercise reduces stress by 25%</li>
                        <li>People who exercise are 12.5% more productive versus people who don’t</li>
                        <li>People who exercise take 5 less sick days annually versus people who don’t exercise</li>
                        <li>Less than 5% of people participate in 30 mins of physical activity each day</li>
                    </ul>
                </span>
            </div>
        </div>

        <div class="devider"></div>

        <div class="container second-row">
            <div class="">
                <span>
                    Your employees can join a <strong>flexible month to month</strong> membership with up to <strong>20% discount</strong> on our normal rate. We’re throwing in an <strong>extra R100 off</strong> the Joining Fee.
                    <br><br>
                    Come and enjoy our world-class facility with state-of-the-art equipment near you. We can help you and your employees live happier and healthier lives!
                    <br><br><br>
                </span>
            </div>
        </div>


        <div class="section">
            <div class="row">
                <div class="video">
                    <div class="videowrapper">
						<span class="placeholder" style="background: url('https://vivagym.co.za/wp-content/uploads/2018/05/sunningdale-2-e1526395690415.jpg') no-repeat 0 0 / cover; width: 80%;">
							<span class="overlay"></span>
							<span class="prompt"><?php include TEMPLATEPATH . "/images/svg/play.svg" ?></span>
						</span>
                        <iframe id="viva_promo" src="https://www.youtube.com/embed/glULnfRY3aE?rel=0&amp;controls=0&amp;showinfo=0" width="80%" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="devider"></div>

        <div class="container third-row">
            <span class="heading">WHAT WE OFFER WITH YOUR MEMBERSHIP:</span>
            <div class="">
                <div class="col-md-6 left">
                    <img src="https://vivagym.co.za/wp-content/uploads/2019/09/corporate-footer-1.jpg">
                </div>
                <div class="col-md-6 right">
                    <ul>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/1.png"></span> world-class equipment</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/2.png"></span> functional training</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/3.png"></span> live & virtual spinning classes</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/4.png"></span> free fitness programmes</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/5.png"></span> free parking</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/6.png"></span> 1gb free wi-fi per day</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/7.png"></span> group training (incl. lunch time classes)</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/8.png"></span> unlimited access</li>
                        <li><span><img src="https://vivagym.co.za/wp-content/uploads/2019/09/9.png"></span> 50+ classes per week</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="devider"></div>

        <div class="container footer">
            <span>Contact you nearest Viva Gym for further queries:</span>
            <a href="/our-gyms/" class="gym-finder">GYM FINDER</a>
        </div>

    </div>

</div>

<?php get_footer(); ?>
