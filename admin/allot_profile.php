<?php
// Start PHP session
session_start();

// Include necessary files
include("../dbconnect.php");

// Redirect to login page if admin not logged in
if (!isset($_SESSION["name"])) {
    header("Location: ./admin_login.php");
    exit();
}

// Function to set a message in session
function set_message($message, $type = 'success') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

// Function to get and clear a message from session
function get_message() {
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    $type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'info';

    // Clear the message from session
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);

    return array($message, $type);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['allot'])) {
    // Get form data
    $reg = $_POST['reg'];

    // Fetch student details to determine their attributes
    $studentQuery = mysqli_query($connect, "SELECT * FROM studapp WHERE reg='$reg'");
    $student = mysqli_fetch_assoc($studentQuery);

    // Initialize room number
    $roomNo = '';

    
    if ($student['physically_challenged'] == 'Yes') {
        // Allot to the ground floor
        $roomNo = 'G'; // Change this according to your room numbering system for the ground floor
    } else {
        // Allot based on programme
        $programme = $student['programme'];

        // Determine the floor based on the programme
        if ($programme == 'PG' || $programme == 'Research Scholar') {
            // Allot to the F floor
            $roomNo = 'F'; // Change this according to your room numbering system for the F floor
        } elseif ($programme == 'UG' || $programme == 'Integrate') {
            // Allot to the S floor
            $roomNo = 'S'; // Change this according to your room numbering system for the S floor
        }
    }

    // Check for available rooms on the selected floor
    $availableRoomsQuery = mysqli_query($connect, "SELECT room FROM rooms WHERE floor = '$roomNo' AND staying_students < no_of_students ORDER BY room ASC LIMIT 1");
    if (mysqli_num_rows($availableRoomsQuery) > 0) {
        // Room available, fetch the room number
        $availableRoom = mysqli_fetch_assoc($availableRoomsQuery);
        $roomNo = $availableRoom['room'];

        // Increase staying_students count for the allotted room
        $updateRoomSql = "UPDATE rooms SET staying_students = staying_students + 1 WHERE room = '$roomNo'";
        mysqli_query($connect, $updateRoomSql);

        // Update the room number in the studapp table
        $updateRoomNoSql = "UPDATE studapp SET room_no = '$roomNo' WHERE reg = '{$student['reg']}'";
        if (mysqli_query($connect, $updateRoomNoSql)) {
            // Room allotted successfully
            set_message("Room allotted successfully.", 'success');
        } else {
            // Error updating room number
            set_message("Error updating room number: " . mysqli_error($connect), 'error');
        }

        // Redirect back to the same page to avoid resubmission on page refresh
        header("Location: {$_SERVER['PHP_SELF']}?reg=$reg");
        exit();
    } else {
        // No available rooms on the selected floor
        set_message("No available rooms on the selected floor. Please try again later.", 'error');
    }
}

// Check if a message is set
list($message, $message_type) = get_message();

// Fetch student details if registration number is provided in URL
if (isset($_GET['reg'])) {
    $reg = $_GET['reg'];
    $qry = mysqli_query($connect, "SELECT * FROM studapp WHERE reg='$reg'");
    $row = mysqli_fetch_assoc($qry);
}

// Initialize $allottedRoom
$allottedRoom = '';

// Check if room is allotted
if (isset($roomNo)) {
    // Set the room number in a variable for display
    $allottedRoom = $roomNo;
}

// Fetch all columns from studapp table
$columns = array();
$result = mysqli_query($connect, "SELECT * FROM studapp LIMIT 1"); // Fetch only one row to get column names
if ($result) {
    $columns = array_keys(mysqli_fetch_assoc($result));
}

// HTML code continues as usual
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

        table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        background-color: white; /* Set background color to white */
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Button styles */
    .btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
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
                            </span>ROOM ALLOTMENT
                        </h3>

                        <div class="add_room">
                            <a href="./add_room.php">
                                <button type="button" class="btn bg-white rounded font-weight-bold text-dark pl-3 pr-3" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;"><i class="mdi mdi-plus menu-icon m-0 mr-2"></i>
                                Add Room</button>
                            </a>
                        </div>

                        <div class="view_room">
                            <a href="./view_room.php">
                                <button type="button" class="btn bg-white rounded font-weight-bold text-dark pl-3 pr-3" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;"><i class="mdi mdi-eye menu-icon m-0 mr-2"></i>
                                View Room Details</button>
                            </a>
                        </div>
                    </div>
           

                               <!-- dash section -->
                               <div class="page-header m-0">
                        
                        <div class="page-header bg-white pl-4 pr-4 rounded" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;">
                            <!-- Student details -->
                        </div>
                        <!-- Display message -->
                        <!-- Display message -->
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Display all columns from studapp table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                
                                <tbody>
                                <?php
// Fetch all rows from studapp table
$query = "SELECT * FROM studapp";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    // Start table
    echo "<table>";
    
    // Output column headers
    echo "<thead><tr>";
    foreach ($columns as $column) {
        echo "<th>{$column}</th>";
    }
    echo "<th>Action</th></tr></thead>";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($columns as $column) {
            echo "<td>{$row[$column]}</td>";
        }
        echo "<td>";
        
        // Check if room is already allotted
        if (empty($row['room_no'])) {
            // If room is not allotted, show the allot button
            echo "<form method='post' action='{$_SERVER['PHP_SELF']}'>";
            echo "<input type='hidden' name='reg' value='{$row['reg']}'>";
            echo "<button type='submit' name='allot' class='btn btn-primary'>Allot Room</button>";
            echo "</form>";
        } else {
            // If room is already allotted, hide the button
            echo "Room Allotted";
        }
        
        echo "</td></tr>";
    }
    // Close table
    echo "</table>";
} else {
    // If no records found
    echo "<p class='text-center'>No records found</p>";
}
?>

                                </tbody>
                            </table>
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
<script src="../admin/include/vendor.bundle.base.js.download"></script>


<!-- Add this script before the closing </body> tag -->
<script>
    $(document).ready(function() {
        // Function to handle form submission
        $("#allotForm").submit(function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request to the server
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                success: function(response) {
                    // Update UI based on server response
                    if (response.success) {
                        // Display success message
                        $("#successMessage").fadeIn();
                        // Update the allotted room input
                        $("#allottedRoom").val(response.roomNo);
                    } else {
                        // Display error message
                        $("#errorMessage").html(response.message).fadeIn();
                    }
                },
                error: function(xhr, status, error) {
                    // Display error message
                    $("#errorMessage").html("Error occurred: " + error).fadeIn();
                }
            });
        });
    });
</script>


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
    document.getElementById("allotButton").addEventListener("click", function() {
        // Disable the button after it has been clicked
        this.disabled = true;
    });
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
