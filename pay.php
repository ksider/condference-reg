<div class="order-side">

<?php if( current_user_can('administrator') ){ ?>

    <div class="order_administrator-data">

      <span>Имя: <?php echo $position; ?> <strong><a href="mailto:<?php echo $amail; ?>"><?php echo strip_tags($var2[0]); ?></a></strong></span>
      
      <span>Телефон: <?php echo $phone; ?> (ip: <?php echo $userIp; ?>)</span>
             
      <span>Работа: <?php echo $job; ?></span>
 
     <span>Оплата: <?php echo $payed;?></span>
     <span>Место: <?php echo $area;?></span>
 
    </div>

<?php } ?>

<div class="order_paiment">
    <div class="book-order_cost">
    
<?php 
    $fprc = '3000'; 
    $aprc = '1500'; 
?>       
<div class="fullprice">
   <span id="fullprice"><?php echo $fprc; ?> </span>&nbsp;₽ <?php if ($count > 1)  { echo 'за все доклады'; } ; ?>  
</div>
   
   
   <div class="cost_ajust">
      
       <form action="" id="aj">
         <label for="full">
           <input type="radio" name="cost" id="full" value="<?php echo $fprc; ?>" checked>
           Полная стоимость <span class="money">(<?php echo $fprc; ?> ₽)</span>
         </label>
         <label for="sudent">
           <input type="radio" name="cost" id="sudent" value="<?php echo $aprc; ?>">
           Для аспирантов <span class="money">(<?php echo $aprc; ?> ₽)</span>
         </label>
         <label for="noun">
           <input type="radio" name="cost" id="noun" value="1200">
           Заочное участие <span class="money">(1200 ₽)</span>
         </label>        
        
  <!--      
       <label for="test">
        <input type="radio" name="cost" id="test" value="2">
           Тест
         </label>
-->
         
        <input type="hidden" value="<?php  echo $count; ?>" id="count">
         
         
        <div class="aj_hide hide">
            
        <label for="count_tit" class="count_titel">
           За несколько докладов
        </label>
        <input type="checkbox" id="count_tit">
        
   
        <div class="aj_count">
         <label for="count" class="">
                Количество докладов
         </label>
        
            <span>Во время оплаты, в комментариях, необходимо указать номера всех заявок</span> 
        </div> 
        
        </div> 
         
       </form>
       
   </div>
   
   
    </div>
    
<?php include( plugin_dir_path( __FILE__ ) . 'yandex.php'); ?>  

<hr>

<div class="order-confirm">
 
<?php $pic_confirm = get_post_meta( $confpid, 'pic_confirm', true );?>

<?php if ($payed) {  ?>

<div class="srev_comments">

 <?php $comments = get_comments('post_id='.$confpid);
      foreach($comments as $comment){ ?>
            <div class="srev_comment"> 
               <?php echo($comment->comment_content); ?>   
            </div>    
      <?php } ?> 
          
</div>


<?php } elseif ($pic_confirm) { ?>
<?php $pic_confirm_full = get_post_meta( $confpid, 'pic_confirm_full', true );?>

<a href="<?php echo $pic_confirm;?>"><img src="<?php echo $pic_confirm;?>" alt=""></a>
 
<?php } else { ?>

 <div class="confirm-info">
    <h4>Подтверждение</h4>
     Прикрепите скан платежки или студенческого билета, лучше в виде картинки (jpg или png, pdf тоже можно, но он не отобразиться в этом окне)
 </div> 

<form id="featured_upload" method="post" action="<?php echo plugin_dir_url( __FILE__ ) . 'function/confirm.php'; ?>" enctype="multipart/form-data">
	
	<input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
	
	<input type="hidden" name="post_id" id="post_id" value="<?php echo $confpid; ?>" />
	<input type="hidden" name="url_back" id="url_back" value="<?php echo get_the_permalink(); ?>/?pass=<?php echo $pass; ?>" />
	
	<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
	
	<!--<a id="submit_my_image_upload">загрузить</a>
	<input type="submit" value="отправить" id="submit_my_image_upload">-->
</form>

<?php } ?>

     
    

</div>       
</div>
  
 
 </div>