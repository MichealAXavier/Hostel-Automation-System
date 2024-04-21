<?php
include("../dbconnect.php");
session_start();

// Redirect to login page if user is not authenticated
if (!isset($_SESSION["name"])) {
    header("Location: ./admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "Reject" button is clicked
    if (isset($_POST["reject"])) {
        // Get the leave ID from the submitted form
        $leaveID = $_POST["reject"];

        // Fetch the record from leaveapp table using the leave ID
        $qry = mysqli_query($connect, "SELECT * FROM leaveapp WHERE leave_id = '$leaveID'");
        $row = mysqli_fetch_array($qry);

        // Check if the record exists
        if ($row) {
            // Insert the record into leaverej table
            mysqli_query($connect, "INSERT INTO leaverej (leave_id, ap_id, name, course_year, from_date, to_date, no_of_days, description,reg) VALUES ('$row[leave_id]', '$row[ap_id]', '$row[name]', '$row[course_year]', '$row[from_date]', '$row[to_date]', '$row[no_of_days]', '$row[description]','$row[reg]')");
            
            // Delete the record from leaveapp table
            mysqli_query($connect, "DELETE FROM leaveapp WHERE leave_id = '$leaveID'");
        } else {
            // Handle the case when the record does not exist
            echo "Record not found.";
        }
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>accepted leaves</title>
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
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-contacts menu-icon"></i>
                            </span>Accepted leave Applications
                        </h3>

                        

                        <div class="view_room">
                            <a href="./reject_leave.php">
                                <button type="button" class="btn bg-white rounded font-weight-bold text-dark pl-3 pr-3" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;"><i class="mdi mdi-close menu-icon m-0 mr-2"></i>
                                Rejected Leaves</button>
                            </a>
                        </div>
                        
                    </div>
                     
                    <!-- Dash data section -->

                    <div class="grid-margin card p-3 stretch-card" style="overflow: hidden;">
                            <form method="post">
                            <table class="table table-responsive-xl table-sm">
            <thead>
                <tr>
                    <th>Leave ID</th>
                    <th>AP_ID</th>
                    <th>Name</th>
                    <th>Course & Year</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>No of Days</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qry = mysqli_query($connect, "SELECT * FROM leaveapp");
                while ($row = mysqli_fetch_array($qry)) {
                ?>
                <tr>
                    <td><?php echo $row['leave_id']; ?></td>
                    <td><?php echo $row['ap_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['course_year']; ?></td>
                    <td><?php echo $row['from_date']; ?></td>
                    <td><?php echo $row['to_date']; ?></td>
                    <td><?php echo $row['no_of_days']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <form method="post">
                            <button type="submit" class="btn btn-danger btn-sm m-3" name="reject" value="<?php echo $row['leave_id']; ?>">Delete</button>
                        </form>
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
                <!-- <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"></span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></span>
                    </div>
                </footer> -->
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
        $(".preloader ").fadeOut();
    </script>
<script>
    const apIDInput = document.getElementById("ap_id");
    apIDInput.addEventListener("input", function() {
        const searchID = apIDInput.value.trim().toLowerCase();
        const tableRows = document.querySelectorAll(".alert");
        
        tableRows.forEach(function(row) {
            const idCell = row.querySelector("td:nth-child(1) div");
            const apID = idCell.textContent.trim().toLowerCase();

            if (apID.includes(searchID)) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>

</body>

</html>