<?php

include 'connection.php';
if (isset($_SESSION['email'])) {
    // User is logged in, generate HTML for Logout
    $signInLink = '';
    $signUpLink = '';
    $accountLink = '<a class="dropdown-item" href="logout.php">Logout</a>';
    $profileIcon = '<a class="nav-link" href="profile.php"><i class="fa-regular fa-user"></i> <span class="sr-only">(current)</span></a>';
} else {
    // User is not logged in, generate HTML for Login
    $accountLink = '';
    $signInLink = '<a class="dropdown-item" href="login.php">Login</a>';
    $signUpLink = '<a class="dropdown-item" href="register.php">Register</a>';
    $profileIcon = '';
}


$query = "SELECT course_id, course, description FROM courses";
$statement = $connection->prepare($query);
$statement->execute();
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .card {
            margin-top: 20px;
        }

        .container {
            padding-top: 50px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">


        <a class="navbar-brand" style="font-size:2rem" href="index.php">LCB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" style="font-size:1.3rem" href="index.php">Home <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" style="font-size:1.3rem" href="course.php">Courses<span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="font-size:1.3rem" href="#" id="navbarDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php echo $accountLink; ?>
                        <?php echo $signInLink; ?>
                        <?php echo $signUpLink; ?>

                </li>
                <li class="nav-item active">
                    <?php echo $profileIcon; ?>
                </li>
            </ul>
        </div>
    </nav>
    <hr>

    <div class="container">
        <h2 class="text-center">Courses Offered</h2>
        <div class="row">
            <?php foreach ($courses as $course): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($course['course']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($course['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>