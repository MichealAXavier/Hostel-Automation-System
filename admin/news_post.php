<?php
include("../dbconnect.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION["name"])) {
    header("Location: ./admin_login.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) { 
    // Extract form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date_published = $_POST['date_published'];

    // Define prefix for news_id
    $news_id_prefix = 'NEWSID';

    // Query to get the maximum ID
    // Query to get the maximum ID
$query = "SELECT MAX(CAST(SUBSTRING(news_id, LENGTH('$news_id_prefix') + 1) AS UNSIGNED)) AS max_id FROM news";
$result = mysqli_query($connect, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $lastInsertedId = $row['max_id'];

    // Generate unique news_id
    $news_id = $news_id_prefix . str_pad($lastInsertedId + 1, 3, '0', STR_PAD_LEFT);
    echo "Generated news ID: " . $news_id; // Debugging statement
} else {
    // If no records found, start with 001
    $news_id = $news_id_prefix . "001";
    echo "Starting news ID: " . $news_id; // Debugging statement
}


    // Insert data into the news table
    $insert_sql = "INSERT INTO news (news_id, title, content, date_published) VALUES (?, ?, ?, ?)";

    $stmt = $connect->prepare($insert_sql);
    $stmt->bind_param("ssss", $news_id, $title, $content, $date_published);

    if ($stmt->execute()) {
        // If insertion is successful, set success message
        $_SESSION['message'] = "News Posted successfully.";
    } else {
        // If insertion fails, set error message
        $_SESSION['error'] = "Error: " . $stmt->error;
        // Print out the error message for debugging
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// No need to redirect after form submission
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>preview_news</title>
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
        #content,
        #title {
            font-size: 1.2rem;
            line-height: 20px;
            letter-spacing: 1px;
        }
        .card {
            height: 80%;
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
                <div class="content-wrapper p-3">
                    <div class="page-header">
                        <h3 class="page-title"style="font-family: 'Montserrat Alternates', sans-serif;">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-newspaper menu-icon"></i>
                            </span> Post News
                        </h3>

                        <a href="./news_displayed.php" class="btn btn--radius-2 btn--blue btn-primary p-1 float-right"><i class="mdi mdi-pin menu-icon"></i>

                            <button class="btn text-light m-2 p-0" type="submit" value="Preview">Posted News</button>
                        </a>
                    </div>

                    <div class="card d-flex justify-content-center align-items-center">


                   


                    <form class="card-body col-8 mx-auto" method="post" action="">


                    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>



    <div class="col">
        <div class="col-md-12 m-3">
            <label for="title" style="font-size: 1rem;">Title:</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="News Title" required>
        </div>
        <div class="col-md-12 m-3">
            <label for="content" style="font-size: 1rem;">Content:</label>
            <textarea class="form-control" id="content" name="content" placeholder="Content" rows="8" cols="20" required></textarea>
        </div>
        <div class="col-md-12 m-3">
            <label for="date_published" style="font-size: 1rem;">Date Published:</label>
            <input class="form-control" type="date" id="date_published" name="date_published" required>
        </div>
        <div class="btn btn--radius-2 pl-3 pr-3 pt-1 pb-1 btn--blue btn-primary mt-3 float-right">
            <button class="btn p-0 m-2 text-light" type="submit" name="submit" value="submit">Post News</button>
        </div>
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