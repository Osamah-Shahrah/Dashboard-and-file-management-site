<?php

include "../db.php";
include "check.php";



$page_id = 4;
$sql_search_user_per = "SELECT * FROM `pages` JOIN pages_permission ON pages.id_page=pages_permission.fk_page_id
 WHERE pages.id_page='" . $page_id . "' AND pages_permission.fk_user_id='" . $publi_id_user . "' AND pages.page_status=1 AND pages_permission.user_pages_status=1 ;";
if ($result = mysqli_query($con, $sql_search_user_per)) {
    // Check if any rows were returned
    if (!mysqli_num_rows($result) > 0) {

        include "Error404.php";
    } else {


        static $id_file = 0;


        if (isset($_GET['id_file'])) {


            $id_file = $_GET['id_file'];

            static $link;
            static $file_name;
            static $file_title;
            static $file_details;
            static $fk_depart;
            static $fk_project_cod;
            static $file_status;
            static $document_type;




            $sql_quer_file = "SELECT * FROM `file` WHERE `id_file`='" . $id_file . "';";



            $execution_query_file = mysqli_query($con, $sql_quer_file) or die(mysqli_error($con));
            if (mysqli_num_rows($execution_query_file) > 0) {
                while ($array_file = mysqli_fetch_array($execution_query_file)) {


                    $id_file = $array_file['id_file'];
                    $link = $array_file['link'];
                    $file_status = $array_file['file_status'];
                    $fk_depart = $array_file['fk_depart'];
                    $file_title = $array_file['file_title'];
                    $file_details = $array_file['file_details'];
                    $fk_project_cod = $array_file['fk_project_cod'];
                    $file_name = $array_file['file_name'];
                    $document_type = $array_file['document_type'];
                }
            }
        }








?>



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mange Documents </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Mange Documents </li>
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
                                <?php if ($id_file > 0) {
                                ?>
                                    <h5> Chang Data Documents </h5>
                                <?php } else {
                                ?>
                                    <h5> Add Documents </h5>

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

                                                <input type="text" class="form-control" name="link" id="link" required placeholder="https://drive.google.com/__" value="<?php if ($id_file > 0) {
                                                                                                                                                                            echo $link;
                                                                                                                                                                        } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">URL</i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                        <input style="display:none;" type="text" name="id_file" id="id_file" value="<?php if ($id_file > 0) {

                                                                                                                        echo $id_file;
                                                                                                                    } ?>">



                                        <div class="form-group">
                                            <label for="file_name">Documents Name </label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="file_name" id="file_name" placeholder="File" value="<?php if ($id_file > 0) {
                                                                                                                                                        echo $file_name;
                                                                                                                                                    } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="file_title">Documents Titel </label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="file_title" id="file_title" required placeholder="File" value="<?php if ($id_file > 0) {
                                                                                                                                                                    echo $file_title;
                                                                                                                                                                } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="file_details">Documents Details</label>
                                            <div class="input-group">

                                                <textarea class="form-control" name="file_details" id="file_details" placeholder="This File for ...... " required><?php if ($id_file > 0) {
                                                                                                                                                                        echo $file_details;
                                                                                                                                                                    } ?></textarea>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>





                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Document Type</label>
                                            <select name="document_type" id="document_type" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $fk_file_type_selected = 0;
                                                if ($id_file > 0) {
                                                    $result_20 = mysqli_query($con, "SELECT * FROM `files_type` WHERE  name_type='" . $document_type . "'  ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_20) != 0) {
                                                        $rowes = mysqli_fetch_array($result_20);
                                                        $fk_file_type_selected = $rowes['name_type'];
                                                        echo " <option value='$rowes[name_type]'> $rowes[name_type]</option>";
                                                    }


                                                    $result = mysqli_query($con, "SELECT * FROM `files_type` WHERE `name_type`!='" . $fk_file_type_selected . "'  ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result)) {
                                                ?>

                                                        <option value="<?php echo $r['name_type'] ?>">


                                                            <?php echo $r['name_type'] ?>

                                                        </option>


                                                    <?php
                                                    }
                                                } else {
                                                    echo "<option value='0'>Chose Documents Type</option>";

                                                    $result_21 = mysqli_query($con, "SELECT * FROM `files_type` ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_21) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result_21)) {
                                                    ?>
                                                        <option value="<?php echo $r['name_type'] ?>">


                                                            <?php echo $r['name_type'] ?>

                                                        </option>
                                                <?php
                                                    }
                                                }

                                                ?>


                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label>Sector</label>
                                            <select name="fk_depart" id="fk_depart" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $fk_depart_selected = 0;
                                                if ($id_file > 0) {
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
                                                    echo "<option value='0'>Chose Documents  Sector</option>";

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
                                                if ($id_file > 0) {
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
                                                    echo "<option value='0'>Chose Code Projects </option>";

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
                                            <label>Documents Status</label>
                                            <select name="file_status" id="file_status" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $job_type_selected = 0;
                                                if ($id_file > 0) {
                                                    $result_17 = mysqli_query($con, "SELECT * FROM `file` WHERE id_file ='" . $id_file . "' ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_17) != 0) {
                                                        $rowes = mysqli_fetch_array($result_17);

                                                        if ($rowes['file_status'] == 1) {
                                                            echo " <option class='selected' value='1'>ON</option>";
                                                            echo " <option  value='3'>OFF</option>";
                                                        } else {
                                                            echo " <option class='selected' value='3'>OFF</option>";
                                                            echo " <option  value='1'>ON</option>";
                                                        }
                                                    }
                                                } else {
                                                    echo " <option class='selected' value='3'>Chose Documents  Status</option>";
                                                    echo " <option   value='1'>ON</option>";
                                                    echo " <option   value='3'>OFF</option>";
                                                }
                                                ?>


                                            </select>


                                        </div>



                                    </div>


                                    <?php if ($id_file > 0) {
                                    ?>
                                        <button class="btn btn-block btn-warning" id="Files_add_or_updata" type="submit" name="Files_add_or_updata">Edit
                                            <span data-feather="save"></span>
                                        <?php } else {
                                        ?>
                                            <button class="btn btn-block btn-info" id="Files_add_or_updata" type="submit" name="Files_add_or_updata">Add
                                                <span data-feather="save"></span>

                                            <?php
                                        }
                                            ?>
                                </form>
                            </div>
                        </div>


                        <div class="card card-info">

                            <div class="card-header">
                                <h5>Table Documents </h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="file_table" class="table table-bordered table-hover dataTable ">
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Link</th>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Documents Details</th>
                                                <th>Sector</th>
                                                <th>Project Cod</th>
                                                <th>Document Type</th>
                                                <th>Status</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT * FROM `file` dash JOIN user_department sec ON dash.fk_depart=sec.depart_id JOIN project ON dash.fk_project_cod=project.project_id ;";
                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>
                                                    <td>

                                                        <?php echo $r['link'] ?>

                                                        <input type="hidden" name="id_file" id='id_file' value=" <?php echo $r['id_file']; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['file_name'] ?></td>


                                                    <td>
                                                        <?php echo $r['file_title'] ?></td>

                                                    </td>
                                                    <td><?php echo $r['file_details'] ?></td>

                                                    <td><?php echo $r['depart_name'] ?></td>
                                                    <td><?php echo $r['project_cod'] ?></td>
                                                    <td><?php echo $r['document_type'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($r['file_status'] == 1) {
                                                            echo "<small class='badge badge-warning'> ON</small>";
                                                        } else {
                                                            echo "<small class='badge badge-danger'> OFF </small>";
                                                        }
                                                        ?>


                                                    </td>
                                                    <td>

                                                        <a title="Edit data" class="btn btn-info btn-sm " href="files.php?id_file=<?php echo $r['id_file'] ?>" role=" button"> <i class="fas fa-edit"></i></a>
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