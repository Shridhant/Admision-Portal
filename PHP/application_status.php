<?php
include 'connection.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

$registrationNumber = '';
$statusText = '';
$message = '';


if (isset($_POST['check_status'])) {
    $registrationNumber = $_POST['registration_number'];


    $query = "SELECT status FROM users WHERE registration_number = :registration_number";
    $statement = $connection->prepare($query);
    $statement->execute([':registration_number' => $registrationNumber]);
    $applications = $statement->fetchAll();

    if ($applications) {

        $application = $applications[0];

        switch ($application['status']) {
            case 1:
                $statusText = "Pending";
                break;
            case 2:
                $statusText = "Success";
                break;
            case 3:
                $statusText = "Rejected";
                break;
            case 4:
                $statusText = "Payment Done";
                break;
            default:
                $statusText = "Unknown";
                break;
        }
    } else {
        $message = "No application found with registration number: " . htmlspecialchars($registrationNumber);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Application Status</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mt-4 mb-4 text-center">Check Application Status</h2>
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="registration_number">Enter Registration Number:</label>
                        <input type="text" class="form-control" id="registration_number" name="registration_number"
                            value="<?php echo htmlspecialchars($registrationNumber); ?>" required>
                    </div>
                    <button type="submit" name="check_status" class="btn btn-primary">Check Status</button>
                </form>
            </div>
        </div>
        <?php if (!empty($statusText)): ?>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Application Status</h5>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($statusText); ?></p>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-primary">Home</a>
        </div>
    </div>
</body>

</html>