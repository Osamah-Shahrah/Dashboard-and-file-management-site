<?php
include "check.php";

?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small Box (Stat card) -->
        <h3>Dashboards for Projects</h3>
        <div class="card-header bg-white">
            <div class="row">
                <?php

                $sql = "SELECT * FROM `dashboard`dash join user_department u_dep  ON dash.`fk_depart`= u_dep.`depart_id` join `project` pro ON dash.`fk_project_cod`=pro.`project_id`JOIN `dash_permission` dash_per ON dash.`id_dash`=dash_per.`fk_id_dash` WHERE  dash_status='1' AND dash_per.`fk_id_user`='" . $_SESSION['id_user'] . "' AND `user_dash_status`=1  ;";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                while ($r = mysqli_fetch_array($result)) {

                    static  $color = "info";
                    if ($r['depart_name'] == 'Health & Nutrition ') {
                        $color = "olive";
                    } elseif ($r['depart_name'] == 'Health') {
                        $color = "info";
                    } elseif ($r['depart_name'] == 'Nutrition') {
                        $color = "info";
                    } elseif ($r['depart_name'] == 'wash ') {
                        $color = "success";
                    } elseif ($r['depart_name'] == 'protection ') {
                        $color = "danger";
                    } else {
                        $color = "warning";
                    }
                ?>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->

                        <div class="small-box bg-<?php echo $color; ?>">
                            <div class="inner">
                                <h3><?php echo $r['project_cod']; ?></h3>

                                <p><?php echo $r['depart_name']; ?></p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="Daschboard.php?title=<?php echo $r['dash_title']; ?>&fk_project_cod=<?php echo $r['fk_project_cod']; ?>&fk_depart=<?php echo $r['fk_depart']; ?>"
                                class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>

                        </div>

                    </div>


                <?php }



                ?>



            </div>
            <!-- /.row -->


        </div>
        <!-- /.row -->


        <h3>Documents</h3>
        <div class="col-sm-12 col-md-6 card-footer bg-white">

            <div class="card-body-6 table-responsive p-0">

                <table id="file_table_home" class="table table-hover text-nowrap">
                    <thead>
                        <tr>

                            <th>#</th>

                        </tr>
                    </thead>
                    <tbody>


                        <?php $result = mysqli_query($con, "SELECT * FROM `file` fi JOIN user_department u_dep  ON fi.`fk_depart`= u_dep.`depart_id` join `project` pro ON fi.`fk_project_cod`=pro.`project_id` JOIN file_permission file_per ON fi.id_file=file_per.fk_id_file    WHERE `file_status`=1 AND file_per.fk_id_user='" . $_SESSION['id_user'] . "' AND `user_file_status`=1 ;") or die(mysqli_error($con));
                        if (mysqli_num_rows($result) == 0) {
                            echo "<p>No File avalibel </p>";
                        }
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td>


                                    <span class=" mailbox-attachment-icon"><i class="far fa-file-<?php echo $r['document_type'] ?>"></i></span>

                                    <div class="  mailbox-attachment-info">
                                        <a href="<?php echo $r['link'] ?>" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> <?php echo $r['file_title'] ?></a>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                            <span>1,245 KB</span>
                                            <a href="<?php echo $r['link'] ?>" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                        </span>
                                    </div>







                                </td>
                            </tr>
                        <?php

                        }

                        ?>





                    </tbody>

                </table>
            </div>

        </div>



    </div>

</section>
<!-- /.content -->



<?php
include "footer.php";
?>