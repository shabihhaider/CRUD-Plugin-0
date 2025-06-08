<?php

/*
Plugin Name: Student Management System
Plugin URI: http://example.com/plugins/student-plugin/
Description: This is a test Student Management System Plugin
Author: Muhammad Shabih Haider
Version: 1.0
Author URI: http://myPortfolio.com
Requires at least: 6.8.1
Requires PHP: 7.4
*/

define("SMS_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("SMS_PLUGIN_URL", plugin_dir_url(__FILE__));

include_once(SMS_PLUGIN_PATH."class/StudentManagement.php"); // Add class path

$studentManagementObject = new StudentManagement();

// Create Table Structure
register_activation_hook(__FILE__, array($studentManagementObject, 'createStudentTable'));

// Remove/Drop Table
register_deactivation_hook(__FILE__, array($studentManagementObject, "dropStudentTable"));