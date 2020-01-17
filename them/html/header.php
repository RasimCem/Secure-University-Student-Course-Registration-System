<?php
ob_start();
session_start();
 include 'operations/connection.php';
 include 'des.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php 
    
 ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>THE BEST UNIVERSTY</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand">       
                       <b><span style="color:white">THE BEST UNIVERSITY  
                         </span>   </b></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php $usermail=$_SESSION['user_mail'];
                                      $selectuser=$db->prepare("SELECT * FROM users WHERE user_mail=:mail");
                                      $selectuser->execute(array(
                                        'mail' => $usermail
                                      ));
                                      $check=$selectuser->rowCount();// Check session for avoid unauthorized login
                                      if($check==0){
                                        header("Location:login.php?unauthorize");
                                      }

                                      $getuser=$selectuser->fetch(PDO::FETCH_ASSOC);

                                      // decryption
                                      
                                      $key=$db->prepare("SELECT * FROM deskey WHERE id=:id");
                                      $key->execute(array(
                                         'id'=>1
                                      ));
                                      $getkey=$key->fetch(PDO::FETCH_ASSOC);
                                      $key=$getkey['deskey'];
                                      $iv=$getkey['iv'];
                                      $des = new DES($key, 'DES-CBC', DES::OUTPUT_BASE64, $iv);
                                      $name=$des->decrypt($getuser['user_name']);
                                      $surname=$des->decrypt($getuser['user_surname']);                         
                                      echo $fullname=$name." ".$surname;

                             ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <?php
                           $duty=$getuser['user_duty'];
                                if($duty==0){ ?>
                                     <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu">Course Regisration</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Profile</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Settings</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Log Out</span></a>
                                     </li>
                                <?php 
                                }else if($duty==2){ ?>
                                      <li> <a class="waves-effect waves-dark" href="vicechair.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Students</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Profile</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="assignadvisor.php" aria-expanded="false"><i class="fa fa-check-circle"></i><span class="hide-menu">Assign Advisor</span></a>
                                     </li>
                                       <li> <a class="waves-effect waves-dark" href="course-details.php" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">Course Details</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Settings</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Log Out</span></a>
                                     </li>
                         <?php }else if(($duty==1)){ ?>
                                     <li> <a class="waves-effect waves-dark" href="advisor.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Confirm Courses</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Profile</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Settings</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Log Out</span></a>
                                     </li>
                          <?php }else if($duty==3){ ?>
                                     <li> <a class="waves-effect waves-dark" href="dean.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Students</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Profile</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Settings</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Log Out</span></a>
                                     </li>
                          <?php }else if($duty==4){   ?>
                                     <li> <a class="waves-effect waves-dark" href="rector.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Students</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Profile</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Settings</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Log Out</span></a>
                                     </li>
                          <?php }else if($duty==5){ ?>
                                    <li> <a class="waves-effect waves-dark" href="admin.php" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Users Role</span></a>
                                     </li>
                                    <li> <a class="waves-effect waves-dark" href="updatekey.php" aria-expanded="false"><i class="fa fa-key"></i><span class="hide-menu">Update Secret Key</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Profile</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Settings</span></a>
                                     </li>
                                     <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Log Out</span></a>
                                     </li>
                          <?php } ?>



                                 
                       
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
                <!-- End Bottom points-->
        </aside>