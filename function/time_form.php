<?php 
    $hours = get_the_date('H'); 
    $minutes = get_the_date('i'); 
    $day = get_the_date('d'); 
?>

<form action="<?php echo plugin_dir_url( __FILE__ ) . 'time.php'; ?>" method="POST" class="timedit">
    <input type="text" name="d" id="day" value="<?php echo $day; ?>">
    
    <input type="text" name="h" id="hours" value="<?php echo $hours; ?>">:<input type="text" name="m" id="minutes" value="<?php echo $minutes; ?>">
    
    <input type="hidden" name="id" id="id" value="<?php echo get_the_ID(); ?>">
    <a class="submit"><i class="icon-check-mark-4"></i></a>
</form>


