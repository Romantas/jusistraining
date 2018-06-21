<?php get_header(); ?>

	<div class="row all_body">
		
		<div class="col-sm-9">
			
			<div class="row text-center">

			<?php 
			$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
			$args = array(
				'post_type' 	 => 'post',
				'posts_per_page' => 2,
				'category_name'  => 'naujienos',
				'page'			 => $paged,
				'paged'			 => $paged,

				);
			$query = new WP_Query($args); ?>

			<?php if ($query->have_posts() ) : ?>

				<?php
				// Start the loop.
				while ($query->have_posts() ) : $query->the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				// End the loop.
				?>

			<?php endwhile;?>

				<div class="col-xs-12" style="margin-top: 20px;">
				<div class="col-xs-6 text-left">

					<?php echo get_previous_posts_link( 'ANKSTESNIS &#8592;' ); ?>

				</div>
				<div class="col-xs-6 text-right">

					<?php echo get_next_posts_link( 'KITAS &#8594;', $query->max_num_pages ); ?>

				</div>
				</div>	

			<?php // If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;

			
			wp_reset_query();
			wp_reset_postdata();
			?>

			</div>
		
		</div>
		
		<div class="col-sm-3">
			<?php get_sidebar(); ?>
		</div>
		
	</div>

<?php get_footer(); ?>