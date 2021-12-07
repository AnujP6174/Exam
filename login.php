<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>RBeI</title>

  <!-- <script language="javascript" type="text/javascript">
    window.history.forward();
  </script> -->
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="RBeI.jpg" type="image/x-icon">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div class="center">
    <h1>Login</h1>
    <form method="post">
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
      <input type="submit" name="login" onclick="submit_data()" value="Login">
      <div class="signup_link">
        <p>Don't Have Account?<a href="register"> Sign Up</a></p>
      </div>
      <div class="container-fluid">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          session_start();
          $_SESSION['logged'] = 'yes';
          $conn = mysqli_connect("localhost", "root", "", "rbeitest_db") or die("Connection Failed");

          if (isset($_POST['login']) && $_POST['g-recaptcha-response'] != " " && !empty($_POST['login'])) {
            $secret = '6Lcjm2QcAAAAAMOmnreR1AdpDEija-zCv0W3Q7Ay';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);

            if ($responseData->success) {
              $UserN = mysqli_real_escape_string($conn, $_POST['un']);
              $PassW = mysqli_real_escape_string($conn, $_POST['pw']);
              // $query = "SELECT * FROM `rb_user_tb` WHERE username='$UserN' AND password='$PassW'";
              $query = "SELECT * FROM `rb_user_tb` WHERE username='$UserN'";
              $result = mysqli_query($conn, $query);
              $count = mysqli_num_rows($result);
              if ($count == 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                  if (password_verify($PassW, $row['password'])) {
                    $_SESSION['CODE'];
                    $TmpClss = $row['class'];
                    $_SESSION['username'] = $UserN;
                    $_SESSION['class'] = $TmpClss;
                    $user_id = $row[0];
                    $_SESSION['id'] = $user_id;
                    header("Location:dashboard");
                  } else {
                    echo "<div class='container-fluid alert alert-danger alert-dismissible fade show' role='alert'>
                    <center><strong>Log-In Unsuccessfull! Please Enter Valid username or password </strong></center>
                    </div>";
                    echo '<div class="container-fluid"><br></div>';
                  }
                }
              } else {
                echo "<div class='container-fluid alert alert-danger alert-dismissible fade show' role='alert'>
                <center><strong>Log-In Unsuccessfull! Please Enter Valid username or password </strong></center>
                </div>";
                echo '<div class="container-fluid"><br></div>';
              }
            } else {
              echo '<div class="container-fluid alert alert-danger alert-dismissible fade show" role="alert">
                <center><strong>Log-In Unsuccessfull! Please Enter Captcha </strong></center>
                </div>';
              echo '<div class="container-fluid"><br></div>';
            }
          }
        }
        ?>
      </div>
    </form>
  </div>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function submit_data() {
      jQuery.ajax({
        url: 'dashboard',
        type: 'post',
        data: jQuery('#frmCaptcha').serialize(),
        success: function(data) {
          // alert(data);
        }
      });
    }
  </script> -->
</body>

</html>