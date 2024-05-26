
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
                        <li><a href="<?= base_url() ?>creat_semester">ADD Semester  </a></li>
                        <li><a href="<?= base_url() ?>add_semester_courses">Add semester courses   </a></li>
                        <li><a href="<?= base_url() ?>admin_routine">Routine  </a></li>
                        <li><a href="<?= base_url() ?>admin_offered_courses">Offered Courses list  </a></li>
                        <li><a href="<?= base_url() ?>admin_unenrolled">Enrolled Courses student list  </a></li>
                        <li><a href="<?= base_url() ?>Unenrolled_course_list">Unenrolled courses</a></li>
                        <li><a href="<?= base_url() ?>add_students">Add New student </a></li>
                        <li><a href="<?= base_url() ?>add_to_routine">Make Routine </a></li>



                    </ul>
                </div>
                <div class="col-md-9 content">
               
                <?php if($this->session->flashdata('massage')){?>
                    <div class="alert">
                        <h3 class="alert_massage text-danger"><?= $this->session->flashdata('massage');?></h3>
                </div>
   <?php } ?>
          
                </div>
            </div>
        </div>
    </div>







    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>