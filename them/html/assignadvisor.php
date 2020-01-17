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
                        <h3 class="text-themecolor">Assign Advisor</h3>
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
                                                <th style="text-align:center;">Select Advisor</th>
                                                <th>Advisor Assign</th>

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
                                                <td>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <form action="operations/operations.php?userid=<?php echo $getstudent['user_id']; ?>" method="POST">
                                            <select name="slct" class="form-control form-control-line">
                                                <option disabled="">Advisors</option>
                                            <?php  
                                                  //List Advisors
                                             $advisor=$db->prepare("SELECT * FROM users WHERE user_duty=:duty");
                                             $advisor->execute(Array(
                                                'duty'=> 1 // duty of advisors from DB
                                             ));

                                            while($listadvisor=$advisor->fetch(PDO::FETCH_ASSOC)){ ?>
                                                <option  value="<?php echo $listadvisor['user_id']; ?>"><?php echo $des->decrypt($listadvisor['user_name'])." ".$des->decrypt($listadvisor['user_surname']); ?></option>
                                         <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                                </td>
                                                <td>
                                                    
                                                       <input class="btn btn-success ml-4" type="submit" value="Assign" name="assignadvisor">   
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