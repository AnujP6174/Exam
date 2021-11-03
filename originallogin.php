<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="RBeI.jpg" type="image/x-icon">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>RBeI Log-in</title>
</head>

<body>
  <div class="center">
    <h1>Login</h1>
    <form action="validate.php" method="post">
      <div class="txt_field">
        <input type="text" name="un" maxlength="20" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32) || (event.charCode>47 && event.charCode<58)" required>
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="pw" maxlength="10" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32) || (event.charCode>47 && event.charCode<58)" required>
        <span></span>
        <label>Password</label>
      </div>
      <div class="g-recaptcha my-4" data-sitekey="6Lcjm2QcAAAAAJIUjubU1KEnSpnBuoarqyl6i6dF"></div>
      <input type="submit" name="login" value="Login">

      <div class="container-fluid my-4">
        <?php
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //   session_start();
        //   $_SESSION['logged'] = 'yes';
        //   $conn = mysqli_connect("localhost", "root", "", "rbeitest_db") or die("Connection Failed");
        //   if (!empty($_POST['login'])) {
        //     $UserN = $_POST['un'];
        //     $PassW = $_POST['pw'];
        //     $query = "SELECT * FROM `rb_user_tb` WHERE username='$UserN' AND password='$PassW'";
        //     $result = mysqli_query($conn, $query);
        //     $count = mysqli_num_rows($result);
        //     $row = mysqli_fetch_array($result);
            // $curl=curl_init();
            // curl_setopt_array($curl,[
            //   CURLOPT_RETURNTRANSFER=>1,
            //   CURLOPT_URL=>'https://www.google.com/recaptcha/api/siteverify',
            //   CURLOPT_POST=>1,
            //   CURLOPT_POSTFIELDS=>[
            //     'secret'=>'6Lcjm2QcAAAAAMOmnreR1AdpDEija-zCv0W3Q7Ay',
            //     'response'=>'',
            //     'remoteip'=>'',
            //   ],
            // ]);
            // if ($count == 1) {
            //   $TmpClss = $row['class'];
            //   $_SESSION['username'] = $UserN;
            //   $_SESSION['class'] = $TmpClss;
            //   $user_id = $row[0];
            //   $_SESSION['id'] = $user_id;
            //   header("Location:dashboard.php");
            // } else {
            //   echo '<div class="container-fluid alert alert-danger alert-dismissible fade show" role="alert">
            //   <center><strong>Log-In Unsuccessfull! Please Enter Valid username or password </strong></center>
            //   </div>';
            //   echo '<div class="container-fluid"><br></div>';
        //     }
        //   }
        // }
        ?>
      </div>
    </form>
  </div>
</body>

</html>