<?php get_header(); ?>

<div id="primary" class="container">
	<main id="main" class="site-main" role="main">

		<section class="error-404 not-found">

			<head class="page-header">
				<h1 class="page-title">Atsiprašome, puslapis nerastas!</h1>
			</head>

			<div class="page-content">
				<h3>tokiu URL nieko neradom :( gal norite pasižiūrėti kažka įdomiau.</h3>

				<?php get_search_form();?>

				<?php the_widget('WP_Widget_Recent_Posts'); ?>
			</div>

		</section>

	</main>
</div>

<?php get_footer(); ?>