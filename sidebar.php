<div id="sidebar" class="widgets-area">
	<?php dynamic_sidebar('sidebar-1'); ?>

	<!--<h2 class="atsiliepimai_title"><?php _e('ATSILIEPIMAI', 'shapespace'); ?></h2>
	<?php echo shapeSpace_get_recent_comments(); ?>-->

	<h2 class="atsiliepimai_title">Atsiliepimai</h2>
	<div>
		 <?php 
		 $args = array(
		 	'category_name'  => 'atsiliepimai',
		 	'posts_per_page' => 1,
		 	'orderby'   => 'rand',
		 	);

		 $query = new WP_Query($args); ?>
	 <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

	 <div class="row">
		<div class="xs-col-12">	 
		 <!-- Display the Title as a link to the Post's permalink. -->
		 <div class="text-center">
		 	<?php the_post_thumbnail( 'thumbnail', array('class' => 'img-rounded')); ?>
		 </div>
		 <h4 class="text-center"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
		  <div class="entry" style="margin-left: 6%;">
		  	<p><?php the_excerpt(); ?></p>
		  </div>
		</div>
	 </div> <!-- closes the first div box -->

	 <?php endwhile; 
	 wp_reset_postdata();
	 ?>
	 <?php endif; ?>
	</div> 
</div>
