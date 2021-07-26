<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel='stylesheet' id='font-awesome-css'  href='<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.min.css' type='text/css' media='all' />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ct-custom' ); ?></a>

	<header id="masthead" class="site-header">
        <div id="tophead" class="container-fluid">
            <div class="row">
            <div class="callnow"> Call Us Now! <a href="tel:<?php echo get_option('ct_phone'); ?>"><?php echo get_option('ct_phone'); ?></a></div>
            <div class="access"><a href="#">Login</a>  <a href="#">SignUp</a> </div>
            </div>
        </div>
        <div id="logoarea" class="container-fluid">
            <div class="row">
                <div class="site-branding">
                <img src="<?php echo get_option('ct_logo'); ?>" alt="logo" />
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ct-custom' ); ?></button>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                    ) );
                    ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content row">

<?php breadcrumbs(); ?>

