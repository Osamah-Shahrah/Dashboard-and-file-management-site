<?php

include "../db.php";
include "check.php";





$page_id = 1;
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
            static $password_user;
            static $permissions_fk;
            static $user_phone;
            static $user_job;
            static $details_job;
            static $fk_id_user;
            static $user_note;
            static $department;
            $sql_quer_usert = "SELECT * FROM `users` WHERE `id_user`='" . $id_user . "';";



            $execution_query_user = mysqli_query($con, $sql_quer_usert) or die(mysqli_error($con));
            if (mysqli_num_rows($execution_query_user) > 0) {
                while ($array_user = mysqli_fetch_array($execution_query_user)) {


                    $id_user = $array_user['id_user'];
                    $name = $array_user['name'];
                    $email_user = $array_user['email_user'];
                    $img_user = $array_user['img_user'];
                    $password_user = $array_user['password_user'];
                    $permissions_fk = $array_user['permissions_fk'];
                    $status = $array_user['status'];
                    $user_phone = $array_user['user_phone'];
                    $user_job = $array_user['user_job'];
                    $details_job = $array_user['details_job'];
                    $fk_id_user = $array_user['fk_id_user'];
                    $user_note = $array_user['user_note'];
                    $department = $array_user['department'];



                    if ($array_user['status'] == 1) {
                        $status_sc = "checked";
                    } else {
                        $status_sc = "check";
                    }
                }
            }
        }


        static $id_user_acc = 0;
        if (isset($_GET['id_user_acc'])) {

            $id_user_acc = $_GET['id_user_acc'];

            $sql_quer_usert = "UPDATE `users` SET `status`='1' WHERE `id_user`='" . $id_user_acc . "';";



            $execution_query_user = mysqli_query($con, $sql_quer_usert) or die(mysqli_error($con));
        }








