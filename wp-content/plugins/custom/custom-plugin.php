<?php

// Class 01

/*
Plugin Name: Employee Management System
Plugin URI: http://example.com/plugins/custom-plugin/
Description: This is a CRUD Employee Management System
Author: Muhammad Shabih Haider
Version: 1.0
Author URI: http://myPortfolio.com
Requires at least: 6.8.1
Requires PHP: 7.4
*/

// define const plugin directory path
define("EMS_PLUGIN_DIR", plugin_dir_path(__FILE__));

define("EMS_PLUGIN_URL", plugin_dir_url(__FILE__)); // For CSS and JS

// Class 02

// Calling action Hook to add Menu
add_action("admin_menu", "cp_add_admin_menu");

// Add Admin menu
function cp_add_admin_menu() {
    add_menu_page("Employee System | Employee Management System", 
    "Employee System", 
    "manage_options", 
    "ems-plugin", 
    "ems_crud_system",
    "dashicons-businessman", 
    "23");

    // Add submenu
    add_submenu_page("ems-plugin",
    "Add Employee",
    "Add Employee",
    "manage_options",
    "ems-plugin",
    "ems_crud_system");

    add_submenu_page("ems-plugin",
    "List Employee",
    "List Employee",
    "manage_options",
    "ems-list-employee",
    "ems_list_system");
}

// Handle Admin menu
function ems_crud_system() {
    include_once(EMS_PLUGIN_DIR."pages/add-employee.php");
}

// Submenu callback function
function ems_list_system() {
   include_once(EMS_PLUGIN_DIR."pages/list-employee.php");
}

// Plugin Activation
register_activation_hook(__FILE__, "ems_create_table");

function ems_create_table() {

    global $wpdb;
    $table_prefix = $wpdb->prefix; // In our case, prefix is 'wp_', it can be different in different cases

    $sql = "
    CREATE TABLE {$table_prefix}ems_form_data (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(120) DEFAULT NULL,
        `email` varchar(80) DEFAULT NULL,
        `phoneNo` int DEFAULT NULL,
        `gender` enum('male','female','other') DEFAULT NULL,
        `designation` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    include_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // Include the path of dbDelta
    dbDelta($sql);

    // Create Wordpress Page (more learn from this: https://developer.wordpress.org/reference/functions/wp_insert_post/)
    $pageData = array(
        'post_title' => 'Employee Management System Page',
        'post_content' => 'This is a sample page.',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'employee-management-system-page', // Slug for the page
    );
    wp_insert_post($pageData);
}

// Plugin Deactivation
register_deactivation_hook(__FILE__, "ems_drop_table");

function ems_drop_table() {
    global $wpdb;
    $table_prefix = $wpdb->prefix;

    $sql = "DROP TABLE IF EXISTS {$table_prefix}ems_form_data"; // {$table_prefix}ems_form_data

    $wpdb->query($sql);

    // Delete wordpress page
    $pageSlug = "employee-management-system-page"; // Slug of the page we created during activation
    $pageInfo = get_page_by_path($pageSlug);

    if (!empty($pageInfo)) {
        $pageId = $pageInfo->ID; // Get the ID of the page
        wp_delete_post($pageId, true); // Delete the page permanently
    }
}

// Add CS/JS to plugin (if you have 3rd party links add these in plugin)
add_action("admin_enqueue_scripts", "ems_add_plugin_assets");

function ems_add_plugin_assets() {
    // CSS plugin files
    wp_enqueue_style("ems-bootstrap-css", EMS_PLUGIN_URL."css/bootstrap.min.css", array(), "1.0.0", "all");
    wp_enqueue_style("ems-datatable-css", EMS_PLUGIN_URL."css/dataTables.dataTables.min.css", array(), "1.0.0", "all");
    wp_enqueue_style("ems-custom-css", EMS_PLUGIN_URL."css/custom.css", array(), "1.0.0", "all");
    
    // JS plugin files
    wp_enqueue_script("ems-bootstrap-js", EMS_PLUGIN_URL."js/bootstrap.min.js", array('jquery'), "1.0.0");
    wp_enqueue_script("ems-datatable-js", EMS_PLUGIN_URL."js/dataTables.min.js", array('jquery'), "1.0.0");
    wp_enqueue_script("ems-validate-js", EMS_PLUGIN_URL."js/jquery.validate.min.js", array('jquery'), "1.0.0");
    //wp_enqueue_script("ems-custom-js", EMS_PLUGIN_URL."js/custom.js", array('jquery'), "1.0.0"); // accrss Datatable from script

    wp_add_inline_script("ems-validate-js", file_get_contents(EMS_PLUGIN_DIR."js/custom.js"), 'after'); // Inline script to add custom JS
}