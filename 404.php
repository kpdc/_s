<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Digitate
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
                    <div class="post-wrap">

			<div class="error-404 not-found">
				<header class="page-header">
					<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'digitate' ); ?></h2>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try the search?', 'digitate' ); ?></p>

					<?php
						get_search_form();
					?>

				</div><!-- .page-content -->
			</div><!-- .error-404 -->

                    </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
