<?php get_header(); ?>

    <div class="content-area">
        <main>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $newsroom = new WP_Query(array(
                'post_type' => 'newsrooms',
                'posts_per_page' => 12,
                'paged' => $paged,
            ));
            if($newsroom->have_posts()) : 
            ?>
            <header>
                <h2 class="page-title"><?php the_title(); ?></h2>
                <div class="news-filter">
                    <nav>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'newsfilter',
                            'container' => '',
                        ))?>
                    </nav>
                </div>
            </header>
            <section class="event">
                <?php while($newsroom->have_posts()) : $newsroom->the_post(); ?>
                <article>
                    <div class="event-date newsImg">
                        <?php the_post_thumbnail(); ?>
                        <p class="media">
                            <span></span>
                            <?php the_field('name_of_media'); ?>
                        </p>
                        <cite class="media-author"><?php the_field('author_of_media'); ?></cite>
                        <?php  ?>
                    </div>
                    <div class="event-info">
                        <div class="info-details">
                            <h3>
                                <?php the_title(); ?>
                               <cite><?php the_field('date_of_media_publish'); ?></cite>
                            </h3>
                            <?php the_content();
                            if(get_field( 'media_link' )) : ?>
                            <div class="external-link">
                                <a href="<?php the_field('media_link'); ?>">Read more</a>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </article>
                <?php endwhile; ?>
                <?php digitate_custom_pagination($newsroom->max_num_pages,"",$paged); ?>
            </section>
            <?php endif; wp_reset_postdata(); ?>
        </main>
    </div>

<?php get_footer(); ?>