<?php
    $current_url = $_SERVER['REQUEST_URI'];

    if ( strpos($current_url, 'survey') !== false || strpos($current_url, 'viva-gym-promotion') !== false) {
    echo "";
    } else { ?>

    <div class="section footer">
        <div class="row">
            <p><?php echo (get_field('footer_text','options')) ? get_field('footer_text','options') : ''; ?></p>
            <div class="social_nav">
                <?php if(get_field('facebook_link','options')){ ?>
                    <div class="fb"><a href="<?php echo get_field('facebook_link','options'); ?>" target="_blank"><?php echo file_get_contents(TEMPLATEPATH ."/images/svg/fb_foot.svg"); ?></a></div>
                <?php } ?>
                <?php if(get_field('twitter_link','options')){ ?>
                    <div class="twit"><a href="<?php echo get_field('twitter_link','options'); ?>" target="_blank"><?php echo file_get_contents(TEMPLATEPATH ."/images/svg/twit_foot.svg"); ?></a></div>
                <?php } ?>
                <?php if(get_field('instagram_link','options')){ ?>
                    <div class="insta"><a href="<?php echo get_field('instagram_link','options'); ?>" target="_blank"><?php echo file_get_contents(TEMPLATEPATH ."/images/svg/insta_foot.svg"); ?></a></div>
                <?php } ?>
                <?php if(get_field('youtube_link','options')){ ?>
                    <div class="tube"><a href="<?php echo get_field('youtube_link','options'); ?>" target="_blank"><?php echo file_get_contents(TEMPLATEPATH ."/images/svg/tube_foot.svg"); ?></a></div>
                <?php } ?>
            </div>
            <div class="footer_site_nav">
                <?php wp_nav_menu( array('menu' => 'Footer', 'container' => '', 'menu_class' => 'footer_menu' )); ?>
            </div>
        </div>
    </div>

<?php } ?>

<!-- end footer -->

<?php wp_footer(); ?>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/dist/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var fsBanner = function(container,options) {
	var self = this;

	var defaults = {
		'showName':true,
		'showCaption':true,	
		'toUpdate':{},
		'whenEmpty':{},
		'trigger':'click',
		'hideParent':null,
		'onChanged':null
	}

	this.options = $.extend({}, defaults, options);

	this.ilast = -1;

	this.setup = function() {
		this.container = $(container);
		this.items = this.container.find('div');

		if (!this.container.width()) this.container.width(this.container.parent().width());

		this.part = this.container.width() / this.items.length;
		this.mini = this.part/4;
		this.widmain = this.container.width() - (this.mini*this.items.length-1);

		this.items.css({'height':this.container.height(),'width':this.widmain+this.mini});	

		if (!this.options.showName) this.items.find('.name').hide();
		if (!this.options.showCaption) this.items.find('.location').hide();

		this.items.each(function(i) {
			var $item = $(this);
			$item.css({'z-index':i});
			if (self.options.trigger == 'click') $item.on('click',function() { self.selectItem($item,i); });
			if (self.options.trigger == 'mouse') $item.on('mouseenter',function() { self.selectItem($item,i,true); });
		});

		if (self.options.trigger == 'mouse') {
			this.container.on('mouseleave',function() { self.resetcss(); });
		}

		this.resetcss();
		this.container.show();
	}

	this.resetcss = function() {
		this.items.each(function(i) {
			var $item = $(this);
			$item.stop().animate({'left':i*self.part});

			if (self.options.showName) {
				var $name = $item.find('.name');
				if ($name.hasClass('minimized')) $name.hide().removeClass('minimized').fadeIn('fast');
			}

			if (self.options.showCaption) {
				var $caption = $item.find('.location');
				if ($name.hasClass('minimized')) $caption.hide().removeClass('minimized').fadeIn('fast');
			}

		});
		this.ilast = null;
		this.updateHtml();
	};

	this.selectItem = function($expanded,iexpanded,forceClick) {
		this.$lastexpanded = this.$expanded;

		if (forceClick) this.ilast = null;
		if (iexpanded == this.ilast) {
			this.$expanded = null;			
			this.resetcss();
		} else {
			this.$expanded = $expanded;			
			this.items.each(function(i) {
				var $item = $(this);
				if (i <= iexpanded) {
					$item.stop().animate({'left':i*self.mini});
				} else {
					$item.stop().animate({'left':i*self.mini+self.widmain});
				}

				if (self.options.showName) {
					var $name = $item.find('.name');
					var method = (i == iexpanded) ? 'removeClass' : 'addClass';				
					if (method == 'addClass' && $name.hasClass('minimized')) method = '';
					if (method) $name.hide()[method]('minimized').fadeIn('fast');
				}

				if (self.options.showCaption) {
					var $name = $item.find('.location');
					var method = (i == iexpanded) ? 'removeClass' : 'addClass';				
					if (method == 'addClass' && $name.hasClass('minimized')) method = '';
					if (method) $name.hide()[method]('minimized').fadeIn('fast');
				}
				
			});
			this.ilast = iexpanded;
			this.updateHtml($expanded);
		}
		this.fireChanged();
	};

	this.updateHtml = function($expanded) {
		this.$expanded = $expanded;

		var $parent = $(self.options.hideParent);
		$.each(this.options.toUpdate,function(field,selector) {
			var $obj = $(selector);
			var showit = false;
			var value = '';
			if ($expanded) {
				$parent.show();
				value = $expanded.find('.'+field).html();
				showit = true;
			} else {
				if ($parent.length) {
					showit = false;
					$parent.hide();
				} else {
					if (self.options.whenEmpty[field]) {
						value = self.options.whenEmpty[field];
						showit = true;
					}
				}
			}
			$obj.hide();
			if (showit) $obj.html(value).fadeIn('fast');
		});
	};

	this.fireChanged = function() {
		if (this.options.onChanged) {
			this.options.onChanged(this.$expanded,this.$lastexpanded);
		}
	};

	this.setup();
	};

	$.fn.fsBanner = function(options) {
		return new fsBanner(this,options);
	};

	$('#demo-3').fsBanner({'trigger':'mouse'});
