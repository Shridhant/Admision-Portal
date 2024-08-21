<?php

include 'connection.php';

if (!isset($_SESSION['admin_email'])) {
    header('location:admin_login.php');
    exit();
}

$query = "SELECT id, name, email, registration_number, course, status FROM users WHERE registration_number IS NOT NULL";

$statement = $connection->prepare($query);
$statement->execute();
$applications = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $newStatus = $_POST['new_status'];
    $updateQuery = "UPDATE users SET status = :status WHERE id = :id";
    $updateStatement = $connection->prepare($updateQuery);
    $updateStatement->execute([':status' => $newStatus, ':id' => $id]);
    header('Location: admin_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <a href="admin_courses.php"><i class="fa fa-file-alt"></i> Courses</a>
        <a href="admin_logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <h1 class="text-center "> Admin Dashboard</h1>


        <h2 class=" text-center">Student Applications</h2>
        <div class="container mt-5">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registration Number</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($applications)) {
                        foreach ($applications as $application) {
                            echo '<tr>
                            <td>' . $application["id"] . '</td>
                            <td>' . $application["name"] . '</td>
                            <td>' . $application["email"] . '</td>
                            <td>' . $application["registration_number"] . '</td>
                            <td>' . $application["course"] . '</td>
                            <td>' . $application["status"] . '</td>';
                            ?>
                            <td>
                                <form method="post" style="display: inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $application["id"]; ?>">
                                    <select name="new_status" class="form-control">
                                        <option value="1" <?php echo ($application["status"] == 1) ? 'selected' : ''; ?>>Pending
                                        </option>
                                        <option value="2" <?php echo ($application["status"] == 2) ? 'selected' : ''; ?>>Accepted
                                        </option>
                                        <option value="3" <?php echo ($application["status"] == 3) ? 'selected' : ''; ?>>Rejected
                                        </option>
                                        <option value="4" <?php echo ($application["status"] == 4) ? 'selected' : ''; ?>>Payment
                                            Done</option>
                                    </select>
                                    <button name="update_status" class="btn btn-primary mt-2">Update Status</button>
                                </form>
                            </td>
                            <?php
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">No Data Found!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>