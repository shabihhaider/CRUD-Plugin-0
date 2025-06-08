<div class="add-card">
    <h2>Add Student</h2>
    <form action="" method="post" class="add-student-form">
                <!-- Name -->
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input 
                    type="text" 
                    required class="form-control" 
                    id="name" 
                    placeholder="Enter Name" 
                    name="name"
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
                  >
                </div>

                <!-- Gender -->
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <select name="gender" id="gender" class="form-control" required>
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
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
                  >
                </div>
                
                <button type="submit">Submit</button>
    </form>
</div>