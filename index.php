<?php
include("db.php");
$sql = "SELECT * FROM exam";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">Student Information</h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adduser">Add User</button>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="user" style="background-color:bisque;">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Course_id</th>
                        <th scope="col">Course_name</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $s = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $s; ?></td>
                            <td><?php echo $row['courseid']; ?></td>
                            <td><?php echo $row['coursename']; ?></td>
                            <td><?php echo $row['grade']; ?></td>
                            <td><?php echo $row['percentage']; ?></td>
                            <td>
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btnuseredit">Edit</button>
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btnuserdelete">Delete</button>
                            </td>
                        </tr>
                    <?php
                        $s++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addnewuser">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="courseid" class="form-label">Course_id</label>
                            <input type="text" name="courseid" class="form-control" placeholder="Enter Course_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="coursename">Course_name</label>
                            <select class="form-control" name="coursename" required>
                                <option value="">Select Course</option>
                                <option value="SSLC">C</option>
                                <option value="HSC">C++</option>
                                <option value="ITI">Python</option>
                                <option value="DIPLOMA">Java</option>
                                <option value="UG">Backend</option>
                            </select>
                            </div>
                          <div class="mb-3">
                          <label for="grade" >Grade</label>
                            <select class="form-control" name="grade" required>
                                <option value="">Select Grade</option>
                                <option value="SSLC">O</option>
                                <option value="HSC">A+</option>
                                <option value="ITI">A</option>
                                <option value="DIPLOMA">B+</option>
                                <option value="UG">B</option>
                            </select>
                          </div>
                        
                        
                            
                        <div class="mb-3">
                            <label for="percentage" class="form-label">Percentage</label>
                            <input type="text" name="percentage" class="form-control" placeholder="Enter Percentage" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="useredit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editform">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="edit_id">
                        <label for="courseid" class="form-label">Course_id</label>
                        <input type="text" name="courseid" id="edit_cid" class="form-control" placeholder="Enter Course_id" required>
                        <label for="coursename">Course_name</label>
                            <select class="form-control" name="coursename" required>
                                <option value="">Select Course</option>
                                <option value="SSLC">C</option>
                                <option value="HSC">C++</option>
                                <option value="ITI">Python</option>
                                <option value="DIPLOMA">Java</option>
                                <option value="UG">Backend</option>
                            </select>

                        <label for="grade" class="form-label">Grade</label>
                        <select class="form-control" name="grade" required>
                                <option value="">Select Grade</option>
                                <option value="SSLC">O</option>
                                <option value="HSC">A+</option>
                                <option value="ITI">A</option>
                                <option value="DIPLOMA">B+</option>
                                <option value="UG">B</option>
                        </select>
                        <label for="percentage" class="form-label">Percentage</label>
                        <input type="text" name="percentage" id="edit_percentage" class="form-control" placeholder="Enter Percentage" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            //to display data tables
            $('#user').DataTable();
        });

        $(document).on('submit', '#addnewuser', function(e) {
            e.preventDefault(); //page doesnot load;
            var formData = new FormData(this); // fetch form data
            formData.append("save_newuser", true);
            $.ajax({
                type: "POST",
                url: "backend.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 200) {
                        $('#adduser').modal('hide'); //modal name
                        $('#addnewuser')[0].reset(); // to reset form details
                        $('#user').load(location.href + " #user"); // table to refresh
                        alert("Data Added Successfully")

                    } else if (res.status == 500) {
                        $('#adduser').modal('hide'); //modal_name
                        $('#addnewuser')[0].reset(); // to reset form
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });

        });

        $(document).on('click', '.btnuserdelete', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var user_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "backend.php",
                    data: {
                        'delete_user': true,
                        'user_id': user_id
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            $('#user').load(location.href + " #user");
                        }
                    }
                });
            }
        });

        // Edit user
        $(document).on('click', '.btnuseredit', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "backend.php",
                data: {
                    'get_user': true,
                    'user_id': user_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $('#edit_id').val(res.data.id);
                        $('#edit_cid').val(res.data.courseid);
                        $('#edit_name').val(res.data.coursename);
                        $('#edit_grade').val(res.data.grade);
                        $('#edit_percentage').val(res.data.percentage);

                        $('#useredit').modal('show'); //to edit modal
                    } else {
                        alert(res.message);
                    }
                }
            });
        });

        
        $(document).on('submit', '#editform', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("update_user", true);

            $.ajax({
                    type: "POST",
                    url: "backend.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response); // Log the response for debugging
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $('#useredit').modal('hide');
                            $('#editform')[0].reset();
                            $('#user').load(location.href + " #user"); // Reload table data
                            alert(res.message);
                        } else if (res.status == 500) {
                            $('#useredit').modal('hide');
                            $('#editform')[0].reset();
                            console.error("Error:", res.message);
                            alert("Something went wrong. Please try again.");
                        }
                    }
                })
            });
    </script>
</body>

</html>