</script>

<script>
    $(document).ready(function(){
        $('.selectric-scroll ul li:nth-child(4)').on('click', function(){
            $('div#frm_field_99_container').addClass('montana-premium');
            $('div#frm_field_99_container').insertBefore('div#frm_field_94_container .montana-sunningdale-year');
        });
        $('.selectric-scroll ul li:nth-child(7)').on('click', function(){
            $('div#frm_field_99_container').addClass('montana-premium');
            $('div#frm_field_99_container').insertBefore('div#frm_field_98_container .montana-sunningdale-year');
        });
        $('.selectric-scroll ul li:nth-child(2)').on('click', function(){
            $('div#frm_field_99_container').removeClass('montana-premium');
            $('div#frm_field_99_container').insertAfter('div#frm_field_92_container');
        });
        $('.selectric-scroll ul li:nth-child(3)').on('click', function(){
            $('div#frm_field_99_container').removeClass('montana-premium');
            $('div#frm_field_99_container').insertAfter('div#frm_field_93_container');
        });
        $('.selectric-scroll ul li:nth-child(5)').on('click', function(){
            $('div#frm_field_99_container').removeClass('montana-premium');
            $('div#frm_field_99_container').insertAfter('div#frm_field_95_container');
        });
        $('.selectric-scroll ul li:nth-child(6)').on('click', function(){
            $('div#frm_field_99_container').removeClass('montana-premium');
            $('div#frm_field_99_container').insertAfter('div#frm_field_96_container');
        });
        $('.selectric-scroll ul li:nth-child(8)').on('click', function(){
            $('div#frm_field_99_container').removeClass('montana-premium');
            $('div#frm_field_99_container').insertAfter('div#frm_field_97_container');
        });
    });
</script>

<script>
		jQuery(function($) {
			jQuery(document).ready(function(){  
			$('.vertical-center-3').slick({
				speed: 300,
				infinite: true,
				slidesToShow: 1,
				centerMode: true,
				variableWidth: true,
				prevArrow: '<i class="slider-arrows slider-left fa fa-angle-left fa-2x"></i>',
    			nextArrow: '<i class="slider-arrows slider-right fa fa-angle-right fa-2x"></i>',
				responsive: [
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}

				]
				
				
			});
			}); 
		});


</script>

	</body>
</html>