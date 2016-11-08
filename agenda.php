<?php include( plugin_dir_path( __FILE__ ) . 'header.php'); ?> 


<div class="agenda clearfix"> 
 <div class="block">
<div class="agenda_sider spied" data-url="<?php echo plugin_dir_url( __FILE__ ) . 'function/agenda_rq.php'; ?>">

<?php 
    $csid = $_GET['section']; 
    $jour = $_GET['jour']; 
    
?> 

<style>
    .agenda_sider ul li a.csid-<?php echo $csid; ?>,
    .agenda_sider ul li a.jour-<?php echo $jour; ?>
    {
       border-bottom: 0px dashed #3498db;
       color: #666;
       cursor: default;  
    }
</style>

<ul> 
 
<?php
$terms = get_terms( 'section', array('parent' => 0, 'hierarchical' => 0, 'hide_empty' => 1 ) );
foreach ( $terms as $term ){    
    $tid =  $term->term_id; 
    $tname =  $term->slug; 
    $termname = $term->name;
    $termlink = get_term_link( $tid );
?>

<li>
<a href="?section=<?php echo $tid; ?>&jour=all" data-posdt="all" data-slug="<?php echo $tid; ?>" data-url="<?php echo plugin_dir_url( __FILE__ ) . 'function/agenda_rq.php'; ?>" class="csid-<?php echo $tid; ?>">
   <?php echo $termname;?> 
</a>
</li>

<?php  } ?>     
</ul> 
 
<hr>
<ul> 
По датам: 
<?php 
$datums = Array();
 $spech = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'ACS',
	'numberposts' => -1,
'tax_query' => array(
	'relation' 	=> 	'AND', 
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'speech'),
		'operator' => 'NOT IN',
        )
    );    
$datum_list = get_posts( $spech );  
    
    foreach ($datum_list as $post) :  
        setup_postdata($post);
    $datums[] = get_the_date('d');
        wp_reset_postdata(); 
    endforeach;
    
foreach (array_unique($datums) as $value) { ?>
        
    <li> 
    <a href="?section=all&jour=<?php echo $value; ?>" data-slug="all" data-posdt="<?php echo $value; ?>" data-url="<?php echo plugin_dir_url( __FILE__ ) . 'function/program_rq.php'; ?>" class="jour-<?php echo $value; ?>">
        <?php echo $value;?> Ноября
    </a>
    </li>
    
<?php }?>
     
</ul>  

 <div class="side_advert">
     
 </div>    
               
</div>


<div class="agenda_wrap">
  
<div id="report_wrap"> 
  
    <?php if ( $_GET['jour'] == 'all' ) : ?>
    
<?php include( plugin_dir_path( __FILE__ ) . 'function/agenda_rq.php'); ?>     
     
   <?php elseif ( $_GET['section']== 'all') : ?> 

<?php include( plugin_dir_path( __FILE__ ) . 'function/program_rq.php'); ?>  

   <?php else : ?>
   
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   
<div class="report_content" >
<div class="report_titel">
      	<?php the_title(); ?>           
</div>
       
<div class="report_text-block" >
<?php the_content(); ?>
</div>
     
</div>
 
<?php endwhile; else : ?>
    <?php endif; ?>
   
  <?php include( plugin_dir_path( __FILE__ ) . 'template/agenda_plenary.php'); ?>   
   
   
<?php endif; ?>
   
</div>

    
    
</div>

</div>
</div>

<?php include( plugin_dir_path( __FILE__ ) . 'footer.php'); ?> 