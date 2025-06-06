<?php
    global $wpdb;

    $employees = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ems_form_data", ARRAY_A);
?>

<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>List Employee</h2>
                <div class="panel panel-primary">
                    <div class="panel-heading">List Employee</div>
                    <div class="panel-body">
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
                                                        <a href="admin.php?page=ems-list-employee&action=delete&empId=<?php echo $employee['id']; ?>" class="btn btn-danger">Delete</a>
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