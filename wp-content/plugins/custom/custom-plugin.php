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