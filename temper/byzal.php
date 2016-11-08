<?php
/*

Template Name: By Zal

*/
get_header();  ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/template/zal.css">



<?php

$dayofr = array();
$datess = array( 
    'post_type' => 'members',
    'posts_per_page'=> -1,
	'orderby'  => 'post_date',
	'order'   => 'ASC',
    'tax_query' => array(
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'speech'),
			),
		);
$query = new WP_Query( $datess );
while ( $query->have_posts() ) : $query->the_post();
$idss = $post->ID;

$dayofr[] = (int)get_the_time( ('j'), $idss );

wp_reset_postdata();
endwhile;

$nedate = array_unique($dayofr);

/* Перебор дат */

foreach ($nedate as $value) { 
$postdate = $value; 
echo '<h1>'.$value.'</h1>';
	
    /* Перебор залов*/
$area = get_terms("area");
$place[] = array();	
foreach ($area as $term) {
$place[] = $term->name;	 
};

foreach ($place as $seleplace) { 
	echo '<h2>'.$seleplace.'</h2>';
$spech = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'ASC',
	'numberposts' => -1,
	// 'monthnum' 	=> 	11,
'tax_query' => array(
	'relation' 	=> 	'AND',
	array(
        'taxonomy' => 'area',
        'field' => 'name',
        'terms' => $seleplace),   

    ));
$myposts = get_posts($spech);
$cunt = 0;
foreach($myposts as $post) :
?>
<p><?php the_title(); ?></p>
<?php	
wp_reset_postdata();
endforeach;	
	};
   
};