<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ru"> <!--<![endif]-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8">

<?php tp_meta_description ('Институт приклданой механики РАН',300); ?>
<?php tp_meta_robots (); ?>
  
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<title>
<?php tp_meta_title (" / "); ?> - <?php bloginfo('description'); ?></title>

<link rel="icon" type="image/png" href="/favicon.png" />

</head>
<body data-spy="scroll" data-offset="100" data-target=".spied" >
<style>
 #wpadminbar {display: none;}   
</style>

<div id="printed" data-action="<?php echo plugin_dir_url( __FILE__ ) . '/badge_req.php'; ?>">
<div class="a4"></div>
</div>

<div class="members_list">

 <form action="<?php echo plugin_dir_url( __FILE__ ) . 'function/badge_req.php'; ?>"> 
 
<?php
$ids = '';    
$terms = get_terms( 'name', 
                   array(
                       'parent' => 0, 
                       'hierarchical' => 0, 
                       'hide_empty' => 1 ) );
foreach ( $terms as $term ){    
    $tid =  $term->term_id;
    $ids .= $tid.',';
    $termname = $term->name;
?>
<div class="part_filter-it">
<input type="checkbox" name="section[]" id="<?php echo $tid;?>" value="<?php echo $tid;?>" class="sections" checked>
    <label for="<?php echo $tid;?>">
        <span><?php echo $termname;?> </span>
    </label>
</div>
<?php  } ?> 
<input type="hidden" class="item_save" value="<?php echo $ids; ?> "> 
</form>  


<div class="sending">

   <div class="b1">
<label for="open" class="creates">
    <span>Создать</span>

    <input type="checkbox" name="open" id="open">
    <div class="create_badge">
        <form action="" id="create_badge">
            
            <label for="">Фамилия
                <input type="text" name="secondname" class="sname">
            </label>

            <label for="">Имя
                <input type="text" name="firstname" class="fname">
            </label>

            <label for="">Отчество
                <input type="text" name="fathename" class="tname">
            </label>

            <label for="">Место работы
                <input type="text" name="job" class="job">
            </label>

            <input type="submit" value="Создать">

        </form>
    </div>
</label>
   </div>
   
   <div class="b1">
      
       <div class="getinblock">
         <a class="ser" data-action="<?php echo plugin_dir_url( __FILE__ ) . '/badge_req.php'; ?>">Get IT!</a>  
       </div> 
       
       <!--<div class="propeties"></div>-->

   <div class="selectall">
        <input type="checkbox" name="all" class="" id="checkAll" checked><label for="checkAll"><span>Все</span></label>
   </div>

   <div class="selectall">
        <a class="invertSelection" id="invert">inv</a>
   </div>    
       
    <div class="selectall">
        <a class="makeorg">Org</a> 
   </div>  
           
       
       
   </div>
   
   
   <div class="b1">
       <a class="clear b1_l">x</a>
   </div>   
     

</div>
 
                              
        
    
</div>



<?php wp_footer(); ?>


<script>
 var svgloader = '<div class="loader" title="2"><svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><path fill="#f1c40f" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"><animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/></path></svg></div>';   
    
WebFont.load({
    google: {
    families: ['PT Sans:400,700,400italic,700italic', 'PT Mono:400', 'PT Serif:400,700,400italic,700italic',]
    },
	timeout: 500
  });
$(document).ready(function() {
    
/*$('#printed').exists(function() {
     
    var act =  $(this).data('action');
    var dates = localStorage.getItem('cart');
    
    $('input.item_save').val(dates);
     
    var toserv = $('input.item_save').val();
     
     $.ajaxSetup({
        type: 'POST',
        cache:false,
        url: act,
        data: toserv,
         complete: function () {
                console.log( toserv );
            }
         });
     
   $('#printed .a4').html(svgloader); ; 
   $('#printed .a4').load(act); 
    
 });*/
    
    
    
  
 $(".ser").click(function(){
     
    var act =  $(this).data('action');
    var toserv = $("input[type='checkbox']").serialize();
    
     $.ajaxSetup({
        type: 'POST',
        cache:false,
        url: act,
        data: toserv,
         complete: function () {
                console.log( toserv );
            }
         });
     
   $('#printed .a4').html(svgloader); ; 
   $('#printed .a4').load(act); 
     
      return false;
    }); 
    
    
    $("#create_badge").submit(function() {

        var fname = $("#create_badge .fname").val();
        var sname = $("#create_badge .sname").val();
        var tname = $("#create_badge .tname").val();
        var job = $("#create_badge .job").val();

        $('#printed .a4').append('<div class="badge-wrap"><div class="lblock"><div class="logo"><span>МКМК·2016</span></div></div><div class="name"><span>'+sname+'</span><span>'+fname+'</span><span>'+tname+'</span></div><div class="lblock"><div class="job"><span>'+job+'</span></div></div></div>');
        return false;

    });
    
    $(".clear").click(function(){ 
        $('#printed .a4').html('');
        return false;
    });    
    
    $(".makeorg").click(function(){ 
        $('#printed .badge-wrap').toggleClass('organizer');
        return false;
    }); 
    
    $("#checkAll").click(function(){
        $('.sections:checkbox').prop('checked', this.checked); 
        
    });    
    
    $("#invert").click(function(){
        
        $('input.sections[type="checkbox"]').each(function () {
          $(this).prop('checked', !$(this).is(':checked'));
        });
    });
    

    

});		    
    
</script>

<?php include(TEMPLATEPATH . '/tp/metrika.php'); ?>
   </body>
</html>