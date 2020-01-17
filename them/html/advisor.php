<?php include 'header.php'; ?>

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
                        <h3 class="text-themecolor">Departmental Students</h3>
                     </div>
                </div>
                   <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Student Number#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Mail</th>
                                                <th>Sex</th>
                                                <th>Semester</th>
                                                <th>GPA</th>
                                                <th>Course Confirm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                         $student=$db->prepare("SELECT * FROM users WHERE student_advisor=:advisor and user_duty=:duty");
                                         $student->execute(array(
                                            'advisor'=>$fullname,
                                            'duty'=>0
                                         ));
                                            while($getstudent=$student->fetch(PDO::FETCH_ASSOC)){  ?> 
                                            <tr>
                                                <td><?php echo $getstudent['student_number']; ?></td>
                                                <td><?php echo $des->decrypt($getstudent['user_name']); ?></td>
                                                <td><?php echo $des->decrypt($getstudent['user_surname']); ?></td>
                                                <td><?php echo $getstudent['user_mail']; ?></td>
                                                <td><?php echo $getstudent['user_sex']; ?></td>
                                                <td><?php echo $getstudent['student_semester']; ?></td>
                                                <td><?php echo $getstudent['student_gpa']; ?></td>
                                                <td>
                                                    <form action="course-confirm.php?userid=<?php echo $getstudent['user_id']; ?>" method="POST">
                                                        <?php 
                                                            $id=$getstudent['user_id'];
                                                            $status=$db->prepare("SELECT * FROM selectedcourses WHERE user_id=:id");
                                                            $status->execute(array(
                                                                'id'=>$id
                                                            ));
                                                            $confirmstatus=$status->fetch(PDO::FETCH_ASSOC);
                                                            $conf=$confirmstatus['course_confirm'];
                                                            if($conf==1){ ?>
                                                                <input class="btn btn-success ml-4" type="submit" value="Confirmed" name="courseconfirmadvisor">
                                                            <?php }
                                                            else if($conf==0){ ?>
                                                                <input class="btn btn-danger ml-4" type="submit" value="Confirm" name="courseconfirmadvisor">
                                                            <?php } ?>                           
                                                </td>
                                                    </form>
                                            </tr>
                                        <?php }  ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                   
                </div>
            </div>
<?php include 'footer.php'; ?>