<?php get_header(); ?>

    <div class="content-area">
        <main>
            <div class="slide">
                <div class="home-slide">
                    <div class="home-slide-container">
                        <img src="<?php bloginfo('template_directory')?>/images/home-slide.jpg" alt="" class="wp-post-image">
                        <div class="home-slide-content wrap">
                            <img src="<?php bloginfo('template_directory') ?>/images/ignio.png" alt="ignio" class="ignioBrand">
                            <p>Cognitive automation <br>system for enterprises</p>
                        </div>
                    </div> <!-- .home-slide-container -->

                    <?php
                    $slide = new WP_Query(array(
                        'post_type' => 'post',
                        'cat' => 8,
                        'posts_per_page' =>2,
                    ));

                    if($slide->have_posts()) : while($slide->have_posts()) : $slide->the_post();
                    ?>
                    <div class="home-slide-container post-slide-container">
                        <?php if(has_post_thumbnail()) {
                            the_post_thumbnail();
                        } ?>
                        <div class="home-slide-content wrap">
                            <div class="innerWrap">
                                <h2><?php the_title(); ?></h2> 
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div> <!-- .home-slide-container -->
                    <?php
                    endwhile; endif; wp_reset_postdata();
                    ?>
                </div> <!-- .home-slide -->
        </div> <!-- .slide -->
            <section class="quick-link">
                <?php if(have_rows('quick_link_field')) : ?>
                    <div class="content-wrapper">
                        <?php while(have_rows('quick_link_field')) : the_row(); 
                            $image = get_sub_field('image');
                            $title = get_sub_field('title');
                            $text = get_sub_field('short_text');
                            $link = get_sub_field('link');
                        ?>
                            <div class="quick-link-thumb">
                                <a href="<?php echo $link; ?>" class="thumb-link">
                                    <div class="quick-link-title">
                                        <h3><?php echo $title; ?><span></span></h3>
                                        <?php echo $text ?>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div> <!-- .content-wrapper -->
                <?php endif; ?>
            </section> <!-- .quick-links -->

            <?php if( get_field('custom_row_1') ) : ?>
            <section class="testimonial">
                <div class="content-wrapper">
                    <div class="testimonial-group-info">
                        <div class="wrap">
                            <div class="testimonial-excerpt">
                                <?php the_field('custom_row_1'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- .testimonial -->
            <?php endif; ?>

            <section class="home-post">
                <?php $blog_post = new WP_Query( array(
                    'post_type' => 'post',
                    'posts_per_page' => 1,
                    'cat' => -9,
                ) ); ?>
                <div class="content-wrapper">
                    <div class="wrap">
                        <?php while($blog_post->have_posts()) : $blog_post->the_post(); ?>
                        <div class="home-post-container">
                            <h2 class="home-post-title"><?php the_title() ?></h2>
                            <?php the_excerpt() ?>
                            <p><a href="<?php the_permalink(); ?>">Find out More</a></p>
                        </div>
                        <?php endwhile; wp_reset_postdata() ?>
                    </div>
                </div>
            </section> <!-- .home-post -->
            <?php $announcement_post = new WP_Query( array(
                'post_type' => 'post',
                'posts_per_page' => 2,
                'cat' => 9,
            ) ); 
     
            if(have_posts()) : 
            ?>
            <section class="announcement">
                <div class="content-wrapper">
                    <div class="wrap">
                        <div class="announcement-container">
                            <?php while($announcement_post->have_posts()) : $announcement_post->the_post(); ?>
                            <div class="announcement-info">
                                <h2 class="announcement-title"><?php the_title() ?></h2>
                                <?php the_excerpt() ?>
                                <p><a href="<?php the_permalink() ?>">Find out More <span></span></a></p>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </section> <!-- .announcement -->
            <?php endif; wp_reset_postdata(); ?>
            <?php if( get_field('custom_row_4') ) : ?>
            <section class="demo-query">
                <div class="content-wrapper">
                    <div class="wrap">
                        <div class="demo-query-excerpt">
                            <?php the_field('custom_row_4'); ?>
                        </div>
                    </div>
                </div>
            </section> <!-- .demo-query -->
            <?php endif; ?>
        </main>
    </div> <!-- .content-area -->

<?php get_footer(); ?>