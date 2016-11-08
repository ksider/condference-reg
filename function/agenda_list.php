<?php      
 $manurl = get_post_meta( $post->ID, 'docurl', true ); 
 $job = get_post_meta( $post->ID, 'work', true );      
 $aut = get_the_term_list( $post->ID, 'name', '', ', ', '' ); 


if( has_term('plenary', 'reportype') ): ?>

<div class="program_rep-block plenary">
   <div class="pure-g">
       <div class="pure-u-1-6">
         
<?php if( is_user_logged_in() ){ ?>

<?php include( plugin_dir_path( __FILE__ ) . 'time_form.php'); ?> 

<?php } else { ?> 
 <div class="report-time">  
                 
      <?php echo get_the_date('H:i'); ?><span>–<?php echo gtis(30); ?></span>   
</div>
<?php } ?>
          
          <div class="plenary_name">
              пленарный
          </div>
       </div>
  
<div class="pure-u-5-6">
           
   <div class="report_block plenary">
    <div class="report-properties">
         
      <span class="report-aut"><?php echo strip_tags($aut); ?></span>
      
   </div>
    
   <div class="report-titel">
       <a href="id-<?php the_ID(); ?>" class="poup_up"><?php the_title(); ?></a> <!--<a href="<?php  echo $manurl; ?>" class="download"></a>-->
   </div>
     
      <div class="hide abstract_block" id="id-<?php the_ID(); ?>">
          
          <div class="abs_flex">
          <div class="abstract"> 
            <h4>Аннотация</h4>
            <?php the_content(); ?>
          </div> 
          </div>
 
      </div>
  
   <div class="plenary_job">
       <span class="report-job"><?php echo strip_tags($job); ?></span>
   </div>
 

        
   </div>           
           
       </div>
   </div>
</div>  

<?php else : ?>
 
<div class="program_rep-block">
   <div class="pure-g">
       <div class="pure-u-1-6">
      
       
<?php if( is_user_logged_in() ){ ?>

<?php include( plugin_dir_path( __FILE__ ) . 'time_form.php'); ?> 

<?php } else { ?> 
 <div class="report-time">              
      <?php echo get_the_date('H:i'); ?><span>–<?php echo gtis(20); ?></span>   
</div>
<?php } ?>

     
      
       </div>
       <div class="pure-u-5-6">
           
   <div class="report_block">
    
     <div class="report-titel"><a href="id-<?php the_ID(); ?>" class="poup_up"><?php the_title(); ?></a> <!--<a href="<?php  echo $manurl; ?>" class="download"></a>--></div>
   
    <div class="report-properties">
         
      <span class="report-aut"><?php echo strip_tags($aut); ?></span>
       — 
      <span class="report-job"><?php echo strip_tags($job); ?></span>
      
      <div class="hide abstract_block" id="id-<?php the_ID(); ?>">
          
          <div class="abs_flex">
          <div class="abstract"> 
            <h4>Аннотация</h4>
            <?php the_content(); ?>
          </div> 
          </div>
 
      </div>
    </div> 
       
   </div>           
           
       </div>
   </div>
</div>     

<?php endif; ?>  