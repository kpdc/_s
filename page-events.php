<?php get_header(); ?>

    <div class="content-area">
        <main>
            <h2 class="page-title"><span id="event" class="title-button active">Events<em></em></span> | <span id="webinar" class="title-button">Webinars<em></em></span></h2>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $event_post = new WP_Query(array(
                'post_type' => 'events',
                'posts_per_page' => 5,
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'event-group',
                        'terms' => 'events',
                        'field' => 'slug',
                    )
                ),
            )); ?>
            <section class="event">
                <?php if( $event_post->have_posts() ) : while( $event_post->have_posts() ) : $event_post->the_post(); ?>
                <article>
                    <div class="event-date">
                        <?php
                        $date = get_field('date', false, false);
                        $date = new DateTime($date);
                        ?>
                        <span class="month"><?php echo $date->format('M'); ?></span>
                        <span class="date"><?php echo $date->format('m'); ?></span>
                        <span class="day"><?php echo $date->format('D'); ?></span>
                    </div>
                    <div class="event-info">
                        <div class="info-details">
                            <h3>
                                <?php the_title(); ?>
                                <?php if(get_field( 'venue' )) : ?>
                                <cite class="location">
                                    <?php the_field('venue'); ?>
                                </cite>
                                <?php endif; ?>
                            </h3>
                            <?php the_content();
                            if(get_field( 'external_link' )) : ?>
                            <div class="external-link">
                                <a href="<?php the_field('external_link'); ?>">Learn more</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
                <?php endwhile; endif; wp_reset_postdata(); ?>
                <?php digitate_custom_pagination($event_post->max_num_pages,"",$paged); ?>
                <div class="past-event">
                    <h3>Past Events</h3>
                    <div class="past-event-container">
                        <?php $event_archive = new WP_Query(array(
                            'post_type' => 'events',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'event-group',
                                    'terms' => 'events-archive',
                                    'field' => 'slug',
                                )
                            ),
                        )); ?>
                        <?php if( $event_archive->have_posts() ) : while( $event_archive->have_posts() ) : $event_archive->the_post(); ?>
                        <article>
                            <div class="event-date">
                                <?php
                                $date = get_field('date', false, false);
                                $date = new DateTime($date);
                                ?>
                                <span class="month"><?php echo $date->format('M'); ?></span>
                                <span class="date"><?php echo $date->format('m'); ?></span>
                                <span class="day"><?php echo $date->format('D'); ?></span>
                            </div>
                            <div class="event-info">
                                <div class="info-details">
                                    <h3>
                                        <?php the_title(); ?>
                                        <?php if(get_field( 'venue' )) : ?>
                                        <cite class="location">
                                            <?php the_field('venue'); ?>
                                        </cite>
                                        <?php endif; ?>
                                    </h3>
                                    <?php the_content(); ?>
                                </div>
                                <?php if(get_field( 'external_link' )) : ?>
                                <div class="external-link">
                                    <a href="<?php the_field('external_link'); ?>">Learn more</a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </article>
                        <?php endwhile; endif; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
            <section class="webinar">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $webinar_post = new WP_Query(array(
                    'post_type' => 'events',
                    'posts_per_page' => 5,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'event-group',
                            'terms' => 'webinars',
                            'field' => 'slug',
                        )
                    ),
                )); ?>
                <?php if( $webinar_post->have_posts() ) : while( $webinar_post->have_posts() ) : $webinar_post->the_post(); ?>
                <article>
                    <div class="event-date">
                        <?php
                        $date = get_field('date', false, false);
                        $date = new DateTime($date);
                        ?>
                        <span class="month"><?php echo $date->format('M'); ?></span>
                        <span class="date"><?php echo $date->format('m'); ?></span>
                        <span class="day"><?php echo $date->format('D'); ?></span>
                    </div>
                    <div class="event-info">
                        <div class="info-details">
                            <h3>
                                <?php the_title(); ?>
                                <?php if(get_field( 'webinar_time' )) : ?>
                                <cite class="location">
                                    <?php the_field('webinar_time'); ?>
                                </cite>
                                <?php endif; ?>
                            </h3>
                            <?php the_content();
                            if(get_field( 'external_link' )) : ?>
                            <div class="external-link">
                                <a href="<?php the_field('external_link'); ?>">Join now</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
                <?php endwhile; endif; wp_reset_postdata(); ?>
                <?php digitate_custom_pagination($webinar_post->max_num_pages,"",$paged); ?>
                <div class="past-event">
                    <h3>Past Webinars</h3>
                    <div class="past-event-container">
                        <?php $webinar_archive = new WP_Query(array(
                            'post_type' => 'events',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'event-group',
                                    'terms' => 'webinars-archive',
                                    'field' => 'slug',
                                )
                            ),
                        )); ?>
                        <?php if( $webinar_archive->have_posts() ) : while( $webinar_archive->have_posts() ) : $webinar_archive->the_post(); ?>
                        <article>
                            <div class="event-date">
                                <?php
                                $date = get_field('date', false, false);
                                $date = new DateTime($date);
                                ?>
                                <span class="month"><?php echo $date->format('M'); ?></span>
                                <span class="date"><?php echo $date->format('m'); ?></span>
                                <span class="day"><?php echo $date->format('D'); ?></span>
                            </div>
                            <div class="event-info">
                                <div class="info-details">
                                    <h3>
                                        <?php the_title(); ?>
                                    </h3>
                                    <?php the_content(); ?>
                                </div>
                                <?php if(get_field( 'webinar_video_link' )) : ?>
                                <div class="external-link">
                                    <a href="<?php the_field('webinar_video_link'); ?>">Watch now</a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </article>
                        <?php endwhile; endif; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        </main>
    </div>

<?php get_footer(); ?>