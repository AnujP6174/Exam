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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <title>image</title>
</head>

<body>
    <?php
    $user_id = $_SESSION['id'];
    $ExmClss = $_SESSION['class'];
    $ExmClss = $ExmClss . '%';
    $sql = "SELECT * FROM `rb_studentexam_tb` WHERE class LIKE '$ExmClss'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    // $exam_id_array = array();
    // $exam_marks = array();
    // $exam_title = array();
    $status_array = array();
    $image = array();

    // Status query

    $status_query = "SELECT * FROM `rb_studentexamresult_tb` WHERE status='incorrect'";
    $status_result = mysqli_query($conn, $status_query);
    $status_count = mysqli_num_rows($status_result);


    // Status query ends
    while ($image = mysqli_fetch_array($status_result)) {
        $image_query = "SELECT * FROM `rb_studentexamresult_tb` WHERE testid=$image[2] AND questionid=$image[3]";
        $image_result = mysqli_query($conn, $image_query);
        // echo $image[2]," ",$image[3]," ", $image[9];
        echo "<br>";
    ?>
        <img src="<?php
                    echo $image['hindi_question_img']; ?>">
    <?php
    }
    ?>
</body>

</html>