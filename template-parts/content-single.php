
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div>
		<?php the_content();?>
	</div>

</article><!-- #post-## -->
