<?php

  $message = '';
  $status = '';
  $action = '';
  $empId = '';

  if (isset($_GET['action']) && isset($_GET['empId'])) {
    // Get the action and employee ID from the URL
    $action = sanitize_text_field($_GET['action']);
    $empId = intval($_GET['empId']);

    // Get the employee data if action is view or edit
    if ($action == 'view' || $action == 'edit') {
      global $wpdb;
      $employee = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}ems_form_data WHERE id = %d", $empId), ARRAY_A);
      
      if (!$employee) {
        $message = "Employee not found.";
        $status = 0;
      }
    }
  }

  // Form Data Submission
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-submit'])) {
      
    // Form Submitted
    global $wpdb;

    // sanitize means to clean the data if user has entered any malicious code
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phoneNo = sanitize_text_field($_POST['phoneNo']);
    $gender = sanitize_text_field($_POST['gender']);
    $designation = sanitize_text_field($_POST['designation']);

    $wpdb->insert(
        "{$wpdb->prefix}ems_form_data",
        array(
            'name' => $name,
            'email' => $email,
            'phoneNo' => $phoneNo,
            'gender' => $gender,
            'designation' => $designation
        )
    );

    $last_insert_id = $wpdb->insert_id;

    if ($last_insert_id > 0) {
      $message = "Employee added successfully with ID: " . $last_insert_id;
      $status = 1;
    } else {
      $message = "Failed to add employee. Please try again.";
      $status = 0;
    }
  }
?>

<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <h2>
        <?php 
          if ($action == 'view') {
            echo "View Employee";
          } elseif ($action == 'edit') {
            echo "Edit Employee";
          } else {
            echo "Add Employee";
          }
        ?>
      </h2>
      <img src="<?php echo EMS_PLUGIN_URL?>images/logo.png" alt="logo" style="width: 100px;">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <?php 
            if ($action == 'view') {
              echo "View Employee Details";
            } elseif ($action == 'edit') {
              echo "Edit Employee Details";
            } else {
              echo "Add New Employee";
            }
          ?>
        </div>
        <div class="panel-body">
          <?php
            if (!empty($message)) {
              if ($status == 1) {
                ?>
                  <div class="alert alert-success">
                    <?php echo $message; ?>
                  </div>
                <?php
              } else {
                ?>
                  <div class="alert alert-danger">
                    <?php echo $message; ?>
                  </div>
                <?php
              }
            } 
          ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>?page=ems-plugin" method="post" id="ems-add-employee-form">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input 
                    type="text" 
                    required class="form-control" 
                    id="name" 
                    placeholder="Enter Name" 
                    name="name"
                    value="<?php echo isset($employee['name']) ? esc_attr($employee['name']) : ''; ?>"
                    <?php echo ($action == 'view') ? 'readonly' : ''; ?>
                    >
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input 
                    type="email" 
                    required class="form-control" 
                    id="email" 
                    placeholder="Enter email" 
                    name="email"
                    value="<?php echo isset($employee['email']) ? esc_attr($employee['email']) : ''; ?>"
                    <?php echo ($action == 'view') ? 'readonly' : ''; ?>
                  >
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input 
                    type="password" 
                    class="form-control" 
                    id="pwd" 
                    placeholder="Enter password" 
                    name="pwd"
                    <?php echo ($action == 'view') ? 'readonly' : ''; ?>
                  >
                </div>
                <div class="form-group">
                  <label for="phoneNo">Phone Number:</label>
                  <input 
                    type="number" 
                    class="form-control" 
                    id="phoneNo" 
                    placeholder="Enter phone number" 
                    name="phoneNo"
                    value="<?php echo isset($employee['phoneNo']) ? esc_attr($employee['phoneNo']) : ''; ?>"
                    <?php echo ($action == 'view') ? 'readonly' : ''; ?>
                  >
                </div>
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <select name="gender" id="gender" class="form-control" required <?php if ($action == 'view') { echo "disabled";} ?>>
                    <option value="">Select gender</option>
                    <option value="male" <?php if ($action == 'view' && $employee['gender'] == 'male') {
                        echo "selected";
                    } ?>>Male</option>
                    <option value="female" <?php if ($action == 'view' && $employee['gender'] == 'female') {
                        echo "selected";
                    } ?>>Female</option>
                    <option value="other" <?php if ($action == 'view' && $employee['gender'] == 'other') {
                        echo "selected";
                    } ?>>Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="designation">Designation:</label>
                  <input 
                    type="text" 
                    required class="form-control" 
                    id="designation" 
                    placeholder="Enter Designation" 
                    name="designation"
                    value="<?php echo isset($employee['designation']) ? esc_attr($employee['designation']) : ''; ?>"
                    <?php echo ($action == 'view') ? 'readonly' : ''; ?>
                  >
                </div>
                
                <?php 
                  if ($action != 'view') {
                    ?>
                    <button type="submit" class="btn btn-success" name="btn-submit">Submit</button>
                    <?php
                  }
                ?>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>