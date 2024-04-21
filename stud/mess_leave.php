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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if $reg is set and not empty
    if (isset($reg) && !empty($reg)) {
        // Extract form data
        $ap_id = $_POST['ap_id'];
        $name = $_POST['name'];
        $year = $_POST['year'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $description = $_POST['description'];

        // Calculate number of days
        $fromDate = new DateTime($from_date);
        $toDate = new DateTime($to_date);
        $interval = $fromDate->diff($toDate);
        $no_of_days = $interval->format('%a');

        $leave_id_prefix = 'LEAVEID';

        // Query to get the maximum ID
        $query = "SELECT MAX(id) AS max_id FROM leavereq";
        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $lastInsertedId = $row['max_id'] + 1;

            $leave_id = $leave_id_prefix . str_pad($lastInsertedId, 3, '0', STR_PAD_LEFT);
        } else {
            $leave_id = $leave_id_prefix . "001";
        }

        // Insert data into the leavereq table
        $insert_sql = "INSERT INTO leavereq (ap_id, leave_id, name, course_year, month, from_date, to_date, no_of_days, description, reg) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connect->prepare($insert_sql);
        $stmt->bind_param("ssssssssss", $ap_id, $leave_id, $name, $year,$month, $from_date, $to_date, $no_of_days, $description, $reg);

        if ($stmt->execute()) {
            // If insertion is successful, set success message
            $_SESSION['message'] = "Leave request submitted successfully.";
        } else {
            // If insertion fails, set error message
            $_SESSION['error'] = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // If $reg is not set or empty, set an error message
        $_SESSION['error'] = "Error: Registration number is not set or empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mess Leave</title>
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
                <h2 class="text-center mb-4">Mess Leave Request</h2>

                    <!-- Mess Leave Request form -->
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center mb-4">Mess Leave Request</h2>

                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <?php
                                    // Check for success message
                                    if (isset($_SESSION['message'])) {
                                        echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
                                        unset($_SESSION['message']); // Clear the message
                                    }
                                    // Check for error message
                                    if (isset($_SESSION['error'])) {
                                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                                        unset($_SESSION['error']); // Clear the error
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label>Reg No</label>
                                        <?php
                                        // Fetch the student application ID from the students table
                                        $query = "SELECT reg FROM students WHERE reg = '{$_SESSION['reg']}'";
                                        $result = mysqli_query($connect, $query);
                                        $row = mysqli_fetch_assoc($result);
                                        $reg = $row['reg'];
                                        ?>
                                        <input type="text" class="form-control" name="reg"
                                            value="<?php echo $reg; ?>" required readonly>
                                    </div>




                                    <div class="form-group">
                                        <label>Student Application ID</label>
                                        <?php
                                        // Initialize $ap_id
                                        $ap_id = '';

                                        // Fetch the student application ID from the students table
                                        $query = "SELECT stud_id FROM students WHERE reg = '{$_SESSION['reg']}'";
                                        $result = mysqli_query($connect, $query);

                                        // Check if the query executed successfully
                                        if ($result) {
                                            // Fetch the row from the result
                                            $row = mysqli_fetch_assoc($result);
                                            // Check if the row exists
                                            if ($row) {
                                                // Assign the value of ap_id to $ap_id
                                                $ap_id = $row['stud_id'];
                                            } else {
                                                // If the row doesn't exist, handle the error
                                                $_SESSION['error'] = "Error: Unable to fetch student application ID.";
                                                // Redirect or display an error message as needed
                                            }
                                        } else {
                                            // If the query fails, handle the error
                                            $_SESSION['error'] = "Error: Failed to execute the query to fetch student application ID.";
                                            // Redirect or display an error message as needed
                                        }
                                        ?>
                                        <input type="text" class="form-control" name="ap_id"
                                            value="<?php echo $ap_id; ?>" required readonly>
                                    </div>


                                    <div class="form-group">
                                        <label>Name</label>
                                        <?php
                                        // Fetch the student application ID from the students table
                                        $query = "SELECT name FROM students WHERE reg = '{$_SESSION['reg']}'";
                                        $result = mysqli_query($connect, $query);
                                        $row = mysqli_fetch_assoc($result);
                                        $name = $row['name'];
                                        ?>
                                        <input type="text" class="form-control" name="name"
                                            value="<?php echo $name; ?>" required readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Course & Year</label>
                                        <?php
                                        // Fetch the student application ID from the students table
                                        $query = "SELECT year FROM students WHERE reg = '{$_SESSION['reg']}'";
                                        $result = mysqli_query($connect, $query);
                                        $row = mysqli_fetch_assoc($result);
                                        $year = $row['year'];
                                        ?>
                                        <input type="text" class="form-control" name="year"
                                            value="<?php echo $year; ?>" required readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Month & Year</label>
                                    <input type="month" name="month" id="month" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" class="form-control" name="from_date" required
                                            min="<?php echo date('Y-m-01'); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" class="form-control" name="to_date" required>
                                    </div>

                                    <div class="form-group">
                                        <label>No of Days</label>
                                        <input type="text" class="form-control" name="no_of_days" id="noOfDays"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Clear</button>
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
