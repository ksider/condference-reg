<?php
/*
Plugin Name: Регистрация на конференци.
Plugin URI: http://nikolaysemenov.ru
Description: Новые поля и регистрация
Version: 2.0
Author: Я
*/

$plugin_dir = plugin_dir_path( __FILE__ );

include( $plugin_dir . 'function/registration.php');    
 
function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',  'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}


add_action( 'wpcf7_before_send_mail', 'mytheme_save_post', 11, 2);
function mytheme_save_post( $cf7 ) {
  try { 
  
    if (!isset($cf7->posted_data) && class_exists('WPCF7_Submission') ) {
 
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {

     
            $data = array();
            $data['title'] = $cf7->title();
            $data['posted_data'] = $submission->get_posted_data();
            $data['uploaded_files'] = $submission->uploaded_files();
        
if (isset($data['posted_data']['pid']) ) {
        
			$fio = $data['posted_data']['namefio'];
            
			$email = $data['posted_data']['email'];
			$phone = $data['posted_data']['phone'];
			$job = $data['posted_data']['work'];
            
            $entitle = $data['posted_data']['workname'];
            $themes = $data['posted_data']['themes'];
            $type = $data['posted_data']['type'];
            
            
			$content = $data['posted_data']['abstract'];
            
			$password = $data['posted_data']['passgen'];
			$order = $data['posted_data']['gen'];
			$parebt_id = $data['posted_data']['pid'];
    
			$step = $data['posted_data']['step'];
             
         
              
            
	$titel_slug = rus2translit($entitle);
            
	$template = htmlspecialchars(strip_tags($content, '<br><br/><a></a><strong></strong><sub></sub>'));
 		     
    $random = date('d').rand(0,100);
            
    $docnamesrc = $data['posted_data']['file']; 
    $docat = rus2translit($fio.'_'.$docnamesrc);
            
    $document = $data['uploaded_files']['file'];
            
    $cont = file_get_contents($document);
            
    $new_file_name = $docat;
            
    $upload = wp_upload_bits( $new_file_name, null, $cont, 'manf/'.date('m') );
            
    
            
    $manurl = ''; 
            if( $upload['error'] )
	$manurl = $upload['error'];
            else
	$manurl = $upload['url'];
         
            $post = array(
            //  'comment_status' => 'closed',
              'ping_status'    => 'closed',
              'post_parent'    => $parebt_id,
              'post_status'    => 'publish',
              'post_type'      => 'members',
              'post_title'     => $entitle,
              'post_name'      => $order,
			  'post_author'   => 1,
              'post_content'   => $template,
			  'post_excerpt' => $template,
            );
            
        $subPost = wp_insert_post($post);
            
	wp_set_object_terms( $subPost, $fio, 'name' );
	wp_set_object_terms( $subPost, $themes, 'section' );
	wp_set_object_terms( $subPost, $type, 'reportype' );
		
			add_post_meta($subPost, 'autmail', $email);
			add_post_meta($subPost, 'auphone', $phone);
			add_post_meta($subPost, 'work', $job);
        
			add_post_meta($subPost, 'docurl', $manurl);
            
			add_post_meta($subPost, 'password', $password);
			add_post_meta($subPost, 'order', $order);
    
			add_post_meta($subPost, 'position', $step);
    
            $purl = get_the_permalink( $subPost );       
            $purl_get =  $purl.'?pass='.$password; 

    return $subPost;      
}    
     
    
if (isset($data['posted_data']['themes']) ) {
            
			$email = $data['posted_data']['email'];
			$phone = $data['posted_data']['phone'];
			$job = $data['posted_data']['work'];
            
            $entitle = $data['posted_data']['workname'];
            $themes = $data['posted_data']['themes'];
            $type = $data['posted_data']['type'];
           
            $step = $data['posted_data']['step'];
            
			$content = $data['posted_data']['abstract'];
            
			$password = $data['posted_data']['passgen'];
			$order = $data['posted_data']['gen'];
              
    $fios = $data['posted_data']['namefio'];
    $fio = $fios; 
    
    
	$titel_slug = rus2translit($entitle);
            
	$template = htmlspecialchars(strip_tags($content, '<br><br/><a></a><strong></strong><sub></sub>'));
 		     
    $random = date('d').rand(0,100);
            
    $docnamesrc = $data['posted_data']['file']; 
    $docat = rus2translit($fio.'_'.$docnamesrc);
            
    $document = $data['uploaded_files']['file'];
            
    $cont = file_get_contents($document);
            
    $new_file_name = $docat;
            
    $upload = wp_upload_bits( $new_file_name, null, $cont, 'manf/'.date('m') );
            
    
            
    $manurl = ''; 
            if( $upload['error'] )
	$manurl = $upload['error'];
            else
	$manurl = $upload['url'];
         
            $post = array(
            //  'comment_status' => 'closed',
              'ping_status'    => 'closed',
              'post_status'    => 'publish',
              'post_type'      => 'members',
              'post_title'     => $entitle,
              'post_name'      => $order,
			  'post_author'   => 1,
              'post_content'   => $template,
			  'post_excerpt' => $template,
            );
            
        $postId = wp_insert_post($post);
            
	wp_set_object_terms( $postId, $fio, 'name' );
	wp_set_object_terms( $postId, $themes, 'section' );
	wp_set_object_terms( $postId, $type, 'reportype' );
		
			add_post_meta($postId, 'autmail', $email);
			add_post_meta($postId, 'auphone', $phone);
			add_post_meta($postId, 'work', $job);
     
     add_post_meta($postId, 'position', $step);
        
			add_post_meta($postId, 'docurl', $manurl);
            
			add_post_meta($postId, 'password', $password);
			add_post_meta($postId, 'order', $order);
            
// prepare email
    
/*remove_all_filters( 'wp_mail_from' );
remove_all_filters( 'wp_mail_from_name' );  */

    $purl = get_the_permalink( $postId );
    $purl_get =  $purl.'?pass='.$password; 
    
    $subject = '[МКМК 2016] Заявка приянята';

    $email_content = '<div class="wrap" style="padding: 1em;width: 60%;margin: 0 auto;">
  <div class="header">
        <div class="mkmk_logo-block">
        <div class="mkmk_iam" style="margin: -1px;">
            <span style="display: inline-block;border: 1px solid #313131;position: relative;text-transform: uppercase;font-size: 14px;letter-spacing: 4px;padding: 8px;">ИПРИМ</span>
        </div>
        <div class="mkmk_name" style="margin: -1px;">
            <span style="display: inline-block;border: 1px solid #313131;position: relative;text-transform: uppercase;font-size: 18px;letter-spacing: 4px;padding: 8px;">МКМК&middot;2016</span>
        </div>
        </div> 
  </div>
  
<div class="template" style="padding-top: 24px;padding-bottom: 24px;">
<h4>Здравствуйте, ваша заявка принята</h4>
<p>Название: «<strong>'.$entitle.'</strong>»</p>
<p>Добавить еще доклад можно на вашей <a href="'.$purl_get.'">странице участника</a></p>
<code style="display: block;background-color: #f2f2f2;">'.$purl_get.'</code>  
<p>По всем вопросам можно писать на <a href="mailto:mkmk@iam.ras.ru">mkmk@iam.ras.ru</a></p>
</div></div>';
    
    $from = 'mkmk@iam.ras.ru';
    $headers  = 'From: МКМК <'.$from.'>'."\r\n";
    $headers .= 'Reply-To: <'.$from.'>'."\r\n";
    $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-Type: text/html; charset=UTF-8';

//    smtpmail('Оргкомитет', $email, $subject, $email_content);
    
    wp_mail($email, $subject, $email_content, $headers);
    
    return $postId;  
    
}    

 
if (isset($data['posted_data']['reports_id']) ) {
    
    $main_id = $data['posted_data']['reports_id'];
    $authors = $data['posted_data']['reports_aut'];
	$proceed_doc = $data['uploaded_files']['proceed'];
    $docnamesrc = $data['posted_data']['proceed']; 
    
    $docat = rus2translit($authors.'_'.$docnamesrc);
    
    $cont = file_get_contents($proceed_doc);
    $new_file_name = $docat;
    
    $upload = wp_upload_bits( $new_file_name, null, $cont, 'proc/'.date('m') );
             
    $manurl = ''; 
            if( $upload['error'] )
	$manurl = $upload['error'];
            else
	$manurl = $upload['url'];
    
    add_post_meta($main_id, 'proceeding', $manurl);
    
    
}        
       
     }
    
    }
  } 
  catch (Exception $ex) {
  print $ex;
  }
  return true;
}


