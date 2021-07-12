<?php
//Template Name: Search Portal
//Template Post Type: Portal
if(is_user_logged_in()){
    $search_val = wp_strip_all_tags($_GET['search_val']);
    if($search_val == ''){
        $search_val = 'EveryonePrint';
    }
    ?>
    <?php $current_term_id = get_queried_object_id();?>
    <?php get_template_part('portal/header-portalnew');?>
    <div id="portal_header" class="infinite-page-title-wrap  infinite-style-small infinite-left-align">
        <div class="infinite-header-transparent-substitute"></div>
        <div class="infinite-page-title-container infinite-container">
            <div class="infinite-page-title-content infinite-item-pdlr"><h3 class="infinite-page-title">Search Result For: <?php echo $search_val;?></h3>
            </div>
        </div>
    </div>
    <div class="portal_wrapper">
        <div class="wrapper">
            <div class="single_news">
                <div class="single_news_left">
                    <h2>Search results in Partner Documents</h2>
                    <?php
                    $portal_pages = get_posts(array(
                        'post_type'=>'portal',
                        'posts_per_page'=>-1,
                    ));?>
                    <ul class="search_results_list">
                        <?php $file_exists = 0; foreach ($portal_pages as $portal_page) {
                            while(have_rows('files_block',$portal_page->ID)){
                                the_row();
                                while(have_rows('files')){
                                    the_row();
                                    while(have_rows('files_group')){
                                        the_row();
                                        $try = 0;
                                        //Данные файла получаем в любом случае
                                        $file_data = get_sub_field('file_data');
                                        $file_name = $file_data['title'];
                                        $custom_link = get_sub_field('custom_link');
                                        //Проверяем на вхождение заголовок
                                        $file_title = get_sub_field('file_title');
                                        $pos_title = stripos($file_title, $search_val);
                                        if($pos_title !== false){
                                            $try = 1;
                                            //Совпадение есть, дальше можно не проверять, поэтому проверяем, нулевой ли try
                                        }
                                        if($file_data){
                                            //Файл есть, отталкиваемся от этого
                                            if($try != 1){
                                                //Проверяем на вхождение имя файла
                                                $pos_name = stripos($file_name, $search_val);
                                                if($pos_name !== false){
                                                    $try = 1;
                                                    //Совпадение есть, дальше можно не проверять
                                                }
                                            }
                                        }
                                        if($custom_link != ''){
                                            $pos_link = stripos($custom_link, $search_val);
                                            if($pos_link !== false){
                                                $try = 1;
                                                //Совпадение есть, дальше можно не проверять
                                            }
                                        }
                                        $string = $file_data['title'];
                                        ?>
                                        <?php
                                        $pos1 = stripos($string, $search_val);
                                        if($try == 1) {
                                            $file_exists = 1;
                                            ?>
                                            <li class="search_result_link">
                                                <?php if($file_title != ''){ ?>
                                                    <div class="search_result_file_title"><?php echo $file_title;?></div>
                                                <?php };?>
                                                <?php
                                                    $resulting_link = '';
                                                    $resulting_name = $file_name;
                                                    if($file_data['url'] != ''){ $resulting_link = $file_data['url']; }
                                                    if($custom_link != ''){ $resulting_link = $custom_link; }
                                                    if($file_name == ''){ $resulting_name = $resulting_link; }
                                                ?>
                                                <a target="_blank" href="<?php echo $resulting_link;?>"><?php echo $resulting_name;?></a>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            }
                        };?>
                    </ul>
                    <?php 
                        if($file_exists != 1){
                            ?><div style="margin:0 0 20px;">Nothing found</div><?php
                        }
                    ?>
                    <?php
                        //Формируем запрос на новости
                        $news = new WP_Query(array(
                            'post_type'=>'partnernews',
                            'posts_per_page'=>1,
                            's'=>$search_val,
                            'exact'=>true
                        ))
                    ?>
                    <h2>Search results in Partner News</h2>
                    <?php if($news->have_posts()){ the_post();?>
                        <div class="search_news_results">
                            <?php while($news->have_posts()){ $news->the_post();?>
                                <div class="news_post">
                                    <h2>
                                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                    </h2>
                                    <div class="news_meta">
                                        <?php $tax = get_the_terms(get_the_ID(),'newscategory'); $term_id = $tax[0]->term_id?>
                                        <span class="news_meta_date"><?php the_time('M d, Y');?></span> | <a class="news_meta_tax" href="<?php echo get_term_link($term_id)?>"><?php echo $tax[0]->name;?></a>
                                    </div>
                                    <div class="news_content">
                                        <?php the_excerpt();?>
                                    </div>
                                </div>
                            <?php };?>
                        </div>
                        <?php if ($news->max_num_pages > 1){ ?>
                            <script>
                                var true_posts = '<?php echo serialize($news->query_vars); ?>';
                                var current_page = '<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>';
                                var max_pages = '<?php echo $news->max_num_pages; ?>';
                            </script>
                            <div class="loadmore_block">
                                <a href="#" data-wrapper="search_news_results" data-block="search_load_news" class="load_more_btn ib">Load more results</a>
                            </div>
                        <?php }; ?>
                    <?php }else{ ?>
                        Nothing found
                    <?php };?>
                </div>
                <div class="single_news_right">
                    <?php get_sidebar('portal')?>
                </div>
        </div>
    </div>
    <?php get_template_part('portal/footer-portal');?>
<?php }else{ ?>
    <?php $login_link = wp_login_url();?>
    <?php header('Location: '.$login_link);?>
<?php }?>