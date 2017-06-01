<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digitate
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) : { ?>
            
            <header class="page-header">
                <?php
                    the_archive_title( '<h2 class="page-title">', '</h2>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    
                    if(is_post_type_archive('resources')) { ?>
                
                    <nav class="resource-nav">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'resourcenav',
                                'container' => '',
                            ));
                        ?>
                    </nav>
                    
                <?php } 
                
                if(!is_post_type_archive('resources')) {
                    
                    get_search_form();
                    
                } ?>
                
            </header><!-- .page-header -->
                
                <?php } if(is_post_type_archive('resources')) {
                    
                    get_template_part( 'page','resources' );
                    
                } elseif(is_post_type_archive('newsrooms')) {
                    
                    get_template_part( 'archive','newsrooms' ); 
                    
                } else { ?>

            <div class="blogpost">
                
                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_format() );

                endwhile; ?>
                
            </div>
                
                <?php } else :
                    
                    get_template_part( 'template-parts/content', 'none' );
                
                endif; ?>
                    
                    <?php digitate_paging_nav(); ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
