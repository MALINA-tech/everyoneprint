jQuery(document).ready(function($){

    //START PROGRESSBAR

    // Remove svg.radial-progress .complete inline styling
    $('svg.radial-progress').each(function( index, value ) {
        $(this).find($('circle.complete')).removeAttr( 'style' );
    });

    // Activate progress animation on scroll
    $(window).scroll(function(){
        $('svg.radial-progress').each(function( index, value ) {
            // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
            if (
                $(window).scrollTop() > $(this).offset().top - ($(window).height() * 1) &&
                $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0)
            ) {
                // Get percentage of progress
                percent = $(value).data('percentage');
                // Get radius of the svg's circle.complete
                radius = $(this).find($('circle.complete')).attr('r');
                // Get circumference (2πr)
                circumference = 2 * Math.PI * radius;
                // Get stroke-dashoffset value based on the percentage of the circumference
                strokeDashOffset = circumference - ((percent * circumference) / 100);
                // Transition progress for 1.25 seconds
                $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 3000);
            }
        });
    }).trigger('scroll');

    //END PROGRESSBAR

    new WOW().init();


    $.exists = function(selector) {
        return ($(selector).length > 0)
    };



    $('.menu-item-has-children').children("a").after('<a href="#" class="sub_menu_toggle"></a>');
    $('.progressive_link .sub_menu_toggle').on('click',function(e){
        e.preventDefault();
        $(this).siblings('ul').slideToggle();
    });
    $(".menu-item-has-children > a").on('click',function(e){
        if(!$(this).parents('li').hasClass('progressive_link')){
            e.preventDefault();
            $(this).siblings('ul').slideToggle();
        }
    })
    var reviews_new_slider = new Swiper('.reviews_slider_main', {
        spaceBetween: 30,
        centeredSlides: false,
        loop:false,
        pagination:{
            el:'.reviews_slider_main_pagination',
            clickable:true
        },
        breakpoints:{
            640:{
                slidesPerView:1
            }
        }
    });
    var reviews_slider_logo = new Swiper('.reviews_slider_logo', {
        slidesPerView: 'auto',
        //spaceBetween: 30,
        centeredSlides: false,
        loop:false,
        breakpoints:{
        320:
            {
                slidesPerView:1,
                spaceBetween: 0
            }
            ,
        1024:
            {
                slidesPerView:'auto'
            }
        }
    });
    /*var blog_slider = new Swiper('.slider_blog', {
        slidesPerView:3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop:false,
        loopFillGroupWithBlank:true,
        pagination: {
            el: '.blog_pagination',
            clickable: true,
            renderBullet: function (index, className) {
                return '</i><span class="' + className + '">' + (index + 1) + '</span>';
            }
        },
        breakpoints:{
            320:
            {
                slidesPerView:1
            },
            640:
            {
                slidesPerView:3,
                spaceBetween: 0
            }
        }
    });*/
    var pagination_wrap = $('.blog_pagination');
    pagination_wrap.first().before('<a href="#" class="blog_pagination_item blog_pagination_prev"></a>');
    pagination_wrap.last().after('<a href="#" class="blog_pagination_item blog_pagination_next"></a>');

    $('.blog_pagination_prev').on('click',function(e){
        e.preventDefault();
        blog_slider.slidePrev();
    })
    $('.blog_pagination_next').on('click',function(e){
        e.preventDefault();
        blog_slider.slideNext();
    })

    reviews_new_slider.on('transitionStart',function(){
        console.log(reviews_new_slider.realIndex);
        reviews_slider_logo.slideTo(reviews_new_slider.realIndex);
    })
    $(".different_order_blocks").each(function(){
        var df_block = $(this).find('.df_block');
        df_block.last().addClass('last_df_block');
        df_block.first().addClass('first_df_block');
        var first_offset = $(this).find('.first_df_block').find('.df_cnt').offset().top;
        var last_offset = $(this).find('.last_df_block').find('.df_cnt').offset().top;
        var height = last_offset - first_offset;
        $(this).find('.vertical_line').height(height);
    })
    //$('.cf_check').first().addClass('cf_active');
    $('.cf_check').on('click',function(e){
        var need_adress = $('#dynamichidden-adress');
        var adress_data = $(this).find('.check_val').attr('data-mail');
        console.log(need_adress);
        console.log(adress_data);
        if(!$(this).hasClass('cf_active')){
            $(".cf_active").removeClass('cf_active');
            $(this).addClass('cf_active');
            var text = $(this).find(".check_val").text();
            $(".dynamic_hidden").val(text);
            need_adress.val(adress_data);
        }
    });

    $(".point").on('click',function(e){
        e.preventDefault();
        var point = $(this);
        var map_item_parent = $(this).parents('.map_item');
        if(!map_item_parent.hasClass('map_item_active')){
            var current_point_active = $(".map_item_active");
            current_point_active.find('.map_point_info').fadeOut(500);
            current_point_active.removeClass('map_item_active');
            map_item_parent.siblings('.map_item').css('z-index','9');
            map_item_parent.css('z-index',11);
            point.siblings('.map_point_info').fadeIn(500);
            map_item_parent.addClass('map_item_active');
        }else{
            point.siblings('.map_point_info').fadeOut(500);
            map_item_parent.removeClass('map_item_active');
        }
    })

    $(".mobile_menu_toggle").on('click',function(e){
        e.preventDefault();
        $(".header_mobile_menu").slideToggle();
    })

    $(".void_link > a").first().on('click',function(e){
        e.preventDefault();
    })


    var scroll_smooth = $(".scroll_smooth");
    if ($.exists(scroll_smooth)) {
        $(".scroll_smooth").click(function () {
            var elementClick = $(this).attr("href");
            var destination = $(elementClick).offset().top;
            jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800);
            return false;
        });
    }

    $('.parallax-window').parallax({
        speed:1.001,
        positionY:'top'
    });
    var state_selector = $("#state_selector");
    var country_selector = $('#country_selector');
    var country_result = $('#dynamic_hidden_country');
    country_selector.countrySelect(
        {
            defaultCountry:'us'
        }
    );
    var country_selected = country_selector.countrySelect("getSelectedCountryData");
    console.log(country_selected.iso2);
    var start_country = country_selector.val();
    country_result.val(start_country);

    country_selector.on('change',function(e){
        var country = $(this).val();
        country_result.val(country);
    })
    var data_path = $('body').attr('data-path');
    var build_url = data_path+'/js/intl-tel-input/build/js/utils.js';
    var input = document.querySelector("#phone");
    if($.exists(input)){
        var input_tel = intlTelInput(input, {
            utilsScript:build_url,
            autoPlaceholder:'aggressive',
            initialCountry : "auto" ,
            separateDialCode:true,
            geoIpLookup: function(callback) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            nationalMode:true
        });
        setTimeout(function(){
            var full_input = input_tel;
            var countryData = input_tel.getSelectedCountryData();
            var iso_2 = countryData.iso2;
            country_selector.countrySelect("selectCountry",iso_2);
            if(iso_2 == 'us'){
                state_selector.attr('disabled',false);
                state_selector.removeClass('disabled');
            }else{
                state_selector.attr('disabled',true);
                state_selector.addClass('disabled');
            }
        },1000)
    }
    $("#country_selector").on('change',function(){
        var countryData = country_selector.countrySelect("getSelectedCountryData");
        var iso_2 = countryData.iso2;
        console.log(iso_2);
        if(iso_2 == 'us'){
            state_selector.attr('disabled',false);
            state_selector.removeClass('disabled');
        }else{
            state_selector.attr('disabled',true);
            state_selector.addClass('disabled');
        }
    })
    $('#phone').on('change',function(){
        var number = input_tel.getNumber(intlTelInputUtils.numberFormat.E164);
        //console.log(number);
        $("#dynamichidden-phone").val(number);
    })

    $(document).mouseup(function (e) {
        var div = $(".sub-menu"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            div.hide(); // скрываем его
        }
    });


    var animation_block = $(".animation_images_block");
    //console.log(animation_block);
    if($.exists(animation_block)){
        animation_block.each(function(){
            //Находим все изображения
            var this_images = $(this).find('img');
            //Проходим по всем изображениям
            var images_heights = [];
            var num = 1;
            this_images.each(function(i){
                var this_image = this_images[i];
                console.log(i);
                $(this_image).attr('data-wow-delay',num+'s');
                num = num+1;
            })
        })
    }
    $('.modal_way_btn').on('click',function(e){
        e.preventDefault();
        $.fancybox.open({
            baseClass: "modal_way_fancybox",
            src:'#modal_way',
            toolbar: true,
            buttons:[
                'close'
            ]
        })
    });

    var simple_grid_blocks = $('.simple_grid_blocks');
    simple_grid_blocks.each(function(){
        //Проходим по каждому блоку simple_grid_blocks
        $(this).find('.simple_grid_block_col').first().find('.simple_grid_image').addClass('first_simple_image');
    })

    $(".first_simple_image").parents('.simple_grid_block_col').addClass('simple_grid_justify');
    $("input").on('focus',function(){
        $(this).attr('placeholder','')
    });
    $("textarea").on('focus',function(){
        $(this).attr('placeholder','')
    });
    function nameHere(str) {
        return str.match(/[a-z]/);
    }
    function numHere(str) {
        return str.match(/[0-9]/);
    }
    function UppHere(str) {
        return str.match(/[A-Z]/);
    }
    $(".reset_click").on('click',function(e){
        e.preventDefault();
        var all_true = 1;
        var length = $('#length');
        var lowercase = $('#lowercase');
        var numb = $('#numb');
        var upper = $('#upper');
        var match = $('#match');
        var new_pass = $("#pass1").val();
        var confirm_pass = $("#pass2").val();
        //Проверяем на длину пароля
        var new_pass_length = new_pass.length;
        if(new_pass_length < 8){
            length.addClass('error');
            length.removeClass('success');
            all_true = 0;
        }else{
            length.removeClass('error');
            length.addClass('success');
        }
        //Проверяем на наличие одной маленькой буквы
        if(nameHere(new_pass)){
            lowercase.addClass('success');
            lowercase.removeClass('error');
        }else{
            lowercase.removeClass('success');
            lowercase.addClass('error');
            all_true = 0;
        }
        //Проверяем на наличие одной цифры
        if(numHere(new_pass)){
            numb.addClass('success');
            numb.removeClass('error');
        }else{
            numb.addClass('error');
            numb.removeClass('success');
            all_true = 0;
        }
        //Проверяем на наличие одной заглавной буквы
        if(UppHere(new_pass)){
            upper.removeClass('error');
            upper.addClass('success');
        }else{
            upper.addClass('error');
            upper.removeClass('success');
            all_true = 0;
        }
        //Проверяем пароли на совпадение
        if(new_pass == confirm_pass){
            match.removeClass('error');
            match.addClass('success');
        }else{
            match.removeClass('success');
            match.addClass('error');
            all_true = 0;
        }
        console.log(all_true);
        if(all_true == 1){
            $("#resetpass-button").click();
        }
    });
    $(".show_pass").on('click',function(e){
        e.preventDefault();
        var siblings_input = $(this).siblings('input');
        if(!siblings_input.hasClass('visible')){
            siblings_input.addClass('visible');
            siblings_input.attr('type','text');
        }else{
            siblings_input.removeClass('visible');
            siblings_input.attr('type','password');
        }
    });

    $(".children_cat").on('click',function(e){
        e.preventDefault();
        var this_link = $(this);
        var data_cat = $(this).attr('data-cat');
        var data = {
            'data_cat': data_cat,
            'action': 'load_blog'
        }
        var wrapper = $('.loading');
        $.ajax({
            url:ajaxurl.url,
            data:data,
            type:'POST',
            beforeSend: function( xhr){
                wrapper.children().remove();
                wrapper.text('');
            },
            success:function(content){
                console.log(content);
                if( content ) {
                    wrapper.prepend(content);
                    $(".loading_header_active").removeClass('loading_header_active');
                    this_link.addClass('loading_header_active');
                } else {

                }
            }
        });
    })


    var blog_h2 = $(".blog_center").find('h2');
    var anc_cnt = 1;
    blog_h2.each(function(){
        var h2_text = $(this).text();
        $(this).attr('data-anc','anc_h2_'+anc_cnt);
        $('.blog_anchors').append('<li class="anchor_item"><a data-href="anc_h2_'+anc_cnt+'" href="#">'+ h2_text+'</a></li>');
        anc_cnt++;
    });
    var blog_anchors_height = $(".blog_anchors").height();
    $('.blog_anchors_line').css('height',blog_anchors_height);
    var blog_anchors = $('.blog_anchors');
    var social_share = $("#socials_share");
    if($.exists(blog_anchors)){
        var stickyEl = new Sticksy('.blog_anchors', {
            topSpacing: 60,
        })
        stickyEl.onStateChanged = function (state) {
            console.log(state);
            if (state === 'fixed') stickyEl.nodeRef.classList.add('widget--sticky')
            else stickyEl.nodeRef.classList.remove('widget--sticky')
        }
    }
    if($.exists(social_share)){
        social_share.sticksy({
            topSpacing: 50
        });
    }
    $(".anchor_item a").on('click',function(e){
        $(".anchor_active").removeClass('anchor_active');
        e.preventDefault();
        var elementClick = $(this).attr("data-href");
        var destination = $('h2[data-anc='+elementClick+']').offset().top;
        destination = destination-35;
        jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800);
        $(this).addClass('anchor_active');
        return false;
    })


    document.addEventListener( 'wpcf7mailsent', function( event ) {
        if ( '8901' == event.detail.contactFormId ) {
            $(".single_webinar_register.cf_form").fadeOut(500);
            $('.after_submit_block').fadeIn(1000)
            $(".wpcf7-response-output").remove();
        }
    }, false );

    $('.resend').on('click',function (e) {
        e.preventDefault();
        $('.after_submit_block').css('display','none');
        $(".single_webinar_register.cf_form").fadeIn(1000);
    })


    document.addEventListener( 'wpcf7mailsent', function( event ) {
        //Webinar registration
        if ( '8898' == event.detail.contactFormId ) {
            $(".single_webinar_register.cf_form").fadeOut(500);
            $('.after_submit_block').fadeIn(1000)
            $(".wpcf7-response-output").remove();
        }
    }, false );

    document.addEventListener( 'wpcf7mailsent', function( event ) {
        //Webinar registration
        if ( '8900' == event.detail.contactFormId ) {
            $(".single_webinar_register.cf_form").fadeOut(500);
            $('.after_submit_block').fadeIn(1000)
            $(".wpcf7-response-output").remove();
        }
    }, false );

    document.addEventListener( 'wpcf7mailsent', function( event ) {
        //Webinar registration
        if ( '8899' == event.detail.contactFormId ) {
            $(".single_webinar_register.cf_form").fadeOut(500);
            $('.after_submit_block').fadeIn(1000)
            $(".wpcf7-response-output").remove();
        }
    }, false );

    document.addEventListener( 'wpcf7mailsent', function( event ) {
        //Contact form
        if ( '8413' == event.detail.contactFormId ) {
            $(".cf_form").fadeOut(500);
            $('.after_submit_block').fadeIn(1000)
            $(".wpcf7-response-output").remove();
        }
    }, false );


    var current_webinar = $('.single_webinar_info').find('.webinar_title').text();
    $('.dynamic_webinar_title').val(current_webinar);

    /*window.onscroll = function () { myFunction() };
    function myFunction() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        document.getElementsByClassName("progress-bar").style.width = scrolled + "%";
    }*/
    var blog_body = $(".blog_body");
    if($.exists(blog_body)){
        var blog_body_height = blog_body.height();
        $(window).on("scroll resize", function() {
            var o = $(window).scrollTop() / (blog_body_height - $(window).height() / 2);
            $(".progress-bar").css({
                "width": (100 * o | 0) + "%"
            });
            $('progress')[0].value = o;
        })
    }
    //$('.blog_body').scrollIndicator();
    //$.scrollIndicator('.blog_body');
    var StickyElement = function(node){
        var doc = $(document),
            fixed = false,
            anchor = node.find('.sticky-anchor'),
            content = node.find('.sticky-content');
        var onScroll = function(e){
            var docTop = doc.scrollTop(),
                anchorTop = anchor.offset().top;
            if(docTop > anchorTop){
                if(!fixed){
                    anchor.height(content.outerHeight());
                    content.addClass('fixed');
                    fixed = true;
                }
            } else {
                if(fixed){
                    anchor.height(0);
                    content.removeClass('fixed');
                    fixed = false;
                }
            }
        };
        $(window).on('scroll', onScroll);
    };
    if($.exists('.sticky-element')){
        var sticky = new StickyElement($('.sticky-element'));
    }

    function inWindow(s){
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var currentEls = $(s);
        var result = [];
        currentEls.each(function(){
            var el = $(this);
            var offset = el.offset();
            if(scrollTop <= offset.top && (el.height() + offset.top) < (scrollTop + windowHeight))
                result.push(this);
        });
        return $(result);
    }

    $(window).on('wheel', function(){
        var h2_in_window = inWindow(".blog_body h2");
        if($.exists(h2_in_window)){
            var h2_first = h2_in_window.first();
            var data_anc = h2_first.attr('data-anc');
            var need_anchor = $('.anchor_item a[data-href='+data_anc+']');
            need_anchor.parent('li').siblings('.anchor_item').find('.anchor_active').removeClass('anchor_active');
            need_anchor.addClass('anchor_active');
        }
    });
    $(".check_info").on('click',function(e){
        e.preventDefault();
    })
    $('.check_info').mouseenter(function (e) {
        e.preventDefault();
        $(this).parents('.cf_check').find('.check_info_body').fadeIn(500);
    });
    $('.check_info').mouseleave(function (e) {
        e.preventDefault();
        $(this).parents('.cf_check').find('.check_info_body').fadeOut(500);
    });

    var loginform = $("#Loginform");
    loginform.find('#wp-submit').on('click',function(e){
        e.preventDefault();
        var user_login = $('#user_login');
        var user_pass = $('#user_pass');
        var trying = 1;
        if(user_login.val() == ''){
            if(!user_login.parents('.input_wrap').hasClass('error')){
                user_login.parents('.input_wrap').addClass('error');
                user_login.parents('.pass_wrapper').append('<div class="error_text">This field is required</div>');
            }
            trying = 0;
        }
        if(user_pass.val() == ''){
            if(!user_pass.parents('.input_wrap').hasClass('error')){
                user_pass.parents('.input_wrap').addClass('error');
                user_pass.parents('.pass_wrapper').append('<div class="error_text">This field is required</div>');
            }
            trying = 0;
        }
        if(trying == 1){
            loginform.submit();
        }
    })


    $(".solutions_item").mouseenter(function(){
        $(this).find('.solutions_animate_first').fadeOut(500);
        $(this).find('.solutions_animate_second').fadeIn(500);
    })
    $(".solutions_item").mouseleave(function(){
        $(this).find('.solutions_animate_second').fadeOut(500);
        $(this).find('.solutions_animate_first').fadeIn(500);
        /*$(this).find('.solutions_animate_first').clearQueue();
        $(this).find('.solutions_animate_second').clearQueue();*/
    })
    setTimeout(function(){
        $('.BambooHR-ATS-Jobs-Item a').attr('target','_blank');
    },3000);



    /*var wpcf7Elm = document.querySelector( '.wpcf7' );
    wpcf7Elm.addEventListener( 'wpcf7submit', function( event ) {
        if ( '8413' == event.detail.contactFormId ) {
            var check_try = 0;
            $('.cf_check').each(function(){
                if(!$(this).hasClass('cf_active')){
                    check_try = 1;
                }
            })
        }
        if(check_try == 1){
            alert ('Выберите тему');
        }
    }, false );*/
    /*$("#wpcf7-f8413-o1").find('.wpcf7-submit').on('click',function(e){
        var check_try = 0;
        var $el = $('.cf_check_items');
        if($el.find('.cf_active').length ==0){
            e.preventDefault();
            alert ('Выберите тему');
        }
    })*/
    var domains = [
        /* Default domains included */
        "aol.com", "att.net", "comcast.net", "facebook.com", "gmail.com", "gmx.com", "googlemail.com",
        "google.com", "hotmail.com", "hotmail.co.uk", "mac.com", "me.com", "mail.com", "msn.com",
        "live.com", "sbcglobal.net", "verizon.net", "yahoo.com", "yahoo.co.uk",

        /* Other global domains */
        "email.com", "fastmail.fm", "games.com" /* AOL */, "gmx.net", "hush.com", "hushmail.com", "icloud.com",
        "iname.com", "inbox.com", "lavabit.com", "love.com" /* AOL */, "outlook.com", "pobox.com", "protonmail.ch", "protonmail.com", "tutanota.de", "tutanota.com", "tutamail.com", "tuta.io",
        "keemail.me", "rocketmail.com" /* Yahoo */, "safe-mail.net", "wow.com" /* AOL */, "ygm.com" /* AOL */,
        "ymail.com" /* Yahoo */, "zoho.com", "yandex.com",

        /* United States ISP domains */
        "bellsouth.net", "charter.net", "cox.net", "earthlink.net", "juno.com",

        /* British ISP domains */
        "btinternet.com", "virginmedia.com", "blueyonder.co.uk", "freeserve.co.uk", "live.co.uk",
        "ntlworld.com", "o2.co.uk", "orange.net", "sky.com", "talktalk.co.uk", "tiscali.co.uk",
        "virgin.net", "wanadoo.co.uk", "bt.com",

        /* Domains used in Asia */
        "sina.com", "sina.cn", "qq.com", "naver.com", "hanmail.net", "daum.net", "nate.com", "yahoo.co.jp", "yahoo.co.kr", "yahoo.co.id", "yahoo.co.in", "yahoo.com.sg", "yahoo.com.ph", "163.com", "yeah.net", "126.com", "21cn.com", "aliyun.com", "foxmail.com",

        /* French ISP domains */
        "hotmail.fr", "live.fr", "laposte.net", "yahoo.fr", "wanadoo.fr", "orange.fr", "gmx.fr", "sfr.fr", "neuf.fr", "free.fr",

        /* German ISP domains */
        "gmx.de", "hotmail.de", "live.de", "online.de", "t-online.de" /* T-Mobile */, "web.de", "yahoo.de",

        /* Italian ISP domains */
        "libero.it", "virgilio.it", "hotmail.it", "aol.it", "tiscali.it", "alice.it", "live.it", "yahoo.it", "email.it", "tin.it", "poste.it", "teletu.it",

        /* Russian ISP domains */
        "mail.ru", "rambler.ru", "yandex.ru", "ya.ru", "list.ru",

        /* Belgian ISP domains */
        "hotmail.be", "live.be", "skynet.be", "voo.be", "tvcablenet.be", "telenet.be",

        /* Argentinian ISP domains */
        "hotmail.com.ar", "live.com.ar", "yahoo.com.ar", "fibertel.com.ar", "speedy.com.ar", "arnet.com.ar",

        /* Domains used in Mexico */
        "yahoo.com.mx", "live.com.mx", "hotmail.es", "hotmail.com.mx", "prodigy.net.mx",

        /* Domains used in Canada */
        "yahoo.ca", "hotmail.ca", "bell.net", "shaw.ca", "sympatico.ca", "rogers.com",

        /* Domains used in Brazil */
        "yahoo.com.br", "hotmail.com.br", "outlook.com.br", "uol.com.br", "bol.com.br", "terra.com.br", "ig.com.br", "itelefonica.com.br", "r7.com", "zipmail.com.br", "globo.com", "globomail.com", "oi.com.br"
    ];




    $('.wpcf7-submit').on('click',function(e){
        var el = $('.cf_check_items');
        if(el.length != 0){
            if(el.find('.cf_active').length ==0){
                e.preventDefault();
                $('.cf_check_items').siblings('.cf_input_title').addClass('error');
                alert ('Please choose type of request');
            }else{
                $('.cf_check_items').siblings('.cf_input_title').removeClass('error');
            }
        }
        var e_mail = $('.wpcf7-email').val();
        var domain = e_mail.split('@').pop();
        if(domains.indexOf(domain) != -1 && e_mail != ''){
            e.preventDefault();
            alert ('Please enter your business or corporate e-mail address');
        }
    })
});