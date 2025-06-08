<?php

class StudentManagement {
    public function __construct() {
        // Initialize the plugin
        add_action('admin_menu', array($this, 'addAdminMenus'));
    }

    public function addAdminMenus() {
        // Plugin Menu
        add_menu_page(
            'Student Management',
            'Student Management',
            'manage_options',
            'student-management',
            array($this, 'listStudentCallback'),
            'dashicons-welcome-learn-more',
            6
        );

        // Plugin Submenu 1
        add_submenu_page(
            'student-management',
            'List Student',
            'List Student',
            'manage_options',
            'student-management',
            array($this, 'listStudentCallback'),
        );

        // Plugin Submenu 2
        add_submenu_page(
            'student-management',
            'Add Student',
            'Add Student',
            'manage_options',
            'add-student-management',
            array($this, 'addStudentCallback')
        );
    }

    // List student callback
    public function listStudentCallback() {
        echo "<h1>List Student</h1>";
    }

    // Add student callback
    public function addStudentCallback() {
        echo "<h1>Add Student</h1>";
    }

    // Create table structure
    public function createStudentTable() {
        global $wpdb;

        $table_prefix = $wpdb->prefix;

        $sql = "
            CREATE TABLE `{$table_prefix}student_management` (
            `Id` int NOT NULL AUTO_INCREMENT,
            `name` varchar(50) NOT NULL,
            `email` varchar(80) NOT NULL,
            `gender` enum('male','female','other') DEFAULT NULL,
            `phoneNo` int DEFAULT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
        ";

        include_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // Include the path of dbDelta
        dbDelta($sql);
    }       

    public function dropStudentTable() {
        global $wpdb;

        $table_prefix = $wpdb->prefix;

        $sql = "DROP TABLE IF EXISTS {$table_prefix}student_management";
        $wpdb->query($sql);
    }
}