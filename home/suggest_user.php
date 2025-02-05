<?php

include "../db.php";
include "check.php";

$page_id = 7;
$sql_search_user_per = "SELECT * FROM `pages` JOIN pages_permission ON pages.id_page=pages_permission.fk_page_id
 WHERE pages.id_page='" . $page_id . "' AND pages_permission.fk_user_id='" . $publi_id_user . "' AND pages.page_status=1 AND pages_permission.user_pages_status=1 ;";
if ($result = mysqli_query($con, $sql_search_user_per)) {
    // Check if any rows were returned
    if (!mysqli_num_rows($result) > 0) {

        include "Error404.php";
    } else {

        $publi_id_user


?>



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Suggest User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Suggest User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>




        <section class="content">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-12">
                        <div class="card card-warning">
                            <div class="card-header">

                                <h5> Add User</h5>


                            </div>
                            <div class="card-body">
                                <form action="insert_data.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" name="name" id="name" required placeholder="Osamah___ ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                        <input style="display:none;" type="text" name="id_user" id="id_user" value="<?php echo $publi_id_user; ?>">




                                        <div class="form-group">
                                            <label for="user_phone">Phone Number</label>
                                            <div class="input-group">

                                                <input type="number" class="form-control" name="user_phone" id="user_phone" placeholder="(_,_,_)___">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <div class="input-group">

                                                <input type="email" class="form-control" name="Email" id="Email" required placeholder="name@example.com">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="password_user">Password</label>
                                            <div class="input-group">

                                                <input type="password" class="form-control" name="password_user" id="password_user" required placeholder="***">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">










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
                                            <label for="imgpro">Photo User</label>
                                            <div class="input-group">
                                                <input type="file" name="picture" id="imgpro" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                                <img id="proimg" src="" width='100px' height='100px' class='img-fluid rounded'>

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

                                            <textarea class="form-control" name="user_note" id="user_note" placeholder="____"></textarea>


                                        </div>
                                    </div>





                                    <button class="btn btn-block btn-warning" id="suggest_add_user" type="submit" name="suggest_add_user">Add
                                        <span data-feather="save"></span>

                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>



<?php

        include "footer.php";
    }
}
?>