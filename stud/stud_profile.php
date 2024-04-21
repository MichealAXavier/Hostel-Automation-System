<?php
include("../dbconnect.php");
extract($_POST);
session_start();

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
  <title>Hotel_Management</title>
  <link rel="stylesheet" href="../admin/include/materialdesignicons.min.css">
  <link rel="stylesheet" href="../admin/include/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../dist/css/style.min.css">
  <link rel="stylesheet" href="./include/style.css">
  <link rel="stylesheet" href="../admin/include/style.css">
  <link rel="shortcut icon" href="../admin/include/ho_login.png">

  <style>
    .card-img-holder a {
      text-decoration: none;
      color: white;
      font-family: Georgia, 'Times New Roman', Times, serif;
    }

    .bg-gradient {
      background: linear-gradient(45deg, #94a2b3, #cbddf2);
      color: white;
      padding: 20px;
    }

    .form-control {
      font-size: 1rem;
    }
  </style>
</head>

<body class="">
  <div class="container-scroller">
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
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
          <div class="page-header m-0">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span> Profile
            </h3>
            <?php
            $user_id = $_SESSION["reg"];
            $query = "SELECT * FROM students WHERE reg = '$user_id'";
            $result = mysqli_query($connect, $query);
            if ($result) {
              $row = mysqli_fetch_assoc($result);
            ?>
              <div class="page-header bg-white pl-4 pr-4 rounded" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;">
                <h3 type="text" class="p-0" name="ap_id" style="font-size:1rem;">AP_ID: <?php echo $row['ap_id']; ?></h3>
                <h3 type="text" class="p-4" name="stud_id" style="font-size:1rem;">STUD_ID: <?php echo $row['stud_id']; ?></h3>
                <img style="border-radius: 20px;height:60px;" src="include/<?php echo $row['image']; ?>">
              </div>
          </div>

          <div class="formbold-main-wrapper card  justify-content-center align-items-center">
          <form method="post">
    <div class="row mt-0 justify-content-center p-3 align-items-center">
        <input type="hidden" name="reg" value="<?php echo $row['reg']; ?>">
        <div class="m-1 col-md-5">
            <div style="margin-top:10px;">
                <label for="name">Name</label><br>
                <input type="text" class="form-control" name="name" disabled value="<?php echo $row['name']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-top:10px;">
                <label for="reg">Reg No</label><br>
                <input type="text" class="form-control" name="reg" disabled value="<?php echo $row['reg']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-top:10px;">
                <label for="programme">Programme</label><br>
                <input type="text" class="form-control" name="programme" disabled value="<?php echo $row['programme']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
        </div>
        <div class="m-1 col-md-5">
            <div style="margin-top:10px;">
                <label for="dept">Department</label><br>
                <input type="text" class="form-control" name="dept" disabled value="<?php echo $row['dept']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-top:10px;">
                <label for="year">Year</label><br>
                <input type="text" class="form-control" name="year" disabled value="<?php echo $row['year']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-top:10px;">
                <label for="request_letter">Request Letter (PDF)</label><br>
                <!-- Add a link to the request letter PDF -->
                <a href="./include/' . $row['request_letter'] . '" target="_blank">View Request Letter</a>
            </div>
            <div style="margin-top:10px;">
    <label for="physically_challenged">Physically Challenged</label><br>
    <input type="text" class="form-control" name="physically_challenged" disabled value="<?php echo $row['physically_challenged'] == 'Yes' ? 'Yes' : 'No'; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
</div>

        </div>

        <div class="m-1 col-md-5">
            <div style="margin-top:10px;">
                <label for="phone">Phone</label><br>
                <input type="text" class="form-control" name="phone" disabled value="<?php echo $row['phone']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-top:10px;">
                <label for="email">Email</label><br>
                <input type="text" class="form-control" name="email" disabled value="<?php echo $row['email']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
        </div>

        <div class="m-1 col-md-5">
            <div style="margin-top:10px;">
                <label for="age">Age:</label><br>
                <input type="text" class="form-control" name="age" disabled value="<?php echo $row['age']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-top:10px;">
                <label for="dob">Dob</label><br>
                <input type="text" class="form-control" name="dob" disabled value="<?php echo $row['dob']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
        </div>

        <div class="m-1 col-md-5">
            <div style="margin-top:10px;">
                <label for="bldgrp">Blood Group</label><br>
                <input type="text" class="form-control" name="bldgrp" disabled value="<?php echo $row['bldgrp']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            

            <div style="margin-top:10px;">
                <label for="fathname">Father Name</label><br>
                <input type="text" class="form-control" name="fathname" disabled value="<?php echo $row['fathname']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div style="margin-top:10px;">
                <label for="fatame">Room No</label><br>
                <input type="text" class="form-control" name="room_no" disabled value="<?php echo $row['room_no']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
        </div>

        <div class="m-1 col-md-5">
            <div style="margin-top:10px;">
                <label for="fathphone">Father Phone</label><br>
                <input type="text" class="form-control" name="fathphone" disabled value="<?php echo $row['fathphone']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-top:10px;">
                <label for="address">Address</label><br>
                <textarea name="address" cols="30" class="form-control" disabled style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?php echo $row['address']; ?></textarea>
            </div>
        </div>
                                                   
                                                </div>

                                          
                                    </div>

                                    </form>
                                            </div>
        <?php

            } else {
              die("Error: " . mysqli_error($connect));
            }
        ?>
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