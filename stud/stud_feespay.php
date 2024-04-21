

<?php
include("../dbconnect.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION["reg"])) {
    header("Location: ../stud_login.php"); 
    exit();
}

// Get the registration number of the logged-in student
$reg = $_SESSION["reg"];

// Check if $reg is set and not empty
if (isset($reg) && !empty($reg)) {
    // Query to fetch mess leave data for the logged-in student
    $qry = mysqli_query($connect, "SELECT * FROM amnt WHERE reg='$reg'");
} else {
    // Handle the case when $reg is not set or empty
    echo "Error: Registration number is not set or empty.";
    exit(); // Exit script to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fees Details</title>
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
            background: linear-gradient(45deg, #94a2b3, #cbddf2);
            /* Other styling properties */
            color: white;
            padding: 20px;
        }

        .card-body h2 {
            font-family: 'Montserrat Alternates', sans-serif;
        }

        /* Adjust the width of form elements */
        .form-control {
            width: 400px;
            /* Adjust the width as needed */
        }

        /* Reduce padding around form elements */
        .form-group {
            margin-bottom: 10px;
            /* Reduce bottom margin */
        }

        /* Optional: Reduce padding inside form elements */
        .form-control {
            padding: 8px;
            /* Adjust padding as needed */
        }

        /* Optional: Reduce padding inside form elements */
        textarea.form-control {
            padding: 8px;
            /* Adjust padding as needed */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Adjust as needed */
        }
    </style>
</head>

<body class="">
    <div class="container-scroller">
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

                    <!-- Mess Leave Request form -->
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center mb-4">Fees Details</h2>

                               
                                <form method="post">
                <table class="table table-responsive-xl table-sm">
                    <thead>
                    <tr>
                                        <th class="fw-bolder" scope="col">Reg</th>
                                        <th class="fw-bolder" scope="col">Name</th>
                                        <th class="fw-bolder" scope="col">Mess Fees</th>
                                        <th class="fw-bolder" scope="col">Electricity Charges</th>
                                        <th class="fw-bolder" scope="col">Total Fees</th>
                                        <th class="fw-bolder" scope="col">Month</th>
                                        <th class="fw-bolder" scope="col">Last Date</th>
                                        <th class="fw-bolder" scope="col">Payment Status</th>
                                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch mess leave data for the logged-in student
                        $qry = mysqli_query($connect, "SELECT * FROM amnt WHERE reg='$reg'");
//echo mysqli_num_rows($qry); // Add this line to check the number of rows returned

                        // Loop through fetched mess leave data
                        while ($row = mysqli_fetch_array($qry)) {
                        ?>
                            <tr>
                            <td><?php echo $row['reg']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['mess_fees']; ?></td>
                                            <td><?php echo $row['electricity_charges']; ?></td>
                                            <td><?php echo $row['total_fees']; ?></td>
                                            <td><?php echo $row['month']; ?></td>
                                            <td><?php echo $row['last_date']; ?></td>
                                            <td>
    <?php 
        if ($row['laction'] === null) {
            echo "Unpaid";
        } else {
            echo "<a href='receipt.php?id=".$row['id']."'>Paid</a>";
        }
    ?>
</td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
        <!-- End Mess Leave Request form -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var fromDateInput = document.querySelector('input[name="from_date"]');
            var toDateInput = document.querySelector('input[name="to_date"]');
            var noOfDaysInput = document.getElementById('noOfDays');

            fromDateInput.addEventListener('input', updateNoOfDays);
            toDateInput.addEventListener('input', updateNoOfDays);

            function updateNoOfDays() {
                var fromDate = new Date(fromDateInput.value);
                var toDate = new Date(toDateInput.value);
                var timeDiff = toDate.getTime() - fromDate.getTime();
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                noOfDaysInput.value = diffDays >= 0 ? diffDays : '';
            }
        });
    </script>

</body>

</html>
