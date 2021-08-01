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
    <title>Test2</title>
</head>

<body>
    <form method="$_GET">
        <?php
        $ExmClss = $_SESSION['class'];
        $ExmClss = $ExmClss . '%';
        $sql = "SELECT * FROM `rb_studentexam_tb` WHERE class LIKE '$ExmClss'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        while ($TitleRow = mysqli_fetch_array($result)) {
            $titl = $TitleRow[1]."|".$TitleRow[0];
            $IdRow=substr($titl,strpos($titl, '|', 0)+1,strlen($titl));
            echo "<a href=https://www.rbeiset.com/packageexam/?examid=$IdRow>$titl</a>";
            echo "<br><br>";
        }
        exit();
        $conn->close();
        $conn = mysqli_connect("localhost", "root", "", "rbeitest_db");
        // if(a)
        // $sql = "SELECT * FROM `rb_studentexam_tb` WHERE title='$some'";
        // $result = mysqli_query($conn, $sql);
        // $count = mysqli_num_rows($result);
        // $IdRow = mysqli_fetch_array($result);
        // echo $IdRow[0];
        ?>
    </form>
</body>

</html>