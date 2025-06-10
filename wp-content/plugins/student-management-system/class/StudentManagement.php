<?php

class StudentManagement {

    private $message = "";
    private $status = "";
    private $action = "";

    public function __construct() {
        // Initialize the plugin
        add_action('admin_menu', array($this, 'addAdminMenus'));

        add_action('admin_enqueue_scripts', array($this, 'addStudentPluginFiles'));
    }

    // Add student plugin menus and submenus
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

        if (isset($_GET["action"]) && $_GET["action"] == "edit") {
            global $wpdb;
            $this->action = "edit";
            $action = $this->action;

            $student_id = $_GET["id"];
            $table_prefix = $wpdb->prefix;

            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btn_submit'])) {
                $name = sanitize_text_field($_POST['name']);
                $email = sanitize_text_field($_POST['email']);
                $gender = sanitize_text_field($_POST['gender']);
                $phone = sanitize_text_field($_POST['phone']);

                $wpdb->update("{$table_prefix}student_management", array(
                    'name' => $name,
                    'email' => $email,
                    'gender' => $gender,
                    'phoneNo' => $phone
                ), array(
                    'Id' => $student_id
                ));

                $this->message = "Student Updated Successfully";
            }

            $displayMessage = $this->message;

            $student = $this->getStudentData($student_id);

            include_once(SMS_PLUGIN_PATH."pages/add-student.php");
        } elseif(isset($_GET["action"]) && $_GET["action"] == "view") {
            $this->action = "view";
            $action = $this->action;

            $student_id = $_GET["id"];
            $student = $this->getStudentData($student_id);

            // View single student data
            include_once(SMS_PLUGIN_PATH."pages/add-student.php");
        } else {
            // Get Student data from db
            global $wpdb;
            $table_prefix = $wpdb->prefix;

            if (isset($_GET["action"]) && $_GET["action"] == "delete") {
                // Get student data based on the given Id
                $studentData = $this->getStudentData($_GET["id"]);

                // If student exist delete it
                if (!empty($studentData)) {
                    $wpdb->delete("{$table_prefix}student_management", array(
                        'Id' => intval($_GET["id"])
                    ));

                    $this->message = "Student Deleted Successfully";
                    $displayMessage = $this->message;
                } 
            }
            
            $students = $wpdb->get_results("SELECT * FROM {$table_prefix}student_management", ARRAY_A);
            
            include_once(SMS_PLUGIN_PATH."pages/list-student.php");
        }
        
    }

    // Get student data
    private function getStudentData($student_id) {
        global $wpdb;
        $table_prefix = $wpdb->prefix;

        $student = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$table_prefix}student_management WHERE Id = %d", $student_id), 
            ARRAY_A
        );

        return $student;
    }

    // Add student callback
    public function addStudentCallback() {

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_submit'])) {
            $this->saveStudentFormData();
        }

        $displayMessage = $this->message;
        $displayStatus = $this->status;

        include_once(SMS_PLUGIN_PATH."pages/add-student.php");
    }

    // Save Student form data
    private function saveStudentFormData() {
        global $wpdb;

            $name = sanitize_text_field($_POST['name']);
            $email = sanitize_text_field($_POST['email']);
            $gender = sanitize_text_field($_POST['gender']);
            $phone = sanitize_text_field($_POST['phone']);

            $table_prefix = $wpdb->prefix;

            $wpdb->insert("{$table_prefix}student_management", array(
                "name" => $name,
                "email" => $email,
                "gender" => $gender,
                "phoneNo" => $phone,
            ));

            $student_id = $wpdb->insert_id;

            if ($student_id > 0) {
                // Saved data successfully
                $this->message = "Data Saved Successfully";
                $this->status = 1;
            } else {
                // Failed to saved data
                $this->message = "Failed to Saved Data";
                $this->status = 0;
            }
    }

    // Create Student Table
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

    // Drop Student Table
    public function dropStudentTable() {
        global $wpdb;

        $table_prefix = $wpdb->prefix;

        $sql = "DROP TABLE IF EXISTS {$table_prefix}student_management";
        $wpdb->query($sql);
    }

    // Add Student Plugin Files
    public function addStudentPluginFiles() {
        // Style
        wp_enqueue_style('datatable-css', SMS_PLUGIN_URL . 'assets/css/dataTables.dataTables.min.css', array(), "1.0", 'all');
        wp_enqueue_style('style-css', SMS_PLUGIN_URL . 'assets/css/style.css', array(), "1.0", 'all');
        
        // Script
        wp_enqueue_script('datatable-js', SMS_PLUGIN_URL . 'assets/js/dataTables.min.js', array('jquery'), "1.0");
        wp_enqueue_script('style-js', SMS_PLUGIN_URL . 'assets/js/script.js', array('jquery'), "1.0");
    }
}