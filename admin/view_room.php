<?php
include("../dbconnect.php");
extract($_POST);
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
    <title>room_details</title>
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
                            </span>Room Details
                        </h3>
                        <div class="stud_req">
                            <a href="./allot_profile.php">
                                <button type="button" class="btn bg-white rounded font-weight-bold text-dark pl-3 pr-3" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;"><i class="mdi mdi-arrow-left menu-icon m-0 mr-2"></i>Room Allotment</button>
                            </a>
                        </div>
                    </div>
                     <!-- Search Form -->
                     <form method="POST" action="">
                        <div class="input-group" style="bottom:10px ;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: white;width: 50px; padding:0%"><i class="mdi mdi-magnify" style="font-size:2rem; left:10px;top:5px;position:absolute;"></i></span>
                            </div>
                            <input type="text" class="form-control" style="font-size: 1rem;" id="room" name="room" placeholder="Search by Room Number">
                        </div>
                    </form>
                    <!-- Dash data section -->

                    <div class="grid-margin card p-3 stretch-card" style="overflow: hidden;">
                            <form method="post" action=".view_room.php">
                                <table class="table table-responsive-xl">
                                    <thead class="bg-light asd">
                                        <tr>
                                            <th class="fw-bolder" scope="col">ID</th>
                                            <th class="fw-bolder" scope="col">Floor</th>
                                            <th class="fw-bolder" scope="col">Room No.</th>
                                            <!-- <th class="fw-bolder" scope="col">Father Name</th> -->
                                            <th class="fw-bolder" scope="col">Students Limit</th>
                                            <th class="fw-bolder" scope="col">stayed students</th>
                                             </tr>
                                    </thead>

                                    <?php
                        $noResults = true; // Flag to check if there are no search results
                        if (isset($_POST['room'])) {
                            $searchID = mysqli_real_escape_string($connect, $_POST['room']);
                            $qry = mysqli_query($connect, "SELECT * FROM rooms WHERE room LIKE '%$searchID%'");
                        } else {
                            $qry = mysqli_query($connect, "SELECT * FROM rooms");
                        }
                        $i = 1;
                        
                            while ($row = mysqli_fetch_array($qry)) {
                                $reg = $row['id'];
                            ?>
                                        <tr class="alert asd" role="alert">
                                            <td>
                                                <div class="as"><?php echo $row['id']; ?></div>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            </td>
                                            <td>
                                                <div class="as"><?php echo $row['floor']; ?></div>
                                            </td>
                                            <td>
                                                <div class="as"><?php echo $row['room']; ?></div>
                                            </td>
                                            <td>
                                            
                                                <div class="as"><?php echo $row['no_of_students']; ?></div>
                                            </td>
                                            <td>
                                                <div class="as"><?php echo $row['staying_students']; ?></div>
                                            </td>
                                            
                                          <!--  <td>
                                                <a href="room_profile.php?id=<?php echo $row['id']; ?>">
                                                    <button type="button" class="btn btn-primary">View</button>
                                                </a>
                                            </td>-->
                                        </tr><?php
                                $i++;
                            }
                            ?>
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