/* Filter the single_template with our custom function*/
function my_custom_template($sin) {
global $wp_query, $post;
    if ($post->post_type == "members"){
        $memb = __DIR__ . '/members.php';
            return $memb;
    }
    return $sin;
}

add_filter('single_template', 'my_custom_template', 11);



function wpa3396_page_template( $page_template )
{
    if ( is_page( 'participants' ) ) {
        $page_template = dirname( __FILE__ ) . '/archive.php';
    }    
    if ( is_page( 'pd4' ) ) {
        $page_template = dirname( __FILE__ ) . '/function/pd4.php';
    }    
    if ( is_page( 'agenda' ) || is_page( 'program' ) ) {
        $page_template = dirname( __FILE__ ) . '/agenda.php';
    }   
    if ( is_page( 'perday' ) ) {
        $page_template = dirname( __FILE__ ) . '/perday.php';
    }    
    if ( is_page( 'badge' ) ) {
        $page_template = dirname( __FILE__ ) . '/template/badges.php';
    }
    return $page_template;
}
add_filter( 'page_template', 'wpa3396_page_template',11 );


function tax_section_template( $taxonomy_template )
{ 
    if ( is_tax( 'section' ) ) {
        $taxonomy_template = dirname( __FILE__ ) . '/section.php';
    }
    return $taxonomy_template; 
}
add_filter( 'taxonomy_template', 'tax_section_template', 11 );

