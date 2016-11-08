<?php

if ( isset( $_POST['submitted'] ) ) { 
	
	$pds = $_POST['postday'];
	$pmn = $_POST['posttime'];
	$pid = $_POST['pid'];
	$title= $_POST['title'];
	$content= $_POST['content'];

$dtums = '2014-12-'.$pds.' '.$pmn.':00';
$postdd = date('Y-m-d H:i:s', strtotime($dtums));
$timezone_offset = get_option( 'gmt_offset' );

$date= $postdd;
$post_date = date_create($postdd);
$post_date_gmt = date_create($postdd);	

    $the_post = array();
    $the_post['ID'] = $pid;
    $the_post['post_title'] = $title;
    $the_post['post_date'] = $postdd;
    $the_post['post_date_gmt'] = $postdd;

        $post_id = wp_update_post($the_post);
}
?>


<i class="icon-check-mark-4"></i>