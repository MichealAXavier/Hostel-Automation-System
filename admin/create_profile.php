<?php
include("../dbconnect.php");
session_start();

if (!isset($_SESSION["name"])) {
	header("Location: ./admin_login.php");
	exit();
}

?>
<?php
$rej_send = "";
$errormail = "";

$_SESSION['rej_send'] = $rej_send;
$_SESSION['errormail'] = $errormail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'armxavier13@gmail.com';
        $mail->Password = 'kkwb oqeo xdbv puah';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('armxavier13@gmail.com', 'Hostel Admin');
        $mail->addReplyTo('info@gmail.com', 'Information');
        $mail->isHTML(true);


        // Check which button was clicked
        if (isset($_POST['approve'])) {
            $reg = $_POST['reg'];
        
            $sql = "SELECT * FROM studapp WHERE reg = '$reg'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
        
            $reg_date = date("Y-m-d H:i:s");
            
            $insert_sql = "INSERT INTO students (ap_id, stud_id, name, reg, dept, year, fathname, fathphone, age, dob, bldgrp, email, phone, address, image, request_letter, reg_date, physically_challenged, programme, room_no) VALUES (
                '{$row['ap_id']}', '{$row['stud_id']}', '{$row['name']}', '{$row['reg']}', '{$row['dept']}', '{$row['year']}', '{$row['fathname']}', '{$row['fathphone']}', '{$row['age']}', '{$row['dob']}', '{$row['bldgrp']}', '{$row['email']}', '{$row['phone']}', '{$row['address']}', '{$row['image']}', '{$row['request_letter']}', '{$row['reg_date']}', '{$row['physically_challenged']}', '{$row['programme']}', '{$row['room_no']}')";
            
            mysqli_query($connect, $insert_sql);
        
            // Send approval notification email
            $mail->addAddress($row['email']);
            $mail->Subject = 'MSU Hostel Room allot and User ID';
            $mail->Body = 'Congratulations, ' . $row['name'] . '! Welcome to MSU Hostel.<br>
            Your Alloted Room No is, '. $row['room_no'] .'<br>Your User Id and Password is <br>
            Your Name and Clg Admission Number';
        
            // Delete only the specific record corresponding to the accepted application
            $delete_rq = "DELETE FROM studapp WHERE reg = '$reg'";
            mysqli_query($connect, $delete_rq);
        }
         elseif (isset($_POST['reject'])) {
            $reg = $_POST['reg'];
            $sql = "SELECT * FROM studrej WHERE reg = '$reg'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
        
            $reject_sql = "INSERT INTO studrej (ap_id, stud_id, name, reg, dept, year, fathname, fathphone, age, dob, bldgrp, email, phone, address, image, request_letter, reg_date, physically_challenged, programme) VALUES (
                '{$row['ap_id']}', '{$row['stud_id']}', '{$row['name']}', '{$row['reg']}', '{$row['dept']}', '{$row['year']}', '{$row['fathname']}', '{$row['fathphone']}', '{$row['age']}', '{$row['dob']}', '{$row['bldgrp']}', '{$row['email']}', '{$row['phone']}', '{$row['address']}', '{$row['image']}', '{$row['request_letter']}', '{$row['reg_date']}', '{$row['physically_challenged']}', '{$row['programme']}' )";
            
            mysqli_query($connect, $reject_sql);
        
            // Reject button was clicked
            $mail->setFrom('armxavier13@gmail.com', 'Hostel Admin');
            $mail->addAddress($row['email']);
            $mail->Subject = 'Rejection Notification';
            $mail->Body = 'Sorry ' . $row['name'] . ' for Your Hostel Admission request has been rejected.';
        
            // Delete only the specific record corresponding to the rejected application
            $delete_rj = "DELETE FROM studapp WHERE reg = '$reg'";
            mysqli_query($connect, $delete_rj);
        }
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        $_SESSION['rej_send'] =  $row['name'] . "'s application has been rejected.";
    } catch (Exception $e) {
        $_SESSION['errormail'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    header("Location: ./create_stud.php?=id");
    exit();
}

if (isset($_GET['reg'])) {
    $reg = $_GET['reg'];
    $qry = mysqli_query($connect, "SELECT * FROM studapp WHERE reg='$reg'");
    $row = mysqli_fetch_assoc($qry);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>stud_details</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./include/materialdesignicons.min.css">
    <link rel="stylesheet" href="./include/vendor.bundle.base.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="./include/style.css">
    <!-- Add this link to your HTML head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="../dist/css/style.min.css">

    <!-- external -->
    <link href="Table 05_files/css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="Table 05_files/font-awesome.min.css">
    <link rel="stylesheet" href="Table 05_files/style.css">
    <!-- endinject -->
    <link rel="stylesheet" href="./include/style.css">
    <link rel="shortcut icon" href="./include/ho_login.png">
    <link rel="stylesheet" href="./include/exstyle.css">

    <style>
        table .fw-bolder {
            font-weight: bolder;
            font-size: 1rem;
            /* font-size: 10px; */
        }

        .asd {
            /* flex-wrap: wrap; */
            /* width: fit-content; */
            width: 12000px;
        }

        .as {
            font-size: 15px;
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
            <?php include 'navbar.php' ?>
        </header>
        <div class="container-fluid page-body-wrapper pt-0 proBanner-padding-top">
            <div class="navcantainer d-fixed">
                <?php include 'sidebar.php' ?>
            </div>
            <div class="main-panel">
                <div class="content-wrapper p-4">

                    <!-- dash section -->
                    <div class="page-header m-0">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-contacts menu-icon"></i>
                            </span>Create Profile
                        </h3>
                        <div class="page-header bg-white pl-4 pr-4 rounded" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;">
                            <h3 type="text" class="p-0" name="ap_id" style="font-size:1rem;">AP_ID: <?php echo $row['ap_id']; ?></h3>
                            <h3 type="text" class="p-4" name="stud_id" style="font-size:1rem;">STUD_ID: <?php echo $row['stud_id']; ?></h3>
                            <img style="border-radius: 20px; height:60px;" src="./include/<?php echo $row['image']; ?>">
                        </div>
                    </div>
                    <!-- Dash data section -->
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

        <div class="m-1 col-md-5">
            <div style="margin-top:10px;">
                <label for="fathphone">Room No</label><br>
                <input type="text" class="form-control" name="room_no" disabled value="<?php echo $row['room_no']; ?>" style="font-size:1rem; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
        </div>

                                                    <div class="col-10 p-0">
                                                    <button type="submit" class="btn btn-success m-3" name="approve" value="approve">Create Profile</button>
                                                    <button type="submit" class="btn btn-danger m-3" name="reject" value="reject">Delete Profile</button>
                                                    </div>
                                                </div>

                                          
                                    </div>

                                    </form>
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

    <script src="../admin/include/vendor.bundle.base.js.download"></script>
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
        $(document).ready(function() {
            // Show the success message
            $("#successMessage").fadeIn();

            // Hide the success message after 10 seconds
            setTimeout(function() {
                $("#successMessage").fadeOut();
            }, 20000); // 10 seconds (10,000 milliseconds)
        });
    </script>

    <script>
        $(".preloader ").fadeOut();
    </script>

</body>

</html>
