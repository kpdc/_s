<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Digitate
 */

if ( ! function_exists( 'digitate_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function digitate_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'digitate' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'Written by %s', 'post author', 'digitate' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $byline . '</span><span class="byline"> ' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'digitate_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function digitate_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'digitate' ) );
		if ( $categories_list && digitate_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'digitate' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'digitate' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'digitate' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'digitate' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'digitate' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'digitate_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */

function digitate_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 2,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '← Previous', 'digitate' ),
		'next_text' => __( 'Next →', 'digitate' ),
                'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'digitate' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
    
endif;

if( ! function_exists( 'custom_pagination' )) :

function digitate_custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('← Previous', 'digitate'),
    'next_text'       => __('Next →', 'digitate'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='navigation paging-navigation'>";
    echo $paginate_links;
    echo "</nav>";
  }

}
endif;


if ( ! function_exists( 'digitate_post_nav' ) ) :
    
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function digitate_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
            <div class="post-nav-box clear">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'digitate' ); ?></h1>
		<div class="nav-links">
			<?php
                            previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . _x( 'Previous Post:', 'Previous post', 'digitate' ) . '</div><h1>%link</h1></div>', '%title', TRUE );
                            next_post_link(     '<div class="nav-next"><div class="nav-indicator">' . _x( 'Next Post:', 'Next post', 'digitate' ) . '</div><h1>%link</h1></div>', '%title', TRUE );
                        ?>
		</div><!-- .nav-links -->
            </div>
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function digitate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'digitate_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'digitate_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so digitate_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so digitate_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in digitate_categorized_blog.
 */
function digitate_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'digitate_categories' );
}
add_action( 'edit_category', 'digitate_category_transient_flusher' );
add_action( 'save_post',     'digitate_category_transient_flusher' );

function digitate_home_category($query) {
    if($query->is_home() && $query->is_main_query()) {
        $query->set('cat','1');
    }
}
add_action( 'pre_get_posts', 'digitate_home_category' );

/**
*
* Prevent Wordpress from wrapping images and iframes in p tags
* http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
* ( <p> and <iframe> and ACF support - http://wordpress.stackexchange.com/questions/136840/how-to-remove-p-tags-around-img-and-iframe-tags-in-the-acf-wysiwyg-field
*/
// Default Wordpress WYSIWYG
function digitate_filter_ptags_on_images_iframes($content)
{
    $content_wp = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content_wp);
}
add_filter('the_content', 'digitate_filter_ptags_on_images_iframes');

// ACF WYSIWYG Plugin
function digitate_filter_ptags_on_images_iframes_acf($content)
{
    $content_acf = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content_acf);
}
add_filter('acf_the_content', 'digitate_filter_ptags_on_images_iframes_acf');

// Add current-page-item class to nav li for CPT
function digitate_custom_menu_item_classes($classes = array(), $menu_item = false){
    //use this format for removing highlighting
    // if((is_singular('works') || is_post_type_archive('works')) && $menu_item->ID == $blog_menu_item) {
            // $classes = array();
    // }
    //use this format for adding highlighting
    if((is_singular('resources') || is_post_type_archive('resources')) && $menu_item->ID == 163) {
            $classes[] = 'current-menu-item';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'digitate_custom_menu_item_classes', 10, 2);

// moving Jetpack Share Button to the top of the post
function digitate_move_jp_sharing( $content ) {
	
	if ( is_singular( 'post' ) && function_exists( 'sharing_display' ) ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
		$content = sharing_display() . $content;
	}
	
	return $content;
}
add_filter( 'the_content', 'digitate_move_jp_sharing' );

// Remove [] from excerpt
function digitate_excerpt_more( $text ) {
    $text = '...';
    return $text;
}
add_filter( 'excerpt_more', 'digitate_excerpt_more' );

// Reduce Excerpt wording.
function digitate_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'digitate_custom_excerpt_length', 999 );

// Limit search results to only blog posts
/**
 * Restrict native search widgets to the 'post' post type
 */
// Change search function globally to search only post, page and portfolio post types
function digitate_limit_post_types_in_search( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array( 'post' ) );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'digitate_limit_post_types_in_search' );



//add_filter( 'widget_title', function( $title, $instance, $id_base )
//{
//    // Target the search base
//    if( 'search' === $id_base )
//        add_filter( 'get_search_form', 'digitate_post_type_restriction' );
//    return $title;
//}, 10, 3 );
//
//function digitate_post_type_restriction( $html )
//{
//    // Only run once
//    remove_filter( current_filter(), __FUNCTION__ );
//
//    // Inject hidden post_type value
//    return str_replace( 
//        '</form>', 
//        '<input type="hidden" name="post_type" value="post" /></form>',
//        $html 
//    );
//}