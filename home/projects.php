<?php

include "../db.php";
include "check.php";






$page_id = 2;
$sql_search_user_per = "SELECT * FROM `pages` JOIN pages_permission ON pages.id_page=pages_permission.fk_page_id
 WHERE pages.id_page='" . $page_id . "' AND pages_permission.fk_user_id='" . $publi_id_user . "' AND pages.page_status=1 AND pages_permission.user_pages_status=1 ;";
if ($result = mysqli_query($con, $sql_search_user_per)) {
    // Check if any rows were returned
    if (!mysqli_num_rows($result) > 0) {

        include "Error404.php";
    } else {

        static $project_id = 0;


        if (isset($_GET['project_id'])) {


            $project_id = $_GET['project_id'];

            static $project_cod;
            static $project_note;
            static $project_status;
            static $project_period;
            static $project_date_start;
            static $project_date_end;
            static $project_details;





            $sql_quer_project = "SELECT * FROM `project` WHERE `project_id`='" . $project_id . "';";



            $execution_query_project = mysqli_query($con, $sql_quer_project) or die(mysqli_error($con));
            if (mysqli_num_rows($execution_query_project) > 0) {
                while ($array_project = mysqli_fetch_array($execution_query_project)) {


                    $project_id = $array_project['project_id'];
                    $project_cod = $array_project['project_cod'];
                    $project_details = $array_project['project_details'];
                    $project_date_start = $array_project['project_date_start'];
                    $project_status = $array_project['project_status'];
                    $project_period = $array_project['project_period'];
                    $project_date_end = $array_project['project_date_end'];
                    $project_note = $array_project['project_note'];
                    if ($array_project['project_status'] == 1) {
                        $project_status_sc = "checked";
                    } else {
                        $project_status_sc = "check";
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
                        <h1>Mange project</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Mange project</li>
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
                                <?php if ($project_id > 0) {
                                ?>
                                    <h5> Chang Data project</h5>
                                <?php } else {
                                ?>
                                    <h5> Add project</h5>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="insert_data.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="project_cod"> Project cod</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="project_cod" id="project_cod" required placeholder="35___" value="<?php if ($project_id > 0) {
                                                                                                                                                                    echo $project_cod;
                                                                                                                                                                } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                        <input style="display:none;" type="text" name="project_id" id="project_id" value="<?php if ($project_id > 0) {
                                                                                                                                echo $project_id;
                                                                                                                            } ?>">




                                        <div class="form-group">
                                            <label for="project_period">Project Period </label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="project_period" id="project_period" placeholder="_" value="<?php if ($project_id > 0) {
                                                                                                                                                                echo $project_period;
                                                                                                                                                            } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>

                                            </div>
                                        </div>





                                        <div class="form-group">
                                            <label for="project_details">Project Details</label>
                                            <div class="input-group">

                                                <textarea class="form-control" name="project_details" id="project_details" required><?php if ($project_id > 0) {
                                                                                                                                        echo $project_details;
                                                                                                                                    } ?></textarea>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label for="project_date_start">Project Date Begins (MM-DD-YYYY)</label>
                                            <div class="input-group">

                                                <input type="date" class="form-control" name="project_date_start" id="project_date_start" placeholder="YYYY-MM-DD" require value="<?php if ($project_id > 0) {
                                                                                                                                                                                        echo $project_date_start;
                                                                                                                                                                                    } ?>">

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="project_date_end">Project Date Complete (MM-DD-YYYY)</label>
                                            <div class="input-group">

                                                <input type="date" class="form-control" name="project_date_end" id="project_date_end" placeholder="YYYY-MM-DD" require value="<?php if ($project_id > 0) {
                                                                                                                                                                                    echo $project_date_end;
                                                                                                                                                                                } ?>">

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label>Project Status</label>
                                            <select name="project_status" id="project_status" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $job_type_selected = 0;
                                                if ($project_id > 0) {
                                                    $result_17 = mysqli_query($con, "SELECT * FROM `project` WHERE project_id ='" . $project_id . "' ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_17) != 0) {
                                                        $rowes = mysqli_fetch_array($result_17);

                                                        if ($rowes['project_status'] == 1) {
                                                            echo " <option class='selected' value='1'>Functional</option>";
                                                            echo " <option  value='2'>Completed</option>";
                                                            echo " <option  value='3'>stop</option>";
                                                        } elseif ($rowes['project_status'] == 2) {
                                                            echo " <option class='selected' value='2'>Completed</option>";
                                                            echo " <option  value='1'>Functional</option>";
                                                            echo " <option  value='3'>stop</option>";
                                                        } else {
                                                            echo " <option class='selected' value='3'>stop</option>";
                                                            echo " <option   value='2'>Completed</option>";
                                                            echo " <option  value='1'>Functional</option>";
                                                        }
                                                    }
                                                } else {
                                                    echo " <option class='selected' value='3'>Chose project Status</option>";
                                                    echo " <option   value='2'>Completed</option>";
                                                    echo " <option   value='1'>Functional</option>";
                                                    echo " <option   value='3'>stop</option>";
                                                }
                                                ?>


                                            </select>


                                        </div>



                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="project_note">Project Note</label>
                                        <div class="input-group">

                                            <textarea class="form-control" name="project_note" id="project_note" placeholder="____"><?php if ($project_id > 0) {
                                                                                                                                        echo $project_note;
                                                                                                                                    } ?></textarea>


                                        </div>
                                    </div>




                                    <?php if ($project_id > 0) {
                                    ?>
                                        <button class="btn btn-block btn-warning" id="projects_add_or_updata" type="submit" name="projects_add_or_updata">Edit
                                            <span data-feather="save"></span>
                                        <?php } else {
                                        ?>
                                            <button class="btn btn-block btn-info" id="projects_add_or_updata" type="submit" name="projects_add_or_updata">Add
                                                <span data-feather="save"></span>

                                            <?php
                                        }
                                            ?>
                                </form>
                            </div>
                        </div>


                        <div class="card card-info">

                            <div class="card-header">
                                <h5>Table projects</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="projects_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th># </th>
                                                <th>project Cod</th>
                                                <th>Project Details</th>
                                                <th>project Period</th>
                                                <th>project Status</th>
                                                <th>Date Begins</th>
                                                <th>Date Complete</th>
                                                <th>project Note</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT * FROM `project`;";
                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>
                                                    <td>

                                                        <?php echo $r['project_cod'] ?>

                                                        <input type="hidden" name="project_id" id='project_id' value=" <?php echo $r['project_id']; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['project_details'] ?></td>


                                                    <td>
                                                        <?php echo $r['project_period'] ?></td>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($r['project_status'] == 1) {
                                                            echo "<small class='badge badge-warning'> Functional</small>";
                                                        } elseif ($r['project_status'] == 2) {
                                                            echo "<small class='badge badge-success'> Completed </small>";
                                                        } else {
                                                            echo "<small class='badge badge-danger'> Stoped </small>";
                                                        }
                                                        ?>


                                                    </td>
                                                    <td><?php echo $r['project_date_start'] ?></td>
                                                    <td><?php echo $r['project_date_end'] ?></td>
                                                    <td><?php echo $r['project_note'] ?></td>
                                                    <td>

                                                        <a title="Edit data" class="btn btn-info btn-sm " href="projects.php?project_id=<?php echo $r['project_id'] ?>" role=" button"> <i class="fas fa-edit"></i></a>
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