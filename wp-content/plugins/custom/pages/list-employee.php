<?php
    global $wpdb;
    $message = "";
    
    // Delete Employee
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['empId']) && !empty($_POST['empId'])) {
            $wpdb->delete("{$wpdb->prefix}ems_form_data", array(
                "id" => intval($_POST['empId'])
            ));
            $message = "Employee Deleted Successfully";
        }
    }
    
    $employees = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ems_form_data", ARRAY_A);
?>

<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>List Employee</h2>
                <div class="panel panel-primary">
                    <div class="panel-heading">List Employee</div>
                    <div class="panel-body">
                        <?php
                            if (isset($message) && !empty($message)) {
                                ?>
                                    <div class="alert alert-success">
                                        <?php echo $message; ?>
                                    </div>
                                <?php
                            }
                        ?>
                        <table class="table table-condensed" id="tbl-employee">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>#Name</th>
                                    <th>#Email</th>
                                    <th>#Phone No</th>
                                    <th>#Gender</th>
                                    <th>#Designation</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (count($employees) > 0) {
                                        foreach ($employees as $employee) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $employee['id']; ?></td>
                                                    <td><?php echo $employee['name']; ?></td>
                                                    <td><?php echo $employee['email']; ?></td>
                                                    <td><?php echo $employee['phoneNo']; ?></td>
                                                    <td><?php echo ucfirst($employee['gender']); ?></td>
                                                    <td><?php echo $employee['designation']; ?></td>
                                                    <td>
                                                        <a href="admin.php?page=ems-plugin&action=edit&empId=<?php echo $employee['id']; ?>" class="btn btn-warning">Edit</a>

                                                        <form action="<?php $_SERVER['PHP_SELF'] ?>?page=ems-list-employee" method="post" id="form-delete-employee-<?php echo $employee['id']; ?>">
                                                            <input type="hidden" name="empId" value="<?php echo $employee['id']; ?>">
                                                        </form>

                                                        <a href="javascript:void(0)" onclick="if(confirm('Are you sure you want to delete it?')) { jQuery('#form-delete-employee-<?php echo $employee['id']; ?>').submit(); }" class="btn btn-danger">Delete</a>
                                                        
                                                        <a href="admin.php?page=ems-plugin&action=view&empId=<?php echo $employee['id']; ?>" class="btn btn-info">View</a>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "No Employee Found";
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>