<?php include 'header.php'; ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Update DES Key</h3>
                    </div>
                </div>
                <div class="row ml-5">
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form method="POST" action="operations/operations.php"  class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12"><p class="text-primary">Update Key</p></label>
                                        <div class="col-md-12">
                                            <input type="text"  name="key" value="" class="form-control form-control-line">
                                        </div>
                                    </div>                          
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="btn btn-success btn-block" type="submit" value="Confirm" name="updatekey">
                                        </div>
                                    </div>
                                    <?php $update=$_GET['update'];
                                    if($update=='ok'){ ?>
                                    <h2 class="text-success" align="center">Key update successful!</h2>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <?php include 'footer.php'; ?>
