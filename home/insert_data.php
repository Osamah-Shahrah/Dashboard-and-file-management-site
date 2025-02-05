<?php
include "../db.php";



//this code to add or updata user used in page mange_user
if (isset($_POST['add_user_or_updata'])) {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $Email = $_POST['Email'];
    $password_user = md5($_POST['password_user']);
    $permission_id = $_POST['permission_id'];
    $user_phone = $_POST['user_phone'];
    $job_type = $_POST['job_type'];
    $user_note = $_POST['user_note'];
    $Sector = $_POST['Sector'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة


    if ($id_user > 0) {
       
        if ($picture_name == "" & $picture_type == "") {
            $sql_updata_bunch_form = "UPDATE `users` SET `name`='" . $name . "',`email_user`='" . $Email . "' ,`password_user`='" . $password_user . "',`permissions_fk`='" . $permission_id . "',`user_phone`='" . $user_phone . "',`user_job`='" . $job_type . "',`user_note`='" . $user_note . "',`department`='" . $Sector . "' WHERE `id_user`=" . $id_user . "";
            if (mysqli_query($con, $sql_updata_bunch_form)) {
                header("location:mange_user.php");
            }
        } else {
            
            if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../img/img_user/" . $pic_name); //upload the image for the folder

                    $sql_updata_bunch_form = "UPDATE `users` SET `name`='" . $name . "',`email_user`='" . $Email . "' ,`password_user`='" . $password_user . "',`permissions_fk`='" . $permission_id . "',`img_user`='" . $pic_name . "',`user_phone`='" . $user_phone . "',`user_job`='" . $job_type . "',`user_note`='" . $user_note . "',`department`='" . $Sector . "' WHERE `id_user`=" . $id_user . "";
                    if (mysqli_query($con, $sql_updata_bunch_form)) {
                        header("location:mange_user.php");
                    }
                } else {

                    header("location:mange_user.php");
                }
            } else {

                header("location:mange_user.php");
            }
        }
    } else {
        #if no one have that data we insert data 

        #search about categ if on table debartment
        $result = mysqli_query($con, "SELECT * FROM `users` WHERE `name` = '" . $name . "' ;") or die(mysqli_error($con));
        #if the search on table cat true
        if (mysqli_num_rows($result) != 0) {

            header("location:mange_user.php");
            return 0;
        } elseif ($picture_name == "" & $picture_type == "") {

            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `users`(`name`, `email_user`, `password_user`, `permissions_fk`, `user_phone`, `user_job`, `user_note`, `department`) VALUES ('" . $name . "','" . $Email . "','" . $password_user . "','" . $permission_id . "','" . $user_phone . "','" . $job_type . "','" . $user_note . "','" . $Sector . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:mange_user.php");
            } else {
                header("location:mange_user.php");
            }
        } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../img/img_user/" . $pic_name); //upload the image for the folder


                //update data for the order
                $sql_che_ord = mysqli_query($con, "INSERT INTO `users`(`name`, `email_user`, `password_user`, `permissions_fk`, `img_user`, `user_phone`, `user_job`, `user_note`, `department`) VALUES ('" . $name . "','" . $Email . "','" . $password_user . "','" . $permission_id . "','" . $pic_name . "','" . $user_phone . "','" . $job_type . "','" . $user_note . "','" . $Sector . "');") or die(mysqli_error($con));
                if ($sql_che_ord) {
                    header("location:mange_user.php");
                } else {
                    header("location:mange_user.php");
                }
            } else {

                header("location:mange_user.php");
            }
        } else {
            header("location:mange_user.php");
        }
    }
}

//this code to add or updata user used in page my_profile
if (isset($_POST['chang_data'])) {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $Email = $_POST['Email'];
    $password_user =md5( $_POST['password_user']);
    $user_phone = $_POST['user_phone'];
    $job_type = $_POST['job_type'];
    $user_note = $_POST['user_note'];
    $details_job = $_POST['details_job'];
    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة


    if ($id_user > 0) {
        
        if ($picture_name == "" & $picture_type == "") {
            $sql_updata_bunch_form = "UPDATE `users` SET `name`='" . $name . "',`email_user`='" . $Email . "' ,`password_user`='" . $password_user . "',`user_phone`='" . $user_phone . "',`user_job`='" . $job_type . "',`user_note`='" . $user_note . "',details_job='" . $details_job . "' WHERE `id_user`=" . $id_user . "";
            if (mysqli_query($con, $sql_updata_bunch_form)) {
                header("location:my_profile.php");
            }
        } else {
            
            if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../img/img_user/" . $pic_name); //upload the image for the folder

                    $sql_updata_bunch_form = "UPDATE `users` SET `name`='" . $name . "',`email_user`='" . $Email . "' ,`password_user`='" . $password_user . "',`img_user`='" . $pic_name . "',`user_phone`='" . $user_phone . "',`user_job`='" . $job_type . "',`user_note`='" . $user_note . "',details_job='" . $details_job . "'  WHERE `id_user`=" . $id_user . "";
                    if (mysqli_query($con, $sql_updata_bunch_form)) {
                        header("location:my_profile.php");
                    }
                } else {

                    header("location:my_profile.php");
                }
            } else {

                header("location:my_profile.php");
            }
        }
    } else {
        header("location:my_profile.php");
    }
}