?>



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mange User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Mange User</li>
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
                                <?php if ($id_user > 0) {
                                ?>
                                    <h5> Chang Data User</h5>
                                <?php } else {
                                ?>
                                    <h5> Add User</h5>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="insert_data.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="name" id="name" required placeholder="Osamah___ " value="<?php if ($id_user > 0) {
                                                                                                                                                            echo $name;
                                                                                                                                                        } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                        <input style="display:none;" type="text" name="id_user" id="id_user" value="<?php if ($id_user > 0) {
                                                                                                                        echo $id_user;
                                                                                                                    } ?>">




                                        <div class="form-group">
                                            <label for="user_phone">Phone Number</label>
                                            <div class="input-group">

                                                <input type="number" class="form-control" name="user_phone" id="user_phone" placeholder="(_,_,_)___" value="<?php if ($id_user > 0) {
                                                                                                                                                                echo $user_phone;
                                                                                                                                                            } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>

                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <div class="input-group">

                                                <input type="email" class="form-control" name="Email" id="Email" required placeholder="name@example.com" value="<?php if ($id_user > 0) {
                                                                                                                                                                    echo $email_user;
                                                                                                                                                                } ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="password_user">Password</label>
                                            <div class="input-group">

                                                <input type="password" class="form-control" name="password_user" id="password_user" required placeholder="***">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">*</i></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Sector</label>
                                            <select name="Sector" id="Sector" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $Sector_selected = 0;
                                                if ($id_user > 0) {
                                                    $result_13 = mysqli_query($con, "SELECT * FROM `user_department` WHERE depart_id ='" . $department . "' ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_13) != 0) {
                                                        $rowes = mysqli_fetch_array($result_13);
                                                        $Sector_selected = $rowes['depart_id'];
                                                        echo " <option value='$rowes[depart_id]'> $rowes[depart_name]</option>";
                                                    }


                                                    $result = mysqli_query($con, "SELECT * FROM `user_department` WHERE `depart_id`!='" . $department . "'   ;") or die(mysqli_error($con));
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

                                                    $result_16 = mysqli_query($con, "SELECT * FROM `user_department` ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_16) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result_16)) {
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
                                            <label>Job Type</label>
                                            <select name="job_type" id="job_type" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $job_type_selected = 0;
                                                if ($id_user > 0) {
                                                    $result_17 = mysqli_query($con, "SELECT * FROM `jobs_table` WHERE job_id ='" . $user_job . "' ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_17) != 0) {
                                                        $rowes = mysqli_fetch_array($result_17);
                                                        $job_type_selected = $rowes['job_id'];
                                                        echo " <option value='$rowes[job_id]'> $rowes[job_name]</option>";
                                                    }


                                                    $result = mysqli_query($con, "SELECT * FROM `jobs_table` WHERE `job_id`!='" . $job_type_selected . "'   ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result)) {
                                                ?>

                                                        <option value="<?php echo $r['job_id'] ?>">


                                                            <?php echo $r['job_name'] ?>

                                                        </option>


                                                    <?php
                                                    }
                                                } else {
                                                    echo "<option value='0'>Chose Job</option>";

                                                    $result_15 = mysqli_query($con, "SELECT * FROM `jobs_table` ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_15) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result_15)) {
                                                    ?>
                                                        <option value="<?php echo $r['job_id'] ?>">


                                                            <?php echo $r['job_name'] ?>

                                                        </option>
                                                <?php
                                                    }
                                                }

                                                ?>

                                            </select>


                                        </div>




                                        <div class="form-group">
                                            <label>Permission</label>
                                            <select name="permission_id" id="permission_id" class="form-control select2bs4" required style="width: 100%;">

                                                <?php
                                                $permission_selected = 0;
                                                if ($id_user > 0) {
                                                    $result_12 = mysqli_query($con, "SELECT * FROM `permission` WHERE  id_perm='" . $permissions_fk . "' ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_12) != 0) {
                                                        $rowes = mysqli_fetch_array($result_12);
                                                        $permission_selected = $rowes['id_perm'];
                                                        echo " <option value='$rowes[id_perm]'> $rowes[name_permiss]</option>";
                                                    }


                                                    $result = mysqli_query($con, "SELECT * FROM `permission` WHERE `id_perm`!='" . $permission_selected . "'   ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result)) {
                                                ?>

                                                        <option value="<?php echo $r['id_perm'] ?>">


                                                            <?php echo $r['name_permiss'] ?>

                                                        </option>


                                                    <?php
                                                    }
                                                } else {
                                                    echo "<option value='0'>Chose Permission</option>";

                                                    $result_14 = mysqli_query($con, "SELECT * FROM `permission` ;") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($result_14) == 0) {
                                                        echo "<option value='0'>No Thing</option>";
                                                    }
                                                    while ($r = mysqli_fetch_array($result_14)) {
                                                    ?>
                                                        <option value="<?php echo $r['id_perm'] ?>">


                                                            <?php echo $r['name_permiss'] ?>

                                                        </option>
                                                <?php
                                                    }
                                                }

                                                ?>

                                            </select>

                                        </div>









                                        <div class="form-group">
                                            <label for="imgpro">Photo User</label>
                                            <div class="input-group">
                                                <input type="file" name="picture" id="imgpro" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                                <img id="proimg" src="<?php if ($id_user > 0) {
                                                                            echo "../img/img_user/$img_user";
                                                                        } ?>" width='100px' height='100px' class='img-fluid rounded' <?php if ($id_user == 0) {
                                                                                                                                    echo "style='display: none;'";
                                                                                                                                } ?>>

                                                <script>
                                                    function openfile() {
                                                        document.getElementById('imgpro').click();
                                                    }
                                                    $(document).ready(function() {
                                                        var proimg = $("#proimg");

                                                        $("#imgpro").change(function(e) {
                                                            var tmppath = URL.createObjectURL(e.target.files[0]);

                                                            proimg.fadeIn("fast").attr('src', tmppath)

                                                        })
                                                    })
                                                </script>

                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="user_note">Note</label>
                                        <div class="input-group">

                                            <textarea class="form-control" name="user_note" id="user_note" placeholder="____"><?php if ($id_user > 0) {
                                                                                                                                    echo $user_note;
                                                                                                                                } ?></textarea>


                                        </div>
                                    </div>




                                    <?php if ($id_user > 0) {
                                    ?>
                                        <button class="btn btn-block btn-warning" id="add_user_or_updata" type="submit" name="add_user_or_updata">Edit
                                            <span data-feather="save"></span>
                                        <?php } else {
                                        ?>
                                            <button class="btn btn-block btn-info" id="add_user_or_updata" type="submit" name="add_user_or_updata">Add
                                                <span data-feather="save"></span>

                                            <?php
                                        }
                                            ?>
                                </form>
                            </div>
                        </div>


                        <div class="card card-warning">

                            <div class="card-header">
                                <h5>Table Users</h5>
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
                                                <th>User Permission</th>
                                                <th>User Status</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT * FROM users join permission ON users.permissions_fk=permission.id_perm Where status!=3;";
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
                                                        <?php echo $r['name_permiss'] ?></td>

                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($r['status'] == 1) {
                                                            $status_sc = "checked";
                                                        } else {
                                                            $status_sc = "check";
                                                        }
                                                        ?>



                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox" class="custom-control-input" id="<?php echo $r['id_user']; ?>" name="user_status" value="<?php echo $r['status']; ?>" <?php echo $status_sc; ?>>
                                                                <label class="custom-control-label" for="<?php echo $r['id_user']; ?>">
                                                                    <?php
                                                                    if ($r['status'] == 1) {
                                                                        echo "<small class='badge badge-warning'> On </small>";
                                                                    } else {
                                                                        echo "<small class='badge badge-danger'> off </small>";
                                                                    }
                                                                    ?></label>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a title="Edit data" class="btn btn-info btn-sm " href="mange_user.php?id_user=<?php echo $r['id_user'] ?> role=" button">
                                                            <i class="fas fa-edit"></i></a>
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


                        <div class="card card-danger">

                            <div class="card-header">
                                <h5>Suggested Users</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="col-sm-12 ">

                                    <table id="suggeste_users_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th># </th>
                                                <th>Add By</th>
                                                <th>User Information</th>
                                                <th>Email</th>
                                                <th>User Permission</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_row = 0;
                                            $sql = "SELECT * FROM `users` JOIN jobs_table ON users.user_job=jobs_table.job_id WHERE users.status=3 AND `fk_id_user`!=0;";
                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            while ($r = mysqli_fetch_array($result)) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $count_row += 1; ?></td>


                                                    <td>

                                                        <?php
                                                        $sql_4 = "SELECT name FROM `users` WHERE`id_user`='" . $r['fk_id_user'] . "';";
                                                        $result_20 = mysqli_query($con, $sql_4) or die(mysqli_error($con));
                                                        $or = mysqli_fetch_array($result_20);

                                                        echo $or['name'];



                                                        ?>


                                                    </td>
                                                    <td>
                                                        <img width='50px' height='50px' class='img-fluid rounded' src="../img/img_user/<?php echo $r['img_user']; ?>" alt="<?php echo $r['name']; ?>">



                                                        <?php echo $r['name']; ?>

                                                        <input type="hidden" name="id_user" id='id_user' value=" <?php echo $r['id_user']; ?>"></input>
                                                    </td>
                                                    <td><?php echo $r['email_user']; ?></td>


                                                    <td>
                                                        <?php echo $r['job_name']; ?>

                                                    </td>

                                                    <td>

                                                        <a title="Accept" class="btn btn-info btn-sm " href="mange_user.php?id_user_acc=<?php echo $r['id_user']; ?> role=" button">Accept<i class="fas fa-done"></i></a>
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