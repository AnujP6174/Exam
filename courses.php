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
        <select id='class_dropdown' name='class_dropdown' style='width: 15%;'>";
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
            $chapter_query = "SELECT Chap_name FROM `rb_chapter_tb` WHERE subject='$selected_subject'";
            $chapter_result = mysqli_query($conn, $chapter_query) or die(mysqli_error($conn));
            // $chapter_count = mysqli_num_rows($chapter_result);
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
                echo "<tr class='table table-success' style='text-align:center'><td>$chapter_row[0]</td>";
                $progress_query = "SELECT * FROM `chapter_completion_tb` WHERE Chap_name='$chapter_row[0]'";
                $progress_result = mysqli_query($conn, $progress_query) or die(mysqli_error($conn));
                $progress_row = mysqli_fetch_array($progress_result);
                if ($progress_row[3] == "Done") {
                    echo "<td id=$chapter_row[0]>$progress_row[3]</td>";
                } else {
                    echo '<td id=' . "$chapter_row[0]" . '><input class="btn btn-danger" type="button" name="progress_btn" id=progress_button_' . "$chapter_row[0]" . ' value="Mark as Done" onclick=(update_status(' . "'$chapter_row[0]'" . '))></td>';
                }
                echo "<td>$progress_row[4]</td></tr>";
            }
            echo '</tbody></table>';
        }
        echo '<script type="text/javascript">proceedBtnClick();</script>';
    }
    ?>
    <script>
        function update_status(chapter_name) {

            var request = new XMLHttpRequest();
            // alert(chapter_name);
            request.open("GET", "update_chapter_status.php?chapter=" + chapter_name, true);
            request.send();

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    markAsDone(chapter_name);
                }
            }
        }

        function markAsDone(chapter_name) {
            document.getElementById('progress_button_' + chapter_name).style.display = "none";
            document.getElementById(chapter_name).innerHTML = "Done";
        }
    </script>
    <!-- Progress table ends -->

    <!--Pie chart starts-->
    <div id="piechart" style="width: 900px; height: 500px;"></div>

    <?php
    $chapters_array = array();
    $chapters_notdone_array = array();
    $progress_done_array = array();
    $progress_notdone_array = array();
    $selected_subject = $_GET['class_dropdown'];
    $chapters = "SELECT Chap_name FROM `rb_chapter_tb` WHERE subject='$selected_subject'";
    $chapters_result = mysqli_query($conn, $chapter_query) or die(mysqli_error($conn));
    while ($graph_chapters = mysqli_fetch_array($chapters_result)) {
        array_push($chapters_array, $graph_chapters[0]);
        $completed_or_not = "SELECT Progress FROM `chapter_completion_tb` WHERE Chap_name='$graph_chapters[0]'";
        $completed_or_not_result = mysqli_query($conn, $progress_query) or die(mysqli_error($conn));
        while ($graph_progress = mysqli_fetch_array($completed_or_not_result)) {
            array_push($progress_array, $graph_progress[0]);
        }
    }
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var chapters = JSON.parse('<?php echo json_encode($chapters_array); ?>');
            var progress = JSON.parse('<?php echo json_encode($progress_array); ?>');

            console.log(chapters);
            console.log(progress);

            var data = google.visualization.arrayToDataTable();
            data.addColumn('Chapters', 'Completed');
            // load data
            for (var i = 0; i < chapters.length; i++) {
                var row = [chapters[i], progress[i]];
                data.addRow(row);
            }
            var options = {
                title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    <!--Pie Chart Ends-->
</body>

</html>