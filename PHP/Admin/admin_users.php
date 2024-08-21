<?php
include 'connection.php';

// Check if admin is logged in

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
    exit();
}

$query = "SELECT * FROM users";
$statement = $connection->prepare($query);
$statement->execute();
$users = $statement->fetchAll();

// Handle delete user request
if (isset($_POST['delete_mail'])) {
    $id = $_POST['id'];
    $deleteQuery = "DELETE FROM users WHERE id = :id";
    $deleteStatement = $connection->prepare($deleteQuery);
    $deleteStatement->execute([':id' => $id]);
    header('Location: admin_users.php');
    exit();
}

// Handle update password request
if (isset($_POST['update_password'])) {
    $id = $_POST['id'];
    $newPassword = $_POST['new_password'];
    $updateQuery = "UPDATE users SET password = :password WHERE id = :id";
    $updateStatement = $connection->prepare($updateQuery);
    $updateStatement->execute([':password' => $newPassword, ':id' => $id]);
    header('Location: admin_users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
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
            flex-guser: 1;
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
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">

        <h2 class="mt-4 mb-4 text-center">Users</h2>
        <div class="container mt-5 ">

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($users)) {
                        foreach ($users as $user) {
                            echo '<tr>
                            <td>' . $user["id"] . '</td>
                            <td>' . $user["email"] . '</td>
                            <td>' . $user["name"] . '</td>';
                            ?>
                            <td>
                                <form method="post" style="display: inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
                                    <button name="delete_mail" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                </form>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Update Password
                                </button>

                            </td>
                            <?php
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">No Data Found!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" style="display: inline-block;">
                                <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
                                <input type="text" name="new_password" placeholder="New Password" required>
                                <button name="update_password" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
</body>

</html>