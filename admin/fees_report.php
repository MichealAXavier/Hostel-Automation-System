<?php
include("../dbconnect.php");
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: ./admin_login.php");
    exit();
}

$filterApplied = isset($_POST['month']) && !empty($_POST['month']);

// Function to update 'laction' column in the database
function updateLaction($id) {
    global $connect;
    $query = "UPDATE amnt SET laction = 'paid' WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Check if the paid button is clicked
if (isset($_POST['paid_id'])) {
    $paid_id = $_POST['paid_id'];
    updateLaction($paid_id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fees Details</title>
    <link rel="stylesheet" href="./include/materialdesignicons.min.css">
    <link rel="stylesheet" href="./include/vendor.bundle.base.css">
    <link rel="stylesheet" href="./include/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link href="Table 05_files/css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="Table 05_files/font-awesome.min.css">
    <link rel="stylesheet" href="Table 05_files/style.css">
    <link rel="stylesheet" href="./include/style.css">
    <link rel="shortcut icon" href="./include/ho_login.png">
    <link rel="stylesheet" href="./include/exstyle.css">
    <style>
        table .fw-bolder {
            font-weight: bolder;
            font-size: 1rem;
        }
        .asd {
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
                    <!-- Dash section -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-contacts menu-icon"></i>
                            </span>Fees Report
                        </h3>
                    </div>
                    <!-- Search Form -->
                    <form method="POST" action="">
                        <div class="input-group" style="bottom:10px ;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: white;width: 50px; padding:0%"><i class="mdi mdi-calendar" style="font-size:2rem; left:10px;top:5px;position:absolute;"></i></span>
                            </div>
                            <input type="month" name="month" id="month" class="form-control" >
                            
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    <!-- Dash data section -->
                    <div class="grid-margin card p-3 stretch-card" style="overflow: hidden;">
                        <form method="post">
                            <table class="table table-responsive-xl">
                                <thead class="bg-light asd">
                                    <tr>
                                        <th class="fw-bolder" scope="col">Reg</th>
                                        <th class="fw-bolder" scope="col">Name</th>
                                        <th class="fw-bolder" scope="col">Mess Fees</th>
                                        <th class="fw-bolder" scope="col">Electricity Charges</th>
                                        <th class="fw-bolder" scope="col">Total Fees</th>
                                        <th class="fw-bolder" scope="col">Month</th>
                                        <th class="fw-bolder" scope="col">Last Date</th>
                                        <th class="fw-bolder" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Fetch data based on filter or display all data
                                        if ($filterApplied) {
                                            // Filter applied, fetch data based on filter
                                            $month = $_POST['month'];
                                            $qry = mysqli_query($connect, "SELECT * FROM amnt WHERE month = '$month'");
                                        } else {
                                            // No filter applied, fetch all data
                                            $qry = mysqli_query($connect, "SELECT * FROM amnt");
                                        }

                                        while ($row = mysqli_fetch_array($qry)) {
                                    ?>
                                        <tr class="alert asd" role="alert">
                                            <td><?php echo $row['reg']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['mess_fees']; ?></td>
                                            <td><?php echo $row['electricity_charges']; ?></td>
                                            <td><?php echo $row['total_fees']; ?></td>
                                            <td><?php echo $row['month']; ?></td>
                                            <td><?php echo $row['last_date']; ?></td>
                                            <td>
                                                <?php
                                                    // Display "Paid" button only if the action is not marked as "paid"
                                                    if ($row['laction'] != 'paid') {
                                                        echo '<button class="btn btn-primary paid-button" data-id="' . $row['id'] . '">Paid</button>';
                                                    } else {
                                                        echo '<span>Paid</span>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
        // JavaScript to handle the click event of the "Paid" button
        document.addEventListener('DOMContentLoaded', function() {
            var paidButtons = document.querySelectorAll('.paid-button');
            paidButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var id = button.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'fees_report.php', true); // Updated path
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // Replace the button with 'Paid' label
                            button.parentNode.innerHTML = '<span>Paid</span>';
                        } else {
                            console.log('Error updating payment');
                        }
                    };
                    xhr.send('paid_id=' + id);
                });
            });
        });
    </script>
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>
</html>
