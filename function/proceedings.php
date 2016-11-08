    
    <div class="bid-proceedings">
      
<?php 
$proceeding = get_post_meta( $post->ID, 'proceeding', true );
        
if ($proceeding) {  ?>
  
   <a href="<?php echo $proceeding;?>">статья</a>            
                
<?php } else { ?>
          
<a  class="add-proceedings"
        data-work="<?php the_title(); ?>"
        data-namefio="<?php echo strip_tags($aut); ?>"
        data-link="<?php echo get_the_permalink(); ?>"
        data-pid="<?php echo $pid; ?>">
Добавить полный текст доклада (<strong>7-15 страниц</strong>)
</a>
        <div class="poc_file hide" id="pf-<?php echo $pid; ?>">
        
        <?php echo do_shortcode( '[contact-form-7 id="2328" title="Proceedings" class="proceedings" html_id="proc-'.$pid.'"]' ); ?>
        </div>
   
    <?php } ?> 
    
    </div>