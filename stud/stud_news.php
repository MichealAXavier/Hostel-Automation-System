<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../dbconnect.php");
extract($_POST);
session_start();

if (!isset($_SESSION["reg"])) {
    header("Location: ../stud_login.php");
    exit();
}

// Query to select news items
$query = "SELECT * FROM news";

// Execute the query
$result = mysqli_query($connect, $query);

// Check for errors
if (!$result) {
    die("Database query failed: " . mysqli_error($connect));
}

// Debugging: Output the number of rows fetched
$num_rows = mysqli_num_rows($result);
echo "Number of rows fetched: $num_rows<br>";

// Debugging: Output the data fetched
while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Announcement</title>
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
</head>

<body class="">
    <div class="container-scroller">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="container-scroller">
            <header class="topbar" data-navbarbg="skin6">
                <?php include './stud_navbar.php' ?>
            </header>

            <div class="container-fluid page-body-wrapper pt-0 proBanner-padding-top">
                <div class="navcantainer d-fixed">
                    <?php include './stud_sidebar.php' ?>
                </div>
                <div class="main-panel">
                    <div class="content-wrapper p-3">
                        <div class="page-header">
                            <h3 class="page-title" style="font-family: 'Montserrat Alternates', sans-serif;">
                                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                    <i class="mdi mdi-newspaper menu-icon"></i>
                                </span> Posted News
                            </h3>
                        </div>
                        <div class="card d-flex justify-content-center align-items-center">
                            <div class="card-body col-12">
                                <div class="col p-0">
                                
                                <form method="post">
    <table class="table table-responsive-xl table-sm">
        <thead>
            <tr>
                <th>News ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Date Published</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch news data
            $qry = mysqli_query($connect, "SELECT * FROM news");

            // Check if there are rows returned
            if (mysqli_num_rows($qry) > 0) {
                // Loop through fetched news data
                while ($row = mysqli_fetch_assoc($qry)) {
                    ?>
                    <tr>
                        <td><?php echo $row['news_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['content']; ?></td>
                        <td><?php echo $row['date_published']; ?></td>
                    </tr>
                <?php
                }
            } else {
                // No news items found
                ?>
                <tr>
                    <td colspan="4">No news items found.</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</form>


                                </div>
                            </div>
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

        // Add click event listeners to all the collapsed menu items
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


