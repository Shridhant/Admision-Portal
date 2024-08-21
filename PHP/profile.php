<?php
include 'connection.php';

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

$query = "SELECT * FROM users WHERE id = :id";
$statement = $connection->prepare($query);
$statement->execute([':id' => $_SESSION['id']]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update_name'])) {
    $newName = $_POST['new_name'];

    $updateQuery = "UPDATE users SET name = :name WHERE id = :id";
    $updateStatement = $connection->prepare($updateQuery);
    $updateStatement->execute([':name' => $newName, ':id' => $_SESSION['id']]);

    $user['name'] = $newName;
    header('location: profile.php');
    exit();
}

if (isset($_POST['update_email'])) {
    $newEmail = $_POST['new_email'];

    $updateQuery = "UPDATE users SET email = :email WHERE id = :id";
    $updateStatement = $connection->prepare($updateQuery);
    $updateStatement->execute([':email' => $newEmail, ':id' => $_SESSION['id']]);

    $_SESSION['email'] = $newEmail;
    $user['email'] = $newEmail;
    header('location: profile.php');
    exit();
}

if (isset($_POST['update_password'])) {
    $newPassword = $_POST['new_password'];

    $updateQuery = "UPDATE users SET password = :password WHERE id = :id";
    $updateStatement = $connection->prepare($updateQuery);
    $updateStatement->execute([':password' => $newPassword, ':id' => $_SESSION['id']]);

    header('location: profile.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #F5F5DC;
        }

        .sidebar {
            width: 250px;
            background-color: #5A5A5A;
            color: #ffffff;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar a {
            display: block;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 15px;
        }

        .sidebar a:hover {
            background-color: #6C6C6C;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .profile-container {
            margin-top: 20px;
        }

        .card {
            background-color: #F9F6EE;
        }

        .btn-primary {
            background-color: #5A5A5A;
            border-color: #5A5A5A;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3 class="text-center">My Account</h3>
        <a href="profile.php"><i class="fa fa-user"></i> Profile</a>
        <a href="application_status.php"><i class="fa fa-cog"></i> Application Status</a>
        <a href="student_application.php"><i class="fa fa-list"></i> Apply</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center profile-container">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Profile</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="new_name"
                                        value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                </div>
                                <button type="submit" name="update_name" class="btn btn-primary btn-block">Update
                                    Name</button>
                            </form>
                            <form method="post" class="mt-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="new_email"
                                        value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                </div>
                                <button type="submit" name="update_email" class="btn btn-primary btn-block">Update
                                    Email</button>
                            </form>
                            <form method="post" class="mt-3">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="new_password"
                                        required>
                                </div>
                                <button type="submit" name="update_password" class="btn btn-primary btn-block">Update
                                    Password</button>
                            </form>
                            <div class="text-center mt-3">
                                <a href="logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>