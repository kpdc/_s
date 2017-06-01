<?php get_header(); ?>

    <div class="content-area">
        <main>
            <div class="contact-detail">
                <div class="cForm">
                    <?php if(have_posts()) : ?>
                    <h2 class="page-title"><?php the_title(); ?></h2>
                    
                    <?php 
                    while(have_posts()) : the_post(); 

                    the_content();

                    endwhile; endif;?>
                
                </div>
                
                <div class="location">
                        <h2 class="page-title">Digitate Offices</h2>
                        <?php if(have_rows('addresses')) : while(have_rows('addresses')) : the_row(); 
                            $company_location = get_sub_field('company_location');
                        ?>
                        <div class="address">
                                <?php echo $company_location ?>
                        </div>
                        <?php endwhile; endif; ?>
                </div>
                
                <div class="social">
                        <h2 class="page-title">Connect with us</h2>
                        <ul>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                </div>
                
            </div>
        </main>
    </div>

<?php get_footer(); ?>