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
                <form action="login.php">
                    <button class="btn btn-transparent" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Navbar ends -->
    <!-- Dropdown Starts -->
    <?php
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
        <select class='dropdown' id='class_dropdown' name='class_dropdown' style='width: 15%;'>";
        while ($sub_row = mysqli_fetch_array($sub_result)) {
            echo "<option value='$sub_row[0]'>" . $sub_row[0] . "</option>";
        }
        echo "</select> &nbsp &nbsp &nbsp
        <input type='submit' name='subject_select' id='subject_select' value='Proceed'>
        </form>
        </div>";
    }
    ?>
    <!-- Dropdown Ends -->
    <!-- Progress table start -->
    <?php
    if($_SERVER['REQUEST_METHOD']=="GET"){
        if(isset($_GET['subject_select'])){
            $selected_subject = $_GET['class_dropdown'];
            $chapter_query="SELECT DISTINCT Chap_name FROM `rb_chapter_tb` WHERE subject='$selected_subject'";
            $chapter_result=mysqli_query($conn,$chapter_query) or die(mysqli_error($conn));
            $chapter_count=mysqli_num_rows($chapter_result);
            echo '<div class="container my-4">
            <form action="courses.php" method="GET">
            <table style="width:50%" class="table table-striped table-hover table-bordered">
            <thead class="table table-dark">
                <tr style="text-align:center">
                <th scope="col">Chapter</th>
                    <th scope="col">Chapter Status</th>
                    <th scope="col">Difficulty Level</th>
                </tr>
            </thead>
            <tbody>';
                while($chapter_row=mysqli_fetch_array($chapter_result)){
                    echo "<tr style='text-align:center'><td>$chapter_row[0]</td>";
                    $progress_query="SELECT Progress FROM `chapter_completion_tb` WHERE Chap_name='$chapter_row[0]'";
                    $progress_result=mysqli_query($conn,$progress_query) or die(mysqli_error($conn));
                    $progress_row=mysqli_fetch_array($progress_result);
                    echo "<td>$progress_row[0] ";
                    if($progress_row[0]=='Not Done'){
                        echo "&nbsp <input type='submit' name='progress_btn' id='progress_button' value='Mark as Done'>";
                        if($_SERVER['REQUEST_METHOD']=='GET'){
                            if(isset($_GET['progress_btn'])){
                                $button_selection=$_GET['progress_button'];
                                $button_query="UPDATE `chapter_completion_tb` SET Progress='Done' WHERE Progress='Not Done'";
                                $button_result=mysqli_query($conn,$button_query);
                                $button_row=mysqli_fetch_array($button_result);
                                echo "&nbsp <input type='submit' name='progress_btn' id='progress_button' value='Mark as Done'>";
                            }
                        }
                    }
                    
                }
            echo '</tbody></table></form>';
        }
    }
    ?>
    <!-- Progress table ends -->

    <!-- <script>
        function selectSubject() {
            var dropdown = document.getElementById("class_dropdown");
            var selected_class = dropdown.options[dropdown.selectedIndex].value;
        }
    </script> -->
</body>

</html>