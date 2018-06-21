	<?php
		get_header();
	?>
	<div class="row all_body">
		<div class="col-sm-9">
			<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.

							$comments_args = array(
								
						        // change the title of send button 
						        'label_submit'=>'išsiųsti',
						        // change the title of the reply section
						        'title_reply'=>'Palikti atsiliepimą',
						        // remove "Text or HTML to be displayed after the set of comment fields"
						        'comment_notes_after' => '',
						        // redefine your own textarea (the comment body)
						        'comment_field' => '<p class="comment-form-comment"><br /><textarea id="comment" name="comment" aria-required="true" class="comment-field"></textarea></p>',

						        'comment_notes_before' => '<p class="comment-notes">' . __( 'Šie laukeliai yra privalomi*.' ) .'</p>',

						        
							); 

						if ( comments_open() || get_comments_number() ) {
							comment_form($comments_args);
						}

						// End of the loop.
					endwhile;
			?>
		</div>
		
		<div class="col-sm-3">
			<?php get_sidebar(); ?>
		</div>

	</div>
	<?php
		get_footer();
	?>
