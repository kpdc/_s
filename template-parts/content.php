<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digitate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if(is_home() || is_archive()) { ?>
        <?php if( has_post_thumbnail() ) {
            the_post_thumbnail( 'blog-post-thumbnail' );
        } else { ?>
        <img src="<?php bloginfo( 'template_directory' ); ?>/images/noThumb.png" alt="<?php the_title(); ?>">
        <?php } ?>
        <div class="source">
                <div class="excerpt">
                        <p><?php the_title(); ?></p>
                        <a href="<?php the_permalink(); ?>">more &#62;&#62;</a>
                </div>
                <div class="meta">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php digitate_posted_on(); ?>
                </div>
        </div>
        
    <?php } else { ?>
        
        <header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php digitate_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'digitate' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'digitate' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php digitate_entry_footer(); ?>
	</footer><!-- .entry-footer -->
        
    <?php } ?>
    
	
</article><!-- #post-## -->