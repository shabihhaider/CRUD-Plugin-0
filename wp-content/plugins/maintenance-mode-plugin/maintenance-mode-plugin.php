<?php
/**
 * Plugin Name: Maintenance Mode Plugin
 * Description: Display a maintenance message to non-logged-in users while allowing logged-in users to browse normally.
 * Version: 1.0.0
 * Author: Muhammad Shabih Haider
 * License: GPL2+
 */

defined('ABSPATH') || exit;

// Constants
define("MM_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("MM_PLUGIN_URL", plugin_dir_url(__FILE__));

// Include Main Class
include_once MM_PLUGIN_PATH . "class/MMP_MaintenanceMode.php";

// Initialize Plugin
add_action('plugins_loaded', function () {
    new MMP_MaintenanceMode();
});
