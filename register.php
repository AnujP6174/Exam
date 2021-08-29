<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "rbeitest_db");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>RBeI Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center">
        <h1>Register</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="name" maxlength="40" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32) || (event.charCode>47 && event.charCode<58)" required>
                <span></span>
                <label>Enter Your Name</label>
            </div>
            <div class="txt_field">
                <input type="text" name="email" onkeypress="return (event.charCode > 63 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode>47 && event.charCode<58) || (event.charCode=46)" required>
                <span></span>
                <label>Enter Your Email</label>
            </div>
            <div class="txt_field">
                <input type="tel" name="mobile_number" maxlength="10" onkeypress="return (event.charCode > 48 && event.charCode < 58)" required>
                <span></span>
                <label>Enter Your Mobile No.</label>
            </div>
            <div class="txt_field">
                <input type="pw" name="password" maxlength="10" onkeypress="return (event.charCode > 48 && event.charCode < 58)" required>
                <span></span>
                <label>Create Password(Numbers Only)</label>
            </div>
            <div class="dropdown">
                <?php
                $register_select_class_query = "SELECT * FROM `rb_class_tb`";
                $register_select_class_result = mysqli_query($conn, $register_select_class_query) or die(mysqli_error($conn));
                echo "<form method='GET'>
                <label>Select Your Class: </label>
                <select name='register_class' id='register_class'>";
                while ($register_select_class_row = mysqli_fetch_array($register_select_class_result)) {
                    echo "<option value='$register_select_class_row[1]'>$register_select_class_row[1]</option>";
                }
                echo "</select></form><br>";
                ?>
                <br><input type="submit" name="signup" value="SignUp">
            </div>
            <div class="my-4"></div>
        </form>
    </div>
</body>

</html>