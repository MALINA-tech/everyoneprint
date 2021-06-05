jQuery(document).ready(function ($) {
    $('body').addClass('draimstar');
    $('.load_more_btn').on('click',function(e){
        e.preventDefault();
        $(this).addClass('hello');
        var load_more_btn = $(this);
        var data_block = $(this).attr('data-block');
        console.log(data_block);
        var data_wrapper = $(this).attr('data-wrapper');
        var text = $(this).text();
        $(this).text('Loading...');
        var data = {
            'action': 'loadmore',
            'query': true_posts,
            'page' : current_page,
            'data_block' : data_block
        };
        console.log(data);
        $.ajax({
            url:ajaxurl.url,
            data:data,
            type:'POST',
            success:function(data){
                if(data){
                    load_more_btn.text(text);
                    current_page++;
                    if(current_page == max_pages){
                        load_more_btn.remove();
                    }
                    $("."+data_wrapper).append(data);
                }else{
                    load_more_btn.remove()
                }
            }
        });
    });
    $("#menu-portal-header-menu .menu-item-has-children").children('a').each(function(){
        $(this).on('click',function(e){
            e.preventDefault();
        })
    })
    $(".portal_menu_callback").on('click',function(e){
        e.preventDefault();
        $(".portal_menu_mobile").slideToggle();
    })
    $(".portal_header_menu .submenu_right").find('ul').addClass('sub_menu_right');

    $('#search_submit_callback').on('click',function(e){
        e.preventDefault();
    })

    $(".portal_open_search").on('click',function (e) {
        e.preventDefault();
        $.fancybox.open({
            src:'#search_float',
            touch:false
        })
    })


    $(document).mouseup(function (e) {
        var container = $(".sub-menu");
        var siblings_a = container.siblings('a');
        if (container.has(e.target).length === 0 && siblings_a.has(e.target).length === 0){
            container.hide();
        }
    });
})