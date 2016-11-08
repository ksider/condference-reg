<?php
/*
Template Name: Conference memebers edit
*/
 ?>

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

<!--<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/template/badge.css">-->

<link rel="icon" type="image/png" href="/favicon.png" />
</head>
<body>

<?php
if( current_user_can( 'edit_posts' ) ) { ?>


<style>
	.ajaxlist {
		padding-top: 10%;
		background-color: #fff;
	}
	.set_time {
		display: block;
	font-family:"PT Serif", Verdana, Geneva, sans-serif; 
	font-weight: 400;
	}	
	.set_time input{
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		text-align: center;
		
		background-color: #3498db;
		color: #fff;
		
		padding: 0.5em 0;
		
		
		border: 0;
						 
		display: block;
		float: left;
		width: 40%;
	}
	
	.set_time input:focus {
		background-color: #fff;
		color: #000;
		outline: 0;
	}
	.update_link {
		cursor: pointer;
		background-color: #27ae60;
		color: #fff;
		padding: 0.5em 0;
		border-radius: 10%;
		display: block;
		float: left;
		width: 20%;
		margin: 0 auto;
	}
    
.memb-list-time.yellow {
	border-left: 1em solid #e67e22;
}

.memb-list-time.con_zal  {
	border-left: 1em solid #16a085;
}

.memb-list-time.green {
	border-left: 1em solid #ff0;
}

.memb-list-time.purple {
	border-left: 1em solid #8e44ad;
}

.memb-list-time.red {
	border-left: 1em solid #e74c3c;
}

.memb-list-time.noncolor {
	border-left: 1em solid #ff0;
}
    
</style>

<div class="memlist ajaxlist">
	<div class="block">

		
<ul class="nav">
	<li><a href="#cat-538">Механика композитов и конструкций</a></li>
	<li><a class="scrollto" href="#cat-536">Механика адаптивных материалов</a></li>
	<li><a class="scrollto" href="#cat-169">Аэро-, гидромеханика, реология структурно-сложных сред</a></li>
	<li><a class="scrollto" href="#cat-199">Проблемы горения и детонации сложных сред</a></li>
	<li><a class="scrollto" href="#cat-201">Вычислительные методы механики гетерогенных сред</a></li>
	<li><a class="scrollto" href="#cat-200">Биомеханика</a></li>
	<li><a href="#cat-217">Школа молодых ученых</a></li>
</ul>
			
<?php
$do_not_duplicate = array();
$terms = get_terms( 'them', array('parent' => 0, 'hierarchical' => 0, 'hide_empty' => 1, 'exclude'=> '190,556,540' ) );
foreach ( $terms as $term ){ ?>
<h3> 
    <a href="<?php echo get_term_link( $term ); ?>" id="cat-<?php echo $term->term_id; ?>">
     <?php echo $term->name; ?>
  </a>
</h3> 							
<ol class="mem-speech-list">	
<?php 

$spech = array(
    'post_type' => 'members',
	'orderby' => 'post_date',
    'order' => 'ASC',
	'post__not_in' => $do_not_duplicate,
	'posts_per_page' => -1,
	'tax_query' => array(
		'relation' 	=> 	'AND',
	array(
        'taxonomy' => 'them',
        'field' => 'id',
        'terms' => $term->term_id,),
	array(
        'taxonomy' => 'reportype',
        'field' => 'slug',
        'terms' => 'speech'),
		'operator' => 'AND',

    ));

$query = new WP_Query( $spech );
while ( $query->have_posts() ) : $query->the_post(); $do_not_duplicate[] = $post->ID;?>

<?php
$pagid =  $post->ID; 

$ptime = get_the_time( 'G:i', $pagid );
$hose = get_the_time( 'G', $pagid );
$sec = get_the_time( 'i', $pagid );
$postday = get_the_time( 'j', $pagid );

$edit = '';
if( current_user_can( 'edit_posts' ) ) {
	$edit = '<a href="'. get_edit_post_link() .'"> #</a>';
}

 if(has_term('conzal', 'area') ) : 
 $area = 'con_zal';
 elseif( has_term('yellow-zal', 'area') ) : 
  $area = 'yellow';
 elseif( has_term('green-zal', 'area') ) : 
 $area = 'green';
 elseif( has_term('purple-zal', 'area') ) : 
  $area = 'purple';
 elseif( has_term('red-zal', 'area') ) : 
  $area = 'red';
 else : 
 $area = 'noncolor';
 endif;
    
$content = get_the_content();    
    ?>

<li class="" id="" >
<div class="pure-g">
<div class="pure-u-1-5">
	<div class="memb-list-time <?php echo $area; ?>" id="formlist">
	
	

		
<form method="post" id="<?php echo $pagid; ?>" action="/badge/" class="set_time clearfix" >

<input type="hidden" id="idis-<?php echo $pagid; ?>" name="pid" value="<?php echo $pagid; ?>">

<input type="text" value="<?php echo $postday; ?>" name="postday">
<input type="text" value="<?php echo $ptime; ?>" name="posttime">

<input type="hidden" name="title" id="title-<?php echo $pagid; ?>" value="<?php the_title(); ?>" /> 	
<input type="hidden" name="content" id="content-<?php echo $pagid; ?>" value="<?php strip_tags($content); ?>" />
	
<input type="hidden" name="submitted" id="submitted-<?php echo $pagid; ?>" value="true" /> 	
<!--<input type="submit" name="submit" id="submit-<?php echo $pagid; ?>" value="0" class="hide" /> 	-->
<a class="update_link"><i class="icon-chevron-right-2"></i></a>
</form>	
	

		
	
	
	</div>
</div>
<div class="pure-u-4-5">
	<div class="memb-list_ttl"><?php the_title(); ?> <?php echo $edit; ?></div>
	<div class="memb-list-aut"><?php the_terms( $post->ID, 'name', ' '); ?>	</div>	</div>
</div>
</li>

<?php wp_reset_postdata(); ?>
<?php endwhile; ?>

</ol>	

<?php  } ?> 	
	
	</div>
</div>
<?php  } ?> 
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
