<?php
$wp_login_page = ABSPATH.'/wp-login.php';

/**
 * Определение констант для упрощения написания кода в шаблонах
 */

if ( function_exists( 'get_bloginfo' )) {
  define( 'NAME', get_bloginfo( 'name' ));
  define( 'MAIL', get_bloginfo( 'admin_email' ));
  define( 'IMAGES', get_bloginfo( 'template_url' ) . '/images' );
}

if ( ! defined( '_S_VERSION' ) ) {
  // Replace the version number of the theme on each release.
  define( '_S_VERSION', '1.0.0' );
}

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/template-assets.php';

/**
 * Add main functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Template type Post & Taxonomies.
 */
require get_template_directory() . '/inc/template-taxonomies.php';

/**
 * Add template Authenticate.
 */
require get_template_directory() . '/inc/template-auth.php';

/**
 * Only Admin
 */

function only_admin() {
  if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
    wp_redirect( get_post_type_archive_link('portal'));
  }
}

add_action( 'admin_init', 'only_admin', 1 );

if ( ! current_user_can( 'manage_options' )) {
    show_admin_bar( false );
}



function news_block_function( $atts ) {
  $atts = shortcode_atts( array( 'id' => '' ), $atts, 'news_block' );
  ?>
  <div class="news_block_wrapper">
    <div class="wrapper">

      <?php 
      $portal_news = new WP_Query(
        array(
          'post_type'       => 'partnernews',
          'posts_per_page'  => 3,
          'order'           => 'DESC',
          'tax_query'       => array(
            array(
              'taxonomy'  => 'newscategory',
              'terms'     => $atts[ 'id' ]
            )
          )
        )
      )?>

      <div class="news_block">
        <?php while( $portal_news->have_posts() ): $portal_news->the_post(); ?>
          <div class="news_item">
            <a class="news_item_title" href="<?php the_permalink();?>"><?php the_title();?></a>
            <div class="news_meta">
              <?php 
                $tax = get_the_terms( get_the_ID(), 'newscategory' ); 
                $term_id = $tax[0]->term_id 
              ?>
              <span class="news_meta_date"><?php the_time('M d, Y'); ?></span> | <a class="news_meta_tax" href="<?= get_term_link( $term_id ); ?>"><?= $tax[0]->name; ?></a>
            </div>
            <div class="news_item_excerpt"><?= kama_excerpt( [ 'maxchar' => 100 ] ); ?></div>
          </div>
        <?php endwhile; ?>
      </div>
      <?php if ( $portal_news->max_num_pages > 1 ): ?>
        <script>
          var true_posts = '<?= serialize( $portal_news->query_vars ); ?>';
          var current_page = '<?= ( get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1; ?>';
          var max_pages = '<?= $portal_news->max_num_pages; ?>';
        </script>
        <div class="loadmore_block">
          <a href="#" data-wrapper="news_block" data-block="load_news" class="load_more_btn ib">Older Entries</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php
}

/**
 * Функция "Загрузить больше"
 */

function loadmore_function() {
  $data_block = wp_strip_all_tags( $_POST['data_block'] );
  $args = unserialize(stripslashes( $_POST['query'] ));
  $args['paged'] = $_POST['page'] + 1;
  $args['post_status'] = 'publish';
  $q = new WP_Query($args);
  while($q->have_posts()): $q->the_post();//the_title();
      ?>
      <?php if ( $data_block == 'search_load_news' ): ?>
          <?php //Loading search news block ?>
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
      <?php else: ?>
          <div class="news_item">
              <a class="news_item_title" href="<?php the_permalink();?>"><?php the_title();?></a>
              <div class="news_meta">
                  <?php $tax = get_the_terms(get_the_ID(),'newscategory'); $term_id = $tax[0]->term_id?>
                  <span class="news_meta_date"><?php the_time('M d, Y');?></span> | <a class="news_meta_tax" href="<?php echo get_term_link($term_id);?>"><?php echo $tax[0]->name;?></a>
              </div>
              <div class="news_item_excerpt"><?php echo kama_excerpt(['maxchar'=>100]);?></div>
          </div>
      <?php endif;?>
      <?php
  endwhile;
  die();
}

add_action('wp_ajax_loadmore', 'loadmore_function');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_function');

/**
 * Create Excerpt Box
 */

function wph_create_excerpt_box() {
  global $post;
  $id = 'excerpt';
  $excerpt = wph_get_excerpt($post->ID);
  wp_editor($excerpt, $id);
}

function wph_get_excerpt($id) {
  global $wpdb;
  $row = $wpdb->get_row("SELECT post_excerpt FROM $wpdb->posts WHERE id = $id");
  return $row->post_excerpt;
}

function wph_replace_excerpt() {
  foreach (array("partnernews") as $type) {
    remove_meta_box('postexcerpt', $type, 'normal');
    add_meta_box('postexcerpt', __('Excerpt'), 'wph_create_excerpt_box', $type, 'normal');
  }
}

add_action( 'admin_init', 'wph_replace_excerpt' );

