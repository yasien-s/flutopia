<?php
/*
Plugin Name:	Flutopia for Zion
Plugin URI:	https://github.com/yasien-s/flutopia
Description:	Fluid type scale and space via Utopia.fyi
Version:	1.2.3
Author:		Yasien Sarlie
Author URI:	https://sarlie.dev/
License:	GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'wp_enqueue_scripts', 'flutopia_enqueue_files' );
function flutopia_enqueue_files() {
	if ( ! class_exists( 'CT_Component' ) ) { // if Zion is not active
		wp_enqueue_style( 'utopia', plugin_dir_url( __FILE__ ) . 'assets/css/utopia.css' );
		wp_enqueue_style( 'flutopia', plugin_dir_url( __FILE__ ) . 'assets/css/flutopia.css' );
	}
}

// 1000000 priority so it is executed after all Zion's styles
add_action( 'wp_head', 'flutopia_enqueue_css_after_zions', 1000000 );
function flutopia_enqueue_css_after_zions() {
	// if Zion is not active, abort.
	if ( ! class_exists( 'CT_Component' ) ) {
		return;
	}

	$styles = new WP_Styles;
	$styles->add( 'utopia', plugin_dir_url( __FILE__ ) . 'assets/css/utopia.css' );
	$styles->add( 'flutopia', plugin_dir_url( __FILE__ ) . 'assets/css/flutopia.css' );
	$styles->enqueue( array ( 'utopia', 'flutopia' ) );
	$styles->do_items();
}
