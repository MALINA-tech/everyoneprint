<?php
//Template Name: Support
//Template Post Type: Portal
?>
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
                <div class="portal_content">
                    <?php the_content();?>
                </div>
                <div class="support_list">
                    <?php while(have_rows('support_list')){ the_row();?>
                        <?php
                        $file_icon_c = get_sub_field('bg_icon');
                        $file_icon_color = '';
                        switch ($file_icon_c) {
                            case "red":
                                $file_icon_color = '#E02B20';
                                break;
                            case "blue":
                                $file_icon_color = '#2B80FF';
                                break;
                            default:
                                $file_icon_color = '#E02B20';
                        }
                        ?>
                        <div class="support_item">
                            <a target="_blank" style="background: <?php echo $file_icon_color;?>;" target="_blank" href="<?php the_sub_field('file_url');?>" class="support_item_icon">
                                <?php the_sub_field('file_icon');?>
                            </a>
                            <br />
                            <a target="_blank" class="support_item_title" href="<?php the_sub_field('file_url');?>"><?php the_sub_field('file_title');?></a>
                        </div>
                    <?php };?>
                </div>
            </div>
        </div>
    <?php };
    get_template_part('portal/footer-portal');?>
<?php }else{ ?>
    <?php $login_link = wp_login_url();?>
    <?php header('Location: '.$login_link);?>
<?php }?>
