<div class="add-card">
    <h2>
      <?php
        if (isset($action) && $action == "edit") {
          echo "Edit Student";
        } elseif(isset($action) && $action == "view") {
          echo "View Student";
        } else {
          echo "Add Student";
        }
      ?>
    </h2>

    <?php if (!empty($displayMessage)) {
        ?>
            <div class="display-success">
                <?php echo $displayMessage; ?>
            </div>
        <?php
    } ?>

    <form method="post" class="add-student-form" 
    action="<?php 
        if ($action == "edit") {
            echo 'admin.php?page=student-management&action=edit&id=' . $student["Id"];
        } else {
            echo 'admin.php?page=add-student-management';
        }
    ?>">
                <!-- Name -->
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input 
                    type="text" 
                    required class="form-control" 
                    id="name" 
                    placeholder="Enter Name" 
                    name="name"
                    value="<?php if (isset($student['name'])) {
                      echo $student['name'];
                    } ?>"
                    <?php if (isset($action) && $action == "view") {
                      echo "readonly";
                    } ?>
                    >
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input 
                    type="email" 
                    required class="form-control" 
                    id="email" 
                    placeholder="Enter email" 
                    name="email"
                    value="<?php if (isset($student['email'])) {
                      echo $student['email'];
                    } ?>"
                    <?php if (isset($action) && $action == "view") {
                      echo "readonly";
                    } ?>
                  >
                </div>

                <!-- Gender -->
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <select name="gender" id="gender" class="form-control" required
                    <?php if (isset($action) && $action == "view") {
                        echo "disabled";
                      } ?>
                    >
                    <option value="">Select gender</option>
                    <option <?php if (isset($student['gender']) && $student['gender'] == 'male') {
                      echo 'selected';
                    } ?> value="male">Male</option>
                    <option <?php if (isset($student['gender']) && $student['gender'] == 'female') {
                      echo 'selected';
                    } ?> value="female">Female</option>
                    <option <?php if (isset($student['gender']) && $student['gender'] == 'other') {
                      echo 'selected';
                    } ?> value="other">Other</option>
                  </select>
                </div>

                <!-- Phone No -->
                <div class="form-group">
                  <label for="phone">Phone Number:</label>
                  <input 
                    type="number" 
                    class="form-control" 
                    id="phone" 
                    placeholder="Enter phone number" 
                    name="phone"
                    value="<?php if (isset($student['phoneNo'])) {
                      echo $student['phoneNo'];
                    } ?>"
                    <?php if (isset($action) && $action == "view") {
                      echo "readonly";
                    } ?>
                  >
                </div>
                
                <?php
                  if (isset($action) && $action == "view") {
                    // No button
                  } else {
                    ?>
                      <button type="submit" name="btn_submit">Submit</button>
                    <?php
                  }
                ?>
    </form>
</div>