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
    ?>
    <div>
        <h1>Employee Management System</h1>
        <p>Welcome to the Employee Management System. You can manage employees here.</p>
        <p>Use the submenu to add or list employees.</p>
    </div>
    <?php
}

// Submenu callback function
function ems_list_system() {
    ?>
    <div>
        <h1>List of Employees</h1>
        <p>This is where you can list all employees.</p>
        <p>You can implement the logic to fetch and display employee data here.</p>
    </div>
    <?php
}