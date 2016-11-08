<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
if ( $_GET ) {
    
    $id = $_GET['section'];
    $sl = $id;
        
    $termine = get_term_by( 'id', $sl, 'section' );
    $name = $termine->name;
    $slug = $termine->slug;
 ?>   
    
<div class="sect-block" id="section-<?php echo $sl; ?>">

 <div class="mem-sect">
     <a href="?section=<?php echo $sl; ?>&jour=all">#</a> <?php echo $name; ?> 
</div>

<div class="mem-manager">
    <?php echo $termine->description; ?>
</div>


<?php 
    
$spech = array(
    'post_type' => 'members',
	'orderby'  => 'post_date',
    'order' => 'ASC',
	'numberposts' => -1,

'tax_query' => array(
        'relation' 	=> 	'AND',
            array(
                'taxonomy' => 'section',
                'field' => 'slug',
                'terms' => $slug),   
            array(
                'taxonomy' => 'reportype',
                'field' => 'slug',
                'terms' => 'speech'),
                'operator' => 'AND',)
    );
   
    
$datums = Array();
$datum_list = get_posts( $spech );  

foreach ($datum_list as $post) :  setup_postdata($post);
    $datums[] = get_the_date('d');
wp_reset_postdata(); 
    endforeach; 
    
 $anchors = '';
    foreach (array_unique($datums) as $value) { 
 $anchors .= '<a href="#datum-'.$value.'">'.$value.'</a> ';
    }
?>


<h4 class="type_header">Устные доклады <span><?php echo $anchors; ?></span> | <a href="#poster-<?php echo $sl; ?>">Постеры <i class="icon-arrow-down-1"></i></a></h4> 
<?php
    
$myposts = get_posts($spech);    
    
    $datum = '';    
foreach($myposts as $post) :
    setup_postdata($post);   
 
 if ( $datum != get_the_date('d F') ) {
	$datum = get_the_date('d F');
    $day_num = get_the_date('d'); 
    echo '<div class="date_titel" id="datum-'.$day_num.'">'.$datum.' <a href="#section-'.$sl.'"><i class="icon-arrow-up-1"></i></a></div>';
 }
?>
 
<?php include( plugin_dir_path( __FILE__ ) . 'agenda_list.php'); ?> 
 
<?php 
    wp_reset_postdata();
    endforeach;    
?>
 
<div class="poster_lists" id="poster-<?php echo $sl; ?>">

 <h4>Постерная сессия | <a href="#section-<?php echo $sl; ?>">Устные доклады <i class="icon-arrow-up-1"></i></a></h4>
 
<?php
$posters = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'DESC',
	'numberposts' => -1,
'tax_query' => array(
	'relation' 	=> 	'AND',
	array(
        'taxonomy' => 'section',
        'field' => 'slug',
        'terms' => $slug),   
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'poster'),
		'operator' => 'AND',
    ));
    
$posters = get_posts($posters); 
foreach($posters as $post) :
    setup_postdata($post);
 $job = get_post_meta( $post->ID, 'work', true );      
 $aut = get_the_term_list( $post->ID, 'name', '', ', ', '' ); 
    ?>  

  
  <div class="poster_block">
     
      <div class="poster_titel">
<a href="id-<?php the_ID(); ?>" class="poup_up"><?php the_title(); ?></a>    <a href="<?php  echo $manurl; ?>" class="download"></a>       
      </div>
      
   
      <div class="hide abstract_block" id="id-<?php the_ID(); ?>">
          
          <div class="abs_flex">
          <div class="abstract"> 
            <h4>Аннотация</h4>
            <?php the_content(); ?>
          </div> 
          </div>
 
      </div>
            
      <div class="poster_authors">
    <span class="report-aut"><?php echo strip_tags($aut); ?></span>
       — 
      <span class="report-job"><?php echo strip_tags($job); ?></span>          
      </div>
  </div>
  

 

<?php 
wp_reset_postdata();
endforeach; ?>   
</div> 
   
</div>      
   
    
    
<?php } 
