<?php
/*
Plugin Name: WP Curtain
Plugin URI: https://wpgurus.net/wp-curtain/
Description: WP Curtain is a simple plugin that allows you to hide your website from the general public and display an elegant countdown timer.
Version: 1.0.0
Author: WPGurus
Author URI: https//wpgurus.net/
License: GPL2
*/

function wpc_redirect() {
	$wpc_settings = wpc_get_settings();
	if ( !is_user_logged_in() || !current_user_can($wpc_settings['minimum_role']) ){
		include('template.php');
		exit();
	}
}
add_action('template_redirect', 'wpc_redirect', 1);

function wpc_scripts_styles(){
	$wpc_settings = wpc_get_settings();
	wp_enqueue_style('wpc-stylesheet', plugins_url( 'static/css/style.min.css' , __FILE__ ) );
	wp_enqueue_script('wpc-script', plugins_url( 'static/js/script.js' , __FILE__ ), array('jquery'));
	wp_localize_script('wpc-script', 'wpc_settings', $wpc_settings);

	if(!$wpc_settings['disable_timer'] && $wpc_settings['future_date'])
	{
		wp_enqueue_script('flipclock', plugins_url( 'static/js/flipclock.package.min.js' , __FILE__ ), array('jquery'));
	}
}
add_action('wp_enqueue_scripts', 'wpc_scripts_styles', 1);

function wpc_rollback(){
	delete_option('wpc_settings');
}
register_uninstall_hook(__FILE__, 'wpc_rollback');

function wpc_get_settings()
{
	return wp_parse_args(
		get_option('wpc_settings'),
		array(
			'page_title'        => "We'll be right back",
			'page_heading'      => "We'll be right back",
			'page_description'  => 'Please try again later',
			'disable_timer'     => false,
			'future_date'       => false,
			'disable_login_box' => false,
			'redirect_url'      => '',
			'minimum_role'      => 'install_plugins'
		)
	);
}

function wpc_get_value($array, $key = array()) {
	if (!is_array($key)) {
		$key = array($key);
	}

	if (!is_array($array)) {
		return NULL;
	}

	$value = $array;
	foreach ($key as $key_part) {
		$value = isset($value[ $key_part ]) ? $value[ $key_part ] : NULL;
	}

	return $value;
}

include('options-panel.php');