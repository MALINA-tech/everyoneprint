<?php

/**
 * Функция регистрации Post Type
 */

function add_draim_post_type(){

  // Post Type 'product'

  $labels = array(
    'name'                => 'Products', // основное название для типа записи
    'singular_name'       => 'Product', // название для одной записи этого типа
    'add_new'             => 'Add product', // для добавления новой записи
    'add_new_item'        => 'Adding product', // заголовка у вновь создаваемой записи в админ-панели.
    'edit_item'           => 'Edit product', // для редактирования типа записи
    'new_item'            => 'New product', // текст новой записи
    'view_item'           => 'View product', // для просмотра записи этого типа.
    'search_items'        => 'Find products', // для поиска по этим типам записи
    'not_found'           => 'Products not found', // если в результате поиска ничего не было найдень
    'not_found_in_trash'  => 'There are no products in recycle bin', // если не было найдено в корзине
    'parent_item_colon'   => '', // для родительских типов. для древовидных типов
    'menu_name'           => 'Products' // название меню
  );

  $args = array(
    'label'               => null,
    'labels'              => $labels,
    'description'         => '',
    'public'              => true ,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => null,
    'menu_icon'           => get_template_directory_uri() . '/assets/img/menu_products_icon.png',
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes' )
  );

  register_post_type( 'product', $args );

  // Post Type 'review'

  $labels = array(
    'name'                => 'Reviews', // основное название для типа записи
    'singular_name'       => 'Review', // название для одной записи этого типа
    'add_new'             => 'Add review', // для добавления новой записи
    'add_new_item'        => 'Adding review', // заголовка у вновь создаваемой записи в админ-панели.
    'edit_item'           => 'Edit review', // для редактирования типа записи
    'new_item'            => 'New review', // текст новой записи
    'view_item'           => 'View review', // для просмотра записи этого типа.
    'search_items'        => 'Find reviews', // для поиска по этим типам записи
    'not_found'           => 'Reviews not found', // если в результате поиска ничего не было найдень
    'not_found_in_trash'  => 'There are no reviews in recycle bin', // если не было найдено в корзине
    'parent_item_colon'   => '', // для родительских типов. для древовидных типов
    'menu_name'           => 'Reviews' // название меню
  );

  $args = array(
    'label'               => null,
    'labels'              => $labels,
    'description'         => '',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => null,
    'menu_icon'           => get_template_directory_uri() . '/assets/img/menu_reviews_icon.png',
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'review', $args );

  // Post Type 'portal'

  $labels = array(
    'name'                => 'Portal', // основное название для типа записи
    'singular_name'       => 'Portal', // название для одной записи этого типа
    'add_new'             => 'Add portal page', // для добавления новой записи
    'add_new_item'        => 'Adding portal page', // заголовка у вновь создаваемой записи в админ-панели.
    'edit_item'           => 'Edit portal page', // для редактирования типа записи
    'new_item'            => 'New portal page', // текст новой записи
    'view_item'           => 'View portal page', // для просмотра записи этого типа.
    'search_items'        => 'Find portal pages', // для поиска по этим типам записи
    'not_found'           => 'Portal pages not found', // если в результате поиска ничего не было найдень
    'not_found_in_trash'  => 'There are no portal pages in recycle bin', // если не было найдено в корзине
    'parent_item_colon'   => '', // для родительских типов. для древовидных типов
    'menu_name'           => 'Portal' // название меню
  );

  $args = array(
    'label'               => null,
    'labels'              => $labels,
    'description'         => '',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'partnerzone' ),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => true,
    'menu_position'       => null,
    'menu_icon'           => get_template_directory_uri() . '/assets/img/menu_portal_icon.png',
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes' )
  );

  register_post_type( 'portal', $args );

  // Post Type 'partnernews'

  $labels = array(
    'name'                => 'News', // основное название для типа записи
    'singular_name'       => 'Portal news story', // название для одной записи этого типа
    'add_new'             => 'Add portal news story', // для добавления новой записи
    'add_new_item'        => 'Adding portal news story', // заголовка у вновь создаваемой записи в админ-панели.
    'edit_item'           => 'Edit portal news story', // для редактирования типа записи
    'new_item'            => 'New portal news story', // текст новой записи
    'view_item'           => 'View portal news story', // для просмотра записи этого типа.
    'search_items'        => 'Find portal news story', // для поиска по этим типам записи
    'not_found'           => 'Portal news not found', // если в результате поиска ничего не было найдень
    'not_found_in_trash'  => 'There are no portal news in recycle bin', // если не было найдено в корзине
    'parent_item_colon'   => '', // для родительских типов. для древовидных типов
    'menu_name'           => 'Portal News' // название меню
  );

  $args = array(
    'label'               => null,
    'labels'              => $labels,
    'description'         => '',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => null,
    'menu_icon'           => get_template_directory_uri() . '/assets/img/menu_portal_news_icon.png',
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes' )
  );

  register_post_type( 'partnernews', $args );

  // Post Type 'webinars'

  $labels = array(
    'name'                => 'Webinars', // основное название для типа записи
    'singular_name'       => 'Webinar', // название для одной записи этого типа
    'add_new'             => 'Add webinar', // для добавления новой записи
    'add_new_item'        => 'Adding webinar', // заголовка у вновь создаваемой записи в админ-панели.
    'edit_item'           => 'Edit webinar', // для редактирования типа записи
    'new_item'            => 'New webinar', // текст новой записи
    'view_item'           => 'View webinar', // для просмотра записи этого типа.
    'search_items'        => 'Find webinar', // для поиска по этим типам записи
    'not_found'           => 'Webinar news not found', // если в результате поиска ничего не было найдень
    'not_found_in_trash'  => 'There are no webinar in recycle bin', // если не было найдено в корзине
    'parent_item_colon'   => '', // для родительских типов. для древовидных типов
    'menu_name'           => 'Webinars' // название меню
  );

  $args = array(
    'label'               => null,
    'labels'              => $labels,
    'description'         => '',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => null,
    'menu_icon'           => get_template_directory_uri() . '/assets/img/menu_webinar_icon.png',
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes' )
  );

  register_post_type( 'webinars', $args );

  // Post Type 'jobs'

  $labels = array(
    'name'                => 'Jobs', // основное название для типа записи
    'singular_name'       => 'Job', // название для одной записи этого типа
    'add_new'             => 'Add job', // для добавления новой записи
    'add_new_item'        => 'Adding job', // заголовка у вновь создаваемой записи в админ-панели.
    'edit_item'           => 'Edit job', // для редактирования типа записи
    'new_item'            => 'New job', // текст новой записи
    'view_item'           => 'View job', // для просмотра записи этого типа.
    'search_items'        => 'Find job', // для поиска по этим типам записи
    'not_found'           => 'Jobs not found', // если в результате поиска ничего не было найдень
    'not_found_in_trash'  => 'There are no jobs in recycle bin', // если не было найдено в корзине
    'parent_item_colon'   => '', // для родительских типов. для древовидных типов
    'menu_name'           => 'Jobs' // название меню
  );
  $args = array(
    'label'               => null,
    'labels'              => $labels,
    'description'         => '',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => null,
    'menu_icon'           => get_template_directory_uri() . '/assets/img/menu_job_icon.png',
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes' )
  );

  register_post_type( 'jobs', $args );
}

