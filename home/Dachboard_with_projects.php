<?php

include "../db.php";
include "check.php";




$page_id = 3;
$sql_search_user_per = "SELECT * FROM `pages` JOIN pages_permission ON pages.id_page=pages_permission.fk_page_id
 WHERE pages.id_page='" . $page_id . "' AND pages_permission.fk_user_id='" . $publi_id_user . "' AND pages.page_status=1 AND pages_permission.user_pages_status=1 ;";
if ($result = mysqli_query($con, $sql_search_user_per)) {
    // Check if any rows were returned
    if (!mysqli_num_rows($result) > 0) {

        include "Error404.php";
    } else {


        static $id_dash = 0;


        if (isset($_GET['id_dash'])) {


            $id_dash = $_GET['id_dash'];

            static $link;
            static $dash_name;
            static $dash_title;
            static $details;
            static $fk_depart;
            static $fk_project_cod;
            static $dash_status;





            $sql_quer_Dashboard = "SELECT * FROM `Dashboard` WHERE `id_dash`='" . $id_dash . "';";



            $execution_query_Dashboard = mysqli_query($con, $sql_quer_Dashboard) or die(mysqli_error($con));
            if (mysqli_num_rows($execution_query_Dashboard) > 0) {
                while ($array_Dashboard = mysqli_fetch_array($execution_query_Dashboard)) {


                    $id_dash = $array_Dashboard['id_dash'];
                    $link = $array_Dashboard['link'];
                    $dash_status = $array_Dashboard['dash_status'];
                    $fk_depart = $array_Dashboard['fk_depart'];
                    $dash_title = $array_Dashboard['dash_title'];
                    $details = $array_Dashboard['details'];
                    $fk_project_cod = $array_Dashboard['fk_project_cod'];
                    $dash_name = $array_Dashboard['dash_name'];
                }
            }
        }








?>



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mange Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Mange Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>




        <section class="content">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <?php if ($id_dash > 0) {
                                ?>
                                    <h5> Chang Data Dashboard</h5>
                                <?php } else {
                                ?>
                                    <h5> Add Dashboard</h5>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="insert_data.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link">URL -Lnk</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="link" id="link" required placeholder="https://app.powerbi.com/__" value="<?php if ($id_dash > 0) {
                                                                                                                                                                            echo $link;
                                                                                                                                                                        } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">URL</i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                        <input style="display:none;" type="text" name="id_dash" id="id_dash" value="<?php if ($id_dash > 0) {

                                                                                                                        echo $id_dash;
                                                                                                                    } ?>">



                                        <div class="form-group">
                                            <label for="dash_name">Dashboard Name </label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="dash_name" id="dash_name" placeholder="Dashboard for bienif" value="<?php if ($id_dash > 0) {
                                                                                                                                                                        echo $dash_name;
                                                                                                                                                                    } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="dash_title">Dashboard Titel </label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="dash_title" id="dash_title" required placeholder="Dashboard for Achifment" value="<?php if ($id_dash > 0) {
                                                                                                                                                                                    echo $dash_title;
                                                                                                                                                                                } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="details">Dashboard Details</label>
                                            <div class="input-group">

                                                <textarea class="form-control" name="details" id="details" placeholder="This Dashboard for explin the charts " required><?php if ($id_dash > 0) {
                                                                                                                                                                            echo $details;
                                                                                                                                                                        } ?></textarea>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>





                                    </div>
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label>Sector</label>
                                            <select name="fk_depart" id="fk_depart" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $fk_depart_selected = 0;
                                                if ($id_dash > 0) {
                                                    $result_20 = mysqli_query($con, "SELECT * FROM `user_department` WHERE  depart_id='" . $fk_depart . "'  ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_20) != 0) {
                                                        $rowes = mysqli_fetch_array($result_20);
                                                        $fk_depart_selected = $rowes['depart_id'];
                                                        echo " <option value='$rowes[depart_id]'> $rowes[depart_name]</option>";
                                                    }


                                                    $result = mysqli_query($con, "SELECT * FROM `user_department` WHERE `depart_id`!='" . $fk_depart_selected . "'  ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result)) {
                                                ?>

                                                        <option value="<?php echo $r['depart_id'] ?>">


                                                            <?php echo $r['depart_name'] ?>

                                                        </option>


                                                    <?php
                                                    }
                                                } else {
                                                    echo "<option value='0'>Chose Sector</option>";

                                                    $result_21 = mysqli_query($con, "SELECT * FROM `user_department` ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_21) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result_21)) {
                                                    ?>
                                                        <option value="<?php echo $r['depart_id'] ?>">


                                                            <?php echo $r['depart_name'] ?>

                                                        </option>
                                                <?php
                                                    }
                                                }

                                                ?>

                                            </select>

                                        </div>











                                        <div class="form-group">
                                            <label>Projects</label>
                                            <select name="fk_project_cod" id="fk_project_cod" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $permission_selected = 0;
                                                if ($id_dash > 0) {
                                                    $result_12 = mysqli_query($con, "SELECT * FROM `project` WHERE  project_id='" . $fk_project_cod . "' ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_12) != 0) {
                                                        $rowes = mysqli_fetch_array($result_12);
                                                        $permission_selected = $rowes['project_id'];
                                                        echo " <option value='$rowes[project_id]'> $rowes[project_cod]</option>";
                                                    }


                                                    $result = mysqli_query($con, "SELECT * FROM `project` WHERE `project_id`!='" . $permission_selected . "'   ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result)) {
                                                ?>

                                                        <option value="<?php echo $r['project_id'] ?>">


                                                            <?php echo $r['project_cod'] ?>

                                                        </option>


                                                    <?php
                                                    }
                                                } else {
                                                    echo "<option value='0'>Chose Code Projects</option>";

                                                    $result_14 = mysqli_query($con, "SELECT * FROM `project` ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_14) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result_14)) {
                                                    ?>
                                                        <option value="<?php echo $r['project_id'] ?>">


                                                            <?php echo $r['project_cod'] ?>

                                                        </option>
                                                <?php
                                                    }
                                                }

                                                ?>

                                            </select>

                                        </div>








                                        <div class="form-group">
                                            <label>Dashboard Status</label>
                                            <select name="dash_status" id="dash_status" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $job_type_selected = 0;
                                                if ($id_dash > 0) {
                                                    $result_17 = mysqli_query($con, "SELECT * FROM `Dashboard` WHERE id_dash ='" . $id_dash . "' ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_17) != 0) {
                                                        $rowes = mysqli_fetch_array($result_17);

                                                        if ($rowes['dash_status'] == 1) {
                                                            echo " <option class='selected' value='1'>ON</option>";
                                                            echo " <option  value='3'>OFF</option>";
                                                        } else {
                                                            echo " <option class='selected' value='3'>OFF</option>";
                                                            echo " <option  value='1'>ON</option>";
                                                        }
                                                    }
                                                } else {
                                                    echo " <option class='selected' value='3'>Chose Dashboard Status</option>";
                                                    echo " <option   value='1'>ON</option>";
                                                    echo " <option   value='3'>OFF</option>";
                                                }
                                                ?>


                                            </select>


                                        </div>



                                    </div>


                                    <?php if ($id_dash > 0) {
                                    ?>
                                        <button class="btn btn-block btn-warning" id="Dashboards_add_or_updata" type="submit" name="Dashboards_add_or_updata">Edit
                                            <span data-feather="save"></span>
                                        <?php } else {
                                        ?>
                                            <button class="btn btn-block btn-info" id="Dashboards_add_or_updata" type="submit" name="Dashboards_add_or_updata">Add
                                                <span data-feather="save"></span>

                                            <?php
                                        }
                                            ?>
                                </form>
                            </div>
                        </div>


                        <div class="card card-info">

                            <div class="card-header">
                                <h5>Table Dashboards</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="dash_table" class="table table-bordered table-hover dataTable ">
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Link</th>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Details</th>
                                                <th>Sector</th>
                                                <th>Project Cod</th>
                                                <th>Status</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT * FROM `dashboard` dash JOIN user_department sec ON dash.fk_depart=sec.depart_id JOIN project ON dash.fk_project_cod=project.project_id ;";
                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>
                                                    <td>

                                                        <?php echo $r['link'] ?>

                                                        <input type="hidden" name="id_dash" id='id_dash' value=" <?php echo $r['id_dash']; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['dash_name'] ?></td>


                                                    <td>
                                                        <?php echo $r['dash_title'] ?></td>

                                                    </td>
                                                    <td><?php echo $r['details'] ?></td>

                                                    <td><?php echo $r['depart_name'] ?></td>
                                                    <td><?php echo $r['project_cod'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($r['dash_status'] == 1) {
                                                            echo "<small class='badge badge-warning'> ON</small>";
                                                        } else {
                                                            echo "<small class='badge badge-danger'> OFF </small>";
                                                        }
                                                        ?>


                                                    </td>
                                                    <td>

                                                        <a title="Edit data" class="btn btn-info btn-sm " href="Dachboard_with_projects.php?id_dash=<?php echo $r['id_dash'] ?>" role=" button"> <i class="fas fa-edit"></i></a>
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
                        <!-- /.card -->



                    </div>
                </div>
            </div>
        </section>



<?php

        include "footer.php";
    }
}
?>