$apiKey = 'AIzaSyBcgh2HPhtTHnm9yNuXN0w9qARVADr7yrE';

function bidscripts() 
{		
   if ( is_singular( 'members' ) || is_page( 'participants' ) || is_singular( 'conference' ) || is_page( 'program' ) || is_page( 'agenda' ) || is_page( 'perday' ) ) {

    wp_enqueue_script( 'mapscript', plugin_dir_url( __FILE__ ) . 'js/script.js', array(), null, true ); 
    wp_enqueue_style( 'bid_style', plugin_dir_url( __FILE__ ) . '/less/style.css', '', 'all' );
       
    }
    
   if ( is_page( 'badge' ) ) {
     wp_enqueue_style( 'badge', plugin_dir_url( __FILE__ ) . '/less/badge.css', '', 'all' ); 
       
    } 
    
}
add_action( 'wp_enqueue_scripts', 'bidscripts', 11 );


include( plugin_dir_path( __FILE__ ) . 'function/shortcodes.php');


add_action('admin_post_submit-form', '_handle_form_action'); // If the user is logged in
add_action('admin_post_nopriv_submit-form', '_handle_form_action'); // If the user in not logged in
function _handle_form_action(){
 {include( plugin_dir_path( __FILE__ ) . '/function/pd4.php');}
}

function gtis($min)
{
    $starttime = get_the_date('H:i'); 
    $endtime = date('H:i',strtotime($starttime.' + '.$min.' min'));
    return $endtime;
}




/*
function rwrite_date(){
if( is_user_logged_in() ){
    $params = array(
        'posts_per_page' => -1, 
        'post_type'	=> 'members',
        'post_parent' => 0,
    );
    $q = new WP_Query( $params );
    if( $q->have_posts() ) : // если посты по заданным параметрам найдены
        while( $q->have_posts() ) : $q->the_post();
           
    
    
        endwhile;
    endif;
    wp_reset_postdata();
 }    
}
*/
// add_action( 'init', 'rwrite_date' );


?>