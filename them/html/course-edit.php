<?php include 'header.php'; ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Edit Course</h3>
                    </div>
                </div>
                <?php 
                    $course_id=$_GET['course_id'];
                    $coursedetails=$db->prepare("SELECT * FROM courses WHERE course_id=:id");
                    $coursedetails->execute(array(
                        'id'=>$course_id
                    ));
                    $getdetails=$coursedetails->fetch(PDO::FETCH_ASSOC);
                 ?>
                <div class="row ml-5">
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form method="POST" action="operations/operations.php?course_id=<?php echo $course_id ?>" class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Course Name</p></label>
                                        <div class="col-md-12">
                                            <input type="text" name="course_name" value="<?php echo $getdetails['course_name'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>   
                                     <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Course Code</p></label>
                                        <div class="col-md-12">
                                            <input type="text" name="course_code" value="<?php echo $getdetails['course_code'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Course Teacher</p></label>
                                        <div class="col-md-12">
                                            <input type="text" name="course_teacher" value="<?php echo $getdetails['course_teacher'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Course Credit</p></label>
                                        <div class="col-md-12">
                                            <input type="number" name="course_credit" value="<?php echo $getdetails['course_credit'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>                       
                                    <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Course Description</p></label>
                                        <div class="col-md-12">
                                            <textarea name="course_description" rows="5" class="form-control form-control-line"><?php echo $getdetails['course_description'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="btn btn-success btn-block" type="submit" value="Update Course Informations" name="updatecourse">
                                            <input class="btn btn-danger btn-block" type="submit" value="Delete Course" name="deletecourse">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <?php include 'footer.php'; ?>
