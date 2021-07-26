<?php
/**
 * CT Custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CT_Custom
 */

if ( ! function_exists( 'ct_custom_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ct_custom_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CT Custom, use a find and replace
		 * to change 'ct-custom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ct-custom', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ct-custom' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ct_custom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ct_custom_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ct_custom_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ct_custom_content_width', 640 );
}
add_action( 'after_setup_theme', 'ct_custom_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ct_custom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ct-custom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ct-custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ct_custom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ct_custom_scripts() {
	wp_enqueue_style( 'ct-custom-style', get_stylesheet_uri() );
    
	wp_enqueue_script( 'ct-custom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ct-custom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
}
add_action( 'wp_enqueue_scripts', 'ct_custom_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

function ct_custom_settings_page(){
    ?>
	    <div class="wrap">
	    <h1>CT Settings</h1>
	    <form method="post" enctype="multipart/form-data" action="options.php">
	        <?php
	            settings_fields("ctsettings");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function add_ct_custom_menu_item()
{
	add_menu_page("CT Settings", "CT Settings", "manage_options", "ct-settings", "ct_custom_settings_page", null, 99);
}

add_action("admin_menu", "add_ct_custom_menu_item");

function ct_logo_display()
{
	?>
        <input type="file" name="ct_logo" />
        <img src="<?php echo get_option('ct_logo'); ?>" alt="" />
   <?php
}

function ct_logo_upload($option)
{
    if(!empty($_FILES['ct_logo']['tmp_name']))
    {
        $urls = wp_handle_upload($_FILES["ct_logo"], array('test_form' => FALSE));
        $temp = $urls["url"];
       return $temp;
    }

  return $option;
} 

function ct_physical_address()
{
	?>
    	<textarea name="ct_address" id="ct_address" placeholder="Address"><?php echo get_option('ct_address'); ?></textarea>
    <?php
}

function ct_phone_number()
{
	?>
    	<input type="text" name="ct_phone" id="ct_phone" placeholder="Phone Number" value="<?php echo get_option('ct_phone'); ?>" />
    <?php
}

function ct_fax_number()
{
	?>
    	<input type="text" name="ct_fax" id="ct_fax" placeholder="Fax Number" value="<?php echo get_option('ct_fax'); ?>" />
    <?php
}

function ct_twitter_link()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" placeholder="twitter url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function ct_facebook_link()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" placeholder="facebook url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function ct_linkedin_link()
{
	?>
    	<input type="text" name="linkedin_url" id="linkedin_url" placeholder="linkedin url" value="<?php echo get_option('linkedin_url'); ?>" />
    <?php
}

function ct_settings_fields()
{
	add_settings_section("ctsettings", "", null, "theme-options");
    
    
    register_setting("ctsettings", "ct_logo", "ct_logo_upload");
    add_settings_field("ct_logo", "Logo", "ct_logo_display", "theme-options", "ctsettings");  
    
    

    add_settings_field("ct_address", "Address", "ct_physical_address", "theme-options", "ctsettings");
    register_setting("ctsettings", "ct_address");

    add_settings_field("ct_phone", "Phone", "ct_phone_number", "theme-options", "ctsettings");
    register_setting("ctsettings", "ct_phone");

    add_settings_field("ct_fax", "Fax", "ct_fax_number", "theme-options", "ctsettings");
    register_setting("ctsettings", "ct_fax");
	
	add_settings_field("twitter_url", "Twitter Url", "ct_twitter_link", "theme-options", "ctsettings");
    register_setting("ctsettings", "twitter_url");

    add_settings_field("facebook_url", "Facebook Url", "ct_facebook_link", "theme-options", "ctsettings");
    register_setting("ctsettings", "facebook_url");

    add_settings_field("linkedin_url", "LinkedIn Url", "ct_linkedin_link", "theme-options", "ctsettings");
    register_setting("ctsettings", "linkedin_url");
}

add_action("admin_init", "ct_settings_fields");

//show the breadcrub
function breadcrumbs($id = null){
    ?>
    <div id="breadcrumbs">
        <a href="<?php bloginfo('url'); ?>">Home</a></span> /
        <?php if(!empty($id)): ?>
        <a href="<?php echo get_permalink( $id ); ?>" ><?php echo get_the_title( $id ); ?></a> /
        <?php endif; ?>
        <span class="breadcrumb_last"><?php the_title(); ?></span>
    </div>
    <?php }