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
                        <h3 class="text-themecolor m-b-0 m-t-0">Student Course Confirmation</h3>
                    </div>
                </div>
                <?php
                    $student_id=$_GET['userid']; 
                    $student=$db->prepare("SELECT * FROM users WHERE user_id=:id");
                    $student->execute(array(
                        'id'=>$student_id
                    ));
                    $studentinfo=$student->fetch(PDO::FETCH_ASSOC);
                 ?>

                <div class="row m-5" >
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form method="POST" action="operations/operations.php?user_id=<?php echo $student_id ?>" class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Student Number#</label>
                                        <div class="col-md-12">
                                            <input type="number" disabled="" value="<?php echo $studentinfo['student_number'] ?>"  class="form-control form-control-line">
                                        </div>
                                        <label class="col-md-12">First Name</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" value="<?php echo $des->decrypt($studentinfo['user_name']) ?>" class="form-control form-control-line">
                                        </div>
                                        <label class="col-md-12">Last Name</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" value="<?php echo $des->decrypt($studentinfo['user_surname']) ?>"  class="form-control form-control-line">
                                        </div>
                                        <label class="col-md-12">Mail</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" value="<?php echo $studentinfo['user_mail'] ?>" class="form-control form-control-line">
                                        </div>
                                        <label class="col-md-12">GPA</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" value="<?php echo $studentinfo['student_gpa'] ?>"  class="form-control form-control-line">
                                        </div>
                                        <label class="col-md-12">Semester</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" value="<?php echo $studentinfo['student_semester'] ?>" class="form-control form-control-line">
                                        </div><br><br>
                                        <h4 class="text-primary" style="text-align: center">Confirm The Courses</h4><br>
                                        <?php 
                                            $course=$db->prepare("SELECT * FROM selectedcourses WHERE user_id=:id");
                                            $course->execute(array(
                                                'id' => $student_id
                                            ));
                                            $num=0;
                                            while($listcourse=$course->fetch(PDO::FETCH_ASSOC)){ $num++; ?>
                                        
                                        <!-- Material checked -->
                                        <div class="form-check" style="margin-left: 395px">
                                            <input name="courses[]" value="<?php echo $listcourse['course_code']; ?>" type="checkbox" class="form-check-input" id="<?php echo $num ?>">
                                             <label class="form-check-label" for="<?php echo $num; ?>"><?php echo $listcourse['course_name'] ?></label>
                                        </div>
                                          <?php } ?><br>
                                          <input style="margin-left: 420px;" type="submit" class="btn btn-info" value="Confirm Selected Courses"
                                          <?php if($duty==1){?>
                                           name="courseconfirmadvisor"
                                       <?php }else if($duty==2){ ?>
                                        name="courseconfirm"
                                           <?php } ?>>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php'; ?>
