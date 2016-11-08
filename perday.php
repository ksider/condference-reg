<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ru"> <!--<![endif]-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="refresh" content="300">

<?php wp_head(); ?>

<title>
<?php tp_meta_title (" / "); ?> - <?php bloginfo('description'); ?>
</title>





</head>
<body>
<style>body {overflow: hidden;}</style>

<!--<div class="plenary_wrap hide">
   
   <div class="plenary-head">
       Пленраная сессия докладов
       <span>10:00–14:00</span>
   </div>
<?php include( plugin_dir_path( __FILE__ ) . 'template/plenary.php'); ?> 
 </div>-->
    
<div class="day_wrap">
<?php
    $args = array(
        'orderby'       => 'count', 
        'hierarchicals' => true,
        'order'         => 'DESC',
        'number'        => 3,
        'hide_empty'    => 1,

        );    
    
$area = get_terms('area', $args); 
foreach ($area as $term) {
$seleplace = $term->name;    
$area_color = $term->slug;    
    ?>
    
<div class="zal_list <?php echo $area_color; ?>">

<ul>

 
<?php
    
    $today = getdate();
    
    $hr = $today['hours']+3;
    $dt = '17';
    
    $zal = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'ASC',

        
    'date_query' => array(
		array(
			'hour'      => $hr-0.5,
			'compare'   => '>=',
		),
		array(
			'hour'      => $hr+1.5,
			'compare'   => '<=',
		),
    ),    
    
    'day' => $dt,
	'numberposts' => 8,

'tax_query' => array(
	'relation' 	=> 	'AND',
	array(
        'taxonomy' => 'area',
        'field' => 'name',
        'terms' => $seleplace),   
    	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'speech'),
		'operator' => 'AND',    
        )
    );
    
$reports = get_posts($zal);
    
$slg = '';    
 foreach($reports as $post) : 
setup_postdata($post);

    
$sections = get_the_terms( $post->ID, 'section' );
    
foreach( $sections as $section ){
	$s = $section->name;
	$slgs = $section->term_id;
};   
    
if ( $slg != $slgs   ) {
    $slg = $slgs;
    echo '<div class="report_sect_titel" >'.$s.'</div>';
 }    
    
$aut = get_the_term_list( $post->ID, 'name', '', ', ', '' ); 
$time = get_the_date('H_i');
?>
 
            <li id="<?php echo $time; ?>">
            
    <div class="report_ttl">
       
        <div class="report_author">
            <?php echo strip_tags($aut); ?>
        </div>

        <div class="report_time">
            <?php echo get_the_date('H:i'); ?>                   
        </div> 
        
    </div>
    
    <div class="report_card">
           <div class="report_titel">
              <?php the_title(); ?>
           </div> 
    </div>
         
            </li>
  
    
<?php	
wp_reset_postdata();
endforeach;	?> 

  </ul>
</div>

<?php }; ?>     
</div>



<?php wp_footer(); ?>


<script>
WebFont.load({
    google: {
    families: ['PT Sans:400,700,400italic,700italic', 'PT Mono:400', 'PT Serif:400,700,400italic,700italic',]
    },
	timeout: 500
  });
</script>
  
   </body>
</html>