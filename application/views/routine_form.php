
<!doctype html>
<html lang="en">
<?php 
    $login_email = $this->session->userdata('superadmin_logged_in')['email'];
    $login_name = $this->session->userdata('superadmin_logged_in')['username'];
    $present_semester = $this->session->userdata('superadmin_logged_in')['present_semester'];
   
    
    ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container">
        <header class="navbar">
            <div class="sticky-area">
                <div class="container">
                    <diV class="row">
                        <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <div class="col-md-2 logo"></div>
                            <div class="col-md-5 top_header"><h1>East Delta university</h1></div>
                            <div class="col-md-3 user_information align-items-center"><h5><?= $login_name ?></h5><h6><?= $login_email?></h6></div>
                            <div class="col-md-2 logout align-items-center"><i class=" fa fa-home"></i><a class="collapse-item" width="300px" href="<?= base_url() ?>admin_auth/logout">Log out</a></div>
                        </div>
                    </diV>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-3 menu">
                    
                    <ul>
                        
                        <li><a href="<?= base_url() ?>admin_home">Home  </a></li>
                        <li><a href="<?= base_url() ?>admin_routine">Routine  </a></li>
                        <li> <a href="<?= base_url() ?>add_to_routine">back </a></li>
                    </ul>
                </div>
                <div class="col-md-9 content">
                <tbody>
                    <?php $index = 1; foreach($create_routine as $post) { 
                      ?>
                   
                    <?php } ?>
                </tbody>
                        <h2>Course Time and Date </h2>
                        <?php echo form_open('Admin_routine/course_add_routine'); ?>
                                <div class="mb-3">
                                    <label for="course_code">Course Code</label>
                                    <input type="text" name="course_code" class="form-control" id="course_code" value="<?= $post->course_code; ?>">
                                </div>
                                <div class="mb-3">
                                <label for="section">section</label>    
                                <select name="section" class="form-control" id="section">
                                        <option value="">---Select section---</option>
                                        <?php $i=1; while($i<=$post->section){?>
                                            <option value="<?=$i ;?>"><?= $i ;?></option>
                                        <?php $i++; } ?>
                                    </select> 
                                </div>
                                 <div class="mb-3">
                                    <label for="present_semester">Present semester</label>
                                    <input type="text" name="present_semester" class="form-control" id="present_semester" value="<?=$present_semester;?>" >
                                </div>
                                <div class="mb-3">
                                    <label for="sunday">sunday</label>
                                    <input type="time" name="sunday" class="form-control" id="sunday" value="" >
                                </div>
                                <div class="mb-3">
                                    <label for="monday">monday</label>
                                    <input type="time" name="monday" class="form-control" id="monday" value="" >
                                </div>
                                <div class="mb-3">
                                    <label for="tuesday">tuesday</label>
                                    <input type="time" name="tuesday" class="form-control" id="tuesday" value="" >
                                </div>
                                <div class="mb-3">
                                    <label for="wednesday">wednesday</label>
                                    <input type="time" name="wednesday" class="form-control" id="wednesday" value="" >
                                </div>
                                <div class="mb-3">
                                    <label for="thursday">thursday</label>
                                    <input type="time" name="thursday" class="form-control" id="thursday" value="" >
                                </div>
                                <button type="submit" class="btn btn-primary">ADD to Routine</button>
                            <?php echo form_close(); ?> 
                </div>
            </div>
        </div>
    </div>






    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/staterestore/1.1.1/js/dataTables.stateRestore.min.js"></script>
    <script src="https://cdn.datatables.net/staterestore/1.1.1/js/stateRestore.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>

        $(document).ready( function () {
            $('#unenrolled_table').DataTable();
        } );
    </script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