//this code to add or updata user used in page suggest_user
if (isset($_POST['suggest_add_user'])) {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $Email = $_POST['Email'];
    $password_user = md5($_POST['password_user']);
    $permission_id = $_POST['permission_id'];
    $user_phone = $_POST['user_phone'];
    $job_type = $_POST['job_type'];
    $user_note = $_POST['user_note'];
    $Sector = $_POST['Sector'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة


    if ($picture_name == "" & $picture_type == "") {

        $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `users`(`name`, `email_user`, `password_user`, `user_phone`, `user_job`, `user_note`,`fk_id_user`,`status`) VALUES ('" . $name . "','" . $Email . "','" . $password_user . "','" . $user_phone . "','" . $job_type . "','" . $user_note . "','" . $id_user . "','3');") or die(mysqli_error($con));
        if ($sql_che_ord_non_imag) {
            header("location:suggest_user.php");
        } else {
            header("location:suggest_user.php");
        }
    } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
    {
        if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
        {
            //code take name file and search . and tak after that
            $type = substr($picture_name, strrpos($picture_name, '.'));
            $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
            move_uploaded_file($picture_tmp_name, "../img/img_user/" . $pic_name); //upload the image for the folder


            //update data for the order
            $sql_che_ord = mysqli_query($con, "INSERT INTO `users`(`name`, `email_user`, `password_user`,`img_user`, `user_phone`, `user_job`, `user_note`,`fk_id_user`,`status`) VALUES ('" . $name . "','" . $Email . "','" . $password_user . "','" . $pic_name . "','" . $user_phone . "','" . $job_type . "','" . $user_note . "','" . $id_user . "','3');") or die(mysqli_error($con));
            if ($sql_che_ord) {
                header("location:suggest_user.php");
            } else {
                header("location:suggest_user.php");
            }
        } else {

            header("location:suggest_user.php");
        }
    } else {
        header("location:suggest_user.php");
    }
}



//this code to add or updata user used in page projects
if (isset($_POST['projects_add_or_updata'])) {
    $project_id = $_POST['project_id'];
    $project_cod = $_POST['project_cod'];
    $project_note = $_POST['project_note'];
    $project_status = $_POST['project_status'];
    $project_period = $_POST['project_period'];
    $project_date_start = $_POST['project_date_start'];
    $project_date_end = $_POST['project_date_end'];
    $project_details = $_POST['project_details'];




    if ($project_id > 0) {


        $sql_updata_project_form = "UPDATE `project` SET `project_cod`='" . $project_cod . "',`project_note`='" . $project_note . "' ,`project_details`='" . $project_details . "',`project_period`='" . $project_period . "',`project_date_start`='" . $project_date_start . "',`project_date_end`='" . $project_date_end . "',`project_status`='" . $project_status . "'  WHERE `project_id`=" . $project_id . "";
        if (mysqli_query($con, $sql_updata_project_form)) {
            header("location:projects.php");
        }
    } else {
        #if no one have that data we insert data 

        #search about categ if on table debartment
        $result = mysqli_query($con, "SELECT * FROM `project` WHERE `project_cod` = '" . $project_cod . "' ;") or die(mysqli_error($con));
        #if the search on table cat true
        if (mysqli_num_rows($result) != 0) {

            header("location:projects.php");
            return 0;
        } else {






            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `project`(`project_cod`, `project_note`, `project_details`, `project_status`, `project_period`, `project_date_start`, `project_date_end`) VALUES
             ('" . $project_cod . "','" . $project_note . "','" . $project_details . "','" . $project_status . "','" . $project_period . "','" . $project_date_start . "','" . $project_date_end . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:projects.php");
            } else {
                header("location:projects.php");
            }
        }
    }
}









//this code to add or updata user used in page Dachboard_with_projects
if (isset($_POST['Dashboards_add_or_updata'])) {


    $id_dash = $_POST['id_dash'];
    $link = $_POST['link'];
    $dash_name = $_POST['dash_name'];
    $dash_title = $_POST['dash_title'];
    $details = $_POST['details'];
    $fk_depart = $_POST['fk_depart'];
    $fk_project_cod = $_POST['fk_project_cod'];
    $dash_status = $_POST['dash_status'];




    if ($id_dash > 0) {


        $sql_updata_project_form = "UPDATE `dashboard` SET `link`='" . $link . "',`dash_name`='" . $dash_name . "',`dash_title`='" . $dash_title . "' ,`details`='" . $details . "',`fk_depart`='" . $fk_depart . "',`fk_project_cod`='" . $fk_project_cod . "',`dash_status`='" . $dash_status . "'  WHERE `id_dash`=" . $id_dash . "";
        if (mysqli_query($con, $sql_updata_project_form)) {
            header("location:Dachboard_with_projects.php");
        }
    } else {
        #if no one have that data we insert data 

        #search about categ if on table debartment
        $result = mysqli_query($con, "SELECT * FROM `dashboard` WHERE link='" . $link . "' AND `dash_name` = '" . $dash_name . "' ;") or die(mysqli_error($con));
        #if the search on table cat true
        if (mysqli_num_rows($result) != 0) {

            header("location:Dachboard_with_projects.php");
            return 0;
        } else {
            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `dashboard`(`link`, `dash_name`, `dash_title`, `details`, `fk_depart`, `fk_project_cod`, `dash_status`) VALUES
             ('" . $link . "','" . $dash_name . "','" . $dash_title . "','" . $details . "','" . $fk_depart . "','" . $fk_project_cod . "','" . $dash_status . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:Dachboard_with_projects.php");
            } else {
                header("location:Dachboard_with_projects.php");
            }
        }
    }
}



//this code to add or updata use in page files
if (isset($_POST['Files_add_or_updata'])) {


    $id_file = $_POST['id_file'];
    $link = $_POST['link'];
    $file_name = $_POST['file_name'];
    $file_title = $_POST['file_title'];
    $file_details = $_POST['file_details'];
    $fk_depart = $_POST['fk_depart'];
    $fk_project_cod = $_POST['fk_project_cod'];
    $file_status = $_POST['file_status'];
    $document_type = $_POST['document_type'];



    if ($id_file > 0) {


        $sql_updata_file = "UPDATE `file` SET `link`='" . $link . "',`file_name`='" . $file_name . "',`file_title`='" . $file_title . "' ,`file_details`='" . $file_details . "',`fk_depart`='" . $fk_depart . "',`fk_project_cod`='" . $fk_project_cod . "',`file_status`='" . $file_status . "',`document_type`='" . $document_type . "'  WHERE `id_file`=" . $id_file . "";
        if (mysqli_query($con, $sql_updata_file)) {
            header("location:files.php");
        }
    } else {
        #if no one have that data we insert data 

        #search about categ if on table debartment
        $result = mysqli_query($con, "SELECT * FROM `file` WHERE link='" . $link . "' AND `file_name` = '" . $file_name . "' ;") or die(mysqli_error($con));
        #if the search on table cat true
        if (mysqli_num_rows($result) != 0) {

            header("location:files.php");
            return 0;
        } else {
            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `file`(`link`, `file_name`, `file_title`, `file_details`, `fk_depart`, `fk_project_cod`, `file_status`, `document_type`) VALUES
             ('" . $link . "','" . $file_name . "','" . $file_title . "','" . $file_details . "','" . $fk_depart . "','" . $fk_project_cod . "','" . $file_status . "','" . $document_type . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:files.php");
            } else {
                header("location:files.php");
            }
        }
    }
}








//this code  change  user state stop or turn on used in page mange_user
if (isset($_POST['stop_user'])) {
    $id_user_stop_stat = $_POST['id_user_stop_stat'];
    $stop_user_stat = $_POST['stop_user_stat'];



    $sql_updata_user_stope = "UPDATE `users` SET `status`='" . $stop_user_stat . "' WHERE `id_user`='" . $id_user_stop_stat . "'  ;";
    if (mysqli_query($con, $sql_updata_user_stope)) {
        header("location:mange_user.php");
    }
}






//this code  change  user permissoin for dashbord state stop or turn on used in page mange_permission
if (isset($_POST['user_per_dash'])) {
    $stop_pre_stat = $_POST['stop_pre_stat'];
    $id_dash_stat = $_POST['id_dash_stat'];
    $id_user_stat = $_POST['id_user_stat'];

    $sql_search_user_per_dash = "SELECT * FROM `dash_permission` WHERE `fk_id_user`='".$id_user_stat."' AND  `fk_id_dash`='".$id_dash_stat."' ;";
    if ($result = mysqli_query($con, $sql_search_user_per_dash)) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $sql_updata_user_per_dash = "UPDATE `dash_permission` SET `user_dash_status`='".$stop_pre_stat."'  WHERE `fk_id_user`='".$id_user_stat."'  AND  `fk_id_dash`= '". $id_dash_stat."'  ;";
            if (mysqli_query($con, $sql_updata_user_per_dash)) {
                header("location:mange_permission.php");
            } else {
                // Handle update query error
                echo "Error updating user permission: " . mysqli_error($con);
            }
        } else {
            // Handle no rows found
            $sql_insert_user_per_dash = "INSERT INTO `dash_permission`(`fk_id_user`, `fk_id_dash`, `user_dash_status`) VALUES ('".$id_user_stat."','".$id_dash_stat."','1') ;";
            if (mysqli_query($con, $sql_insert_user_per_dash)) {
                header("location:mange_permission.php");
            } else {
                // Handle insert query error
                echo "Error inserting user permission: " . mysqli_error($con);
            }
        }
    } else {
        // Handle search query error
        echo "Error searching for user permission: " . mysqli_error($con);
    }
}






