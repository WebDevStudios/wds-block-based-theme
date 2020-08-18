<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function wds_block_based_theme_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette',
		[
			[
				'name'  => __( 'strong magenta', 'wdsbbt' ),
				'slug'  => 'strong-magenta',
				'color' => '#a156b4',
			],
			[
				'name'  => __( 'very dark gray', 'wdsbbt' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			],
		]
	);
};
add_action( 'after_setup_theme', 'wds_block_based_theme_setup' );

/**
 * Enqueue theme scripts and styles.
 */
function wds_block_based_theme_scripts() {
	wp_enqueue_style( 'wdsbbt-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wds_block_based_theme_scripts' );
