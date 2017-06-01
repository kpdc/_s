<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Digitate
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php /* App Icons */ ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory') ?>/favicon.ico">
<!-- Standard iPhone --> 
<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory') ?>/icon-57.png">
<!-- Retina iPhone --> 
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory') ?>/icon-114.png">
<!-- Standard iPad --> 
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory') ?>/icon-72.png">
<!-- Retina iPad --> 
<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory') ?>/icon-144.png">

<?php wp_head(); ?>
</head>

<body id="<?php echo (is_page()) ? get_query_var('name') : ((is_home()) ? "home" : ((is_single()) ? "single": ((is_category()) ? single_cat_title() : ((is_archive()) ? "archive" : "")))); ?>" <?php body_class(); ?>>
<div class="pageWrap">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'digitate' ); ?></a>

	<header class="site-header" role="banner">
                <hgroup class="wrap">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-button"><img src="<?php bloginfo('template_directory') ?>/images/digitate.png" alt="Digitate" class="headbrand"></a>
                    <div class="toggleWrap">
	                    <div class="toggle">
	                        <div class="top"><span></span></div>
	                        <div class="center"><span></span></div>
	                        <div class="bottom"><span></span></div>
	                    </div>
                    </div>
                    <nav class="site-header-menu">
	                    <img src="<?php bloginfo('template_directory') ?>/images/digitate.png" alt="Digitate" class="sub-headbrand">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container' => '',
                            ));
                        ?>
                    </nav>
                </hgroup>
	</header><!-- #masthead -->

	<div class="container">
            <?php if(is_front_page() || is_page( array('product', 'learn', 'resolve', 'prevent') )) : ?>
                <div id="content" class="site-content">
            <?php else : ?>
                <div id="content" class="site-content wrap">
            <?php endif; ?>
