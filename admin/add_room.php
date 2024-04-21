<?php
include("../dbconnect.php");
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: ./admin_login.php");
    exit();
}

$success_reg = "";
$no_reg = "";
$noo_reg="";

if (isset($_POST['btn'])) {
    $floor = mysqli_real_escape_string($connect, $_POST["floor"]);
    $room = mysqli_real_escape_string($connect, $_POST["room"]);
    $no_of_students = mysqli_real_escape_string($connect, $_POST["no"]);

    // Check if the room number already exists
    $check_query = "SELECT * FROM rooms WHERE room = '$room'";
    $result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $noo_reg = "Room " . $room . " is already saved.";
    } else {
        // Insert the new room record
        $query = "INSERT INTO rooms (floor, room, no_of_students) VALUES ('$floor', '$room', '$no_of_students')";
        
        if (mysqli_query($connect, $query)) {
            $success_reg = "Room details saved successfully!";
        } else {
            $no_reg = "Failed to insert room details: " . mysqli_error($connect);
        }
    }

    mysqli_close($connect);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Add Rooms</title>
	<link rel="stylesheet" href="./include/materialdesignicons.min.css">
	<link rel="stylesheet" href="./include/vendor.bundle.base.css">
	<link rel="stylesheet" href="./include/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="../dist/css/style.min.css">
	<link rel="stylesheet" href="./include/style.css">
	<link rel="shortcut icon" href="./include/ho_login.png">
	<link rel="stylesheet" href="./include/exstyle.css">

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
		.divcont {
			box-shadow: none;
		}
		.row {
			justify-content: center;
			align-items: center;
		}
		.sucees {
			background-color: rgb(195, 255, 225);
			border-radius: 5px;
			border: 1px solid white;
		}
		.error {
			background-color: rgb(255, 121, 121);
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
		<?php include 'navbar.php' ?>

		<!-- partial -->
		<div class="container-fluid page-body-wrapper pt-0 proBanner-padding-top">
			<?php include 'sidebar.php' ?>
			<div class="main-panel">
				<div class="content-wrapper p-4">
					<div class="page-header">
						<h3 class="page-title" style="font-family: 'Montserrat Alternates', sans-serif;
">
							<span class="page-title-icon bg-gradient-primary text-white mr-2">
								<i class="mdi mdi-account-plus menu-icon"></i>
							</span> Create Rooms
						</h3>
					</div>

					<div class="card d-flex justify-content-center align-items-center">
						<form class="card-body col-12" id="f1" name="f1" method="post" action="#" onSubmit="return vali()" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-5 m-2">
                                <label for="">Select Floor</label>
									<select class="form-control" id="floor" name="floor" placeholder="Select Floor" required name="blood_group">
										<option value="" disabled selected>Select Floor</option>
										<option value="G">Ground Floor</option>
										<option value="F">First Floor</option>
										<option value="S">Second Floor</option>
										<option value="T">Third Floor</option>
									</select>
                                </div>
                            </div>
                            <div class="row">
								<div class="col-md-5 m-2">
									<label for="">Room No</label>
									<input type="text" class="form-control" name="room" id="room" placeholder="G-1" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5 m-2">
									<label for="">Number of Students (Per Room)</label>
									<input type="number" class="form-control" name="no" id="no" placeholder="4" required>
								</div>
								
							</div>
							
                            <!-- Display exist message -->
                            <?php if (!empty($noo_reg)) : ?>
                        <div class="alert alert-success"><?php echo $noo_reg; ?></div>
                    <?php endif; ?>

							 <!-- Display success message -->
                             <?php if (!empty($success_reg)) : ?>
                        <div class="alert alert-success"><?php echo $success_reg; ?></div>
                    <?php endif; ?>

                    <!-- Display error message -->
                    <?php if (!empty($no_reg)) : ?>
                        <div class="alert alert-danger"><?php echo $no_reg; ?></div>
                    <?php endif; ?>


							<div class="p-t-15" style="margin-left: 320px;">
								<button class="btn btn--radius-2 btn--blue btn btn-primary m-3" name="btn" type="submit" id="btn" value="Submit">Submit</button>
								<button class="btn btn--radius-2 btn--blue btn btn-primary m-3" type="reset" name="Submit2" value="Reset">Reset</button>
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

	<!-- phone -->
	<script>
		function validatePhoneNumber(input) {
			var phoneNumber = document.getElementById(fathphone) // Remove non-numeric characters
			// const maxLength = 10;

			if (!/^[0-9]{10}$/.test(fathphone)) {
				alert('Invalid phone number ')
			}
			return
		}
	</script>
	<!-- year -->
	<script>
		function validateYear(input) {
			const yearno = input.value.replace(/\D/g, ''); // Remove non-numeric characters
			const maxLength = 4;

			if (yearno.length > maxLength) {
				input.value = yearno.slice(0, maxLength); // Truncate input to 10 digits
			}
		}
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