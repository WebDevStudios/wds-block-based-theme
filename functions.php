<?php

/**
 * Enqueue theme styles.
 */
function wds_block_based_theme_scripts() {
		wp_enqueue_style(
			'wdsbbt-theme-style',
			get_stylesheet_directory_uri() . '/style.css',
			array(),
			filemtime( dirname( __FILE__ ) . '/style.css' )
		);
	}
add_action( 'wp_enqueue_scripts', 'wds_block_based_theme_scripts' );

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
	add_theme_support( 'custom-units' );
	add_theme_support( 'block-nav-menus' );
	add_theme_support( 'editor-color-palette',
		[
			[
				'name'  => __( 'strong magenta', 'wdsbbt' ),
				'slug'  => 'strong-magenta',
				'color' => '#a156b4',
			],
			[
				'name'  => __( 'very light gray', 'wdsbbt' ),
				'slug'  => 'very-light-gray',
				'color' => '#f1f1f1',
			],
		]
	);
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'Small', 'wdsbbt' ),
			'size' => 12,
			'slug' => 'small',
		),
		array(
			'name' => __( 'Regular', 'wdsbbt' ),
			'size' => 16,
			'slug' => 'regular',
		),
		array(
			'name' => __( 'Large', 'wdsbbt' ),
			'size' => 36,
			'slug' => 'large',
		),
	) );
};
add_action( 'after_setup_theme', 'wds_block_based_theme_setup' );
