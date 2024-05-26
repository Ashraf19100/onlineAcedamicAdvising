
<!doctype html>
<html lang="en">
<?php 
    $login_email = $this->session->userdata('admin_logged_in')['student_email'];
    $login_id = $this->session->userdata('admin_logged_in')['student_id'];
    $login_name = $this->session->userdata('admin_logged_in')['student_name'];
    $present_semester = $this->session->userdata('admin_logged_in')['present_semester'];
   
    
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
                            <div class="col-md-2 logout align-items-center"><i class=" fa fa-home"></i><a class="collapse-item" width="300px" href="<?= base_url() ?>auth/logout">Log out</a></div>
                        </div>
                    </diV>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-3 menu">
                    
                    <ul>
                        <li><a href="<?= base_url() ?>routine">Routine  </a></li>
                        <li><a href="<?= base_url() ?>offered_courses">All Offered Courses</a></li>
                        <li><a href="<?= base_url() ?>completed_course">Completed Courses</a></li>
                        <li><a href="<?= base_url() ?>mydonecourses">Enrolled Courses</a></li>
                        <li><a href="<?= base_url() ?>allpost">Available Courses </a></li>
                    </ul>
                </div>
                <div class="col-md-9 content">
                <h3>Routine for <?=$present_semester?> </h3>
                <?php if($this->session->flashdata('massage')){?>
                    <div class="alert">
                        <h3 class="alert_massage text-danger"><?= $this->session->flashdata('massage');?></h3>
                </div>
   <?php } ?>
            <table class="table">   
            <thead>
            <tr>
                    <th scope="col">##</th>
                    <th scope="col">Course</th>
                    <th scope="col">SUNDAY</th>
                    <th scope="col">MONDAY</th>
                    <th scope="col">TUESDAY</th>
                    <th scope="col">WEDNESDAY</th>
                    <th scope="col">THURSDAY</th>
                    
                    </tr>
                </thead>
                
                <tbody>
                    <?php $index = 1; foreach($routine as $post) { 
                      ?>
                      
                    <tr>
                        
                    <th scope="row"><?= $index++; ?></th>
                    <td><?= $post->course_code; ?>.<?=$post->section;?></td>
                    <td><?= $post->sunday; ?></td>
                    <td><?= $post->monday; ?></td>
                    <td><?= $post->tuesday; ?></td>
                    <td><?= $post->wednesday; ?></td>
                    <td><?= $post->thursday; ?></td>
                    

                    <!--<td>
                      <?php //echo form_open('Allpost/enroll_course'); ?>
   <?= $post->course_code; ?><?= $post->course_code; ?><?= $post->course_code; ?>                   <div class="mb-3">
                          <input type="hidden" name="course_code" class="form-control" id="post_title" value="<?= $post->course_code; ?>">
                      </div>
                      <div class="mb-3">
                          <input type="hidden" name="course_title" class="form-control" id="post_title" value="<?= $post->course_title; ?>" >
                      </div>
                      <div class="mb-3">
                          <input type="text" name="student_id" class="form-control" id="post_title" value="<?php echo $login_id; ?>" >
                      </div>
                      <button type="submit" class="btn btn-primary">Enroll<a href="<?= base_url() ?>allpost/course_check"></a></button>
                    <?php// echo form_close(); ?>  
                    </td>-->
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
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