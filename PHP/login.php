<?php
include 'connection.php';


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $statement5 = $connection->prepare($query);

    $statement5->execute([':email' => $email, ':password' => $password]);

    if ($statement5->rowCount() > 0) {
        $result = $statement5->fetchAll();
        foreach ($result as $row) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header('location:index.php');
            exit();
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #F5F5DC;
        }

        .login-container {
            margin-top: 100px;
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
    <h1 class="text-center">
        <a class="text-primary" href="index.php">Home</a>
    </h1>
    <div class="container">
        <div class="row justify-content-center login-container">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
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
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="register.php">Don't have an account? Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>