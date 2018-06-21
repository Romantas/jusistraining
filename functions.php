<?php

//Include Scripts

function AR_script_enqueue()
{
	//css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
	wp_enqueue_style('custumstyle-css',get_template_directory_uri().'/css/AR.css', array(), '1.0.0', 'all');
	//js
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
	wp_enqueue_script('custumjs',get_template_directory_uri().'/js/AR.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'AR_script_enqueue');

//Menus Functions

function AR_theme_setup()
{
	add_theme_support('menus');
	register_nav_menu('primary','Primary Header Navigation');
	register_nav_menu('secondary','Footer Navigation');
}
add_action('init','AR_theme_setup');

//Theme Support Functions

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('aside','image','video'));
add_theme_support('html5', array('search-form'));

//Sidebar Function

function AR_widget_setup()
{
	register_sidebar(array
		(

			'name'	=> 'sidebar',
			'id' 	=> 'sidebar-1',
			'class' => 'sidebar-custom',
			'description' => 'Standart sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',

		)
	);
}
add_action('widgets_init','AR_widget_setup');

//Walker Function

require get_template_directory() . '/inc/walker.php';

//Head Function

function AR_remove_version()
{
	return '';
}
add_filter('the_generator','AR_remove_version');

//Post Type

function AR_custom_post_type()
{
	$labels = array(
		'name' => 'portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Pridėti elementą',
		'all_items' => 'Visi elementai',
		'add_new_item' => 'Pridėti elementą',
		'edit_item' => 'Koreguoti elementą',
		'new_item' => 'Naujas elementas',
		'view_item' => 'Žiūrėti elementą',
		'search_item' => 'Ieškoti elemento',
		'not_found' => 'Tokio elemento nerasta',
		'not_found_in_trash' => 'Tokio elemento nerasta šiukšlių dėžeje',
		'parent_item_colon' => 'Pagrindinis elementas'

		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'revisions',

			),
		//'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => true,
		);
	register_post_type('portfolio', $args);
}
add_action('init', 'AR_custom_post_type');

function AR_custom_taxonomies()
{
	$labels = array(
		'name' => 'Kategorijos',
		'singular_name' => 'Kategorija',
		'search_items' => 'Ieskoti kategoriju',
		'not_found' => 'Nerasta jokiu kategoriju',
		'all_items' => 'Visos kategorijos',
		'parent_item' => 'Pagrindine kategorija',
		'parent_item_colon' => 'Pagrindine kategorija:',
		'edit_item' => 'Koreguoti kategorija',
		'update_item' => 'Atnaujinti',
		'add_new_item' => 'Prideti kategorija',
		'new_item_name' => 'Kategorijos pavadinimas',
		'menu_name' => 'Kategorija',
		);
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'kategorija'),
		);

	register_taxonomy('Kategorija', array('portfolio'), $args);


	register_taxonomy('softwaras', 'portfolio', array(
		'label' => 'Softwaras',
		'rewrite' => array('slug' => 'softwaras'),
		'hierarchical' => false,
		) );
}
add_action('init', 'AR_custom_taxonomies');

//Term Function

function AR_get_terms( $postID, $term ){
	
	$terms_list = wp_get_post_terms($postID, $term); 
	$output = '';
					
	$i = 0;
	foreach( $terms_list as $term ){ $i++;
		if( $i > 1 ){ $output .= ', '; }
		$output .= '<a href="' . get_term_link( $term ) . '">'. $term->name .'</a>';
	}
	
	return $output;
	
}

function AR_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( ' Daugiau', 'textdomain' )
    );
}

//filtrai
add_filter( 'excerpt_more', 'AR_excerpt_more' );

add_filter('comment_form_default_fields', 'AR_custom_fields');
function AR_custom_fields($fields) {

    $commenter = wp_get_current_commenter();
    $req = false;
    $aria_req = ( $req ? " aria-required='false'" : '' );

    $fields[ 'author' ] = '<p class="comment-form-author">'.
      '<label for="author">' . __( 'Vardas  ' ) . '</label>'.
      ( $req ? '<span class="required">*</span>' : '' ).
      '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .
      '" size="30" tabindex="1"' . $aria_req . ' /></p>';

    $fields[ 'email' ] = '<p class="comment-form-email">'.
      '<label for="email">' . __( 'Pastas  ' ) . '</label>'.
      ( $req ? '<span class="required">*</span>' : '' ).
      '<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .
      '" size="30"  tabindex="2"' . $aria_req . ' /></p>';

    $fields[ 'url' ] = '<p class="comment-form-url">'.
      '<label for="url">' . __( 'Puslapis' ) . '</label>'.
      '<input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .
      '" size="30"  tabindex="3" /></p>';

      

  return $fields;
}

// truncate string at word
function shapeSpace_truncate_string($phrase, $max_words) {
	
	$phrase_array = explode(' ', $phrase);
	
	if (count($phrase_array) > $max_words && $max_words > 0) 
		$phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . __('...', 'shapespace');
	
	return $phrase;
	
}

// get recent comments
function shapeSpace_get_recent_comments() {
	
	$args = array();
	
	$comments_query = new WP_Comment_Query;
	$comments = $comments_query->query($args);
	
	$recent_comments = '';
	
	if ($comments) {
		
		$recent_comments .= '<ul class="atsiliepimai_ul">';
		
		foreach ($comments as $comment) {
			
			$id      = $comment->comment_ID;
			$author  = $comment->comment_author;
			$comment = $comment->comment_content;
			$date    = $comment->comment_url;
			$url     = get_comment_link($id);
			$avatar  = get_avatar($author);
			
			$recent_comments .= '<li class="atsiliepimai_li"><a href="'. $url .'" title="'. $date .'">'. $author .'</a>: ';
			$recent_comments .= '</br>';
			$recent_comments .= '<p class="atsiliepimai_p">'. shapeSpace_truncate_string(wp_strip_all_tags($comment, true), 12) .'</p>';
			$recent_comments .= $avatar;
			$recent_comments .= '</li>';
			
		}
		
		$recent_comments .= '</ul>';
		
	} else {
		
		$recent_comments = '<p>'. __('No recent comments.', 'shapespace') .'</p>';
		
	}
	
	return $recent_comments;
	
}

add_filter( 'avatar_defaults', 'new_default_avatar' );

function new_default_avatar ( $avatar_defaults ) {
		//Set the URL where the image file for your avatar is located
		$new_avatar_url = get_bloginfo( 'template_directory' ) . '/images/new_default_avatar.png';
		//Set the text that will appear to the right of your avatar in Settings>>Discussion
		$avatar_defaults[$new_avatar_url] = 'Your New Default Avatar';
		return $avatar_defaults;
	}

//footer widget area

function AR_footer_widget_area()
{
	register_sidebar( array(
	'name' => 'Footer Sidebar 1',
	'id' => 'footer-sidebar-1',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
}

add_action('widgets_init', 'AR_footer_widget_area');
?>


