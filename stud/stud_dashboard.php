<?php
include("../dbconnect.php");
extract($_POST);
session_start();
// $reg = $_SESSION['reg'];

// Check if the user is logged in
if (!isset($_SESSION["reg"])) {
    header("Location: ../stud_login.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MSU Hostel</title>
  <link rel="stylesheet" href="../admin/include/materialdesignicons.min.css">
  <link rel="stylesheet" href="../admin/include/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../dist/css/style.min.css">
  <link rel="stylesheet" href="./include/style.css">
  <link rel="stylesheet" href="../admin/include/style.css">
  <link rel="shortcut icon" href="../admin/include/ho_login.png">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap');
</style>

  <style>
    .card-img-holder a {
      text-decoration: none;
      color: white;
      font-family: Georgia, 'Times New Roman', Times, serif;
    }

    .bg-gradient {
    background: linear-gradient(45deg, #94a2b3,#cbddf2);
    /* Other styling properties */
    color: white;
    padding: 20px;
}
.card-body h2{
  font-family: 'Montserrat Alternates', sans-serif;
}
  </style>
</head>

<body class="">
  <div class="container-scroller">

    <!-- <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div> -->
    <header class="topbar" data-navbarbg="skin6">
      <?php include './stud_navbar.php' ?>
    </header>

    <div class="container-fluid page-body-wrapper pt-0 proBanner-padding-top">
      <div class="navcantainer d-fixed">
        <?php include './stud_sidebar.php' ?>
      </div>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper p-4">

          <!-- dash section -->

          <div class="page-header">
            <h3 class="page-title"style="font-family: 'Montserrat Alternates', sans-serif;
">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>
          </div>
              
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient card-img-holder text-white">
              <a href="./stud_feespay.php">
                  <div class="card-body">
                    <img src="../admin/include/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h2 class="font-weight-normal mb-1">
                      Fees Pay
                      <i class="mdi mdi-message mdi-24px float-right"></i>
                    </h2>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient card-img-holder text-white">
              <a href="./mess_leave.php">
                  <div class="card-body">
                    <img src="../admin/include/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h2 class="font-weight-normal mb-1">
                      Mess Leave Request
                      <i class="mdi mdi-account mdi-24px float-right"></i>
                    </h2>
                  </div>
                </a>
              </div>
            </div>


            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient card-img-holder text-white">
              <a href="./stud_profile.php">
                  <div class="card-body">
                    <img src="../admin/include/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h2 class="font-weight-normal mb-1">
                      Complaint
                      <i class="mdi mdi-account mdi-24px float-right"></i>
                    </h2>
                  </div>
                </a>
              </div>
            </div>
          </div>


         
          </div>
        </div>
      </div>
    </div>
    <script src="../admin/include/vendor.bundle.base.js.download"></script>
    <script src="../admin/include/Chart.min.js.download"></script>
    <script src="../admin/include/jquery.cookie.js.download" type="text/javascript"></script>
    <script src="../admin/include/off-canvas.js.download"></script>
    <script src="../admin/include/hoverable-collapse.js.download"></script>
    <script src="../admin/include/misc.js.download"></script>
    <script src="../admin/include/dashboard.js.download"></script>
    <script src="../admin/include/todolist.js.download"></script>
    <script src="../assets/libs/jquery/dist/jquery.min.js "></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script src="../admin/include/vendor.bundle.base.js.download"></script>
    <script>
      $(".preloader ").fadeOut();
    </script>

</body>

</html>