/**
* Cuts the specified text up to specified number of characters.
*
* Strips any of WordPress shortcodes.
*
* @author Kama (wp-kama.ru)
*
* @version 2.7.0
*
* @param string|array $args {
*     Optional. Arguments to customize output.
*
*     @type int       $maxchar            Макс. количество символов.
*     @type string    $text               Текст который нужно обрезать. По умолчанию post_excerpt, если нет post_content.
*                                         Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
*                                         все до `<!--more-->` вместе с HTML.
*     @type bool      $autop              Заменить переносы строк на `<p>` и `<br>` или нет?
*     @type string    $more_text          Текст ссылки `Читать дальше`.
*     @type string    $save_tags          Теги, которые нужно оставить в тексте. Например `'<strong><b><a>'`.
*     @type string    $sanitize_callback  Функция очистки текста.
*     @type bool      $ignore_more        Нужно ли игнорировать <!--more--> в контенте.
*
* }
*
* @return string HTML
*/
function kama_excerpt( $args = '' ){
  global $post;

  if( is_string( $args ) ){
      parse_str( $args, $args );
  }

  $rg = (object) array_merge( [
      'maxchar'           => 350,
      'text'              => '',
      'autop'             => true,
      'more_text'         => 'Читать дальше...',
      'ignore_more'       => false,
      'save_tags'         => '',
      'sanitize_callback' => 'strip_tags',
  ], $args );

  $rg = apply_filters( 'kama_excerpt_args', $rg );

  if( ! $rg->text ){
      $rg->text = $post->post_excerpt ?: $post->post_content;
  }

  $text = $rg->text;
  // strip content shortcodes: [foo]some data[/foo]. Consider markdown
  $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
  // strip others shortcodes: [singlepic id=3]. Consider markdown
  $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
  $text = trim( $text );

  // <!--more-->
  if( ! $rg->ignore_more && strpos( $text, '<!--more-->' ) ){
      preg_match( '/(.*)<!--more-->/s', $text, $mm );

      $text = trim( $mm[1] );

      $text_append = ' <a href="' . get_permalink( $post ) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
  }
  // text, excerpt, content
  else {

      $text = 'strip_tags' === $rg->sanitize_callback
          ? strip_tags( $text, $rg->save_tags )
          : call_user_func( $rg->sanitize_callback, $text, $rg );

      $text = trim( $text );

      // cut
      if( mb_strlen( $text ) > $rg->maxchar ){
          $text = mb_substr( $text, 0, $rg->maxchar );
          $text = preg_replace( '/(.*)\s[^\s]*$/s', '\\1...', $text ); // del last word, it not complate in 99%
      }
  }

  // add <p> tags. Simple analog of wpautop()
  if( $rg->autop ){
      $text = preg_replace(
          [ "/\r/", "/\n{2,}/", "/\n/", '~</p><br ?/?>~' ],
          [ '', '</p><p>', '<br />', '</p>' ],
          $text
      );
  }

  $text = apply_filters( 'kama_excerpt', $text, $rg );

  if( isset( $text_append ) ){
      $text .= $text_append;
  }

  return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}

/**
 * Add Menu
 */

function draim_menu( $menu ) {
  wp_nav_menu( array( 
    'theme_location'  => $menu,
    'items_wrap'      => '%3$s',
    'container'       => false));
}

/**
 * Other Updates
 */

function other_updates_callback($atts){
  global $post_id;
  $atts = shortcode_atts( 
    array(
      'exclude'         => '',
      'posts_per_page'  => '2',
      'show_need'       => 'false',
      'category'        => array( 2, 150 )
    ), $atts, 'other_updates' );
  ?>
  <section class="other_updates wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
      <div class="wrapper">
          <div class="ou_title">More Updates</div>
          <div class="ou_list">
              <?php if($atts['show_need'] == 'false'){ ?>
                  <?php $exclude_ids = array($atts['exclude']);?>
                  <?php $other_updates = new WP_Query(array(
                      'post_type'=>'post',
                      'order'=>'DESC',
                      'posts_per_page'=>$atts['posts_per_page'],
                      'post__not_in'=>$exclude_ids,
                      'post_status'=>'publish',
                      'cat'=>$atts['category']
                  ));?>
              <?php }else{ ?>
                  <?php $exclude_ids = array($atts['exclude']);?>
                  <?php $other_updates = new WP_Query(array(
                      'post_type'=>'post',
                      'order'=>'DESC',
                      'posts_per_page'=>$atts['posts_per_page'],
                      'post__not_in'=>$exclude_ids,
                      'post_status'=>'publish',
                      'meta_query'=>array(
                          array(
                              'key'=>'show_in_other_updates',
                              'value'=>1
                          )
                      ),
                      'cat'=>$atts['category']
                  ));?>
              <?php };?>
              <?php while($other_updates->have_posts()){ $other_updates->the_post();?>
                  <div class="ou_item">
                      <div class="ou_left">
                          <a href="<?php the_permalink();?>" class="ou_thumb">
                              <?php $ou_image = get_field('other_updates_image');?>
                              <?php if($ou_image['url'] != ''){ ?>
                                  <img src="<?php echo $ou_image['url'];?>" alt="<?php echo $ou_image['alt'];?>" />
                              <?php }else{ ?>
                                  <?php the_post_thumbnail();?>
                              <?php };?>
                          </a>
                      </div>
                  <div class="ou_right">
                      <?php $current_pt = get_the_category();
                      $curr_name = $current_pt[0]->slug;
                      ?>
                      <div class="ou_category<?php if($curr_name == 'webinar'){ ?> ou_category_webinar <?php };?>">
                          <a href="<?php echo get_category_link($current_pt[0]->term_id);?>"><?php echo $current_pt[0]->name?></a>
                      </div>
                      <?php
                      $ou_title = get_field('other_updates_title');
                      $ou_link_text = get_field('other_updates_link_text');
                      ?>
                      <div class="ou_item_title">
                          <a href="<?php the_permalink();?>">
                              <?php if($ou_title != ''){ echo $ou_title;?>

                              <?php }else{ the_title(); };?>
                          </a>
                      </div>
                      <a href="<?php the_permalink();?>" class="ou_permalink"><?php if($ou_link_text != ''){ echo $ou_link_text; }else{ ?>Read more ><?php };?></a>
                  </div>
                  </div>
              <?php };?>
          </div>
      </div>
  </section>
  <?php
}

add_shortcode( 'other_updates', 'other_updates_callback' );