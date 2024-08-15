<?php
include("db.php");

// Add new User
if (isset($_POST['save_newuser'])) {
    try {
        $courseid = mysqli_real_escape_string($conn, $_POST['courseid']);
        $coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
        $grade = mysqli_real_escape_string($conn, $_POST['grade']);
        $percentage = mysqli_real_escape_string($conn, $_POST['percentage']);

        $query = "INSERT INTO exam (courseid,coursename,grade,percentage) VALUES ('$courseid', '$coursename','$grade','$percentage')";

        if (mysqli_query($conn, $query)) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

// Delete User
if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "DELETE FROM exam WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

// Update User
if (isset($_GET['get_user'])) {
    $student_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $query = "SELECT * FROM exam WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_assoc($query_run);
        $res = [
            'status' => 200,
            'data' => $user
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'User Not Found'
        ];
    }
    echo json_encode($res);
}

if (isset($_POST['update_user'])) {
    try {
        $student_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $courseid = mysqli_real_escape_string($conn, $_POST['courseid']);
        $coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
        $grade = mysqli_real_escape_string($conn, $_POST['grade']);
        $percentage = mysqli_real_escape_string($conn, $_POST['percentage']);

        // Ensure the fields are not empty
        if (!empty($student_id) && !empty($courseid) && !empty($coursename) && !empty($grade) && !empty($percentage)) {
            $query = "UPDATE exam SET courseid='$courseid', coursename='$coursename', grade='$grade', percentage='$percentage' WHERE id='$student_id'";

            if (mysqli_query($conn, $query)) {
                $res = [
                    'status' => 200,
                    'message' => 'Details Updated Successfully'
                ];
            } else {
                throw new Exception('Query Failed: ' . mysqli_error($conn));
            }
        } else {
            throw new Exception('All fields are required.');
        }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
    }
    echo json_encode($res);
}
?>
