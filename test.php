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
    <title>Test</title>
</head>

<body>
    <?php
    $ExmClss = $_SESSION['class'];
    $ExmClss = $ExmClss . '%';
    $sql = "SELECT * FROM `rb_studentexam_tb` WHERE class LIKE '$ExmClss'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    // $row = mysqli_fetch_array($result);
    // if ($count == 0) {
    //     echo "Paper not Prepared";
    // } elseif ($count >= 1) {
    // while($row==$count):;
    //     echo $row[1];
    // echo "Ap";
    // }
    ?>
    <!-- ComboBox start -->
    <form method="get">
        <select name="combobox">
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option><?php echo $row[1]; ?></option>
            <?php
            }
            ?>
        </select>
    </form>
    <!-- <button>Submit</button> -->


    <?php
    // $PID = PaperId();
    // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // $conn = mysqli_connect("localhost", "root", "", "rbeitest_db");
    // exit();
    // $PID = 5454546;
    // echo 'https://www.rbeiset.com/packageexam/?examid=' . $PID;
    // function PaperId()
    // {
    echo "ap";
    $conn = mysqli_connect("localhost", "root", "", "rbeitest_db");
    if (isset($_GET['submit'])) {
        $selval = $_GET['combobox'];
        echo $selval;
        // exit();
        $sql = "SELECT * FROM `rb_studentexam_tb` WHERE title='$selval'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        echo $row;
        // echo "arpan";
        if ($count == 1) {
            $idresult = $row[0];
            // echo $idresult;
            // return $idresult;
        }
    }
    // }
    // }
    ?>
    <a name="submit" href="https://www.rbeiset.com/packageexam/?examid=" .$PID>Submit</a>'
    <!-- </form> -->
</body>

</html>