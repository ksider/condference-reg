<?php

function mem_liste($atts, $content = null) {
extract(shortcode_atts(array(
    "id" => '5',
    "nav" => 'cat'
        ), $atts));

global $post;  
$output = ''; 
   
$termine = get_term_by( 'id', $id, 'section' );
$name = $termine->name;

$output .= '      
<div class="sect-block" id="section-'.$id.'">
<div class="mem-sect">
<a href="?section='.$id.'&jour=all">#</a> '.$name.' 
</div>
<div class="mem-manager">'.$content.'</div>
<h4>Устные доклады</h4> 

<div class="program_list">';
 
 $spech = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'DESC',
	'numberposts' => -1,
	'day'	=>	(int)$callday,
'tax_query' => array(
	'relation' 	=> 	'AND',
	array(
        'taxonomy' => 'section',
        'field' => 'id',
        'terms' => $id),   
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'speech'),
		'operator' => 'AND',
    ));
    
$myposts = get_posts($spech);    
    
    $datum = '';    
foreach($myposts as $post) :
    setup_postdata($post);   
 
 if ( $datum != get_the_date('d F') ) {
	$datum = get_the_date('d F');
$output .='<div class="date_titel"></h4>'.$datum.'</div>';}
    
 $job = get_post_meta( $post->ID, 'work', true );      
 $aut = get_the_term_list( $post->ID, 'name', '', ', ', '' ); 
    
if( has_term('plenary', 'reportype') ): 
$output .= '
<div class="program_rep-block plenary">
   <div class="pure-g">
<div class="pure-u-1-6">
          <div class="report-time">
           '.get_the_date('H:i').'
          </div>
          <div class="plenary_name">
              пленарный
          </div>
       </div>
  
<div class="pure-u-5-6">
    <div class="report_block plenary">
    <div class="report-properties">
         
      <span class="report-aut">'.strip_tags($aut).'</span>
      
   </div>
    
   <div class="report-titel">
       <a href="#id-'.get_the_ID().'" class="popup-with-move-anim">'.get_the_title().'</a>
   </div>
  
   <div class="plenary_job">
       <span class="report-job">'.strip_tags($job).'</span>
   </div>
 
<div class="report-abstract zoom-anim-dialog white-popup mfp-hide" id="id-'.get_the_ID().'"><h4>Аннотация</h4>'. get_the_content().'</div> 
        
   </div>           
</div>
   </div>
</div>'; 

 else :
 
$output .=
'<div class="program_rep-block">
   <div class="pure-g">
       <div class="pure-u-1-6">
       <div class="report-time">

           '.get_the_date("H:m").'
            
       </div>
       
       </div>
       <div class="pure-u-5-6">
           
   <div class="report_block">
    
     <div class="report-titel"><a href="#id-'. get_the_ID() .'" class="popup-with-move-anim">'. get_the_title() .'</a></div>
   
    <div class="report-properties">
         
      <span class="report-aut">'. strip_tags($aut) .'</span>
       — 
      <span class="report-job">'. strip_tags($job) .'</span>
      
      <div class="report-abstract zoom-anim-dialog white-popup mfp-hide" id="id-'. get_the_ID() .'">
            <h4>Аннотация</h4>
            '. get_the_content() .'  
      </div>
    </div> 
       
   </div>           
           
       </div>
   </div>
</div> ';   
endif; 
wp_reset_postdata();
endforeach;    
$output .='</div></div>';     

return $output;
} 
add_shortcode("members", "mem_liste"); 

// Добавляем кнопки в текстовый html-редактор
add_action( 'admin_print_footer_scripts', 'add_conferencetag' );
function add_conferencetag() {
   if (wp_script_is('quicktags')) :
?>
    <script type="text/javascript">
      if (QTags) { 
        // QTags.addButton( id, display, arg1, arg2, access_key, title, priority, instance );
        QTags.addButton( 'Секция', 'Sections', '[members id=""]', '[/members]', 'Sections', 'Секиця', 1 );
        
      }
    </script>
<?php endif;
}