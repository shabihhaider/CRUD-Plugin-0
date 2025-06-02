<!DOCTYPE html>
<html lang="en">
<head>
  <title>List Employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
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
                                    <th>#Designation</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Shabih Haider</td>
                                    <td>shabih@gmail.com</td>
                                    <td>0124214241</td>
                                    <td>Web Developer</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-warning">Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                                        <a href="javascript:void(0)" class="btn btn-info">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        $(function(){
            // List Employee Table
            new DataTable('#tbl-employee');
        });
    </script>
</body>
</html>
