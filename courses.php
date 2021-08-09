<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "rbeitest_db");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript">
        window.history.forward();
    </script>
    <title>Courses</title>
    <style>
        body {
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            background-attachment: fixed;
        }

        a {
            color: black;
        }

        span {
            color: #ff8080;
        }
    </style>
</head>

<body>
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container-fluid">
            <h3>RBE <span>INSTITUTE</span></h3>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex" action="dashboard.php">
                    <button class="btn btn-transparent" type="submit">Home</button>
                </form>
                <form action="logout.php">
                    <input href="logout.php" class="btn btn-transparent" type="submit" value="Logout"></input>
                </form>
            </div>
        </div>
    </nav>
    <!-- Navbar ends -->
    <!-- First Dropdown Starts -->

    <?php
    $courses_uid = $_SESSION['id'];
    $course_class = $_SESSION['class'];
    $course_class = $course_class . '%';
    $sub_query = "SELECT DISTINCT subject_name FROM `rb_subject_tb` WHERE class LIKE '$course_class'";
    $sub_result = mysqli_query($conn, $sub_query) or die(mysqli_error($conn));
    $sub_count = mysqli_num_rows($sub_result);
    if ($sub_count == 0) {
        echo "<center>
        <div class='container my-4'>No Data Found for this Student!</div>
        </center>";
    } else {
        echo "<div class='container my-4'>
        <form action='courses.php' method='GET'>
        <label>Select Subject: </label>
        <select id='class_dropdown' name='dropdown_class' style='width: 15%;'>";
        while ($sub_row = mysqli_fetch_array($sub_result)) {
            echo "<option>" . $sub_row[0] . "</option>";
        }
        echo "</select> &nbsp &nbsp &nbsp
        <input class='btn btn-danger' style='width:9%' type='submit' name='select_subject' id='subject_select' value='Proceed'>";
    }
    ?>
    <?php
    // <!-- First Dropdown Ends -->
    // <!-- Chapter Dropdown Start -->
    if (isset($_GET['select_subject'])) {
        $selected_subject = $_GET['dropdown_class'];
        $chapter_query = "SELECT Chap_name FROM `rb_chapter_tb` WHERE subject='$selected_subject'";
        $chapter_result = mysqli_query($conn, $chapter_query) or die(mysqli_error($conn));
        $chapter_count = mysqli_num_rows($chapter_result);
        echo "&nbsp &nbsp <label>Select Chapter: </label> &nbsp
            <select id='chapter_dropdown' name='dropdown_chapter' style='width: 15%;'>";
        while ($chapter_row = mysqli_fetch_array($chapter_result)) {
            echo "<option>" . $chapter_row[0] . "</option>";
        }
        echo "</select> &nbsp &nbsp &nbsp
            <input class='btn btn-danger' type='submit' name='chapter_done' id='done_chapter' value='Mark As Done'></form></div>";
    }
    if (isset($_GET['chapter_done'])) {
        $chapter_selected = $_GET['dropdown_chapter'];
        $progress_query = "UPDATE `chapter_completion_tb` SET Progress='Done' WHERE Chap_name='$chapter_selected'";
        $progress_result = mysqli_query($conn, $progress_query) or die(mysqli_error($conn));
        echo '<div class="container my-4">
        <table style="width:50%" class="table table-striped table-hover table-bordered">
            <thead class="table table-dark">
                <tr style="text-align:center">
                    <th scope="col">Chapter</th>
                    <th scope="col">Chapter Status</th>
                    <th scope="col">Difficulty Level</th>
                </tr>
            </thead>
            <tbody>';
        // Final progress
        $final_query = "SELECT * FROM `chapter_completion_tb` WHERE Progress='Done' AND user_id=$courses_uid";
        $final_result = mysqli_query($conn, $final_query);
        $final_count = mysqli_num_rows($final_result);
        while ($final_row = mysqli_fetch_array($final_result)) {
            echo "<tr class='table table-success' style='text-align:center'><td>$final_row[2]</td>";
            echo "<td>$final_row[3]</td>";
            echo "<td>$final_row[4]</td></tr>";
        }
        echo "</tbody></table></div>";
    }
    ?>
    <!-- Chapter Dropdown Ends -->
</body>

</html>