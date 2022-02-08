$(function() {
 
});

$(document).ready(function(){

    //video play button
     $('.placeholder').click(function() {
      $(this).remove();
       $("#viva_promo")[0].src += "&autoplay=1";
        ev.preventDefault();
    });


    $('.menu_title').each(function() {
     var text_splited = $(this).text().split(" ");
     $(this).html("<span>"+text_splited.shift()+"</span> "+text_splited.join(" "));
    });

    //adds query string to a url
    function reloadWithQueryStringVars(queryStringVars) {
        var existingQueryVars = location.search ? location.search.substring(1).split("&") : [],
            currentUrl = location.search ? location.href.replace(location.search,"") : location.href,
            newQueryVars = {},
            newUrl = currentUrl + "?";
        if(existingQueryVars.length > 0) {
            for (var i = 0; i < existingQueryVars.length; i++) {
                var pair = existingQueryVars[i].split("=");
                newQueryVars[pair[0]] = pair[1];
            }
        }
        if(queryStringVars) {
            for (var queryStringVar in queryStringVars) {
                newQueryVars[queryStringVar] = queryStringVars[queryStringVar];
            }
        }
        if(newQueryVars) { 
            for (var newQueryVar in newQueryVars) {
                newUrl += newQueryVar + "=" + newQueryVars[newQueryVar] + "&";
            }
            newUrl = newUrl.substring(0, newUrl.length-1);
            window.location.href = newUrl;
        } else {
            window.location.href = location.href;
        }
    }

    //club filter
    $('.refine').on('click', function(){
      var val = $('.province_select').val();
      reloadWithQueryStringVars({"province": val});
    });

    //view all trainers
    // $('.viewalltrainers').on('click', function(e){
    //   e.preventDefault();
    //   $('.trainers').toggleClass('show');
    // });

    $('.select select').selectric();

    //moreposts
    $('body').on('click', '.moreposts', function(e){
      e.preventDefault();

      var currentpaged = $('.moreposts').attr('data-paged');
      var newpaged = parseInt(currentpaged) + 1;
      console.log(currentpaged);

      $('.moreposts').attr('data-paged', newpaged);

      var dataString = 'pagedvar=' + newpaged 
      ;

      console.log(dataString);

      $.ajax({
          type: "GET",
          url: "/vivagym/wp-json/nff/v1/posts/",//stage
          //url: "/wp-json/nff/v1/posts/",//localhost + live
          data: dataString,
          success: function(result) {
            console.log('success: ');  
            console.log(result); 

            if(result.nextposts){
                //add the elements
                $('.blog_inner').append(result.nextposts);
            }
            if(result.noposts){
              $('.moreposts').text(result.noposts);
            }
          },
          error: function(result){
            console.log('error: ');  
            console.log(result);  
          }
      });

    });


    //getgyms
    $('body').on('change', '#provinceselect_header', function(e){
      e.preventDefault();

      var province = $(this).val();

      var dataString = 'province=' + province 
      ;

      console.log(dataString);

      $.ajax({
          type: "GET",
          url: "/vivagym/wp-json/nff/v1/gyms/",//stage
          //url: "/wp-json/nff/v1/posts/",//localhost + live
          data: dataString,
          success: function(result) {
            console.log('success: ');  
            console.log(result); 

            if(result.nextposts){
                //add the elements
                $('#clubsnav__list').html(result.nextposts);
            }
            if(result.noposts){
              $('#clubsnav__list').html('<li>No clubs.</li>');
            }
          },
          error: function(result){
            console.log('error: ');  
            console.log(result);  
          }
      });

    });

    //magnific
    $('.popup').magnificPopup({
      type: 'inline',
      closeOnBgClick: true,
      callbacks: {
        close: function() {
        },
        open: function() {
        }
      }
    });

    $(document).on('click', '.closepopup', function (e) {
      e.preventDefault();
      $.magnificPopup.close();
    });



    


});

$(function() {
  var Accordion = function(el, multiple) {
      this.el = el || {};
      this.multiple = multiple || false;

      var links = this.el.find('.accord_title');
      links.on('click', {
          el: this.el,
          multiple: this.multiple
      }, this.dropdown)
  }

  Accordion.prototype.dropdown = function(e) {
      var $el = e.data.el;
      $this = $(this),
          $next = $this.next();

      $next.slideToggle();
      $this.parent().toggleClass('open');

      if (!e.data.multiple) {
          $el.find('.accord_content').not($next).slideUp().parent().removeClass('open');
      };
  }
  var accordion = new Accordion($('.accordion-container'), false);

      // Menu
    $('.btn_menu').click(function() {
        $('.nav_section').addClass('show');
        $('.btn_close').addClass('show');
        $('.btn_menu').addClass('hide');


    });
    $('.btn_close ').click(function() {
        $('.nav_section').removeClass('show');
        $('.btn_close').removeClass('show');
        $('.btn_menu').removeClass('hide');
    });
});