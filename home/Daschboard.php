<?php
include "check.php";


static $id_dash;
static $link;
static $dash_name;
static $dash_title;
static $details;
static $fk_depart;
static $fk_project_cod;
static $dash_status;
static $depart_name;
static $project_cod;

if (isset($_GET['title'])) {

    $title = $_GET['title'];
    $fk_project_cod = $_GET['fk_project_cod'];
    $fk_depart = $_GET['fk_depart'];

    $sql_quer_usert = "SELECT DISTINCT * FROM `dashboard` dash JOIN project  pro ON dash.fk_project_cod=pro.project_id JOIN user_department dep ON dash.fk_depart =dep.depart_id WHERE `dash_title`='" . $title . "' AND `fk_project_cod`='" . $fk_project_cod . "' AND `fk_depart`='" . $fk_depart . "'  AND dash_status=1 ;";



    $execution_query_user = mysqli_query($con, $sql_quer_usert) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_user) > 0) {
        $array_user = mysqli_fetch_array($execution_query_user);
        $dash_title = $array_user['dash_title'];
        $link = $array_user['link'];
        $dash_name = $array_user['dash_name'];
        $details = $array_user['details'];
        $depart_name = $array_user['depart_name'];
        $project_cod = $array_user['project_cod'];
    }
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row sm-1">
            <div class="col">
                <ol class="breadcrumb float-sm-lift">

                    <li class="breadcrumb-item"><?php echo $project_cod; ?></li>
                    <li class="breadcrumb-item active"><?php echo $depart_name; ?></li>
                    <li class="breadcrumb-item active"><?php echo $dash_title; ?></li>
                </ol>
            </div>
            <div>

                <img src="../img/web_img/intersos2.jpg" alt="Intersos Organization" width='120px' height='90px' class='img-fluid rounded'>

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">

    <iframe title="<?php echo $dash_title; ?>" width="100%" height="800" src="<?php echo $link; ?>" frameborder="0" alt="<?php echo $details; ?>" allowFullScreen="true"></iframe>



</section>



<!-- /.content -->
<?php


include "footer.php";


?>