<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

if ($_POST['ids']) {
$list_of_man = $_POST['ids'];    
}
else {
  $list_of_man = $_POST['section'];   
}

$cunt = 0; 

$name_arg = array('taxonomy' => 'name','include'  => $list_of_man,);
$names = get_terms( $name_arg );
    
foreach ( $names as $term ){ 
    $name_id =  $term->term_id; 
    $searchText = $term->name;
    $termname = preg_replace("/(<[^>]+>)?\\w*/us", "<span>$0</span>", $searchText);
    
$cunt++;   
   
$spech = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'DESC',
	'numberposts' => 1,
    
'tax_query' => array(
	'relation' 	=> 	'AND', 
	array(
        'taxonomy' => 'name',
        'field' => 'id',
        'terms' => $name_id),
		'operator' => 'NOT IN',
        )
    );    
$report = get_posts( $spech ); 
    
if( $cunt%6 == 1 )  { echo '<div class="a4">';}     
     foreach ($report as $post) :  
        setup_postdata($post); 
    $job = get_post_meta( $post->ID, 'work', true );
    $posa = get_post_meta( $post->ID, 'position', true );
    ?>
        
<div class="badge-wrap">
  <div class="lblock">
      <div class="logo">
          <span>МКМК·2016</span>
      </div>
  </div>
  
   <div class="name">
       <?php echo $termname; ?> 
   </div>
   
   <div class="lblock">
       <div class="job">
         <span><?php echo $job; ?></span>
       </div>
   </div>         
</div>
    
<?php 
    wp_reset_postdata(); 
    endforeach;
 
if( $cunt%6 == 0 )  { echo '</div>';} 
    
}
if ($count%6 != 1) echo "</div>";
?>
    
    
    
