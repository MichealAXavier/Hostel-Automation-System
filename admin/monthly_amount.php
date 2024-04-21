<?php
include("../dbconnect.php");
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: ./admin_login.php");
    exit();
}

// Check if fees for the selected month already exist
if (isset($_POST['btn'])) {
    $month = $_POST['month'];
    $check_query = mysqli_query($connect, "SELECT * FROM amnt WHERE month = '$month'");
    if (mysqli_num_rows($check_query) > 0) {
        echo "<script>alert('Fees for $month have already been generated.')</script>";
        exit(); // Exit to prevent further execution
    }

    $hf = $_POST['hf'];
    $mf = $_POST['mf'];
    $date = $_POST['date'];
    
    // Fetch all students from the students table
    $student_query = mysqli_query($connect, "SELECT * FROM students");
    
    // Iterate through each student and calculate fees
    while ($student_row = mysqli_fetch_assoc($student_query)) {
        $reg = $student_row['reg']; // Adjusted column name
        $name = $student_row['name']; // Adjusted column name
        
        // Calculate total days in the selected month
       // Calculate total days in the selected month
$yearMonth = date('Y-m', strtotime($month));
$total_days_in_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($month)), date('Y', strtotime($month)));

// Fetch the total number of accepted leaves for the student in the selected month
$leave_query = mysqli_query($connect, "SELECT SUM(no_of_days) AS total_leave_days FROM leaveapp WHERE reg = '$reg' AND (DATE_FORMAT(from_date, '%Y-%m') = '$yearMonth' OR DATE_FORMAT(to_date, '%Y-%m') = '$yearMonth') GROUP BY reg");

$leave_row = mysqli_fetch_assoc($leave_query);
$accepted_leave_days = isset($leave_row['total_leave_days']) ? (int)$leave_row['total_leave_days'] : 0; // Convert to integer to ensure it's a numeric value

// Ensure $hf is a numeric value
$hf = floatval($hf); // Convert $hf to a float (assuming it represents a decimal value)
$mess_fees = ($total_days_in_month - $accepted_leave_days) * $hf;

        
        // Insert the calculated fees into the amnt table
        $insert_query = mysqli_query($connect, "INSERT INTO amnt (reg, name, mess_fees, electricity_charges, total_fees, month, last_date) VALUES ('$reg', '$name', '$mess_fees', '$mf', '$mess_fees' + '$mf', '$month', '$date')");
        
        if (!$insert_query) {
            echo "<script>alert('Error occurred while generating fees for $name.')</script>";
        }
    }
    
    echo "<script>alert('Fees generated successfully for all students.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hostel_Management</title>
    <link rel="stylesheet" href="../admin/include/materialdesignicons.min.css">
    <link rel="stylesheet" href="../admin/include/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="../admin/include/exstyle.css">
    <link rel="stylesheet" href="../admin/include/style.css">
    <link rel="shortcut icon" href="../admin/include/ho_login.png">
    <style>
        .container {
            margin-top: 20px;
            width: 700px;
            background-color: #fff;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
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
                    <div class="page-header">
                        <h3 class="page-title" style="font-family: 'Montserrat Alternates', sans-serif;">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-cash-multiple menu-icon"></i>
                            </span> Fees pay
                        </h3>
                    </div>
                    <div class="card d-flex justify-content-center align-items-center">
                        <form class="card-body" style="align-items:center;justify-content:center;" id="generate-fees-form" name="generate-fees-form" method="post" action="#">
                            <div class="m-10 bg-light p-4" style="box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;">
                                <div class="col">
                                    <div class="grid gap-0 row-gap-3">
                                        <div class="p-2 g-col-6">Mess Fees(Per Day)</div>
                                        <div class="p-2 g-col-6"><input name="hf" type="text" class="form-control" placeholder="Enter Mess Fees" id="hf" required /></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="grid gap-0 row-gap-3">
                                        <div class="p-2 g-col-6">Electricity Charges</div>
                                        <div class="p-2 g-col-6"><input name="mf" type="text" class="form-control" placeholder="Enter Electricity Charges" id="mf" required /></div>
                                    </div>
                                </div>
                                <div class="col">
    <div class="grid gap-0 row-gap-3">
        <div class="p-2 g-col-6">Month and Year</div>
        <div class="p-2 g-col-6">
            <input type="month" name="month" id="month" class="form-control" required>
        </div>
    </div>
</div>

                                <div class="col">
                                    <div class="grid gap-0 row-gap-3">
                                        <div class="p-2 g-col-6">Last Date</div>
                                        <div class="p-2 g-col-6"><input name="date" type="date" class="form-control" placeholder="Last Date" id="date" required/></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="grid gap-0 row-gap-3">
                                        <div class="p-2 g-col-6"></div> <!-- Placeholder for alignment -->
                                        <div class="p-2 g-col-6">
                                            <?php
                                            if (isset($_POST['btn'])) {
                                                echo '<button class="btn btn--radius-2 btn--blue btn btn-primary m-5" name="btn" type="submit" id="btn" value="Submit" disabled>Generate Fees</button>';
                                                echo '<button class="btn btn--radius-2 btn--blue btn btn-primary m-5" type="reset" name="reset" value="Reset">Reset</button>';
                                            } else {
                                                echo '<button class="btn btn--radius-2 btn--blue btn btn-primary m-5" name="btn" type="submit" id="btn" value="Submit">Generate Fees</button>';
                                                echo '<button class="btn btn--radius-2 btn--blue btn btn-primary m-5" type="reset" name="reset" value="Reset">Reset</button>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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