//this code  change  user permissoin for file state stop or turn on used in page mange_permission
if (isset($_POST['user_per_file'])) {
    $stop_pre_stat = $_POST['stop_pre_stat'];
    $id_file_stat = $_POST['id_file_stat'];
    $id_user_stat = $_POST['id_user_stat'];

    $sql_search_user_per_file = "SELECT * FROM `file_permission` WHERE `fk_id_user`='".$id_user_stat."' AND  `fk_id_file`='".$id_file_stat."' ;";
    if ($result = mysqli_query($con, $sql_search_user_per_file)) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $sql_updata_user_per_file = "UPDATE `file_permission` SET `user_file_status`='".$stop_pre_stat."'  WHERE `fk_id_user`='".$id_user_stat."'  AND  `fk_id_file`= '". $id_file_stat."'  ;";
            if (mysqli_query($con, $sql_updata_user_per_file)) {
                header("location:mange_permission.php");
            } else {
                // Handle update query error
                echo "Error updating user permission: " . mysqli_error($con);
            }
        } else {
            // Handle no rows found
            $sql_insert_user_per_file = "INSERT INTO `file_permission`(`fk_id_user`, `fk_id_file`, `user_file_status`) VALUES ('".$id_user_stat."','".$id_file_stat."','1') ;";
            if (mysqli_query($con, $sql_insert_user_per_file)) {
                header("location:mange_permission.php");
            } else {
                // Handle insert query error
                echo "Error inserting user permission: " . mysqli_error($con);
            }
        }
    } else {
        // Handle search query error
        echo "Error searching for user permission: " . mysqli_error($con);
    }
}










