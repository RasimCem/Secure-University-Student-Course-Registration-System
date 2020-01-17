<?php include 'header.php'; ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
      
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Course Details</h3>
                    </div>
                </div>
                <div class="row" style="margin-left:300px;margin-top: 75px;">
                    <div class="col-lg-4 col-xlg-8 col-md-5">
                         <div class="card">
                            <div class="card-block bg-info">
                                <h4 class="text-white card-title">Courses</h4>
                                <h6 class="card-subtitle text-white m-b-0 op-5">For more information click on courses.</h6>
                            </div>
                            <div class="card-block">
                                <div class="message-box contact-box">    
                                    <div class="message-widget contact-widget">
                                    	<?php 
                                    	$course=$db->prepare("SELECT * FROM courses");
                                    	$course->execute();
                                    	while($listcourse=$course->fetch(PDO::FETCH_ASSOC)){?>
                                        <a href="course-edit.php?course_id=<?php echo $listcourse['course_id'] ?>"> 
                                            <div class="mail-contnet">
                                               <h5><?php echo $listcourse['course_name'] ?></h5> <span class="mail-desc"><?php echo $listcourse['course_code'] ?></span>
                                           </div>
                                        </a>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>











<?php include 'footer.php'; ?>