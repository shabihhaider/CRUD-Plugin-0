<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <h2>Add Employee</h2>
      <img src="<?php echo EMS_PLUGIN_URL?>images/logo.png" alt="logo" style="width: 100px;">
      <div class="panel panel-primary">
        <div class="panel-heading">Add Employee</div>
        <div class="panel-body">
            <form action="javascript:void(0)" method="post" id="ems-add-employee-form">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" required class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" required class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                </div>
                <div class="form-group">
                  <label for="phoneNo">Phone Number:</label>
                  <input type="number" class="form-control" id="phoneNo" placeholder="Enter phone number" name="phoneNo">
                </div>
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <select name="gender" id="gender" class="form-control">
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="designation">Designation:</label>
                  <input type="text" required class="form-control" id="designation" placeholder="Enter Designation" name="designation">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>