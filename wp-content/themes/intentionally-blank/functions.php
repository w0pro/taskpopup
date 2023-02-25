<?php
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
function theme_name_scripts() {

    wp_enqueue_script( 'jquery');
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js');

    wp_localize_script(
        'script',
        'feedback_object',
        array(
            'url'   => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'feedback-nonce' ),
        )
    );

}

get_template_part( 'templates/shortcodes/shortcodes');
get_template_part( 'templates/Classes/Mail');


add_action( 'wp_ajax_mail', 'send_mail' );
add_action( 'wp_ajax_nopriv_mail', 'send_mail' );

function send_mail () {
    Mail::check_form_fields($_POST);
}




/**
 * Intentionally Blank Theme functions
 *
 * @package WordPress
 * @subpackage intentionally-blank
 */

if ( ! function_exists( 'blank_setup' ) ) :
	/**
	 * Sets up theme defaults and registers the various WordPress features that
	 * this theme supports.
	 */
	function blank_setup() {
		load_theme_textdomain( 'intentionally-blank' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// This theme allows users to set a custom background.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'f5f5f5',
			)
		);

		add_theme_support( 'custom-logo' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 256,
				'width'       => 256,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);
	}
endif; // end function_exists blank_setup.
add_action( 'after_setup_theme', 'blank_setup' );

/**
 * Sets up theme defaults and registers the various WordPress features that
 * this theme supports.

 * @param class $wp_customize Customizer object.
 */
function blank_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'static_front_page' );

	$wp_customize->add_section(
		'blank_footer',
		array(
			'title'      => __( 'Footer', 'intentionally-blank' ),
			'priority'   => 120,
			'capability' => 'edit_theme_options',
			'panel'      => '',
		)
	);
	$wp_customize->add_setting(
		'blank_copyright',
		array(
			'type'              => 'theme_mod',
			'default'           => __( 'Intentionally Blank - Proudly powered by WordPress', 'intentionally-blank' ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	/**
	 * Checkbox sanitization function

	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function blank_sanitize_checkbox( $checked ) {
		// Returns true if checkbox is checked.
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
	$wp_customize->add_setting(
		'blank_show_copyright',
		array(
			'default'           => true,
			'sanitize_callback' => 'blank_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'blank_copyright',
		array(
			'type'     => 'textarea',
			'label'    => __( 'Copyright Text', 'intentionally-blank' ),
			'section'  => 'blank_footer',
			'settings' => 'blank_copyright',
			'priority' => '10',
		)
	);
	$wp_customize->add_control(
		'blank_footer_copyright_hide',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Show Copyright Text', 'intentionally-blank' ),
			'section'  => 'blank_footer',
			'settings' => 'blank_show_copyright',
			'priority' => '20',
		)
	);
}
add_action( 'customize_register', 'blank_customize_register', 100 );
