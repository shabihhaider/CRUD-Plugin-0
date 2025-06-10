<div class="list-card">
    <h2>List Student</h2>

    <?php if (!empty($displayMessage)) {
        ?>
          <div class="display-success">
              <?php echo $displayMessage; ?>
          </div>
        <?php
    } ?>
    
    <div class="table-container">
      <table class="student-table" id="tbl-student">
        <thead>
          <th>#ID</th>
          <th>#Name</th>
          <th>#Email</th>
          <th>#Gender</th>
          <th>#Phone</th>
          <th>#Action</th>
        </thead>

        <tbody>

          <?php
            if (count($students) > 0) {
              foreach ($students as $student) {
               ?>
                 <tr>
                  <td><?php echo $student["Id"] ?></td>
                  <td><?php echo $student["name"] ?></td>
                  <td><?php echo $student["email"] ?></td>
                  <td><?php echo $student["gender"] ?></td>
                  <td><?php echo $student["phoneNo"] ?></td>
                  <td>
                    <a href="admin.php?page=student-management&action=edit&id=<?php echo $student["Id"] ?>" class="btn-edit">Edit</a>
                    <a href="admin.php?page=student-management&action=view&id=<?php echo $student["Id"] ?>" class="btn-view">View</a>
                    <a href="admin.php?page=student-management&action=delete&id=<?php echo $student["Id"] ?>" class="btn-delete"
                    onclick="return confirm('Are you sure you want to delete this?')"
                    >Delete</a>
                  </td>
                </tr>
               <?php
              }
            }    
          ?>
        </tbody>
      </table>
    </div>
</div>