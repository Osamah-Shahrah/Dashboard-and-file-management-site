<?php

include "check.php";










$id_user = $_SESSION['id_user'];

if (isset($id_user)) {


    //$id_user = $_GET['id_user'];

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


    static $name_jop;
    static $name_permission;
    static $name_derpartmen;


    $sql_quer_usert = "SELECT * FROM `users` us JOIN jobs_table jo ON us.user_job=jo.job_id JOIN permission per ON us.permissions_fk=per.id_perm JOIN user_department der ON us.department=der.depart_id WHERE us.id_user='" . $id_user . "';";



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

            $name_jop = $array_user['job_name'];
            $name_permission = $array_user['name_permiss'];
            $name_derpartmen = $array_user['depart_name'];

            if ($array_user['status'] == 1) {
                $status_sc = "checked";
            } else {
                $status_sc = "check";
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
                <h1>My Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active">My Profiler</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>




<section class="content">
    <div class="container-fluid">
        <div class="row">




            <div class="card card-primary card-outline col-md-12">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?php if ($id_user > 0) {
                                                                                    echo "../img/img_user/$img_user";
                                                                                } ?>" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center"><?php if ($id_user > 0) {
                                                                    echo $name;
                                                                } ?></h3>

                    <p class="text-muted text-center"><?php if ($id_user > 0) {
                                                            echo $name_jop;
                                                        } ?></p>



                </div>
                <div class="card-body">
                    <form action="insert_data.php" id="" class="text-start g-3 needs-validation row" method="POST"
                        type="form" name="" enctype="multipart/form-data">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <div class="input-group">

                                    <input type="text" class="form-control" name="name" id="name" required
                                        placeholder="Osamah___ "
                                        value="<?php if ($id_user > 0) {
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

                                    <input type="text" class="form-control" name="user_phone" id="user_phone"
                                        placeholder="(_,_,_)___"
                                        value="<?php if ($id_user > 0) {
                                                                                                                                                    echo $user_phone;
                                                                                                                                                } ?>">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-text">7</i></span>
                                    </div>

                                </div>
                            </div>




                            <div class="form-group">
                                <label for="Email">Email</label>
                                <div class="input-group">

                                    <input type="Email" class="form-control" name="Email" id="Email" required
                                        placeholder="name@example.com"
                                        value="<?php if ($id_user > 0) {
                                                                                                                                                        echo $email_user;
                                                                                                                                                    } ?>">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                    </div>

                                </div>
                            </div>



                            <div class="form-group">
                                <label for="password_user">Password</label>
                                <div class="input-group">

                                    <input type="password" class="form-control" name="password_user" id="password_user"
                                        required placeholder="***">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-text">*</i></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">










                            <div class="form-group">
                                <label>Job Type</label>
                                <select name="job_type" id="job_type" class="form-control select2bs4"  style="width: 100%;" required
                                    >

                                    <?php
                                    $job_type_selected = 0;
                                    if ($id_user > 0) {
                                        $result_12 = mysqli_query($con, "SELECT * FROM `jobs_table` WHERE job_id ='" . $user_job . "' ;") or die(mysqli_error($con));
                                        if (mysqli_num_rows($result_12) != 0) {
                                            $rowes = mysqli_fetch_array($result_12);
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

                                        $result_14 = mysqli_query($con, "SELECT * FROM `jobs_table` ;") or die(mysqli_error($con));
                                        if (mysqli_num_rows($result_14) == 0) {
                                            echo "<option value='0'>No Thing</option>";
                                        }
                                        while ($r = mysqli_fetch_array($result_14)) {
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

                            <div class="form-group col-md-12">
                                <label for="details_job">Details Job</label>
                                <div class="input-group">

                                    <textarea class="form-control" name="details_job" id="details_job"
                                        placeholder="____"><?php if ($id_user > 0) {
                                                                                                                                echo $details_job;
                                                                                                                            } ?></textarea>


                                </div>
                            </div>







                            <div class="form-group">
                                <label for="imgpro">Photo User</label>
                                <div class="input-group">
                                    <input type="file" name="picture" id="imgpro"
                                        accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                    <img id="proimg" src="<?php if ($id_user > 0) {
                                                                echo "../img/img_user/$img_user";
                                                            } ?>" width='100px' height='100px'
                                        class='img-fluid rounded'
                                        <?php if ($id_user == 0) {
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

                                <textarea class="form-control" name="user_note" id="user_note"
                                    placeholder="____"><?php if ($id_user > 0) {
                                                                                                                        echo $user_note;
                                                                                                                    } ?></textarea>


                            </div>
                        </div>





                        <button class="btn btn-block btn-warning" id="chang_data" type="submit" name="chang_data">Edit
                            <span data-feather="save"></span>
                    </form>
                </div>
            </div>







        </div>
    </div>
</section>



<?php

include "footer.php";
?>