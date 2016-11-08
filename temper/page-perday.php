<?php get_header(); ?>
<style>
  
/* archive members of conference */
.mem-sect {
	font-size: 2em;
	color: #000;
	padding: 0 2em;
	line-height: 100%;
	font-weight: bold;
}
.mem-manager {
	font-size: 1.1em;
	color: #7f8c8d;
	padding: 0 4em;
}
.memb-list_ttl {
	font-size: 1em;
	color: #000;
}
.mem-sect_tl {
	color: #7f8c8d;
}
.sect-block {
	padding-bottom: 5em;
}

.mem-titel {
	text-align: center;
    padding:10% 0 ;
}
.mem-titel h1{
	font-weight: 300;
}


.memb-list-aut {
	color: #7f8c8d;
}
.plenary-list {
	margin: 2em 0;
}
.plenary-list-aut {
	color: #7f8c8d; 
	font-size: 1em;
}

.plenary-list-aut a {
	color: #000;
	text-decoration: none;
	border-bottom: 2px solid #000;
	font-weight: bold;
	font-size: 1.2em;
}
.plenary-degree {
	font-size: 0.8em;
	color: #7f8c8d;
	line-height: 100%;
	margin-top: -1em;	
}

.plenary-list_ttl {
	padding: 0.6em 0;
	font-size: 1.4em;
}

.memb-list-time {
    font-size: 1em;
	color: #fff;
	margin-right: 1em;
	padding: 1em 0;
	background-color: #3498db;
	font-size: 1.2em;
	text-align: center;
}
.mem-speech-list {
	padding: 2em;
	padding-top: 0;
	color: #313131;
}

ul.mem-posters-list {
	margin: 0;padding: 0;
	display: block;
	background-color: #ecf0f1;
	padding: 2em;
	margin-left: 3em;
	color: #313131;
}
ul.mem-posters-list li{
	padding-bottom: 1em;
	display:block;
}

.memlist {
	padding: 0;
    padding-bottom: 10%;
	background-color:#323232;	
/*	color: #fff;*/
}
.memlist-content {
	background-color: #fff;	
	padding: 2em 0;
}

.sidinfo {
    background-color: #4aa3df;
    padding: 2em;
    color: #fff;
}
.sidinfo li a {
	text-decoration: none;
	display: inline-block;
	border-bottom: 1px dashed #fff;  
	color: #fff;
}
.sidinfo li:before {
	color: #fff;
}


.perday_block {
    position: fixed;
    padding: 0.2em;
    background-color: rgba(44, 62, 80,0.8);
    color: #fff;
    font-size: 2em;
    text-align: center;
    width: 100%;
    top: 0;right: 0;left: 0;
    z-index: 9999;
    box-shadow: 0 0 15px 0 #000;
}
.perday_content {
    padding-top: 4em;
    margin: 0 2%;
    position: relative;
    height: 100%;
}
.perday_content .pure-u-1-3 {
  position: relative;  
  height: 100%;
}
.perday_content .pure-g {
  position: relative;  
  height: 100%;
}
.area-block {
   position: absolute;
   top: 0;bottom: 0;right: 0;left: 0;
    overflow-y: hidden;
}
.area-block:hover {
    overflow-y: scroll;
}
.area-call {
    text-align: center;
    font-weight: bold;
}
.area-speech-list {
   
}
.area-list {
  padding: 1em 0; 
}
.area-time {
   width: 50%;
    background-color: #2980b9;
    color: #fff;
    padding: 0.2em;
    text-align: center;
}

.area-time.yellow {
    background-color: #e67e22;

}

.area-time.con_zal  {
    background-color: #16a085;

}

.area-time.green {
    background-color: #ff0;

}

.area-time.purple {
    background-color: #8e44ad;

}

.area-time.red {
    background-color: #e74c3c;

}

.area-time.noncolor {
    background-color: #7f8c8d;

}


.area-name {
    font-weight: bold;
}
.area-title {
  font-size: 1em;  
}
.area-thems {
   font-size: 0.8em;
   color: #7f8c8d;
}


/* archive members of conference END*/  
   
   
</style>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$today = date('d');?>

<div class="perday_block">
    <?php the_title(); ?> <?php echo $today; ?> декабря
</div>

<div class="perday_content">


<?php the_content(); ?>    


</div>

<?php endwhile; else : ?>
<?php endif; ?>

<?php get_footer(); ?>


