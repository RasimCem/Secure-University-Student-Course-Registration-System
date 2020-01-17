    <?php
         include 'header.php';

        $code=$_GET['code'];
        $course=$db->prepare("SELECT * FROM courses WHERE course_code=:code");
        $course->execute(array(
          'code'=>$code
        ));
        $courseselect=$course->fetch(PDO::FETCH_ASSOC);
     ?>

  <div class="col-lg-8 col-xlg-9 col-md-7" style="max-width: 1050px; margin-top: 50px; margin-left:400px;">
                        <div class="card">
                            <div class="card-block">
                                <form action="operations/operations.php?id=<?php echo $courseselect['course_id']?>" method="POST" class="form-horizontal form-material">
                                    <div class="form-group">
                                        <h2><label class="col-md-12 text-primary"><?php echo $courseselect['course_name']; ?></label></h2><br>
                                            <label class="col-md-12"><?php echo "Course Code: ".$courseselect['course_code']; ?></label>
                                            <label class="col-md-12"><?php echo "Course Instructor: ".$courseselect['course_teacher']; ?></label>
                                            <label class="col-md-12"><?php echo "Course Credit: ".$courseselect['course_credit']; ?></label>
                                    </div>
                                    <div class="form-group">
                                        <h3><label class="col-md-12 text-primary">Course Description:</label></h3>
                                        <div class="col-md-12">
                                            <p>    <?php echo $courseselect['course_description']; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="btn btn-danger" value="Remove Course" type="submit" name="removecourse">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php include 'footer.php'; ?>