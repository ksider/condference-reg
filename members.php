<?php include( plugin_dir_path( __FILE__ ) . 'header.php'); ?> 


<?php 
$count = '';
if (have_posts()) : while (have_posts()) : the_post(); 

$count++;

$aut = get_the_term_list( $post->ID, 'name', '', ', ', '' );

$var2=explode(", ",$aut,2); 


$part = '/program/';

$tr = get_the_terms( $post->ID, 'reportype' );
foreach ( $tr as $term ){    
$type = '<a href="'.$part.'&type='.$term->term_id.'" >'.$term->name.'</a>';   
}

$tm = get_the_terms( $post->ID, 'section' );
foreach ( $tm as $term ){    
$thems = '<a href="'.$part.'?section='.$term->term_id.'&jour=all" >'.$term->name.'</a>';   
}

// $paymethod = get_the_term_list( $post->ID, 'payment', '', ' ', '' );
$area = get_the_term_list( $post->ID, 'area', '', ' ', '' );

$payed = get_post_meta( $post->ID, 'paidresp', true );

$amail = get_post_meta( $post->ID, 'autmail', true );    
$phone = get_post_meta( $post->ID, 'auphone', true ); 
$order = get_post_meta( $post->ID, 'order', true ); 

$userIp = get_post_meta( $post->ID, 'ip', true ); 

$manurl = get_post_meta( $post->ID, 'docurl', true );  
$job = get_post_meta( $post->ID, 'work', true );  

$position = get_post_meta( $post->ID, 'position', true );  
  
$pid = $post->ID;
$confpid = $post->ID;
$pass = get_post_meta( $post->ID, 'password', true );
$user = get_current_user_id();
$userby = get_user_by('id', $user);  
$a_email = $userby->user_email;

if ( $post->post_author == $user ) {$_GET['pass'] = $pass;}
        
        if ( $_GET['pass'] == $pass ) { 
 
?>


<div class="bid_wrap">
   
    <div class="block">
        <div class="pure-g">
            <div class="pure-u-2-3">
            
<div class="bid-content">
       
   <?php 
$setry = get_the_terms( $post->ID, 'reportype' );
$timet = '';
foreach( $setry as $st ){
    $timet = $st->slug;
	if ($timet == 'poster') {
        
    }
    else {
     echo '<div class="bid-time"><div class="date">'.get_the_date('d').'  Ноября</div><div class="time">'.get_the_date('H:i').'</div></div>';   
    }
}
    ?>
        
        <div class="bid-authors">
<p class="authors"><a href="<?php echo get_the_permalink(); ?>?pass=<?php echo $pass; ?>">Заявка <?php echo $order; ?></a>: <span class="position"><?php echo $position; ?></span> <?php echo strip_tags($aut); ?></p>
        </div>  
                             
    <div class="bid-titel">

        <span><?php the_title(); ?></span>

        <?php if( is_user_logged_in() ){ ?>
        (<a href="<?php  echo $manurl; ?>"></a><?php edit_post_link('<i class="icon-pencil-2"></i>', ', ', ' '); ?>)
        <?php } ?> 

    </div>
                    
           <div class="bid-details">
           
<span>Категория: <?php echo $thems; ?> (<?php echo strip_tags($type); ?>)</span>            
           </div>         

     <div class="bid-abstract">
       <div class="srev_content-abstract">
            <h4>Аннотация</h4>   
            <?php the_content(); ?>    
       </div>                           
    </div>
    
<?php include( plugin_dir_path( __FILE__ ) . 'function/proceedings.php'); ?>    

    
</div>
          
          
           
<div class="bid-sub">
         
<!--<div class="bid_variable">
<?php if (!$payed) {  ?>         
 <div class="open_link">           
 <a data-email="<?php echo $amail; ?>"
    data-namefio="<?php echo strip_tags($aut); ?>"
    data-phone="<?php echo $phone; ?>"
    data-work="<?php echo $job; ?>"
    data-pid="<?php echo $pid; ?>" id="bid_variable" class="sub_form-open">
    Добавить еще один доклад
</a>
</div>   
<?php } ?>           
<div class="sub_form">
  <?php // echo do_shortcode( '[contact-form-7 id="1925" title="conference_sub_form" html_id="sub_send" html_class="sub_send"]' ); ?>  
</div>  
    
</div>  -->
         
<?php 
$sub = array( 
    'post_type' => 'members',
    'posts_per_page'=> -1,
	'orderby'  => 'post_date',
	'order'   => 'ASC',
    'post_parent' => $post->ID,
   		);
$query = new WP_Query(  $sub ); while ( $query->have_posts() ) : $query->the_post();
$count++;
// $aut = get_the_term_list( $post->ID, 'name', '', ', ', '' );
            
// $thems = get_the_term_list( $post->ID, 'section', '', ' ', '' );
 
$tm = get_the_terms( $post->ID, 'section' );
foreach ( $tm as $term ){    
$thems = '<a href="'.$part.'?section='.$term->term_id.'&jour=all" >'.$term->name.'</a>';   
}            
            
$type = get_the_term_list( $post->ID, 'reportype', '', ' ', '' );
// $paymethod = get_the_term_list( $post->ID, 'payment', '', ' ', '' );
// $area = get_the_term_list( $post->ID, 'area', '', ' ', '' );
// $amail = get_post_meta( $post->ID, 'autmail', true );  
// $phone = get_post_meta( $post->ID, 'auphone', true ); 

$manurl = get_post_meta( $post->ID, 'docurl', true );  
$pid = $post->ID;                                      
// $job = get_post_meta( $post->ID, 'work', true );  
             
?>

<div class="bid-content">
  
         <div class="bid-time">
           <div class="date"><?php echo get_the_date('d'); ?>  Ноября</div>
           <div class="time"><?php echo get_the_date('H:i'); ?></div>
        </div>
   
    <div class="bid-titel">
        <span><?php the_title(); ?></span>

        <?php if( is_user_logged_in() ){ ?>
        (<a href="<?php  echo $manurl; ?>"></a><?php edit_post_link('<i class="icon-pencil-2"></i>', ', ', ' '); ?>)
        <?php } ?> 
    </div>

    <div class="bid-details">
<span>Категория: <?php echo $thems; ?>  (<?php echo strip_tags($type); ?>)</span>    

    </div>

    <div class="bid-abstract">
        <div class="srev_content-abstract">
            <h4>Аннотация</h4>
            <?php the_content(); ?>
        </div>
    </div>
   

<?php include( plugin_dir_path( __FILE__ ) . 'function/proceedings.php'); ?>    
    
</div>
  
<?php wp_reset_postdata(); endwhile; ?> 
              
 
 </div>          

           </div>

<div class="pure-u-1-3">
            
<?php include( plugin_dir_path( __FILE__ ) . 'pay.php'); ?>                      
 </div>
       
        </div>
    </div>
</div>


<?php } else { ?> 
 
   
<div class="srev nonloged">
    <form action="<?php the_permalink(); ?>" method="get">
       <label for="pass">Код доступа:</label>
        <input type="text" name="pass">
        <input type="submit">
    </form>
</div>
                  
          
<?php } ?> 