add_action( 'init', 'add_draim_post_type' );

/**
 * Регистрация таксономии
 */

function draim_taxonomy() {

  // Заголовки
  $labels = array(
    'name'              => 'News Category',
    'singular_name'     => 'News Category',
    'search_items'      => 'Find News Category',
    'all_items'         => 'All News Category',
    'parent_item'       => 'Parent News Category',
    'parent_item_colon' => 'Parent News Category:',
    'edit_item'         => 'Edit News Category',
    'update_item'       => 'Update News Category',
    'add_new_item'      => 'Add News Category',
    'new_item_name'     => 'New News Category',
    'menu_name'         => 'News Category',
    'not_found'			    => 'News Category not found'
  );

  // Параметры
  $args = array(
    'label'                 => '', // определяется параметром $labels->name
    'labels'                => $labels,
    'public'                => true,
    'show_in_nav_menus'     => true, // равен аргументу public
    'show_ui'               => true, // равен аргументу public
    'show_tagcloud'         => true, // равен аргументу show_ui
    'hierarchical'          => true,
    'update_count_callback' => '',
    'rewrite'               => array('slug'=>'partnerinfo'),
    'query_var'             => '',
    'capabilities'          => array(),
    'meta_box_cb'           => 'post_categories_meta_box',
    'show_admin_column'     => false, // позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи
    '_builtin'              => false,
    'show_in_quick_edit'    => null, // по умолчанию значение show_ui
  );

  register_taxonomy('newscategory',array('partnernews'), $args );
}

add_action( 'init', 'draim_taxonomy' );