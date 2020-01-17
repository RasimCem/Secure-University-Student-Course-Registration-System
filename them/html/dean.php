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
                                                <th style="text-align: center">Advisor</th>
                                                <th>Course Confirm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $department=$getuser['user_department'];
                                         $student=$db->prepare("SELECT * FROM users WHERE user_department=:department and user_duty=:duty");
                                         $student->execute(array(
                                            'department'=>$department,
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
                                                <?php 
                                                    if(!empty($getstudent['student_advisor'])){
                                                 ?>
                                                <td><h3 class="bg-warning" style="text-align: center"><?php echo $getstudent['student_advisor']; ?></h3></td>
                                            <?php } else{ ?>
                                                <td style="text-align:center">Not Assigned</td>
                                            <?php } ?> 
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
                                                                <input class="btn btn-success ml-4 disabled" type="submit" disabled="" value="Confirmed" name="courseconfirm">
                                                            <?php }
                                                            else if($conf==0){ ?>
                                                                <input class="btn btn-danger ml-4 disabled" type="submit" disabled="" value="Confirm" name="courseconfirm">
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
            <br><br><br>
           
           <?php include 'footer.php' ?>