<?php endwhile; else : ?>
<?php endif; ?>

<script>
var mark = new google.maps.LatLng(55.779587, 37.576211);
var map;
var infowindow;

function initMap() {
  var pyrmont = {lat: 55.779587, lng: 37.576211};

  map = new google.maps.Map(document.getElementById('map'), {
    center: pyrmont,
    zoom: 15,
       zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
        },
        disableDoubleClickZoom: true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        },
        scaleControl: true,
        scrollwheel: false,
        streetViewControl: false,
        draggable : true,
        overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,

      
  });

  infowindow = new google.maps.InfoWindow();
    
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch({
    location: pyrmont,
    radius: 700,
    types: ['restaurant', 'cafe', 'bar', 'food']
      
  }, callback);
    
    var mkmk = new google.maps.Marker({
    icon: 'http://iam.ras.ru/wp-content/themes/iam-purevedro2/img/map.svg',
            position: pyrmont,
            map: map,
            }); 
        

}

function callback(results, status) {
  if (status === google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {

  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
      map: map,
      position: placeLoc,
      icon: {
      //    path: google.maps.SymbolPath.CIRCLE,
          scale: 4,
            },
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
    
}
</script>



<div class="members_map">

<div class="block">
   
   <div class="pure-g">
       <div class="pure-u-2-3">
   <h4>
       Кафе вокруг места проведения 
  </h4>

    <div id="map"></div>    
       </div>
       
       <div class="pure-u-1-3">
<div class="the_tickets">
<h4>Билеты и гостиницы</h4>
<script charset="utf-8" src="//www.travelpayouts.com/widgets/7ffef09705469f1199901306924a54cd.js?v=816" async></script>           
 </div>   
      
  <div class="exurcion">
   <!-- logo_test.svg -->
     <img src="<?php echo plugins_url('condference-reg/img/logo.png') ?>" alt="Самостоятельные экскурсии" title="Самостоятельные экскурсии">
     <span>Самостоятельные экскурсии</span>
     <a href="http://um.mos.ru/about/"></a>
      
  </div>    
       </div>
   </div>
   

    
    
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcgh2HPhtTHnm9yNuXN0w9qARVADr7yrE&callback=initMap&signed_in=true&libraries=places,visualization" async defer></script> 


</div>


<?php include( plugin_dir_path( __FILE__ ) . 'footer.php'); ?> 	
<?php // get_footer(); ?> 






