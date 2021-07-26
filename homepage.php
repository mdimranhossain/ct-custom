<?php
/**
 * Template Name: HomePage
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <div class="row">
        <div class="contactus">
            <h3>Contact Us</h3>
            <p>
            <?php echo do_shortcode('[contact-form-7 id="21" title="Contact Us"]'); ?>
            </p>
        </div>
        <div class="reachus">
        <h3>Reach Us</h3>
        <p><?php echo nl2br(get_option('ct_address')); ?></p>
        <p>Phone: <?php echo get_option('ct_phone'); ?><br/>
            Fax: <?php echo get_option('ct_fax'); ?></p>
        <div class="social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest"></i></a>
        </div>
        </div>
    </div>

<?php
get_footer();
