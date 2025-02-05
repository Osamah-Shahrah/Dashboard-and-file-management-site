<?php
include "../db.php";
include "check.php";





$page_id = 5;

$sql_search_user_per = "SELECT * FROM `pages` JOIN pages_permission ON pages.id_page=pages_permission.fk_page_id
 WHERE pages.id_page='" . $page_id . "' AND pages_permission.fk_user_id='" . $publi_id_user . "' AND pages.page_status=1 AND pages_permission.user_pages_status=1 ;";
if ($result = mysqli_query($con, $sql_search_user_per)) {
    // Check if any rows were returned
    if (!mysqli_num_rows($result) > 0) {

        include "Error404.php";
    } else {



        static $id_user = 0;


        if (isset($_GET['id_user'])) {


            $id_user = $_GET['id_user'];

            static $name;
            static $email_user;
            static $img_user;
            static $status;

            $sql_quer_usert = "SELECT * FROM `users` WHERE `id_user`='" . $id_user . "';";



            $execution_query_user = mysqli_query($con, $sql_quer_usert) or die(mysqli_error($con));
            if (mysqli_num_rows($execution_query_user) > 0) {
                while ($array_user = mysqli_fetch_array($execution_query_user)) {


                    $id_user = $array_user['id_user'];
                    $name = $array_user['name'];
                    $email_user = $array_user['email_user'];
                    $img_user = $array_user['img_user'];
                    if ($array_user['status'] == 1) {
                        $status_sc_user = "checked";
                    } else {
                        $status_sc_user = "check";
                    }
                }
            }
        }


?>



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mange Permission</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Mange Permission</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>




        <section class="content">
            <div class="container-fluid">


                <div class="row">
                    <!-- user table -->
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-user"></i>
                                    Users
                                </h3>

                            </div>

                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="users_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th># </th>
                                                <th>User Information</th>
                                                <th>Email</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT * FROM users join permission ON users.permissions_fk=permission.id_perm Where status=1;";
                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>
                                                    <td>
                                                        <img width='50px' height='50px' class='img-fluid rounded' src="../img/img_user/<?php echo $r['img_user']; ?>" alt="<?php echo $r['name']; ?>">



                                                        <?php echo $r['name'] ?>

                                                        <input type="hidden" name="id_user" id='id_user' value=" <?php echo $r['id_user']; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['email_user'] ?></td>




                                                    <td>
                                                        <a title="Edit data" class="btn btn-info btn-sm " href="mange_permission.php?id_user=<?php echo $r['id_user'] ?>" role=" button">
                                                            Select

                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php

                                            }

                                            ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </div>
                    </div>
                    <!-- /.card -->


                </div>

                <?php if ($id_user) {


                ?>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <img width='50px' height='50px' class='img-fluid rounded' src="../img/img_user/<?php echo $img_user; ?>" alt="<?php echo $r['name']; ?>">

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo $name ?></span>
                                <span class="info-box-number"><?php echo $email_user; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                <?php
                }
                ?>

                <div class="row">

                    <!-- dashboard table -->
                    <div class="col-md-6">

                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Dashboard
                                </h3>

                            </div>

                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="dashbord_prem" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th># </th>
                                                <th>Titel</th>
                                                <th>Sector</th>
                                                <th>Project Cod</th>
                                                <?php if ($id_user) { ?>
                                                    <th>#</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT `id_dash`,`dash_title`,`depart_name`,`project_cod` FROM `dashboard` dash join user_department u_dep  ON dash.`fk_depart`= u_dep.`depart_id` join `project` pro ON dash.`fk_project_cod`=pro.`project_id`   WHERE `dash_status`=1;";
                                            if ($id_user) {
                                                $sql = "SELECT `id_dash`,`dash_title`,`depart_name`,`project_cod`,user_dash_status FROM `dashboard` dash join user_department u_dep  ON dash.`fk_depart`= u_dep.`depart_id` join `project` pro ON dash.`fk_project_cod`=pro.`project_id` LEFT OUTER JOIN dash_permission dash_per ON dash_per.fk_id_dash=dash.id_dash AND dash_per.fk_id_user='" . $id_user . "'   WHERE `dash_status`=1  ;";
                                            }


                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>
                                                    <td>
                                                        <?php echo $r['dash_title'] ?>

                                                        <input type="hidden" name="id_dash_per" id='id_dash_per' value=" <?php echo $r['id_dash']; ?>"></input>
                                                        <input type="hidden" name="id_user_dash_per" id='id_user_dash_per' value=" <?php echo $id_user; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['depart_name'] ?></td>

                                                    <td><?php echo $r['project_cod'] ?></td>
                                                    <?php if ($id_user) { ?>

                                                        <td>
                                                            <?php
                                                            if ($r['user_dash_status'] == 1) {
                                                                $status_sc = "checked";
                                                            } else {
                                                                $status_sc = "check";
                                                            }
                                                            ?>



                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                    <input type="checkbox" class="custom-control-input" id="dash_<?php echo $r['id_dash']; ?>" name="user_dash_status" value="<?php echo $r['user_dash_status']; ?>" <?php echo $status_sc; ?>>
                                                                    <label class="custom-control-label" for="dash_<?php echo $r['id_dash']; ?>">
                                                                        <?php
                                                                        if ($r['user_dash_status'] == 1) {
                                                                            echo "<small class='badge badge-warning'> On </small>";
                                                                        } else {
                                                                            echo "<small class='badge badge-danger'> off </small>";
                                                                        }
                                                                        ?></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>
                                            <?php

                                            }

                                            ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->




                    <!-- document table -->
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Documents
                                </h3>

                            </div>

                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="document_prem" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th># </th>
                                                <th>Titel</th>
                                                <th>Sector</th>
                                                <th>Project Cod</th>
                                                <th>Type</th>
                                                <?php if ($id_user) { ?>
                                                    <th>#</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT `id_file`, `file_title`, `document_type`,`depart_name`,`project_cod` FROM `file` fi join user_department u_dep  ON fi.`fk_depart`= u_dep.`depart_id` join `project` pro ON fi.`fk_project_cod`=pro.`project_id`   WHERE `file_status`=1 ;";

                                            if ($id_user) {
                                                $sql = "SELECT `id_file`, `file_title`, `document_type`,`depart_name`,`project_cod`,`user_file_status` FROM `file` fi join user_department u_dep  ON fi.`fk_depart`= u_dep.`depart_id` join `project` pro ON fi.`fk_project_cod`=pro.`project_id` LEFT OUTER JOIN `file_permission` fil_per ON fi.`id_file`=fil_per.`fk_id_file` AND fil_per.`fk_id_user`= '" . $id_user . "'   WHERE `file_status`=1 ; ";
                                            }


                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>
                                                    <td>

                                                        <?php echo $r['file_title'] ?>

                                                        <input type="hidden" name="id_file_per" id='id_file_per' value=" <?php echo $r['id_file']; ?>"></input>
                                                        <input type="hidden" name="id_user_file_per" id='id_user_file_per' value=" <?php echo $id_user; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['depart_name'] ?></td>

                                                    <td><?php echo $r['project_cod'] ?></td>
                                                    <td><?php echo $r['document_type'] ?></td>
                                                    <?php if ($id_user) { ?>
                                                        <td>
                                                            <?php
                                                            if ($r['user_file_status'] == 1) {
                                                                $status_sc = "checked";
                                                            } else {
                                                                $status_sc = "check";
                                                            }
                                                            ?>



                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                    <input type="checkbox" class="custom-control-input" id="file_<?php echo $r['id_file']; ?>" name="user_file_status_per" value="<?php echo $r['user_file_status']; ?>" <?php echo $status_sc; ?>>
                                                                    <label class="custom-control-label" for="file_<?php echo $r['id_file']; ?>">
                                                                        <?php
                                                                        if ($r['user_file_status'] == 1) {
                                                                            echo "<small class='badge badge-warning'> On </small>";
                                                                        } else {
                                                                            echo "<small class='badge badge-danger'> off </small>";
                                                                        }
                                                                        ?></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>
                                            <?php

                                            }

                                            ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->














                    <!-- pages table -->
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Pages
                                </h3>

                            </div>

                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="page_prem" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th># </th>
                                                <th>Name</th>
                                                <th>Details</th>
                                                <?php if ($id_user) { ?>
                                                    <th>#</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT * FROM `pages` WHERE `page_status`=1;";

                                            if ($id_user) {
                                                $sql = "SELECT * FROM `pages` LEFT OUTER JOIN `pages_permission` ON pages.id_page=pages_permission.fk_page_id AND pages_permission.fk_user_id= '" . $id_user . "' WHERE `page_status`=1 ; ";
                                            }


                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>
                                                    <td>

                                                        <?php echo $r['name_page'] ?>

                                                        <input type="hidden" name="id_page_per" id='id_page_per' value=" <?php echo $r['id_page']; ?>"></input>
                                                        <input type="hidden" name="id_user_page_per" id='id_user_page_per' value=" <?php echo $id_user; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['page_details'] ?></td>


                                                    <?php if ($id_user) { ?>
                                                        <td>
                                                            <?php
                                                            if ($r['user_pages_status'] == 1) {
                                                                $status_sc = "checked";
                                                            } else {
                                                                $status_sc = "check";
                                                            }
                                                            ?>



                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                    <input type="checkbox" class="custom-control-input" id="page_<?php echo $r['id_page']; ?>" name="user_pages_status_per" value="<?php echo $r['user_pages_status']; ?>" <?php echo $status_sc; ?>>
                                                                    <label class="custom-control-label" for="page_<?php echo $r['id_page']; ?>">
                                                                        <?php
                                                                        if ($r['user_pages_status'] == 1) {
                                                                            echo "<small class='badge badge-warning'> On </small>";
                                                                        } else {
                                                                            echo "<small class='badge badge-danger'> off </small>";
                                                                        }
                                                                        ?></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>
                                            <?php

                                            }

                                            ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->


                </div>
            </div>
        </section>



<?php

        include "footer.php";
    }
}
?>