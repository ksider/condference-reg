<?php // get_header(); ?>
<?php include( plugin_dir_path( __FILE__ ) . 'header.php'); ?> 

<?php 
$key = 'OxcBdaP8wmyhikozLvVGQ4Tqy';
    if ( $_GET['pass'] == $key ) { ?>   
    
<div class="order_archive">
<!--    <div class="shadow"></div>-->

<div class="archive_content">
    <div class="block">



<div class="arc_counter">

    <div class="countA">
        <?php
$published_posts = wp_count_posts('members')->publish;
$goal = 70;
$stat = $published_posts * 100 / $goal;       
        
echo 'Уже: '.$published_posts; ?>
    </div>
<style>
    .lenght {
      /*  width:<?php echo $stat; ?>% ;*/
    }
</style>
    <div class="countG">
    <div class="lenght">
       <?php echo round($stat, 2); ?>% 
    </div>

    </div>

</div> 
          
          
          

          
<div class="filter-menu">
<div class="pure-g">
    <div class="pure-u-1-2">
    
<div class="part_filter" id="part_filter">
     <!-- fixedf-->
<div class="part_filter-it">
<input type="checkbox" name="section" id="ieqall" value="eqall" checked>
    <label for="ieqall">
        <span>Все</span>
    </label>
</div>
     
<?php
$terms = get_terms( 'section', array('parent' => 0, 'hierarchical' => 0, 'hide_empty' => 1 ) );
foreach ( $terms as $term ){    
    $tid =  $term->term_id; 
    $termname = $term->name;
    $termcount = $term->count;
    $termlink = get_term_link( $tid );
?>
<div class="part_filter-it">
<input type="checkbox" name="section" id="i<?php echo $tid;?>" value="i<?php echo $tid;?>">
    <label for="i<?php echo $tid;?>">
        <span><?php echo $termname;?> (<?php echo $termcount;?>)</span>
    </label>
</div>
<?php  } ?>          
         
             
     </div>
        
    </div>
   
     <div class="pure-u-1-2">
<div class="part_filter" id="part_filter">
 
 
<?php
$tr = get_terms( 'reportype', array('parent' => 0, 'hierarchical' => 0, 'hide_empty' => 1, 'orderby'  => 'count', 'order'=> 'DESC', ) );
foreach ( $tr as $term ){    
    $tid =  $term->term_id; 
    $termname = $term->name;
    $tercount = $term->count;
    $termlink = get_term_link( $tid );
    
?>
<div class="">
<span class="r_type <?php echo $term->slug;?>"></span> <a href="?pass=<?php echo $key;?>&type=<?php echo $tid;?>" data-tid="type=<?php echo $tid;?>" class="reportype"><?php echo $termname;?></a> (<?php echo $tercount;?>)
</div>


<?php  } ?>          
         
</div>
       
      
    </div>
</div>
</div>
     
<div id="reports"> 
    
     
  <input class="search" placeholder="Искать" />   
  <table class="tablesorter">
 
        <thead>
        <td>&nbsp;</td>
        <td>
            <a class="sort" data-sort="date">Дата</a>
        </td>
        <td class="order" >
            <a class="sort" data-sort="order">Номер заявки</a>
        </td>
        
        <td>
            <a class="sort" data-sort="pos">Должность</a>
        </td>
        
        <td class="name" >
            <a class="sort" data-sort="name">Автор</a>
        </td>
        <td class="mail" >
            <a class="sort" data-sort="mail">Почта</a>
        </td>
        <td class="titel" >
            <a class="sort" data-sort="titel">Название</a>
        </td>
        <td class="section ">
             <a class="sort" data-sort="section">Секция</a>
        </td>

        <td class="confirm" >
            <a class="sort" data-sort="confirm">Прим</a>
        </td> 

        </thead>
        <tbody id="eqlist" class="list">


    <?php 
        
$section = $_GET['section'];
$type = $_GET['type'];


if (!empty($type)) {
$rep_type = array(
			'taxonomy' => 'reportype',
			'field' => 'id',
			'terms' => $type,
            'operator' => 'IN',    
	);
};
        
if (!empty($section)) {
$cat = array(
			'taxonomy' => 'section',
			'field' => 'id',
			'terms' => $section,
            'operator' => 'IN',    
	);
};    

        
$arg = array( 
        'post_type' => 'members',
        'posts_per_page'=> -1,
        'orderby'  => 'post_date',
        'order'   => 'DESC',
        'tax_query' => array(
                'relation' => 'AND',
                $cat, $rep_type,),
);

$count = '';        
        
$query = new WP_Query( $arg ); while ( $query->have_posts() ) : $query->the_post();

        $count++;

        $aut = get_the_term_list( $post->ID, 'name', '', ', ', '' );
        

        
$cur_thems = get_the_terms( $post->ID, 'section' );
$thems = '';
  
foreach( $cur_thems as $cur_term ){
	$thems .= '<a href="?pass='.$key.'&section='.$cur_term->term_id.'">'. $cur_term->name .'</a>,';
}
  
        
        
$rts = get_the_terms( $post->ID, 'reportype' );
$type = '';
foreach( $rts as $rt ){
	$type .= '<a class="r_type '. $rt->slug .'" title="'.$rt->name.'"></a> ';
}
        

        $area = get_the_term_list( $post->ID, 'area', '', ' ', '' );

        $amail = get_post_meta( $post->ID, 'autmail', true );    
        $phone = get_post_meta( $post->ID, 'auphone', true ); 
        

        $userIp = get_post_meta( $post->ID, 'ip', true ); 

        $manurl = get_post_meta( $post->ID, 'docurl', true );  
        $job = get_post_meta( $post->ID, 'work', true );  

          

        $pid = $post->ID;
        $pass = get_post_meta( $post->ID, 'password', true );
        $user = get_current_user_id();
        $userby = get_user_by('id', $user);  
        $a_email = $userby->user_email;

        $pic_confirm = get_post_meta( $post->ID, 'pic_confirm', true );
        $imc = ' ';
        if ($pic_confirm) {
        $imc = '<a href="'.$pic_confirm.'" class="checks popup-modal">⸙</a>';
        }
       $proc = ''; 
      $proceeding = get_post_meta( $post->ID, 'proceeding', true );  
        if ($proceeding) {
        $proc = '<a href="'.$proceeding.'"></a>';
        }
        
       $position = ''; 
       
       $payed = ''; 
       $url = '';
       $order = ''; 
       if($post->post_parent) {
           
        $position = get_post_meta( $post->post_parent, 'position', true );   
        $payed = get_post_meta( $post->post_parent, 'paidresp', true );   
        $order = get_post_meta( $post->post_parent, 'order', true );   
        $url = get_permalink($post->post_parent); 
           
       }  else {
        $position = get_post_meta( $post->ID, 'position', true );   
        $payed = get_post_meta( $post->ID, 'paidresp', true );    
        $url =  get_permalink(); 
        $order = get_post_meta( $post->ID, 'order', true ); 
       } 
       


        
$sect = get_the_terms( $post->ID, 'section' );
foreach( $sect as $cur_term ){
	 $termid = 'i'.$cur_term->term_id.' '; } 
        
$type_slug = get_the_terms( $post->ID, 'reportype' );
foreach( $type_slug as $cur_term ){
	 $report = 'i'.$cur_term->slug.' '; } 
            
?>
	

<tr id="" class="eqit <?php echo $termid; ?> <?php echo $report; ?> eqall <?php echo $payed; ?>">
       <td class="count center"><?php echo $count; ?></td>
       
       <td class="center date ">
       
<div class="hide"><?php if( is_user_logged_in() ){ ?>

<?php include( plugin_dir_path( __FILE__ ) . 'function/time_form.php'); ?> 

<?php } else { ?> 
<?php } ?></div>   
        
    <?php echo get_the_date('j M H:i'); ?>


       
       </td>
       
        <td class="order center "><?php echo $order; ?></td>
        <td>
            <span class="position"><?php echo $position; ?></span>
        </td>
        <td class="name"><?php echo strip_tags($aut); ?></td>
        <td class="mail"><?php echo $amail; ?></td>
        <td class="titel">
       
        
        <a href="<?php  echo $manurl; ?>" class="link_titel_rep">
        <span><?php the_title(); ?></span>
        </a> 
        <?php echo $type; ?>
        
        <?php if( is_user_logged_in() ){ ?>
        
        <div class="edit_button">
        
        <a href="<?php echo $url; ?>">
         <i class="icon-link-1"></i>
        </a> 
         
         <?php edit_post_link('<i class="icon-pencil-2"></i>', '', ''); ?>  
        </div>
        


         
           <?php } ?> 
         
        </td>
        <td class="section">
         <?php echo $thems; ?>
        </td>

        <td class="confirm">
        
       <?php  echo $imc; ?>
       
        <?php  echo $proc; ?>
        </td> 
</tr>




<?php wp_reset_postdata();
    endwhile; ?>

        </tbody>
    </table>
</div>
</div>
</div>
</div>  
  

           
        
   <?php } else { ?>  
    
    <div class="srev nonloged">
        <form action="<?php the_permalink(); ?>" method="get">
           <label for="pass">Код доступа:</label>
            <input type="text" name="pass" value="<?php if( current_user_can('administrator') ){ echo $key; } ?>">
            <input type="submit">
        </form>
    </div>                  

    <?php } ?>     
    
<?php include( plugin_dir_path( __FILE__ ) . 'footer.php'); ?> 

