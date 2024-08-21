<?php
include 'connection.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['submit_application'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $course = $_POST['course']; // Get the selected course ID
    $registration_number = time(); // Generate a registration number based on the current time

    $query = "INSERT INTO users (name, email, password, registration_number, course, status) VALUES (:name, :email, :password, :registration_number, :course, 1)";
    $statement = $connection->prepare($query);
    $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $password,
        ':registration_number' => $registration_number,
        ':course' => $course
    ]);

    header('Location: application_success.php?reg_num=' . $registration_number);
    exit();
}

// Fetch courses from the database
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
    <title>Student Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center"><a href="index.php">Home</a></h1>
        <h2 class="text-center">Student Application Form</h2>
        <form method="post" class="mt-4">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="course">Course</label>
                <select class="form-control" id="course" name="course" required>
                    <option value="">Select a course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo htmlspecialchars($course['course']); ?>">
                            <?php echo htmlspecialchars($course['course']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit_application" class="btn btn-primary btn-block">Submit
                Application</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>