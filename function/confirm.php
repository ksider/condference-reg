<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
$returntext = '';
// Проверим защиту nonce и что пользователь может редактировать этот пост.
if (isset( $_POST['my_image_upload_nonce'], $_POST['post_id'] ) 
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' ) )
 {
	// все ок! Продолжаем.
	// Эти файлы должны быть подключены в лицевой части (фронт-энде).
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	// Позволим WordPress перехвалить загрузку.
	// не забываем указать атрибут name поля input - 'my_image_upload'
	$attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );
    $back_url = $_POST['url_back'];
    
	if ( is_wp_error( $attachment_id ) ) {
		$returntext = 'что-то пошло не так';
	} 
    
    else {

        
$size = "full"; // (thumbnail, medium, large, full or custom size)
$image = wp_get_attachment_image_src( $attachment_id, $size );
update_post_meta($_POST['post_id'], 'pic_confirm', $image[0]);

    $returntext = 'сейчас вы будете перенаправлены';
	
    }

} 

else {
	$returntext = 'Необходимо выбрать файл';
}

echo $returntext;
echo '<script> document.location.href="'.$back_url.'"</script>';
