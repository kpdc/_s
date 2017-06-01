<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $resources_group = new WP_Query(array(
        'post_type' => 'resources',
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'resource-tag',
                'terms' => 'faq',
                'field' => 'slug',
                'operator' => 'NOT IN',
            )
        ),
    ));
    
    if ( $resources_group->have_posts() ) : ?>

        <div class="blogpost">
             <?php   /* Start the Loop */
                while ( $resources_group->have_posts() ) : $resources_group->the_post(); ?>
                <article>
                    <?php
                    if( has_post_thumbnail() ) {
                        the_post_thumbnail( 'blog-post-thumbnail' );
                    } else { ?>
                    <img src="<?php bloginfo( 'template_directory' ); ?>/images/noThumb.png" alt="<?php the_title(); ?>">
                    <?php } ?>
                    <div class="source">
                        <div class="excerpt">
                            <p><?php the_title(); ?></p>
                            <a href="<?php the_permalink(); ?>">download &#62;&#62;</a>
                        </div>
                        <div class="meta">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php the_date(); ?>
                        </div>
                    </div>
                </article>

                <?php endwhile; wp_reset_postdata();
                
                else :

                get_template_part( 'template-parts/content', 'none' );
                
                endif ?>
        </div>

        <?php digitate_custom_pagination($resources_group->max_num_pages,"",$paged); ?>