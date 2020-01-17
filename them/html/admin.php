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
                                                <th style="text-align: center">First Name</th>
                                                <th style="text-align: center">Last Name</th>
                                                <th style="text-align: center">Mail</th>
                                                <th style="text-align: center">Department</th>
                                                <th style="text-align: center">Current Role</th>
                                                <th style="text-align: center" >Assign Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                         $duties=array(3,4,5);  //2,3,4
                                         $num=implode(',',$duties);
                                         $users=$db->prepare("SELECT * FROM users WHERE user_duty IN (".$num.")");
                                         $users->execute();
                                            while($getuser=$users->fetch(PDO::FETCH_ASSOC)){  ?> 
                                            <tr>
                                                <td style="text-align: center"><?php echo $des->decrypt($getuser['user_name']); ?></td>
                                                <td style="text-align: center"><?php echo $des->decrypt($getuser['user_surname']); ?></td>
                                                <td style="text-align: center"><?php echo $getuser['user_mail']; ?></td>
                                                <td style="text-align: center"><?php echo $getuser['user_department'] ?></td>
                                                <td><h3 class="bg-warning" style="text-align: center"><?php echo $getuser['user_role'] ?></h3></td>
                                                <td style="text-align: center"><a href="roles.php?id=<?php echo $getuser['user_id']; ?>"><input class="btn btn-info" type="submit" name="" value="Assign"></a></td>
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