<?php
//Функция регистрации posttype
add_action('init', 'add_draim_post_type');
function add_draim_post_type(){
    $labels = array(
    'name' => 'Portal' // основное название для типа записи
    ,'singular_name' => 'Portal' // название для одной записи этого типа
    ,'add_new' => 'Add portal page' // для добавления новой записи
    ,'add_new_item' => 'Adding portal page' // заголовка у вновь создаваемой записи в админ-панели.
    ,'edit_item' => 'Edit portal page' // для редактирования типа записи
    ,'new_item' => 'New portal page' // текст новой записи
    ,'view_item' => 'View portal page' // для просмотра записи этого типа.
    ,'search_items' => 'Find portal pages' // для поиска по этим типам записи
    ,'not_found' => 'Portal pages not found' // если в результате поиска ничего не было найдень
    ,'not_found_in_trash' => 'There are no portal pages in recycle bin' // если не было найдено в корзине
    ,'parent_item_colon' => '' // для родительских типов. для древовидных типов
    ,'menu_name' => 'Portal' // название меню
    );
    $args = array(
    'label' => null
    ,'labels' => $labels
    ,'description' => ''
    ,'public' => true
    ,'publicly_queryable' => true
    ,'exclude_from_search' => false
    ,'show_ui' => true
    ,'show_in_menu' => true
    ,'query_var' => true
    ,'rewrite' => true
    ,'capability_type' => 'post'
    ,'has_archive' => true
    ,'hierarchical' => true
    ,'menu_position' => null
    ,'menu_icon'=>get_template_directory_uri().'/images/menu_portal_icon.png'
    ,'supports' => array('title','editor','author','thumbnail','excerpt','comments','page-attributes')
    );
    register_post_type( 'portal', $args );
}
//Регистрация таксономии
//add_action('init', 'draim_taxonomy');
function draim_taxonomy(){
    // заголовки
    $labels = array(
        'name'              => 'Услуги',
        'singular_name'     => 'Услуга',
        'search_items'      => 'Искать услуги',
        'all_items'         => 'Все категории услуг',
        'parent_item'       => 'Родительская категория услуг',
        'parent_item_colon' => 'Родительская категория услуг:',
        'edit_item'         => 'Редактировать категорию услуг',
        'update_item'       => 'Обновить категорию услуг',
        'add_new_item'      => 'Добавить категорию услуг',
        'new_item_name'     => 'Новая категория услуг',
        'menu_name'         => 'Категории',
        'not_found'			=> 'Категорий услуг не найдено'
    );
    // параметры
    $args = array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => $labels,
        'public'                => true,
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_tagcloud'         => true, // равен аргументу show_ui
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'query_var'             => '',
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
    );
    register_taxonomy('uslugi-cat',array('uslugi'), $args );
}