//this code  change  user permissoin for pages state stop or turn on used in page mange_permission
if (isset($_POST['user_per_file'])) {
    $stop_pre_stat = $_POST['stop_pre_stat'];
    $id_page_per = $_POST['id_page_stat'];
    $id_user_stat = $_POST['id_user_stat'];

    $sql_search_user_per_file = "SELECT * FROM `pages_permission` WHERE `fk_user_id`='".$id_user_stat."' AND  `fk_page_id`='".$id_page_per."' ;";
    if ($result = mysqli_query($con, $sql_search_user_per_file)) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $sql_updata_user_per_file = "UPDATE `pages_permission` SET `user_pages_status`='".$stop_pre_stat."'  WHERE `fk_user_id`='".$id_user_stat."'  AND  `fk_page_id`= '". $id_page_per."'  ;";
            if (mysqli_query($con, $sql_updata_user_per_file)) {
                header("location:mange_permission.php");
            } else {
                // Handle update query error
                echo "Error updating user permission: " . mysqli_error($con);
            }
        } else {
            // Handle no rows found
            $sql_insert_user_per_file = "INSERT INTO `pages_permission`(`fk_user_id`, `fk_page_id`, `user_pages_status`) VALUES ('".$id_user_stat."','".$id_page_per."','1') ;";
            if (mysqli_query($con, $sql_insert_user_per_file)) {
                header("location:mange_permission.php");
            } else {
                // Handle insert query error
                echo "Error inserting user permission: " . mysqli_error($con);
            }
        }
    } else {
        // Handle search query error
        echo "Error searching for user permission: " . mysqli_error($con);
    }
}