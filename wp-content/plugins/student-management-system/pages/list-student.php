<style>
  .card {
    max-width: 800px;
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

/* Table style */
.table-container {
    overflow-x: auto;
    width: 100%; /* Adjust as needed */
    padding: 10px;
}

.student-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
}

.student-table th,
.student-table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.student-table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

/* Button style */
.btn-edit,
.btn-delete,
.btn-view {
    display: inline-block;
    padding: 8px 16px;
    margin: 4px;
    text-decoration: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
    border: none;
    font-weight: bold;
    text-transform: uppercase;
    outline: none;
}

.btn-edit {
    background-color: #28a745;
}

.btn-delete {
    background-color: #dc3545;
}

.btn-view {
    background-color: #007bff;
}

.btn-edit:hover,
.btn-delete:hover,
.btn-view:hover {
    opacity: 0.8;
}
</style>

<div class="card">
    <h2>List Student</h2>
    
    <div class="table-container">
      <table class="student-table">
        <thead>
          <th>#ID</th>
          <th>#Name</th>
          <th>#Email</th>
          <th>#Gender</th>
          <th>#Phone</th>
          <th>#Action</th>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>Shabih Haider</td>
            <td>shabih19@gmail.com</td>
            <td>Male</td>
            <td>28736721</td>
            <td>
              <a href="#" class="btn-edit">Edit</a>
              <a href="#" class="btn-view">View</a>
              <a href="#" class="btn-delete">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</div>