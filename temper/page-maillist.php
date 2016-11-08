<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ru"> <!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<title>
<?php tp_meta_title (" / "); ?> - <?php bloginfo('description'); ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php get_bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/template/badge.css">

<link rel="icon" type="image/png" href="/favicon.png" />
</head>
<body>


<style>
table.maillist  {
    margin: 1em;
    }
table.maillist a {
    text-decoration: none;
    color: #000;
    }
.maillist tr {
	padding: 1em;
    margin: 0.2em;
    background-color: #fff;
	}
.maillist tr:hover {
    background-color: #e3e3e3;
	}
.maillist td.paid {
    border:1px solid #f1c40f;
    color: #313131;
	}
.maillist td.paid a {
    color: #313131;
    text-decoration: none;
	}
.maillist td {
   padding: 1em;
    line-height:120%;
    }
.maillist thead{
		border-bottom: 1px solid #ddd;
		font-size: 1.3em;
		font-weight: bold;
	}
	</style>
	
<table class="maillist">
<thead>
	<td width="20%">Имя</td>
	<td width="10%">Емейл</td>
	<td width="20%">Место работы</td>
	<td width="10%">Тип</td>
	<td width="20%">Секция</td>
	<td width="10%">Оплата</td>
</thead>
<tbody>

<ol>
<?php 

$nameof = get_terms("name");
/*$namenum[] = array();*/	
foreach ($nameof as $term) :
$namenum = $term->term_id; 
$namename = $term->name; 
$namecount = $term->count; 
    ?>	 

<!--<tr class="tdname"><td colspan="6"><?php echo $namecount; ?></td></tr>-->
<tr>
	<td>
	<h5><?php echo $namename; ?> </h5>
	</td>

<?php
$badge = array(
    'post_type' => 'members',
    'posts_per_page' => 1, 
    'order'=> 'DESC',
    'tax_query' => array(
	array(
        'taxonomy' => 'name',
        'field' => 'id',
        'terms' => $namenum),   
    )
);

$query = new WP_Query( $badge );
while ( $query->have_posts() ) : $query->the_post();
 
$payment = "none";
if( has_term('paid', 'payment') ) $payment = "paid";   
    ?>

	<td>
	<?php echo get_post_meta($post->ID, 'autmail', true) ?>	
	</td>
	
	<td>
	 <?php the_terms( $post->ID, 'job', ' '); ?>	
	</td>
	
	<td>
	<?php the_terms( $post->ID, 'reportype', ' '); ?>	
	</td>
		
	<td>
	<?php the_terms( $post->ID, 'them', ' '); ?>	
	</td>
	
	<td class="<?php echo $payment; ?>">
	<?php the_terms( $post->ID, 'payment', ' '); ?>	
	</td>


    
<?php wp_reset_postdata(); ?>
<?php endwhile; ?>
</tr>
<?php endforeach;  ?>   
</tbody>
</table>  
         
</ol>




<?php if (function_exists('wp_corenavi')) :?> 
<div class="pure-g">
<div class="pure-u-1" >

<div class="navigation center">
 <?php wp_corenavi(); ?>
</div>

</div>
</div>
<?php else : endif; ?>


<?php wp_footer(); ?>
<script>
WebFont.load({
    google: {
    families: ['PT Serif:400,700,400italic,700italic', 'Roboto Sans:400,300,700']
    },
	timeout: 1000
  });
$('.badge_name a').each(function () {
    this.innerHTML = this.innerHTML.replace( /^(.+?\s)/, '<span>$1</span>' );
});

</script>
   </body>
</html>