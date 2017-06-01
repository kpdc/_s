<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digitate
 */

?>

<?php if(is_page( array('product', 'about', 'partner') )) { ?>
    <div class="slide">
            <div class="intro">
                    <div class="intro-container">
                            <?php the_post_thumbnail(); ?>
                            <div class="intro-text wrap">
                                    <?php the_content(); ?>
                            </div>
                    </div>
            </div>
    </div><!-- slide -->
    <section class="quick-link">
        <?php if(have_rows('quick_link_field')) : ?>
            <div class="content-wrapper wrap">
                <?php while(have_rows('quick_link_field')) : the_row(); 
                    $image = get_sub_field('image');
                    $title = get_sub_field('title');
                    $text = get_sub_field('short_text');
                    $link = get_sub_field('link');
                ?>
                    <div class="quick-link-thumb">
                            <a href="<?php echo $link; ?>" class="thumb-link"><img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>"></a>
                            <div class="quick-link-title">
                                    <a href="<?php echo $link; ?>"><?php echo $title; ?> <span></span></a>
                                    <?php echo $text; ?>
                            </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </section>
<?php } elseif(is_page( array('learn', 'resolve', 'predict') )) { ?>
    <div class="slide">
            <div class="wrap">
                    <?php the_post_thumbnail(); ?>
                    <div class="intro-main-text">
                            <h3 class="page-title"><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                    </div>
            </div>
    </div>
    <div class="product-intro">
            <div class="intro-sub wrap">
                    <?php the_field('introduction_contents'); ?>
            </div>
    </div>
<?php } else { ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                    <?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                    <?php
                            the_content();

                            wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'digitate' ),
                                    'after'  => '</div>',
                            ) );
                    ?>
            </div><!-- .entry-content -->

            <?php if ( get_edit_post_link() ) : ?>
                    <footer class="entry-footer">
                            <?php
                                    edit_post_link(
                                            sprintf(
                                                    /* translators: %s: Name of current post */
                                                    esc_html__( 'Edit %s', 'digitate' ),
                                                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                            ),
                                            '<span class="edit-link">',
                                            '</span>'
                                    );
                            ?>
                    </footer><!-- .entry-footer -->
            <?php endif; ?>
    </article><!-- #post-## -->
    
<?php } ?>

