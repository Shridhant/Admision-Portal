<?php
include 'connection.php';

// Check if admin is logged in


if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
    exit();
}

// Handle add course
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $course = $_POST['course'];
    $course_description = $_POST['course_description'];
    if (!empty($course) && !empty($course_description)) {
        $query = "INSERT INTO courses (course, description) VALUES (:course, :description)";
        $statement = $connection->prepare($query);
        $statement->execute(['course' => $course, 'description' => $course_description]);
        header('location: admin_courses.php');
        exit();
    }
}

// Handle remove course
if (isset($_GET['remove_course'])) {
    $course_id = $_GET['remove_course'];
    $query = "DELETE FROM courses WHERE course_id = :course_id";
    $statement = $connection->prepare($query);
    $statement->execute(['course_id' => $course_id]);
    header('location: admin_courses.php');
    exit();
}

$query = "SELECT * FROM courses";
$statement = $connection->prepare($query);
$statement->execute();
$courses = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Courses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #575d63;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        .navbar {
            margin-left: 250px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="admin_dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
        <a href="admin_users.php"><i class="fa fa-users"></i> Users</a>
        <a href="admin_applications.php"><i class="fa fa-file-alt"></i> Applications</a>
        <a href="admin_logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <h2 class="mt-4 mb-4 text-center">Courses</h2>
        <div class="container mt-5">
            <form method="POST" action="admin_courses.php">
                <div class="form-group">
                    <label for="course">Course Name</label>
                    <input type="text" class="form-control" id="course" name="course" required>
                </div>
                <div class="form-group">
                    <label for="course_description">Course Description</label>
                    <textarea class="form-control" id="course_description" name="course_description"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="add_course">Add Course</button>
            </form>

            <table class="table table-bordered mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?php echo $course['course_id']; ?></td>
                            <td><?php echo $course['course']; ?></td>
                            <td><?php echo $course['description']; ?></td>
                            <td>
                                <a href="admin_courses.php?remove_course=<?php echo $course['course_id']; ?>"
                                    class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>