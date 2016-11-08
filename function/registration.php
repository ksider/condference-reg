<?php 


// Отделы
add_action( 'init', 'create_members' );

function create_members() {
register_post_type( 'members',
array(
    'labels' => array(
    'name' => __( 'Участники' ),
    'singular_name' => __( 'Участники' ),
    'add_new' => 'Добавить',
    'add_new_item' => 'Добавить',
    'edit' => 'Редактировать',
    'edit_item' => 'Редактировать',
    'new_item' => 'Добавить страницу',
    'view' => 'Просмотр',
    'view_item' => 'Перейти',
    'search_items' => 'Search',
    'not_found' => 'Не найдено',
    'not_found_in_trash' =>
    'В корзине пусто',
    'parent' => 'Parent'
    ),
    'public' => true,
    'menu_position' => 128,
    'show_in_nav_menus' => true,
'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'comments', 'page-attributes' ),
    'menu_icon' => 'dashicons-nametag',
    'has_archive' => false,
    'hierarchical'    => true,
) ); }

/*add_action( 'init', 'create_job', 0 );
function create_job(){
register_taxonomy(
        'job',
		'members', array(
        'labels' => array(
		'name' => 'Место работы',
        'add_new_item' => 'Add New',
        'new_item_name' => "New Type"
          ),
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => false
       )
	);
}*/

add_action( 'init', 'create_name', 0 );
function create_name(){
register_taxonomy(
        'name',
		'members', array(
        'labels' => array(
		'name' => 'Имя',
        'add_new_item' => 'Add New',
        'new_item_name' => "New Type"
          ),
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => false
       )
	);
}

add_action( 'init', 'create_them', 0 );
function create_them(){
register_taxonomy(
        'section',
		'members', array(
        'labels' => array(
		'name' => 'Раздел',
		'add_new_item' => 'Add New',
        'new_item_name' => "New Type"
        ),
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,
            'publicly_queryable' => false,
       )
	);
}

add_action( 'init', 'create_reportype', 0 );
function create_reportype(){
register_taxonomy(
        'reportype',
		'members', array(
        'labels' => array(
		'name' => 'Тип доклада',
		'add_new_item' => 'Add New',
        'new_item_name' => "New Type"
        ),
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,
        'publicly_queryable' => false,
       )
	);
}

/*add_action( 'init', 'create_payment', 0 );
function create_payment(){
register_taxonomy(
        'payment',
		'members', array(
        'labels' => array(
		'name' => 'Способ оплаты',
		'add_new_item' => 'Add New',
        'new_item_name' => "New Type"
        ),
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true
       )
	);
}*/

add_action( 'init', 'conference_area', 0 );
function conference_area(){
register_taxonomy(
        'area',
		'members', array(
        'labels' => array(
		'name' => 'Место проведения',
		'add_new_item' => 'Add New',
        'new_item_name' => "New Type"
        ),
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true
       )
	);
}

