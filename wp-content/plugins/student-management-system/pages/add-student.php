<style>
    .card {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
}

.card h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Form input style */
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="tel"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
select:focus {
    outline: none;
    border-color: #6cb2eb;
    box-shadow: 0 0 5px rgba(108, 178, 235, 0.5);
}

/* Submit button style */
button {
    background-color: #4caf50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}

</style>

<div class="card">
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