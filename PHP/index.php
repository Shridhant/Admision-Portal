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
?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>College Website</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="index.css" />


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
          <a class="nav-link" style="font-size:1.3rem" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" style="font-size:1.3rem" href="course.php">Courses<span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="font-size:1.3rem" href="#" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

  <div class="text-center container mt-5">
    <h1><u>Welcome to Lalit Chandra University </u></h1>
    <p>Explore our programs and discover what makes us unique.</p>
  </div>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item img active">
        <img src="/College/Images/Library.jpg" class="d-block w-100" alt="..." />
      </div>
      <div class="carousel-item img">
        <img src="/College/Images/student.jpg" class="d-block w-100" alt="..." />
      </div>
      <div class="carousel-item img">
        <img src="/College/Images/campus.jpg" class="d-block w-100" alt="..." />
      </div>
      <div class="carousel-item img">
        <img src="/College/Images/horse.jpeg" class="d-block w-100" alt="..." />
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <h1 class="text-center">New Professional courses!</h1>
  <hr />
  <section class="d-flex flex-row">
    <div class="card">
      <img src="/College/Images/medium-shot-graduate-student.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        <p class="card-text">
          Some quick example text to build on the card title and make up the
          bulk of the card's content.
        </p>
      </div>
    </div>
    <div class="card">
      <img src="/College/Images/78922_Syphony-Orchestra-29-768x512.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        <p class="card-text">
          Some quick example text to build on the card title and make up the
          bulk of the card's content.
        </p>
      </div>
    </div>
    <div class="card">
      <img
        src="/College/Images/healthcare-workers-preventing-virus-quarantine-campaign-concept-cheerful-friendly-asian-female-physician-doctor-with-clipboard-daily-checkup-standing-white-background.jpg"
        class="card-img-top" alt="..." />
      <div class="card-body">
        <p class="card-text">
          Some quick example text to build on the card title and make up the
          bulk of the card's content.
        </p>
      </div>
    </div>
  </section>
  <h1 class="text-center">Events</h1>
  <hr />
  <section class="d-flex flex-fill justify-content-around" id="event">
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Inter-College Rabha Sangeet Competition</h5>
        <p class="card-text">
          The Inter-College Rabha Sangeet Competition celebrates Bishnu Prasad Rabha's music, featuring student
          performances that honor Assamese musical heritage and showcase emerging talent.
        </p>

      </div>
    </div>
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">College Fest</h5>
        <p class="card-text">
          The College Fest unites students, faculty, and alumni for a vibrant celebration of music, sports, and culture,
          enhancing community spirit and showcasing student talents.

        </p>

      </div>
    </div>
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Hackathons</h5>
        <p class="card-text">
          Hackathons are fast-paced events where teams collaborate intensively to develop innovative solutions,
          fostering creativity, technical skills, and networking opportunities.
        </p>

      </div>
    </div>
  </section>
  <hr>
  <section class="bg-dark text-white py-3">
    <marquee behavior="scroll" direction="left" scrollamount="10">
      Admissions are open for BSC, BCA, BTECH, MBA, BA. Apply now and secure your future!
    </marquee>
  </section>
  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Why Choose Lalit Chandra University?</h2>
      <div class="row ">
        <div class="col-md-4  text-center  ">
          <i class="fas fa-graduation-cap fa-3x mb-3 text-primary"></i>
          <h4 class="mb-3">Excellence in Education</h4>
          <p>Our university provides top-notch education, helping students to reach their full potential.</p>
        </div>
        <div class="col-md-4 text-center  ">
          <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-primary"></i>
          <h4 class="mb-3">Expert Faculty</h4>
          <p>Learn from experienced professors who are leaders in their fields.</p>
        </div>
        <div class="col-md-4 text-center ">
          <i class="fas fa-globe fa-3x mb-3 text-primary"></i>
          <h4 class="mb-3">Global Recognition</h4>
          <p>Our degrees are recognized worldwide, opening doors to global opportunities.</p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-4 text-center  ">
          <i class="fas fa-laptop-code fa-3x mb-3 text-primary"></i>
          <h4 class="mb-3">Modern Facilities</h4>
          <p>Access state-of-the-art facilities and resources to support your learning journey.</p>
        </div>
        <div class="col-md-4 text-center  ">
          <i class="fas fa-user-friends fa-3x mb-3 text-primary"></i>
          <h4 class="mb-3">Vibrant Community</h4>
          <p>Join a diverse and inclusive community that fosters personal growth.</p>
        </div>
        <div class="col-md-4 text-center ">
          <i class="fas fa-award fa-3x mb-3 text-primary"></i>
          <h4 class="mb-3">Award-Winning Programs</h4>
          <p>Enroll in award-winning programs designed to provide cutting-edge knowledge.</p>
        </div>
      </div>
    </div>
  </section>

  <hr>
  <!-- Footer -->
  <footer class="text-center text-lg-start text-white mt-3" style="background-color: #1c2331">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
      <!-- Left -->
      <div class="me-5">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold">Lalit Chandra Bharali College </h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
            <p>
              Lalit Chandra Bharali College, established in 1971, is a general degree undergraduate, coeducational
              college situated at Maligaon in Guwahati, Assam. This college is affiliated with the Gauhati University
            </p>
          </div>
          <!-- Grid column -->





          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Useful links</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />

            <p>
              <a href="#!" class="text-white">Become an Affiliate</a>
            </p>
            <p>
              <a href="#!" class="text-white">Fee Structure</a>
            </p>
            <p>
              <a href="#!" class="text-white">Help</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
            <p><i class="fas fa-home mr-3"></i> Maligaon, Guwahati, IN</p>
            <p><i class="fas fa-envelope mr-3"></i> LCB@LCBcollege.com</p>
            <p><i class="fas fa-phone mr-3"></i> +91 095772 37877</p>

          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2024 Copyright

    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <!-- End of .container -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="scripts.js"></script>
</body>

</html>