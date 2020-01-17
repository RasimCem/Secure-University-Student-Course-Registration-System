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
                        <h3 class="text-themecolor">All Students</h3>
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
                                                <th>Department</th>
                                                <th>Mail</th>
                                                <th>Sex</th>
                                                <th>Semester</th>
                                                <th>GPA</th>
                                                <th style="text-align: center">Advisor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $department=$getuser['user_department'];
                                         $student=$db->prepare("SELECT * FROM users WHERE user_duty=:duty");
                                         $student->execute(array(
                                            'duty'=>0
                                         ));
                                            while($getstudent=$student->fetch(PDO::FETCH_ASSOC)){  ?> 
                                            <tr>
                                                <td><?php echo $getstudent['student_number']; ?></td>
                                                <td><?php echo $des->decrypt($getstudent['user_name']); ?></td>
                                                <td><?php echo $des->decrypt($getstudent['user_surname']); ?></td>
                                                <td><?php echo $getstudent['user_department'] ?></td>
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