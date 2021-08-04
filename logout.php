<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $conn = mysqli_connect("localhost", "root", "", "rbeitest_db");
    session_unset();
    session_destroy();
    mysqli_close($conn);
    setcookie('username', '', time() - 3600);
    setcookie('password', '', time() - 3600);
    header("Location:login.php");
}
// exit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>