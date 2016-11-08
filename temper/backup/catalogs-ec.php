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
'supports' =>
array( 'title', 'editor', 'excerpt', 'custom-fields' ),
'menu_icon' => 'dashicons-nametag',
'has_archive' => false
) );
}

add_action( 'init', 'create_job', 0 );
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
}
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
        'them',
		'members', array(
        'labels' => array(
		'name' => 'Раздел',
		'add_new_item' => 'Add New',
        'new_item_name' => "New Type"
        ),
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => false
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
        'hierarchical' => false
       )
	);
}
add_action( 'init', 'create_payment', 0 );
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
}


add_action( 'wpcf7_before_send_mail', 'mytheme_save_post');
function mytheme_save_post( $cf7 ) {
  try {
    if (!isset($cf7->posted_data) && class_exists('WPCF7_Submission')) {
        $submission = WPCF7_Submission::get_instance();
        if ($submission) {
            $data = array();
            $data['title'] = $cf7->title();
            $data['posted_data'] = $submission->get_posted_data();
            $data['uploaded_files'] = $submission->uploaded_files();
			
			$job = $data['posted_data']['work'];
			$email = $data['posted_data']['email'];
			$phone = $data['posted_data']['phone'];
			$types = $data['posted_data']['type'];
			$fio = $data['posted_data']['namefio'];
			$themes = $data['posted_data']['themes'];
			$types = $data['posted_data']['type'];
			$ttl = $data['posted_data']['workname'];
			$repid = $data['posted_data']['repid'];
			$content = $data['posted_data']['abstract'];
			
			$imptype = implode(",", $types);
			$impthem = str_replace(","," ",$themes);
			
			$template = htmlspecialchars(strip_tags($content, '<br><br/><a></a><strong></strong><sub></sub>'));
			$postdatta = '<h2>'.$fio.'</h2>Место работы '.$job.'<br> Почта: '.$email.', Телефон:'.$phone.'<br> Доклад '.$imptype.' Раздел '.$impthem;
			
			
            $post = array(
              'comment_status' => 'closed',
              'ping_status'    => 'closed',
              'post_status'    => 'publish',
              'post_type'      => 'members',
              'post_title'     => $ttl,
			  'post_author'   => 5,
              'post_content'   => $template.'<p>'.$postdatta.'</p> ID = <strong>'.$repid.'</strong>',
			  'post_excerpt' => $postdatta,
 
			// 'tax_input'    => array( 
				// 'name' => $fio,
				// 'job' => $job,
				// 'them' => $impthem,
				// 'reportype' => $types,
        // ),
					);
            $postId = wp_insert_post($post);
			wp_set_object_terms( $postId, $fio, 'name' );
			wp_set_object_terms( $postId, $job, 'job' );
			wp_set_object_terms( $postId, $impthem, 'them' );
			wp_set_object_terms( $postId, $types, 'reportype' );
			add_post_meta($postId, 'autmail', $email);
		    return $postId;
        }
    }
  } catch (Exception $ex) {
      print $ex;
  }
  return true;
}


function mem_liste($atts, $content = null) {

extract(shortcode_atts(array(
"id" => '5',
"nav" => 'cat'
), $atts));
global $post;
global $wpdb;

$termine = get_term_by( 'id', $id, 'them' );
$name = $termine->name;
$retour='<div class="sect-block" id="'.$nav.'-'.$id.'"><div class="mem-sect"><span class="mem-sect_tl hide">Секция:</span> '.$name.'</div>
<div class="mem-manager">'.$content.'<h3 >Устные доклады</h3></div>';


$where = apply_filters( 'getarchives_where', "WHERE post_type = 'members' AND post_status = 'publish'");
$sql = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, DAYOFMONTH(post_date) AS `dayofmonth`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date), DAYOFMONTH(post_date) ORDER BY post_date $order $limit" ;
$dayses = $wpdb->get_results($sql);

foreach ($dayses as $value) { 
$callday = $value->dayofmonth;
$retour.= '
<h4 class="center">'.$callday.' декабря</h4>
<ol class="mem-speech-list">';
$spech = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'DESC',
	'numberposts' => -1,
	// 'monthnum' 	=> 	11,
	'day'	=>	(int)$callday,
'tax_query' => array(
	'relation' 	=> 	'AND',
	array(
        'taxonomy' => 'them',
        'field' => 'id',
        'terms' => $id),   
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'speech'),
		'operator' => 'AND',
    ));
$myposts = get_posts($spech);
foreach($myposts as $post) :
setup_postdata($post);

$pagid = get_the_ID(); 
$authors = get_the_terms( $pagid, 'name' );


foreach ($authors as $term) {$author = $term->name;}
$jobs = get_the_terms( $pagid, 'job' ); 
foreach ($jobs as $jsterm) {$job = $jsterm->name;}
$ttele = the_title("","",false);
$awmail = get_post_meta( $pagid, 'autmail', true);
$ptime = get_the_time( ('j F в G:i'), $pagid );
$payment = "none";
if( has_term('', 'payment') ) $payment = "paid";
$addition = '<li class="'.$payment.'">
<div class="pure-g">
	<div class="pure-u-2-3">
<div class="memb-list_ttl">'.$ttele.'</div>
<div class="memb-list-aut"><a href="mailto:'.$awmail.'">'.$author.'</a> — '.$job.'</div>		
	
	</div>
	<div class="pure-u-1-3"><div class="memb-list-time">'.$ptime.'</div>	</div>
</div>
</li>';
$retour.= $addition;
wp_reset_postdata();
endforeach;

$retour.='</ol>'; }; unset($dates);

$poster = array(
    'post_type' => 'members',
	'numberposts' => -1,
    'tax_query' => array(
	'relation' => 'AND',
    array(
        'taxonomy' => 'them',
        'field' => 'id',
        'terms' => $id),   
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'poster'),
		'operator' => 'AND',
    ));
$pposts = get_posts($poster);
$retour.='<ul class="mem-posters-list"><h4>Стендовые доклады</h4>';
foreach($pposts as $post) :
setup_postdata($post);

$pogid = get_the_ID(); 
$postmail = get_post_meta( $pogid, 'autmail', true);
$pauthors = get_the_terms( $pogid, 'name' );
foreach ($pauthors as $term) {$pauthor = $term->name;}
$pjobs = get_the_terms( $pogid, 'job' ); 
foreach ($pjobs as $jterm) {$pjob = $jterm->name;}
$ptele = the_title("","",false);
$payment = "none";
if( has_term('', 'payment') ) $payment = "paid";
$posters = '<li class="'.$payment.'"><div class="memb-list_ttl">'.$ptele.'</div>
<div class="memb-list-aut"><a href="mailto:'.$postmail.'" class="poster_mail">'.$pauthor.'</a> — '.$pjob.'</div></li>';
$retour.= $posters;
wp_reset_postdata();
endforeach;
$retour.='</ul></div>';
return $retour;
}
add_shortcode("members", "mem_liste");

?>