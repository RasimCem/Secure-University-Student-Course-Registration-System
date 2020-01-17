<?php include 'header.php'; ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Course Registration</h3>
                     </div>
                <?php 
                    $courseque=$db->prepare("SELECT * FROM courses");
                    $courseque->execute(); 
                   
                     $user_id=$getuser['user_id'];
                     $selectcrs=$db->prepare("SELECT * FROM selectedcourses WHERE user_id=:id");
                     $selectcrs->execute(array(
                       'id'=>$user_id
                     ));
                     $count=$selectcrs->rowCount();


                    //student semester
                    $semester=$getuser['student_semester'];
                 ?>
                </div>
                   <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">Student Courses</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Course Teacher</th>
                                                <th>Course Credit</th>
                                                <th>Course Status</th>
                                                <th>Select Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             while($courseget=$courseque->fetch(PDO::FETCH_ASSOC)){?>
                                            <tr>
                                                <td><?php echo $course_code=$courseget['course_code']; ?></td>
                                                <td><?php echo $courseget['course_name'] ?></td>
                                                <td><?php echo $courseget['course_teacher'] ?></td>
                                                <td><?php echo $courseget['course_credit'] ?></td>
                                                <td><?php 
                                                    $status=$db->prepare("SELECT * FROM coursestatus WHERE user_id=:id and course_code=:code");
                                                    $status->execute(array(
                                                        'id'=>$user_id,
                                                        'code'=>$course_code
                                                    ));
                                                    $statuget=$status->fetch(PDO::FETCH_ASSOC);
                                                    $pass=$statuget['course_status'];
                                                    if($pass==1){ ?>
                                                        <h4 class="text-success">Passed!</h4>

                                                   <?php }
                                                   else if($pass==0){ ?>
                                                        <h3 class="text-danger" >Failed!</h3>
                                                   <?php }
                                                   else{ ?>
                                                        <h3 class="text-primary">Not Taken</h3>
                                                 <?php } ?></td>
                                                <td>
                                                <form action="operations/operations.php?id=<?php echo $courseget['course_id']; ?>" method="POST">
                                                    <input <?php 
                                                    if($semester>7){
                                                        if($count>=7){ ?>
                                                            class="btn btn-success disabled" disabled="" 
                                                    <?php 
                                                        }
                                                    }else{
                                                        if($count>=5){ ?>
                                                            class="btn btn-success disabled" disabled="" 
                                                  <?php }
                                                    }  ?>
                                                     type="submit" class="btn btn-success" value="Confirm" name="courseselect"></td>
                                                </form>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="card" style="max-width: 750px; margin-left:400px;">
                            <div class="card-block bg-info">
                                <h4 class="text-white card-title">Selected Courses</h4>
                                <h6 class="card-subtitle text-white m-b-0 op-5">For more information click on courses.</h6>
                            </div>
                            <div class="card-block">
                                <div class="message-box contact-box">
                                    
                                    <div class="message-widget contact-widget">

                                        <?php 
                                            // SELECTED COURSES
                                            while($slct=$selectcrs->fetch(PDO::FETCH_ASSOC)){ 
                                         ?>  
                                        <a href="coursedetail.php?code=<?php echo $slct['course_code']?>"> 
                                            <div class="mail-contnet">
                                               <h5><?php echo $slct['course_name'] ?></h5> <span class="mail-desc"><?php echo $slct['course_code']; ?></span>
                                           </div>
                                        </a>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
           <?php include 'footer.php' ?>