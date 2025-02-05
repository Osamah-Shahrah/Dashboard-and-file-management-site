<?php
session_start();
include 'db.php';


if (isset($_SESSION['logged_in_user'])) {
  if (isset($_SESSION['id_user']) && isset($_SESSION['name']) != "") {

    header('location:home/home.php');
    exit;
  }
}


static $problem;


if (isset($_POST['login'])) {


  $Email = $_POST['Email'];
  $pass = md5($_POST['password']);

  $sql_quer_usert = "SELECT * FROM `users` WHERE `email_user`='" . $Email . "' AND  `password_user`='" . $pass . "' ;";

  $execution_query_user = mysqli_query($con, $sql_quer_usert) or die(mysqli_error($con));
  if (mysqli_num_rows($execution_query_user) > 0) {
    $rows = mysqli_fetch_array($execution_query_user);

    if ($rows['status'] == 1) {
      $_SESSION['id_user'] = $rows['id_user'];
      $_SESSION['name'] = $rows['name'];
      $_SESSION['logged_in_user'] = 1;
      header("location:home/home.php");
    } else {
      $problem = "This Account is Not Activity";
    }
  } else {
    $problem = "There is no account.Please contact with Administrator ";
  }
}


?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Log in</title>
  <link rel="apple-touch-icon" href="img/web_img/icon.png">
  <link rel="shortcut icon" type="image/x-icon" href="img/web_img/icon.png">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Design/plugins/fontawesome-free/css/all.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="Design/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Design/dist/css/adminlte.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="Design/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="Design/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="Design/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- css for message -->
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="Design/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="Design/plugins/toastr/toastr.min.css">
  <!-- mystyle for them my website -->
  <link rel="stylesheet" href="mystyle.css">

  <script src="Design/pages/assets/js/jquery-3.6.0.min.js"></script>

</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>Log</b> In</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Log in</p>

        <form method="POST">

          <div class="input-group mb-3">
            <input type="Email" name="Email" class="form-control" id="floatingInput" placeholder="name@example.com">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p style="color: red;">
            <?php echo $problem; ?></p>

          <button class="btn btn-block btn-primary" type="submit" name="login">Login</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>