<?php require_once("../config.php");  ?>
 <?php include("header-pdt.php"); ?>

<?php
if(!isset($_SESSION['username'])){

    header('Location: ../index.php');
}
?>

<!-- INIZIO INDEX -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Pannello di amministrazione
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="material-icons">dashboard</i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                <div class="container">
                  <div class="col-sm-6">
                  <h4>    <?php leggereprodotti(); ?></h4>
                  </div>
                </div>


            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


    <?php include("footer.php"); ?>
