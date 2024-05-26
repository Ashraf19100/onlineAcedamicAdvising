
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
                <h3>Course List</h3>
                
              <table class="table ">   
              <thead>
                      <tr>
                      <th scope="col">#</th>
                      <th scope="col">course code</th>
                      <th scope="col">course Title</th>
                      <th scope="col">pre request course</th>
                      <th scope="col">credit</th>
                      <th scope="col">type</th>
                      <th scope="col">Action</th>
                      </tr>
                  </thead>
                  
                  <tbody>
                      
                      <?php $index = 1; foreach($course_offered_bysemester as $post) {
                        
                        $course_status=$post->prerequest_course_cousre_code;
                        //$status=$this->prreqcourse_status_check($login_id,$course_status);
                        //if{$status==true}{}
                        //if(isset($result)){
                          //echo "Succesfully Enrolled to the course";
                        //}else{
                          //echo "you have to pass prerequest course of this course";
                        //}
                        ?>
                      <tr>
                      <th scope="row"><?= $index++; ?></th>
                      <td><?= $post->course_code; ?></td>
                      <td><?= $post->course_title; ?></td>
                      <td><?= $post->prerequest_course_cousre_code; ?></td>
                      <td><?= $post->credit; ?></td>
                      <td><?= $post->type; ?></td>
  
                      <td>
                        <?php echo form_open('Allpost/enroll_course'); ?>
                        <div class="mb-3">
                            <input type="hidden" name="course_code" class="form-control" id="post_title" value="<?= $post->course_code; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="prreq_course_code" class="form-control" id="post_title" value="<?= $post->prerequest_course_cousre_code; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="course_title" class="form-control" id="post_title" value="<?= $post->course_title; ?>" >
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="student_id" class="form-control" id="post_title" value="<?php echo $login_id; ?>" >
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="present_semester" class="form-control" id="post_title" value="<?php echo $present_semester; ?>" >
                        </div>
                        <div class="mb-3">
                                    <select name="section" class="form-control" id="section">
                                        <option value="">---Select section---</option>
                                        <?php $i=1; while($i<=$post->section){?>
                                            <option value="<?= $i ;?>"><?= $i ;?></option>
                                        <?php $i++; } ?>
                                    </select> 
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="limited_seat" class="form-control" id="limited_seat" value="<?php echo $post->limited_seat; ?>" >
                        </div>
                        <button type="submit" class="btn btn-primary">Enroll<a href="<?= base_url() ?>allpost/course_check"></a></button>
                      <?php echo form_close(); ?>  
                      </td>
                      </tr>
                      <?php  } ?>
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