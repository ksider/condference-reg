<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
 
<input type="hidden" name="receiver" value="410012284451679">

<input type="hidden" name="formcomment" value="<?php echo bloginfo('name'); ?>">

<input type="hidden" name="label" value="<?php echo $confpid; ?>">

<input type="hidden" name="quickpay-form" value="shop">

<input type="hidden" name="targets" value="Оплата оргвзноса <?php echo $order;?>">
<input type="hidden" name="sum" id="ya_summary" value="" data-type="number">

<input type="hidden" name="need-fio" value="true">
 
<input type="hidden" name="need-email" value="true">

<input type="hidden" name="need-phone" value="false">
 
<input type="hidden" name="need-address" value="false">
 
<!--Метод оплаты, PC - Яндекс Деньги, AC - банковская карта-->
<!--<input type="hidden" name="paymentType" value="AC" />-->
<!--<input type="hidden" name="paymentType" value="PC" />-->
 
<!--Куда перенаправлять пользователя после успешной оплаты платежа-->
<input type="hidden" name="successURL" value="<?php the_permalink(); ?>?pass=<?php echo $pass; ?>">

<div class="order-submit">
 <button name="paymentType" value="AC" title="Картой" data-wenk="Оплата картой" data-wenk-pos="left"><i class="icon-credit-card"> Картой</i></button><button name="paymentType" value="PC" title="Яндекс Деньги" data-wenk="Оплата Яндекс деньгами"><i class="icon-wallet-money"></i> ЯД</button> 
 <a class="openblank popup-with-move-anim" href="#blancG" data-wenk-pos="right" data-wenk="Сделать бланк счета">Бланк счета</a>   
</div>

</form>

<form action="<?php echo get_admin_url() . 'admin-post.php' ?>" id="blancG" class="zoom-anim-dialog white-popup mfp-hide blanc-generator " method="post">
  
  <lable>Имя</lable>
   <input type="text" name="name" id="blnc_name" value="<?php echo strip_tags($var2[0]); ?>"> 
   <input type="hidden" name="price" id="blnc_price" value="">
   <input type="hidden" name="titel" value="Оплата оргвзноса <?php echo $order;?>">
   
   <?php 
    echo "<input type='hidden' name='action' value='submit-form' />";
    echo "<input type='hidden' name='hide' value='$ques' />";
    ?>
   
   <lable>Адрес</lable>
   <textarea name="address" id="address" value="" cols="20" rows="10">Ваш адрес</textarea> 
   
   <a class="submit">Сгенерировать</a>

</form>
