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

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <title>Progress Report</title>
</head>

<body>
    <div class="container my-5">
        <table class="table table-striped table-hover table-bordered" id="myTable">
            <thead class="table-success">
                <tr style="text-align:center">
                    <th scope="col">List of Test</th>
                    <th scope="col">Exam Status</th>
                    <th scope="col">Score</th>
                    <th scope="col">View Wrong Answers</th>
                </tr>
            </thead>
            <tbody>
                <!-- List of Exams starts -->
                <?php
                $ExmClss = $_SESSION['class'];
                $ExmClss = $ExmClss . '%';
                $sql = "SELECT * FROM `rb_studentexam_tb` WHERE class LIKE '$ExmClss'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                while ($TitleRow = mysqli_fetch_array($result)) {
                    $titl = $TitleRow[1] . "_" . $TitleRow[0];
                    $IdRow = substr($titl, strpos($titl, '_', 0) + 1, strlen($titl));
                    echo "<tr class='table-primary'><td>$titl</td>";
                }
                ?>
                <!-- List of Exams ends -->
                <!-- Score starts -->
                <?php
                $user_id = $_SESSION['id'];
                $exam_id = 5454546;
                //  $marks_array = Array();
                $ExmClss = $_SESSION['class'];
                $ExmClss = $ExmClss . '%';
                $sql = "SELECT * FROM `rb_studentexam_tb` WHERE class LIKE '$ExmClss'";
                $result1 = mysqli_query($conn, $sql);
                $count1 = mysqli_num_rows($result1);
                $exam_id_array = Array();
                while ($TitleRow = mysqli_fetch_array($result1)) {
                    $titl = $TitleRow[1] . "_" . $TitleRow[0];
                    $IdRow = substr($titl, strpos($titl, '_', 0) + 1, strlen($titl));
                    array_push($exam_id_array,$IdRow);    
                }
                
                foreach ($exam_id_array as $value) {
                    $marks_query = "SELECT * FROM `rb_studentexamresult_tb` WHERE studentid='$user_id' AND testid='$value'";
                    $result = mysqli_query($conn, $marks_query);
                    $count = mysqli_num_rows($result);
                    $total_marks = 0;
                    while ($row = mysqli_fetch_array($result)) {
                    $total_marks += $row[6];
                    }
                    // echo $total_marks;
                    echo "<td>$total_marks</td></tr>";
                }

                // $marks_query = "SELECT * FROM `rb_studentexamresult_tb` WHERE studentid='$user_id' AND testid='$IdRow'";
                // $result = mysqli_query($conn, $marks_query);
                // $count = mysqli_num_rows($result);
                // $total_marks = 0;
                // while ($row = mysqli_fetch_array($result)) {
                //     $total_marks += $row[6];
                // }
                // echo $total_marks;
                ?>
                <!-- Score ends -->
            </tbody>
        </table>
    </div>
    <!-- Datatables javascript start -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <!-- </div> -->
    <!-- Datatables javascript ends -->
</body>

</html>
<!-- <div class="container my-4">
                <table class="table table-dark table-striped table-hover table-bordered my-4" id="myTable">
                    <thead class="table-success">
                        <tr style="text-align:center">
                            <th scope="col">List of Test</th>
                            <th scope="col">Exam Status</th>
                            <th scope="col">Score</th>
                            <th scope="col">View Wrong Answers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>Larry the Bird</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table> -->