<?php
/*
Plugin Name: 	Naxos Addons
Description: 	Core features for the Naxos theme.
Version: 		1.1
Author: 		AthenaStudio
Author URI: 	https://themeforest.net/user/athenastudio
License: 		GNU General Public License version 3.0
License URI: 	http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: 	naxos-addons
*/

if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there! I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'NAXOS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Localization
function naxos_plugin_localization( ) {
	load_plugin_textdomain( 'naxos-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action( 'plugins_loaded', 'naxos_plugin_localization' );

// Include features
require_once NAXOS_PLUGIN_DIR . 'linea/icons.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/class.shortcodes.php';
require_once NAXOS_PLUGIN_DIR . 'widgets/class.widgets.php';
require_once NAXOS_PLUGIN_DIR . 'options/class.options.php';
require_once NAXOS_PLUGIN_DIR . 'post-like/post-like.php';

