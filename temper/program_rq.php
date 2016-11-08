<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

if ( $_GET ) {
    
    $id = $_GET['jour'];
    $sl = $id;  
    
$tech = array(
    'post_type' => 'members',
	'orderby'  => 'post_date',
    'order' => 'ASC',
	'numberposts' => -1,
    'day'	=>	$sl,
'tax_query' => array(
        'relation' 	=> 	'AND',
            array(
                'taxonomy' => 'reportype',
                'field' => 'slug',
                'terms' => 'speech'),
                'operator' => 'AND',
            )
    
); 
    
$sectum = Array(); 
$sectum_list = get_posts( $tech ); 
$anchor = '';   
    
   foreach ($sectum_list as $post) :  
    setup_postdata($post);
    
$sect = get_the_terms( $post->ID, 'section' );
foreach( $sect as $sects ){
	$sectum[] = $sects->term_id;
    
}
    
    
    wp_reset_postdata(); 
    endforeach;  
 ?> 
<div class="sect-block" id="section-<?php echo $t_id; ?>">  


 
<div class="mem-sect">
    <a href="?section=all&jour=<?php echo $sl; ?>">#</a> <?php echo $sl; ?> Ноября  
</div>  
   
<?php 
    $args = array(
        'orderby'       => 'id', 
        'hierarchicals' => true,
        'order'         => 'ASC',
        'include'       => array_unique($sectum),
        'hide_empty'    => 1,
        'parent'         => 0,
        );  
    $terms = get_terms('section', $args);
    
foreach ($terms as $term) { 

    $name = $term->name;
    $t_id = $term->term_id;
    
?>


<h4 class="type_header" id="sectum-<?php echo $t_id; ?>">
<?php echo $name; ?> 
<span><?php // echo $anchor; ?></span>
</h4>

<div class="mem-manager">
    <?php echo $term->description; ?>
</div>  

<div class="program_list">
<?php  
$spech = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'ASC',
	'numberposts' => -1,
	'day'	=>	$sl,
    'tax_query' => array(
	'relation' 	=> 	'AND',
	array(
        'taxonomy' => 'section',
        'field' => 'id',
        'terms' => $t_id),   
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'speech'),
		'operator' => 'AND',
    )
    );     
$myposts = get_posts($spech);    
    
foreach($myposts as $post) :
    setup_postdata($post);   
?>

<?php include( plugin_dir_path( __FILE__ ) . 'agenda_list.php'); ?> 
   
    
<?php 
wp_reset_postdata();
endforeach;    
?>     
 </div>

<?php } ?>      
</div>      
   
     
    
<?php } ?>
