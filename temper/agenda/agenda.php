<?php include( plugin_dir_path( __FILE__ ) . 'header.php'); ?> 
<div class="agenda"> 

<div class="agenda_sider spied">
 <ul> 
<?php
$terms = get_terms( 'section', array('parent' => 0, 'hierarchical' => 0, 'hide_empty' => 1 ) );
foreach ( $terms as $term ){    
    $tid =  $term->term_id; 
    $termname = $term->name;
    $termlink = get_term_link( $tid );
?>

<li>
<a href="#section-<?php echo $tid; ?>">
   <?php echo $termname;?> 
</a>
</li>

<?php  } ?>     
</ul>      
</div>

<div class="agenda_wrap">
    
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="report_content">

<div class="report_titel" id="report_titel">
      	<?php the_title(); ?>           
</div>
       
<div class="report_text-block">

<?php the_content(); ?>
</div>
     
</div>

<?php endwhile; else : ?>
	<?php endif; ?>
    
    
</div>


</div>

<?php include( plugin_dir_path( __FILE__ ) . 'footer.php'); ?> 