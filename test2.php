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
        while ($row = mysqli_fetch_array($result)) {
            echo "<a href=https://www.rbeiset.com/packageexam/?examid=>$row[1]</a>";
            $some = $row[1];
            echo "<br>";
        }

        ?>
    </form>
</body>

</html>