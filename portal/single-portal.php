<?php if(is_user_logged_in()){ ?>
    <?php get_template_part('portal/header-portalnew');?>
    <div id="portal_header" class="infinite-page-title-wrap infinite-style-small infinite-left-align">
        <div class="infinite-header-transparent-substitute"></div>
        <div class="infinite-page-title-container infinite-container">
            <div class="infinite-page-title-content infinite-item-pdlr">
                <h3 class="infinite-page-title"><?php the_title();?></h3>
            </div>
        </div>
    </div>
    <?php while(have_posts()){ the_post();?>
        <div class="portal_wrapper">
            <div class="wrapper">
                <?php $menu = get_field('portal_menu'); if($menu == ''){ $menu = 'resources_menu'; };?>
                <nav class="portal_menu">
                    <ul>
                        <?php draim_menu($menu);?>
                    </ul>
                </nav>
                <div class="portal_menu_toggle"><a href="#" class="portal_menu_callback"><i class="fas fa-bars"></i></a></div>
                <div class="portal_menu_mobile"><ul><?php draim_menu($menu);?></ul></div>
                <?php //};?>
                <?php if(get_the_content() != ''){ ?>
                    <div class="portal_content">
                        <?php the_content();?>
                    </div>
                <?php };?>
                <?php while(have_rows('files_block')){ the_row();?>
                    <?php $grid = get_sub_field('grid');?>
                    <?php $custom_align_content = get_sub_field('custom_align_content');?>
                    <div class="files_block <?php echo $grid;?> <?php echo $custom_align_content;?>">
                        <?php if(get_sub_field('block_button_text') != ''){ ?>
                            <div class="files_button">
                                <a target="_blank" href="<?php echo get_sub_field('button_link')?>"><?php the_sub_field('block_button_text');?></a>
                            </div>
                        <?php };?>
                        <div class="files_title">
                            <?php echo get_sub_field('block_title');?>
                        </div>
                        <?php if(get_sub_field('block_description') != ''){ ?>
                            <div class="files_description">
                                <?php the_sub_field('block_description');?>
                            </div>
                        <?php };?>
                        <div class="files_list flex">
                            <?php while(have_rows('files')){ the_row();?>
                                <?php $column_title = get_sub_field('column_title');?>
                                <?php $column_description = get_sub_field('column_description');?>
                                <?php $column_content = get_sub_field('column_content');?>
                                <?php $column_link = get_sub_field('column_link');?>
                                <?php $column_style = get_sub_field('column_style');?>
                                <?php $show_col_in_modal = get_sub_field('show_in_modal_video');?>
                                <?php 
                                    $fancybox = ''; 
                                    if($show_col_in_modal == 1){ 
                                        $fancybox = 'data-fancybox="gallery"'; 
                                    };
                                ?>
                                <div class="files_col <?php echo $column_style;?>">
                                    <?php
                                        if($column_title != '' || $column_description != ''){
                                            ?>
                                            <div class="column_info">
                                            <?php
                                            if($column_link != ''){
                                                ?>
                                                <?php if($column_title != ''){ ?>
                                                    <a <?php echo $fancybox; ?> target="_blank" class="column_title" href="<?php echo $column_link?>"><?php echo $column_title;?></a><br />
                                                <?php };?>
                                                <?php if($column_description != ''){ ?>
                                                    <a <?php echo $fancybox; ?> target="_blank" class="column_description" href="<?php echo $column_link?>"><?php echo $column_description;?></a><br />
                                                <?php };?>
                                                <?php if($column_content != ''){ ?>
                                                    <a <?php echo $fancybox; ?> target="_blank" class="column_content" href="<?php echo $column_link?>"><?php echo $column_content;?></a>
                                                <?php };?>
                                                <?php
                                            }else{
                                                ?>
                                                <?php if($column_title != ''){ ?>
                                                    <div class="column_title"><?php echo $column_title;?></div>
                                                <?php };?>
                                                <?php if($column_description != ''){ ?>
                                                    <div class="column_description"><?php echo $column_description;?></div>
                                                <?php };?>
                                                <?php if($column_content != ''){ ?>
                                                    <div class="column_content"><?php echo $column_content;?></div>
                                                <?php };?>
                                                <?php
                                            }
                                            ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <?php while(have_rows('files_group')){ the_row();
                                        $custom_link = get_sub_field('custom_link');
                                        if ($custom_link != '') {
                                            $file_url = $custom_link;
                                        } else {
                                            $file = get_sub_field('file_data');
                                            $file_url = $file['url'];
                                        }
                                        //Получим иконку
                                        $file_icon = get_sub_field('file_icon');
                                        $file_icon_c = get_sub_field('bg_icon_color');
                                        $file_icon_color = '';
                                        switch ($file_icon_c) {
                                            case "red":
                                                $file_icon_color = '#E02B20';
                                                break;
                                            case "gray":
                                                $file_icon_color = '#2C4251';
                                                break;
                                            case "powder_blue":
                                                $file_icon_color = '#C8EBED';
                                                break;
                                            case "green":
                                                $file_icon_color = '#2BC44E';
                                                break;
                                            case "yellow":
                                                $file_icon_color = '#FFB911';
                                                break;
                                            case "dark_green":
                                                $file_icon_color = '#168F6B';
                                                break;
                                            case "purple":
                                                $file_icon_color = '#8300E9';
                                                break;
                                            default:
                                                $file_icon_color = '#E02B20';
                                        }
                                        $custom_file_icon_color = get_sub_field('custom_bg_icon_color');
                                        if ($custom_file_icon_color != '') {
                                            $file_icon_color = $custom_file_icon_color;
                                        }
                                        $custom_text_color = get_sub_field('text_icon_color');
                                        if ($custom_text_color != '') {
                                            $file_text_color = $custom_text_color;
                                        }
                                        $type = get_sub_field('type');
                                        ?>
                                    <?php
                                        $show_in_modal = get_sub_field('show_in_modal');
                                    ?>
                                    <a <?php if($show_in_modal == 1){ ?>data-fancybox="gallery"<?php };?> target="_blank" class="file_item <?php echo $type;?>" href="<?php echo $file_url;?>"<?php if(get_sub_field('file_description') == ''){ ?> style="align-items: center" <?php };?>>
                                        <?php switch($file_icon){
                                            case 'document':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-file-alt"></i>
                                                <?php break;
                                            case 'image':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-images"></i>
                                                <?php break;
                                            case 'video':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-play"></i>
                                                <?php break;
                                            case 'pause':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-pause-circle"></i>
                                                <?php break;
                                            case 'scale':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-chart-line"></i>
                                                <?php break;
                                            case 'folder':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-folder"></i>
                                                <?php break;
                                            case 'table':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-table"></i>
                                                <?php break;
                                            case 'edit':
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-edit"></i>
                                                <?php break;
                                            default:
                                                ?>
                                                <i style="background: <?php echo $file_icon_color?>; color: <?php echo $file_text_color;?>" class="fas fa-file-alt"></i>
                                                <?php
                                                ?>
                                            <?php };?>
                                        <div class="file_info">
                                            <div class="file_title"><?php the_sub_field('file_title');?></div>
                                            <?php if(get_sub_field('file_description') != ''){ ?>
                                                <div class="file_description"><?php the_sub_field('file_description');?></div>
                                            <?php };?>
                                        </div>
                                    </a>
                                    <?php };?>
                                </div>
                            <?php };?>
                        </div>
                    </div>
                    <?php if(get_field('news_block') == 1){ ?>
                        <?php echo do_shortcode('[news_block id=134]');?>
                    <?php };?>
                <?php };?>
            </div>
        </div>
    <?php };
    get_template_part('portal/footer-portal');?>
<?php }else{ ?>
    <?php $login_link = wp_login_url();?>
    <?php header('Location: '.$login_link);?>
<?php }?>