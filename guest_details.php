<?php
include("dbconnect.php");
session_start();

if (isset($_POST['btn'])) {
    $name = $_POST["name"];
    $reg = $_POST["reg"];
    $dept = $_POST["dept"];
    $programme = $_POST["programme"];
    $year = $_POST["year"];
    $fathname = $_POST["fathname"];
    $fathphone = $_POST["fathphone"];
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $bldgrp = $_POST["bldgrp"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $physically_challenged = $_POST["physically_challenged"];

    $image = $_FILES["pro_img"]["name"];
    $tempname = $_FILES["pro_img"]["tmp_name"];

    $request_letter = $_FILES["request_letter"]["name"];
    $request_tempname = $_FILES["request_letter"]["tmp_name"];

    // Destination path for photo and request letter files
    $image_destination = "include/" . $image;
    $request_letter_destination = "include/" . $request_letter;

    // Move uploaded files to the destination folder
    move_uploaded_file($tempname, $image_destination);
    move_uploaded_file($request_tempname, $request_letter_destination);

    $ap_id_prefix = 'MSUAPP';
    $stud_id_prefix = 'STUD';

    $query = "SELECT MAX(id) AS max_id FROM studreq";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastInsertedId = $row['max_id'] + 1;

        // Concatenate "STUD" prefix with auto-incremented ID
        $stud_id = $stud_id_prefix . str_pad($lastInsertedId, 2, '0', STR_PAD_LEFT);
        $ap_id = $ap_id_prefix . str_pad($lastInsertedId, 3, '0', STR_PAD_LEFT);
    } else {
        // If no records found, start with "stud01" and "MSUAPP001"
        $stud_id = $stud_id_prefix . '01';
        $ap_id = $ap_id_prefix . '001';
    }
    $reg_date = date("Y-m-d H:i:s");

    $insertQuery = "INSERT INTO studreq (ap_id, stud_id, name, reg, programme, dept, year, fathname, fathphone, age, dob, bldgrp, email, phone, address, image, request_letter, reg_date, physically_challenged) VALUES ('$ap_id', '$stud_id', '$name', '$reg', '$programme', '$dept', '$year', '$fathname', '$fathphone', '$age', '$dob', '$bldgrp', '$email', '$phone', '$address', '$image', '$request_letter', '$reg_date', '$physically_challenged')";

    
    if (mysqli_query($connect, $insertQuery)) {
        // Success message
        $_SESSION['status_msg'] = $name . ' - your application has been registered successfully! Verify your details after contacting your registered email-id ' . $email;
    } else {
        // Error message
        $_SESSION['error_msg'] = "Error: " . mysqli_error($connect);
    }

    mysqli_close($connect);

    header("Location: guest_details.php");
    exit();
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>student_admission</title>
	<link rel="stylesheet" href="./admin/include/materialdesignicons.min.css">
	<link rel="stylesheet" href="./admin/include/vendor.bundle.base.css">
	<link rel="stylesheet" href="./admin/include/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="../dist/css/style.min.css">
	<link rel="stylesheet" href="./admin/include/style.css">
	<link rel="shortcut icon" href="./admin/include/ho_login.png">
	<link rel="stylesheet" href="./admin/include/exstyle.css">
	
	<style>
		.container-fluid {
			background-color: rgb(185, 185, 185);
		}

		.container {
			margin-top: 20px;
			width: 700px;
			background-color: #fff;
			padding: 40px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		form {
			background-color: white;
		}

		@media (max-width: 768px) {
			.container {
				padding: 20px;
			}
		}

		.divcont {
			box-shadow: none;
		}

		.row {
			justify-content: center;
			align-items: center;
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

		<!-- navbar -->
		<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 d-flex flex-row fixed-top">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
				<!--<a class="navbar-brand brand-logo" href="./index.php"><img src="./admin/include/HO_LOGO.png" alt="logo">MSU HOSTEL</a>-->
				<h1> MSU HOSTEL<h1>
				<a class="navbar-brand brand-logo-mini" href="./index.php"><img src="./admin/include/ho_login.png" alt="logo"></a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-stretch">
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item">
						<a class="nav-link" style="color: black; font-weight:bold;font-size:1rem;" href="index.php">Home</a>
					</li>
				</ul>
			</div>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper bg-light">
			<div class="card-body">
				<div class="page-header" style="position: relative	;">
					<h3 class="page-title" style="position:relative;left:8%;">
						<span class="page-title-icon bg-gradient-primary text-white mr-2">
							<i class="mdi mdi-account-plus menu-icon"></i>
						</span> Admission Form
					</h3>
					

					
				</div>

				<div class="card d-flex bg-transparent justify-content-center align-items-center">
				<div id="msg" class="alert alert-success" style="display: none;">
</div>


<form class="card-body rounded col-10" id="f1" name="f1" method="post" enctype="multipart/form-data" style="box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;position:relative;" action="#" onSubmit="return vali()">

    <div class="row">
        <!-- Left column for input fields -->
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="name" onChange="return name()" placeholder="Name" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">College Admission No</label>
                    <input type="text" class="form-control" name="reg" id="reg" placeholder="College Admission Number" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Department</label>
                    <input type="text" class="form-control" name="dept" id="dept" placeholder="Department" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Mobile</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" maxLength="10" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Age</label>
                    <input type="text" class="form-control" name="age" id="age" placeholder="Age" maxLength="2" required>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Blood Group</label>
                    <select class="form-control" id="bldgrp" name="bldgrp" placeholder="Blood Group" required name="blood_group">
                        <option value="" disabled selected>Select Blood Group</option>
                        <option value="A+">A +ve</option>
                        <option value="A-">A -ve</option>
                        <option value="B+">B +ve</option>
                        <option value="B-">B -ve</option>
                        <option value="AB+">AB +ve</option>
                        <option value="AB-">AB -ve</option>
                        <option value="O+">O +ve</option>
                        <option value="O-">O -ve</option>
                    </select>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Father Name</label>
                    <input type="text" class="form-control" name="fathname" id="fathname" placeholder="Father Name" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Father Phone</label>
                    <input type="phone" class="form-control" id="fathphone" name="fathphone" placeholder="Father Phone" onInput="validatePhoneNumber(this)" required>
                    
                </div>
            </div>
        </div>

        <!-- Right column for labels -->
        <div class="col-md-6">

		
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Programme</label>
                    <select class="form-control" id="programme" name="programme" required>
                        <option value="" disabled selected>Select Programme</option>
                        <option value="UG">UG</option>
                        <option value="PG">PG</option>
                        <option value="Integrate">Integrated</option>
                        <option value="Research Scholar">Research Scholar</option>
                    </select>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Course & Year</label>
                    <input class="form-control" placeholder="Year ex: MCA-1" name="year" id="year" required>
                    
                </div>
            </div>

			<div class="row">
    <div class="col-md-12 m-2">
        <label for="physically_challenged">Physically Challenged</label>
        <select class="form-control" id="physically_challenged" name="physically_challenged" required>
            <option value="" disabled selected>Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
</div>

            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="E-Mail" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="">DOB</label>
                    <input type="date" title="date of barth" class="form-control" name="dob" id="dob" placeholder="DOB" required>
                    
                </div>
            </div>
			<div class="row">
    <div class="col-md-12 m-2">
        <label for="">Address</label>
        <textarea class="form-control" name="address" id="address" placeholder="Address" required></textarea>
    </div>
</div>


            <div class="row">
                <div class="col-md-12 m-2">
				<label for="image">Profile Photo</label>
                    <input type="file" class="form-control" name="pro_img" id="image" accept="image/*" onchange="previewImage(event)" required />
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-2">
				<label for="request_letter">Request Letter from Department (PDF)</label>
                    <input class="form-control" type="file" name="request_letter" id="request_letter" accept="application/pdf" required />
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Submit and Reset buttons -->
    <div class="p-t-15" style="margin-left: 80px;">
        <button class="btn btn--radius-2 btn--blue btn btn-primary m-3" name="btn" type="submit" id="btn" value="Submit">Submit</button>
        <button class="btn btn--radius-2 btn--blue btn btn-primary m-3" type="reset" name="Submit2" value="Reset">Reset</button>
    </div>


    
</form>

				</div>
			</div>
		</div>
	</div>
	<script src="./admin/include/vendor.bundle.base.js.download"></script>
    <script src="./admin/include/Chart.min.js.download"></script>
    <script src="./admin/include/jquery.cookie.js.download" type="text/javascript"></script>
    <script src="./admin/include/off-canvas.js.download"></script>
    <script src="./admin/include/hoverable-collapse.js.download"></script>
    <script src="./admin/include/misc.js.download"></script>
    <script src="./admin/include/dashboard.js.download"></script>
    <script src="./admin/include/todolist.js.download"></script>
    <script src="./assets/libs/jquery/dist/jquery.min.js "></script>
    <script src="./assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script src="./admin/include/vendor.bundle.base.js.download"></script>

    <!-- Custom JavaScript for image preview -->

    <script>
        // Check if the PHP variable $msg is not empty
        <?php if (!empty($msg)) : ?>
            // Display the message div
            document.getElementById('msg').style.display = 'block';
        <?php endif; ?>
    </script>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const input = event.target;

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            imagePreview.style.display = 'none';
        }
    }
</script>


    <!-- Custom JavaScript for toggling collapse -->
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

    <!-- Check and display PHP message -->
    <script>
        // Check if the PHP variable $msg is not empty
        <?php if (!empty($msg)) : ?>
            // Display the message div
            document.getElementById('msg').style.display = 'block';
        <?php endif; ?>
    </script>

    <!-- Preloader fade out -->
    <script>
        $(".preloader ").fadeOut();
    </script>
<?php
    if (isset($_SESSION['status_msg'])) {
        echo '<script>alert("' . $_SESSION['status_msg'] . '");</script>';
        unset($_SESSION['status_msg']); // Clear the session variable
    }

    if (isset($_SESSION['error_msg'])) {
        echo '<script>alert("Error: ' . $_SESSION['error_msg'] . '");</script>';
        unset($_SESSION['error_msg']); // Clear the session variable
    }
    ?>
</body>

</html>