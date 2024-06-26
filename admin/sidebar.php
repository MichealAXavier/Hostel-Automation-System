<nav class="sidebar sidebar-offcanvas m-0 fixed-left d-flex" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile bg-dark" style="  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;">
            <a href="" class="nav-link">
                <div class="nav-profile-image">
                    <img src="./include/admin_logo1.png" alt="profile" style="height: 40px;">
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2 text-light">Admin</span>
                    <span class="text-secondary text-small"><?php echo " " .$_SESSION['name']; ?></span>
                </div>
                <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> -->
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="manage_students.php">
                <span class="menu-title">Manage Students</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="stud_admission.php">
                <span class="menu-title">Manage Admission</span>
                <i class="mdi mdi-account-plus menu-icon pl-2"></i>
            </a>
        </li>

        <!--Manage Rooms-->

        <li class="nav-item">
            <a class="nav-link" href="allot_profile.php">
                <span class="menu-title">Room Allotment</span>
                <i class="mdi mdi-door-closed menu-icon pl-2"></i>
             </a>
        </li>

        <!--Leave Requests-->
        <li class="nav-item">
            <a class="nav-link" href="manage_leave.php">
                <span class="menu-title">Mess Leave Requests</span>
                <i class="mdi mdi-calendar-edit menu-icon pl-2"></i>
             </a>
        </li>


        <li class="nav-item">
    <a class="nav-link collapsed p-1" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic" id="fees-menu">
        <span class="menu-title">Fees</span>
        <i class="mdi mdi-menu-down mdi-24px text-primary"></i>
        <i class="mdi mdi-credit-card menu-icon"></i>
    </a>
    <div class="collapse bg-light" style="border-radius: 50px;" id="ui-basic">
        <ul class="nav menu-title flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="monthly_amount.php">Monthly Payment <i class="mdi mdi-cash-multiple menu-icon" style="margin-left: 15px;"></i></a></li>
        </ul>
    </div>
</li>




        <!--News-->
        <li class="nav-item">
            <a class="nav-link" href="news_post.php">
                <span class="menu-title">Announcement</span>
                <i class="mdi mdi-newspaper menu-icon pl-2"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="get_feedback.php">
                <span class="menu-title">Complaints & Feedback</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>

<style>
  .nav-link span{
            font-weight: bolder;
        font-family: 'Montserrat Alternates', sans-serif;
}
</style>

