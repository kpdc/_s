<article>
        <div class="category">
                <?php
                    /* translators: used between list items, there is a space after the comma */
                    $category_list = get_the_category_list( __( ', ', 'digitate' ) );

                    if ( digitate_categorized_blog() ) {
                        echo '<div class="category-list">' . $category_list . '</div>';
                    }
                ?>
        </div>
        <div class="title">
                <h1><?php the_title(); ?></h1>
        </div>
        <div class="meta">
                <?php digitate_posted_on(); ?>
                <div class="tags">
                        <?php
                            echo get_the_tag_list( '<i class="fa fa-tag"></i> ', ' <i class="fa fa-tag"></i> ', '' );
                        ?>
                </div>
        </div>
        <div class="post">
                <?php the_post_thumbnail(); ?>
                <div class="txt">
                        <?php the_content(); ?>
                    <?php
                            wp_link_pages( array(
                                    'before' => '<div class="page-links">' . __( 'Pages:', 'digitate' ),
                                    'after'  => '</div>',
                            ) );
                    ?>
                </div>
                <div class="interactive">
                        <div class="comments">
                                <?php 
                                    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                                        echo '<span class="comments-link">';
                                        comments_popup_link( __( 'Leave a comment', 'my-simone' ), __( '1 Comment', 'my-simone' ), __( '% Comments', 'my-simone' ) );
                                        echo '</span>';
                                    }
                                ?>
                        </div>
                </div>
        </div>
</article>

