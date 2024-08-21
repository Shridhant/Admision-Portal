<?php
include 'connection.php';


if (isset($_SESSION['admin_email'])) {
    header('location:admin_dashboard.php');
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE email = :email AND password = :password";
    $statement = $connection->prepare($query);
    $statement->execute([':email' => $email, ':password' => $password]);
    $result = $statement->fetchAll();
    if ($statement->rowCount() > 0) {
        foreach ($result as $row) {
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_dashboard.php');

        }


    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <hr>
        <h1 class="text-center">
            <a class="text-primary" href="/index.php">Home</a>
        </h1>
        <hr>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Admin Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>