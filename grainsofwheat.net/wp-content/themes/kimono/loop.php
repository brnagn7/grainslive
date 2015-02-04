	<div class="loopst1">
		<div class="loopst2">
<ul class="bxslider">
		
<?php
//	query_posts( 'category_name=news' );
$headsr = array( 'posts_per_page' => 5,'category_name' => 'news');
$the_query = new WP_Query( $headsr );
//if ( have_posts() ) : while ( have_posts() ) : the_post();
while ( $the_query->have_posts() ) : $the_query->the_post();
?>

  <li>
    	<?php 
    	$testdayo = the_post_thumbnail(array(1200,1200));
  if(is_null($testdayo)){
  	echo '<img src="'.get_template_directory_uri() .'/images/noimg.gif" class="attachment-1200x1200 wp-post-image">';
  }
  else{
    	echo $testdayo;
  }
    	 ?>
	<div class="headimgs">	</div>
	  <div class="loopst3">
	<a href="<?php the_permalink(); ?>" class="loopst4"><?php
 if(mb_strlen($post->post_title)>40) { $title= mb_substr($post->post_title,0,40) ; echo $title. "..." ;
} else {echo $post->post_title;} ?></a>
</a><br>
	  <a href="<?php the_permalink(); ?>" class="loopst5"><?php kimono_posted_on(); ?></a>
	  </div>
	
    </li>
    
<?php
endwhile;

?>

</ul>
</div>

	</div>
<?php
wp_reset_postdata();
?>