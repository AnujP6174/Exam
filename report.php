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
                <div class="container my-4">
                    <?php
                    // $ExmClss = $_SESSION['class'];
                    // $ExmClss = $ExmClss . '%';
                    // $sql = "SELECT * FROM `rb_studentexam_tb` WHERE class LIKE '$ExmClss'";
                    // $result = mysqli_query($conn, $sql);
                    // $count = mysqli_num_rows($result);
                    // while ($TitleRow = mysqli_fetch_array($result)) {
                    //     $titl = $TitleRow[1] . "_" . $TitleRow[0];
                    //     $IdRow = substr($titl, strpos($titl, '_', 0) + 1, strlen($titl));
                    //     echo "<tr><td><p>$titl</p></td></tr>";
                    // }
                    ?>
                </div>
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