<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "rbeitest_db") or die("Connection Failed");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <input type="checkbox" id="check">
    <!-- Header Area start -->
    <header>
        <label for="check">
            <i class="fas fa-bars" id="sidebar_btn"></i>
        </label>
        <div class="left_area">
            <a href="dashboard.php">
                <h3>RBE <span>Institute</span></h3>
            </a>
        </div>
        <div class="right_area">
            <a href="login.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!-- Header Area ends -->
    <!-- Sidebar start -->
    <div class="sidebar">
        <center>
            <i class="bi bi-person-circle"></i>
            <h4><?php echo ($_SESSION['username']); ?></h4>
        </center>
        <a href="report.php"><i class="fas fa-tasks"></i><span>Progress Report</span></a>
        <a href="about.php"><i class="fas fa-info-circle"></i><span>About</span></a>
        <a href="http://www.studde.com/"><i class="fas fa-video"></i><span>Lectures</span></a>
        <a href="test.php"><i class="fas fa-graduation-cap"></i><span>Test Panel</span></a>
        <a href="courses.php"><i class="fas fa-university"></i><span>Courses</span></a>
    </div>
    <!-- Sidebar ends -->
</body>

</html>