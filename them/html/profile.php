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
                        <h3 class="text-themecolor m-b-0 m-t-0">Profile</h3>
                    </div>
                </div>
                <?php 
                    $userinfo=$db->prepare("SELECT * FROM users WHERE user_mail=:mail");
                    $userinfo->execute(array(
                        'mail'=>$usermail
                    ));
                    $getuser=$userinfo->fetch(PDO::FETCH_ASSOC);
                 ?>



                <div class="row m-5" >
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">First Name</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $des->decrypt($getuser['user_name']) ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-12">Last Name</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $des->decrypt($getuser['user_surname']) ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" disabled="" placeholder="<?php echo $getuser['user_mail'] ?>" class="form-control form-control-line" name="example-email" id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Birthdate</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $getuser['user_birthdate'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-12">Sex</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $getuser['user_sex'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>

                                     <?php
                                        $duty=$getuser['user_duty'];
                                        if($duty==0){ ?>
                                    
                                     <div class="form-group">
                                        <label class="col-md-12">Student Number</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $getuser['student_number'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-12">Department</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $getuser['user_department']; ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-12">Semester</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $getuser['student_semester'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-12">GPA</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" placeholder="<?php echo $getuser['student_gpa'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <?php include 'footer.php'; ?>
