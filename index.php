<?php
include("./dbconnect.php");
$query = "SELECT * FROM news ORDER BY date_published DESC";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="./dist/home/css" rel="stylesheet">
  <title>Hostel Management</title>

  <link href="./dist/home/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./dist/css/style.min.css">
  <link rel="stylesheet" href="./dist/home/fontawesome.css">
  <link rel="stylesheet" href="dist/home/style.css">
  <!-- <link rel="stylesheet" href="./dist/home/owl.css"> -->
  <link rel="stylesheet" href="./dist/home/home.css">
  <link rel="shortcut icon" href="./admin./include/ho_login.png">


  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Automation System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("./admin/include/Manonmaniam-Sundaranar-University.jpg");
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .container {
            width: 70%;
            max-width: 30rem; /* Adjust as needed */
            padding: 2rem;
            border: 2px solid black;
            border-radius: 1rem;
            background-color: white;
            opacity: 0.9; /* Adjust opacity as needed */
        }

        p {
            font-weight: bold;
            font-size: 2rem;
        }

        h1 {
            font-size: 2rem;
            margin-top: 2rem;
        }

        .button {
            background-color: #0d6efd;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.5rem;
            margin-top: 2rem;
            display: inline-block;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0b5ed7;
        }
    </style>


</head>

<body>



    
    <div class="container">
        <
        <p>Hostel Automation System</p>
        <div class="py-20">
            <div class="mb-6">
                <a href="./admin/admin_login.php" class="button">Admin Login</a>
            </div>
            <div class="mb-6">
                <a href="./stud_login.php" class="button">Student Login</a>
            </div>
            <div>
                <a href="./guest_details.php" class="button">Student Admission</a>
            </div>
        </div>
    </div>






  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>


  <!--<header class="fixed-top height:15vh">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href=""><em><img src="./admin/include/ho_login.png" style="width: 40px; height:40px" alt=""></em>
          <h2>Hostel Management</h2>
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg> </button>
        <div class="navbar-collapse collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./admin/admin_login.php">Admin login</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./stud_login.php">Students login</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./guest_details.php">Student Register</a>
            </li>

             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>

              <div class="dropdown-menu">
                <a class="dropdown-item" href="about.html">About Us</a>
                <a class="dropdown-item" href="testimonials.html">Testimonials</a>
                <a class="dropdown-item" href="terms.html">Terms</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header> 

  <div class="main-banner" style="position: absolute; height:85vh; bottom:0%">
    <div class="">
      <div class="owl-banner p-0">
         <div class="bgimg"><img src="./admin/include/HO_LOGO.png" alt=""></div> 
        <div class="image-container">
          <img src="./admin/include/Manonmaniam-Sundaranar-University.jpg" alt="">
          <div class="info">
            <h3>News</h3>
            <hr>
            <div class="inf_news" id="scrollingContainer">
              <div class="news_cont">

                <section class="news">
                  <?php
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $title = $row['title'];
                      $content = $row['content'];
                      $time = $row['date_published'];
                  ?>
                      <div class='news-item'>
                        <h3 class='news-title'><?php echo $title; ?></h3>
                        <p class='news-content'><?php echo $content; ?></p>
                        <h6 class='news-date'><?php echo $time; ?></h6 >
                      </div>
                  <?php
                    }
                  } else {
                    echo "<div class='no-news'>No news available.</div>";
                  }
                  ?>
                </section>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>-->
  <!-- Banner Ends Here -->

  <!-- <footer>
    <div class="container1 bg-dark">
      <div class="row">
        <div class="col-lg-12">
          <div class="copyright-text">
            <p><a href="#"></a>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia possimus repudiandae iure reprehenderit quis, ducimus esse qui odio eius obcaecati, culpa aperiam suscipit cumque neque sint aspernatur! Expedita, vero voluptas?
            </p>
          </div>
        </div>
      </div>
    </div>

  </footer> -->

  <script src="./dist/home/jquery.min.js.download"></script>
  <script src="./dist/home/bootstrap.bundle.min.js.download"></script>

  <!-- preloading -->
  <script src="./assets/libs/popper.js/dist/umd/popper.min.js "></script>

  <script>
    $(".preloader ").fadeOut();
  </script>

  <script>
    const scrollingContainer = document.getElementById('scrollingContainer');

    scrollingContainer.addEventListener('mouseenter', function(event) {
      scrollingContainer.style.cursor = 'pinter';
      scrollingContainer.querySelectorAll('.news_cont').forEach(function(el) {
        el.style.animationPlayState = 'paused';
      });
    });

    scrollingContainer.addEventListener('mouseleave', function(event) {
      scrollingContainer.style.cursor = 'auto';
      scrollingContainer.querySelectorAll('.news_cont').forEach(function(el) {
        el.style.animationPlayState = 'running';
      });
    });
  </script>

</body>

</html>