<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    if (!isset($_SESSION['logged'])) {
        header('Location:login.php');
    }
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <title><?php echo ($_SESSION['username']); ?>'s Courses</title>
    <link rel="icon" href="RBeI.jpg" type="image/x-icon">
    <style>
        body {
            background-image: url("Material.jpg");
            background-size: cover;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="https://rbeiset.com/"><img src="RBeI.jpg" width="90px" height="40px"></a>
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
        <select class='dropdown' id='class_dropdown' name='class_dropdown' style='width: 22%;'>";
        while ($sub_row = mysqli_fetch_array($sub_result)) {
            echo "<option value='$sub_row[0]'>" . $sub_row[0] . "</option>";
        }
        echo "</select> &nbsp &nbsp &nbsp
        <input class='btn btn-danger' type='submit' name='subject_select' id='subject_select' value='Proceed'>
        </form>
        </div>";
    }
    ?>
    <!-- Dropdown Ends -->
    <!-- Progress table start -->
    <script>
        function proceedBtnClick() {
            document.getElementById('class_dropdown').value = "<?php echo $_GET['class_dropdown']; ?>";
        }
    </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['subject_select'])) {
            $selected_subject = $_GET['class_dropdown'];
            $chapter_query = "SELECT * FROM `rb_chapter_tb` WHERE subject='$selected_subject'";
            $chapter_result = mysqli_query($conn, $chapter_query) or die(mysqli_error($conn));
            $chapter_count = mysqli_num_rows($chapter_result);
            echo '<div class="container my-4">
            <table style="width:75%" class="table table-striped table-hover table-bordered">
            <thead class="table table-dark">
                <tr style="text-align:center">
                <th scope="col">Sr No.</th>
                <th scope="col">Chapter</th>
                <th scope="col">Chapter Status</th>
                <th scope="col">Difficulty Level</th>
                </tr>
            </thead>
            <tbody>';
            while ($chapter_row = mysqli_fetch_array($chapter_result)) {
                echo "<tr class='table-primary' style='text-align:center'><td>$chapter_row[0]</td>";
                echo "<td>$chapter_row[2]</td>";
                $usr_id = $_SESSION['id'];

                $progress_query = "SELECT * from `chapter_completion_tb` WHERE Chap_name='$chapter_row[2]' AND user_id='$usr_id'";
                $progress_query_result =  mysqli_query($conn, $progress_query) or die(mysqli_error($conn));
                $progress_query_row = mysqli_fetch_array($progress_query_result);

                if ($progress_query_row == NULL || $progress_query_row[3] == "Not Done") {
                    echo '<td id="' . $chapter_row[0] . '"><input class="btn btn-danger" type="button" name="progress_btn" id="btn_' . $chapter_row[0] . '" value="Mark as Done" onclick=(update_status("' . $chapter_row[0] . '"))></td>';
                } else {
                    echo "<td id=$chapter_row[0]>Done</td>";
                }
                echo "<td>$chapter_row[4]</td></tr>";
            }
            echo '</tbody></table>';
            // echo ' <center><input type="button" class="btn btn-success" id="view_chart_btn" value="View Detailed Chapter Completion Graph">';
            // echo '<div id="piechart" style="width: 900px; height: 500px; display:none;"></div></center>';
        }
        echo '<script type="text/javascript">proceedBtnClick();</script>';
    }
    ?>
    <script>
        function update_status(chapter_id) {

            var request = new XMLHttpRequest();
            var usr_id = '<?php echo $_SESSION['id']; ?>';
            var class_name = '<?php echo $_SESSION['class']; ?>';
            request.open("GET", "update_chapter_status.php?chapter=" + chapter_id + "&user_id=" + usr_id + "&class_name=" + class_name, true);
            request.send();

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    markAsDone(chapter_id);
                }
            }
        }

        function markAsDone(chapter_id) {
            document.getElementById("btn_" + chapter_id).style.display = "none";
            document.getElementById(chapter_id).innerHTML = "Done";
        }
    </script>
    <!-- Progress table ends -->

    <!--Pie chart starts-->
    <?php
    // $chapters_array = array();
    // // $chapters_notdone_array = array();
    // $progress_done_array = array();
    // $progress_notdone_array = array();
    // $selected_subject = $_GET['class_dropdown'];
    // $chapters = "SELECT Chap_name FROM `rb_chapter_tb` WHERE subject='$selected_subject'";
    // $chapters_result = mysqli_query($conn, $chapter_query) or die(mysqli_error($conn));
    // while ($graph_chapters = mysqli_fetch_array($chapters_result)) {
    //     array_push($chapters_array, $graph_chapters[0]);
    //     $completed_or_not = "SELECT Progress , count(*) as number FROM `chapter_completion_tb` WHERE Chap_name='$graph_chapters[0]' GROUP BY Progress";
    //     $completed_or_not_result = mysqli_query($conn, $completed_or_not) or die(mysqli_error($conn));
    // }
    ?>

    <!--Pie Chart Starts-->

    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(initialize);

        function initialize(){
            $("#view_chart_btn").click(function() {
                document.getElementById("#view_chart_btn").style.display = "none";
                document.getElementById("#piechart").style.display = "block";
                drawChart();
                document.getElementById("#piechart").scrollIntoView();
            });
        }

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Completed','Not Completed'],
                <?php
                //    while($row = mysqli_fetch_array($completed_or_not_result)){
                //         echo "['".$row["Progress"]."', ".$row["number"]."],";
                //     }
                ?>

            ]);
            var options = {
                title: 'Chapters Done vs Not Done'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script> -->

    <!--Pie Chart Ends-->
</body>

</html>