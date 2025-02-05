<?php

$publi_id_user;
$publi_name;
$publi_email_user;
$publi_password_user;
$publi_permissions_fk;
$publi_img_user;
$publi_status;
$publi_user_phone;
$publi_user_job;
$publi_details_job;
$publi_fk_id_user;
$publi_user_note;
$publi_department;

$publi_depart_name;
$publi_name_permiss;



if ($_SESSION['logged_in_user']) {
  if (!isset($_SESSION['id_user']) && isset($_SESSION['name']) != "") {

    header('Location:../index.phpp');
    exit;
  }


  $sql_quer_usert = "SELECT * FROM `users` us JOIN user_department de ON us.department=de.depart_id JOIN permission per ON us.permissions_fk=per.id_perm WHERE us.id_user='" . $_SESSION['id_user'] . "';";

  $execution_query_user = mysqli_query($con, $sql_quer_usert) or die(mysqli_error($con));
  if (mysqli_num_rows($execution_query_user) > 0) {
    $rows = mysqli_fetch_array($execution_query_user);

    $publi_id_user = $rows['id_user'];
    $publi_name = $rows['name'];
    $publi_email_user = $rows['email_user'];
    $publi_password_user = $rows['password_user'];
    $publi_permissions_fk = $rows['permissions_fk'];
    $publi_img_user = $rows['img_user'];
    $publi_status = $rows['status'];
    $publi_user_phone = $rows['user_phone'];
    $publi_user_job = $rows['user_job'];
    $publi_details_job = $rows['details_job'];
    $publi_fk_id_user = $rows['fk_id_user'];
    $publi_user_note = $rows['user_note'];
    $publi_department = $rows['department'];

    $publi_depart_name = $rows['depart_name'];
    $publi_name_permiss = $rows['name_permiss'];
  }
} else {
  // User is already logged in, redirect to dashboard
  header('location:../index.php');
  exit;
}





?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Dashboard Project</title>
  <link rel="apple-touch-icon" href="../img/web_img/icon.png">
  <link rel="shortcut icon" type="image/x-icon" href="../img/web_img/icon.png">


  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Design/plugins/fontawesome-free/css/all.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../Design/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Design/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">






  <!-- DataTables -->
  <link rel="stylesheet" href="../Design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">







  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Design/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../Design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Design/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->



  <!-- daterange picker -->
  <link rel="stylesheet" href="../Design/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../Design/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../Design/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../Design/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../Design/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">










  <!-- css for message -->
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../Design/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../Design/plugins/toastr/toastr.min.css">



  <!-- mystyle for them my website -->
  <link rel="stylesheet" href="mystyle.css">


  <!-- Select2 important for select  -->
  <link rel="stylesheet" href="../Design/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../Design/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <script src="../Design/pages/assets/js/jquery-3.6.0.min.js"></script>

</head>



<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">


      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="home.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>



    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="home.php" class="brand-link">
        <img src="../img/web_img/1.jpg" alt="Intersos Organization" class="brand-image  elevation-3">
        <span class="brand-text font-weight-light">Intersos Organization </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php if (isset($publi_name) != "") {  ?>
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="../img/img_user/<?php echo $publi_img_user; ?>" class="img-circle elevation-2"
                alt="<?php echo $publi_name; ?>">
            </div>
            <div class="info">
              <a href="my_profile.php" class="d-block"><?php echo $publi_name; ?></a>
            </div>
          </div>
        <?php } ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <?php
            $sql = "SELECT * FROM `pages`JOIN pages_permission ON pages.id_page=pages_permission.fk_page_id  WHERE `page_status`=1 AND pages_permission.user_pages_status=1 AND pages_permission.fk_user_id='" . $_SESSION['id_user'] . "'  ;";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            while ($r = mysqli_fetch_array($result)) {


            ?>


              <li class="nav-item has-treeview">
                <a href="<?php echo $r['link']; ?>" class="nav-link">
                  <i class="nav-icon fas fa-<?php echo $r['icon_page']; ?>"></i>
                  <p>
                    <?php echo $r['name_page']; ?>
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>

              </li>



            <?php }
            ?>
            <li class="nav-item">
              <a href="my_profile.php" class="nav-link" id="">
                <i class="fas fa-edit"></i>
                <p> My Profile</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="logout.php" class="nav-link" id="">
                <i class="fas fa-times"></i>
                <p> Sign out</p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">