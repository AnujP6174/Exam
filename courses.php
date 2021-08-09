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
                <input href="logout.php" class="btn btn-transparent" type="submit" value="Logout"></input>
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
    if (!isset($_SESSION['class'])) {
    }

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
    <script>
        function proceedBtnClick(){
            document.getElementById('class_dropdown').value = "<?php echo $_GET['class_dropdown'];?>";
        }
    </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['subject_select'])) {
            $selected_subject = $_GET['class_dropdown'];
            $chapter_query = "SELECT Chap_name FROM `rb_chapter_tb` WHERE subject='$selected_subject'";
            $chapter_result = mysqli_query($conn, $chapter_query) or die(mysqli_error($conn));
            $chapter_count = mysqli_num_rows($chapter_result);
            echo '<div class="container my-4">
            <table style="width:100%" class="table table-striped table-hover table-bordered">
            <thead class="table table-dark">
                <tr style="text-align:center">
                <th scope="col">Chapter</th>
                    <th scope="col">Chapter Status</th>
                    <th scope="col">Difficulty Level</th>
                </tr>
            </thead>
            <tbody>';
            while ($chapter_row = mysqli_fetch_array($chapter_result)) {
                echo "<tr style='text-align:center'><td>$chapter_row[0]</td>";
                $progress_query = "SELECT Progress FROM `chapter_completion_tb` WHERE Chap_name='$chapter_row[0]'";
                $progress_result = mysqli_query($conn, $progress_query) or die(mysqli_error($conn));
                $progress_row = mysqli_fetch_array($progress_result);
                if($progress_row[0]=="Done"){
                echo "<td id=$chapter_row[0]>$progress_row[0]</td>";
                }
                else{
                    echo '<td id='."$chapter_row[0]".'><input type="button" name="progress_btn" id=progress_button_'."$chapter_row[0]".' value="Mark as Done" onclick=(update_status('."'$chapter_row[0]'".'))></td>';
                }
            }
            echo '</tbody></table>';
        }
        echo '<script type="text/javascript">proceedBtnClick();</script>';
    }
    ?>
<!-- onclick="update_status('','')" -->
    <script>
        function update_status(chapter_name){
            
            var request = new XMLHttpRequest();
            // alert(chapter_name);
            request.open("GET","update_chapter_status.php?chapter="+chapter_name,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState==4 && request.status==200){
                    markAsDone(chapter_name);
                }
            } 
        }
        function markAsDone(chapter_name){
            document.getElementById('progress_button_'+chapter_name).style.display = "none";
            document.getElementById(chapter_name).innerHTML = "Done";
        }
    </script>
    <!-- Progress table ends -->
</body>

</html>