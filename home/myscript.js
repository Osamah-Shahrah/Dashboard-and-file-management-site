
$(function () {
  $("#users_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});

$(function () {
  $("#dashbord_prem").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});



$(function () {
  $("#document_prem").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});





$(function () {
  $("#page_prem").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});





$(function () {
  $("#projects_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});

$(function () {
  $("#suggeste_users_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});


$(function () {
  $("#dash_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});


$(function () {
  $("#file_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});


$(function () {
  $("#file_table_home").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});





//script to  butoon swetch for enable or disbale the user  this cod used on page mange_user

$(document).ready(function () {
  $('input[name="user_status"]').change(function (event) {
    var user_status = $(this).val();
    var ste = (user_status === '1') ? 2 : 1;
    var comide = $(this).closest('tr').find('input[name="id_user"]').val();

    var r = window.confirm("Do you want change user status");

    if (r) {

      //alert("STE:"+ste);

      $.ajax({
        type: 'POST',
        url: 'insert_data.php',
        data: {
          stop_user: 1,
          stop_user_stat: ste,
          id_user_stop_stat: comide
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);
        }
      });
    }
  });
});





//script to  butoon swetch for enable or disbale the dashbord permission  this cod used on page mange_permission

$(document).ready(function () {
  $('input[name="user_dash_status"]').change(function (event) {
    var user_dash_status = $(this).val();
    var ste = (user_dash_status === '1') ? 0 : 1;
    var dash_id = $(this).closest('tr').find('input[name="id_dash_per"]').val();
    var userid = $(this).closest('tr').find('input[name="id_user_dash_per"]').val();

    var r = window.confirm("Do you want change Dashbord permission status");

    if (r) {

      //alert("STE:"+ste);


      $.ajax({
        type: 'POST',
        url: 'insert_data.php',
        data: {
          user_per_dash: 1,
          stop_pre_stat: ste,
          id_dash_stat: dash_id,
          id_user_stat: userid
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);
        }
      });
    }
  });
});
















//script to  butoon swetch for enable or disbale the file permission  this cod used on page mange_permission

$(document).ready(function () {
  $('input[name="user_file_status_per"]').change(function (event) {
    var user_file_status_per = $(this).val();
    var ste = (user_file_status_per === '1') ? 0 : 1;
    var id_file_per = $(this).closest('tr').find('input[name="id_file_per"]').val();
    var userid = $(this).closest('tr').find('input[name="id_user_file_per"]').val();

    var r = window.confirm("Do you want change Document permission status");

    if (r) {

      //alert("STE:"+ste);


      $.ajax({
        type: 'POST',
        url: 'insert_data.php',
        data: {
          user_per_file: 1,
          stop_pre_stat: ste,
          id_file_stat: id_file_per,
          id_user_stat: userid
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);
        }
      });
    }
  });
});




//script to  butoon swetch for enable or disbale the page permission  this cod used on page mange_permission

$(document).ready(function () {
  $('input[name="user_pages_status_per"]').change(function (event) {
    var user_pages_status_per = $(this).val();
    var ste = (user_pages_status_per === '1') ? 0 : 1;
    var id_page_per = $(this).closest('tr').find('input[name="id_page_per"]').val();
    var userid = $(this).closest('tr').find('input[name="id_user_page_per"]').val();

    var r = window.confirm("Do you want change page permission status");

    if (r) {

      //alert("STE:"+ste);


      $.ajax({
        type: 'POST',
        url: 'insert_data.php',
        data: {
          user_per_file: 1,
          stop_pre_stat: ste,
          id_page_stat: id_page_per,
          id_user_stat: userid
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);
        }
      });
    }
  });
});
