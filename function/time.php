<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

if ( isset( $_POST['id'] ) ) {
    
$id = (int)$_POST['id'];
$d = (int)$_POST['d'];
$h = (int)$_POST['h'];
$m = (int)$_POST['m'];




$newDate = array(
    'ID' => $id,
    'post_date' => '2015-11-'.$d.' '.$h.':'.$m.':59' // [ Y-m-d H:i:s ]
  );


wp_update_post($newDate);
    
echo date('d M h:i', strtotime(get_post($id)->post_date));    
// 
}
else {
    
  print_r($_POST);  
  
/*
$my_posts = get_posts( 
array(
    'post_type' => 'members', 
    'numberposts' => -1 ) 
    );   
$selectedTime = strtotime('10:00');
foreach ( $my_posts as $my_post ):
 
$endTime = $selectedTime + 900;
$nedate = date('h:i', $endTime);

$selectedTime = $endTime;

  $newDate = array(
    'ID' => $my_post->ID,
    'post_date' => '2015-12-20 '.$nedate.':00' // [ Y-m-d H:i:s ]
  );
wp_update_post($newDate);
endforeach; 
*/  
    
}







