<?php include 'header.php'; ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">User Role</h3>
                    </div>
                </div>
                <?php 
                    $user_id=$_GET['id'];
                    $users=$db->prepare("SELECT * FROM users WHERE user_id=:id");
                    $users->execute(array(
                        'id'=>$user_id
                    ));
                    $user=$users->fetch(PDO::FETCH_ASSOC);
                 ?>
                <div class="row ml-5">
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form method="POST" action="operations/operations.php?user_id=<?php echo $user['user_id'] ?>" class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Name</p></label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" name="course_name" value="<?php echo $user['user_name'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>   
                                     <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Last Name</p></label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" name="course_code" value="<?php echo $user['user_surname'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div> 
                                     <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Mail</p></label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" name="course_code" value="<?php echo $user['user_mail'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Birth Date</p></label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" name="course_code" value="<?php echo $user['user_birthdate'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div> 
                                     <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Current Role</p></label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" name="course_code" value="<?php echo $user['user_role'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Department</p></label>
                                        <div class="col-md-12">
                                            <input type="text" disabled="" name="course_code" value="<?php echo $user['user_department'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12"><p class="text-primary">Select Role</p></label>
                                        <div class="col-sm-12">
                                            <select name="duty" class="form-control form-control-line">
                                                <option disabled="">Select New Role</option>
                                                <option value="2">Vice Chair</option>
                                                <option value="3">Dean</option>
                                                <option value="4">Rector</option>
                                            </select>
                                        </div>
                                    </div> <br>                        
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="btn btn-success btn-block" type="submit" value="Assign New Role" name="assignrole">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <?php include 'footer.php'; ?>
