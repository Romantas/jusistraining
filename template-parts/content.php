
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="row">
			<div class="col-md-4">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</div>
			<div class="col-md-8">
				<?php the_excerpt( sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
		        get_permalink( get_the_ID() ),
		        __( 'Read More', 'textdomain' )
		    ));?>
			</div>
		</div>

</article><!-- #post-## -->
