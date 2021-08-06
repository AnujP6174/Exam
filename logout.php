<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    header('Location: /internship/login.php');
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