<?php
include('../dbconnect.php');
session_start();

if (!isset($_SESSION["name"])) {
  header("Location: ./admin_login.php");
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Hostel_Admin</title>
  <link rel="stylesheet" href="./include/materialdesignicons.min.css">
  <link rel="stylesheet" href="./include/vendor.bundle.base.css">
  <link rel="stylesheet" href="./include/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap');
</style>
  <link rel="stylesheet" href="../dist/css/style.min.css">

  <link rel="stylesheet" href="./include/style.css">
  <link rel="shortcut icon" href="./include/ho_login.png">
  <link rel="stylesheet" href="./include/exstyle.css">
  <link rel="stylesheet" href="./include/news.css">

  <style>
    .card-img-holder a {
      text-decoration: none;
      color: white;
      font-family: Georgia, 'Times New Roman', Times, serif;
    }

    .bg-gradient {
      background: linear-gradient(45deg, #94a2b3, #cbddf2);
      /* Other styling properties */
      color: white;
      padding: 20px;
    }
    .card-body h2, .page-title{
      font-family: 'Montserrat Alternates', sans-serif;
    }
    
  </style>
</head>

<body class="">
  <div class="container-scroller">

    <!-- Preloader --->

    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>

    <header class="topbar" data-navbarbg="skin6">
      <?php include './navbar.php' ?>
    </header>

    <div class="container-fluid page-body-wrapper pt-0 proBanner-padding-top">
      <?php include 'sidebar.php' ?>
      <div class="main-panel">

        <div class="content-wrapper p-4">
          <!-- dash section 
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>

            <div aria-label="breadcrumb row-5 bg-gradient-primary">
              <h5 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2"><i class="mdi mdi-calendar align-middle"></i></span>
              //  <?php $currentDate = date('d-m-Y');
               // echo $currentDate; ?>
              </h5>
            </div>
          </div>-->

          <!-- Dash data section -->

          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient card-img-holder text-white">
                <a href="./stud_detail.php">
                  <div class="card-body">
                    <img src="./include/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h2 class="font-weight-normal mb-1" style="color: black;">
                      <i class="mdi mdi-account mdi-24px float-right"></i>
                      <!-- studends count -->
                      <?php echo "Students Profile(Update): ";  ?>
                    </h2>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient card-img-holder text-white">
                <a href="./create_stud.php">
                  <div class="card-body">
                    <img src="./include/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h2 class="font-weight-normal mb-1" style="color: black;">
                      <i class="mdi mdi-message mdi-24px float-right"></i>
                      <!-- studends reg -->
                      <?php echo "Create Id for New Students: "; ?>
                    </h2>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient card-img-holder text-white">

                <a href="./stud_vacate.php">
                  <div class="card-body">
                    <img src="./include/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h2 class="font-weight-normal mb-1" style="color: black;">
                      <i class="mdi mdi-chart-line mdi-24px float-right"></i>

                      <!-- studends feed -->
                      <?php echo "Vacated Students: " ; ?>
                    </h2>
                  </div>
                </a>

              </div>
            </div>

            <!--<div class="col-md-3 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="./include/circle.svg" class="card-img-absolute" alt="circle-image">
                  <h4 class="font-weight-normal mb-1">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-1">95,5741</h2>
                  <h6 class="card-text">Increased by 5%</h6>
                </div>
              </div>
            </div> -->
          </div>


         <!-- <div class="col-md-7 grid-margin stretch-card p-0">
            <div class="card">
              <div class="card-body">

                <h1 class="card-title" style="font-size: 1.5rem; color: skyblue; font-weight:bolder;">Time table</h1>

                
              </div>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="./include/vendor.bundle.base.js.download"></script>
  <script src="./include/Chart.min.js.download"></script>
  <script src="./include/jquery.cookie.js.download" type="text/javascript"></script>
  <script src="./include/off-canvas.js.download"></script>
  <script src="./include/hoverable-collapse.js.download"></script>
  <script src="./include/misc.js.download"></script>
  <script src="./include/dashboard.js.download"></script>
  <script src="./include/todolist.js.download"></script>
  <script src="../assets/libs/jquery/dist/jquery.min.js "></script>
  <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
  <script src="../assets/home_img/popper.js.download"></script>

  <script src="../assets/libs/jquery/dist/jquery.min.js.download"></script>

  <script src="./include/vendor.bundle.base.js.download"></script>
  <script>
    function toggleCollapse(event) {
      event.preventDefault();
      var target = event.target;
      var parent = target.closest('.nav-item');
      var collapse = parent.querySelector('.collapse');
      var icon = parent.querySelector('.menu-icon');

      if (collapse.style.display === 'none') {
        collapse.style.display = 'block';
        icon.classList.add('rotate');
      } else {
        collapse.style.display = 'none';
        icon.classList.remove('rotate');
      }
    }

    var collapsedLinks = document.querySelectorAll('.nav-link.collapsed');
    for (var i = 0; i < collapsedLinks.length; i++) {
      collapsedLinks[i].addEventListener('click', toggleCollapse);
    }
  </script>


  <script>
    $(".preloader ").fadeOut();
  </script>

</body>

</html>