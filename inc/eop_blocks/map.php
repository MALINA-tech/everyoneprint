<?php
    $style = get_sub_field('style');
    $red_title = get_sub_field('red_title');
    $main_title = get_sub_field('main_title');
?>
<section class="map_wrapper" style="<?php echo $style;?>">
    <?php if($red_title != ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
    <?php if($main_title != ''){ ?><h2 class=""><?php echo $main_title;?></h2><?php };?>
    <?php if($content != ''){ ?><div class="content"><?php echo $content;?></div><?php };?>
    <div class="map">
        <img class="map_image" src="<?php echo IMAGES;?>/map.png" alt="" />
        <div class="map_item usa">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">United States</div>
            </div>
        </div>
        <div class="map_item brit">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">United Kingdom</div>
            </div>
        </div>
        <div class="map_item fran">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">France</div>
            </div>
        </div>
        <div class="map_item dan">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">EveryonePrint Headquarter</div>
                <div class="map_point_info_content">
                    Denmark
                </div>
            </div>
        </div>
        <div class="map_item can">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">Canada</div>
            </div>
        </div>
        <div class="map_item rom">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">Romania</div>
            </div>
        </div>
        <div class="map_item ukr">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">Ukraine</div>
            </div>
        </div>
        <div class="map_item ger">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">Germany</div>
            </div>
        </div>
        <div class="map_item spa">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">Spain</div>
            </div>
        </div>
        <div class="map_item bel">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">Belgium</div>
            </div>
        </div>
        <div class="map_item net">
            <a href="#" class="point"></a>
            <div class="map_point_info">
                <div class="map_point_info_title">The Netherlands</div>
            </div>
        </div>

        <div class="map_general_info">
            <div class="wrapper">
                <div class="map_box">
                    <div class="map_general_info_item">
                        <div class="col_2 ib">
                            <img src="<?php echo IMAGES;?>/tower-of-ejer-bavnehoj.png" alt="" />
                        </div>
                        <div class="col_10 ib">
                            <div class="info">
                                <div class="title">HEADQUARTER</div>
                                <div class="description">Copenhagen, Denmark</div>
                                <div class="content">
                                    EveryonePrint<br />
                                    Gladsaxevej 384 D<br />
                                    DK-2860 Soeborg<br />
                                    Denmark
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="map_general_info_item">
                        <div class="col_2 ib">
                            <img src="<?php echo IMAGES;?>/map_general.png" alt="" />
                        </div>
                        <div class="col_10 ib">
                            <div class="info">
                                <div class="title">Remote teams</div>
                                <ul class="list">
                                    <li>United States</li>
                                    <li>United Kingdom</li>
                                    <li>France</li>
                                    <li>Canada</li>
                                    <li>Romania</li>
                                    <li>Ukraine</li>
                                    <li>Germany</li>
                                    <li>Spain</li>
                                    <li>Belgium</li>
                                    <li>The Netherlands</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
