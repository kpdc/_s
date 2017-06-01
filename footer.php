<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Digitate
 */

?>

        </div><!-- .site-content -->
    </div><!-- .container -->

    <footer class="site-footer">
        <div class="wrap">
            <img src="<?php bloginfo('template_directory') ?>/images/digitate.png" alt="digitate" class="foot-brand">
            <div class="contact-group">
                <?php $foot_content = new WP_Query(array('pagename' => 'footer'));
                while($foot_content->have_posts()) : $foot_content->the_post();
                the_content();
                endwhile; wp_reset_postdata();
                ?>
            </div>
            <nav class="privacy">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footnav',
                        'container' => '',
                    ));
                ?>
            </nav>
        </div><!-- .wrap -->
        <div class="sitemap">
            <nav class="resource-nav">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footsitemap',
                        'container' => '',
                    ));
                ?>
            </nav>
        </div>
    </footer><!-- .site-footer -->
    <div class="demo">
        <p class="demo-button">Request a Demo</p>
        <div class="eform">
            <div class="close">x</div>
            <?php echo do_shortcode( '[contact-form-7 id="47" title="Request a Demo"]' ); ?>
        </div>
    </div>
</div><!-- .pageWrap -->

<?php wp_footer(); ?>

</body>
</html>