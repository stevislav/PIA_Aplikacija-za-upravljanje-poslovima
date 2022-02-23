<?php

session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Oglasi za posao</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <a href="index.php" class="logo logo-bg">
      <span class="logo-mini"><b>O</b>P</span>
      <span class="logo-lg"><b>Oglasi</b> za posao</span>
    </a>

    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="../jobs.php">Poslovi</a>
          </li>          
        </ul>
      </div>
    </nav>
  </header>

  <div class="content-wrapper" style="margin-left: 0px;">

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Dobrodošli <b><?php echo $_SESSION['name']; ?></b></h3>
              </div>
              <div class="box-body no-padding">
               <ul class="nav nav-pills nav-stacked">
                  <li><a href="edit-profile.php"><i class="fa fa-user"></i> Izmeni Profil</a></li>
                  <li class="active"><a href="index.php"><i class="fa fa-address-card-o"></i> Moje prijave</a></li>
                  <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Poslovi</a></li>
                  <li><a href="settings.php"><i class="fa fa-gear"></i> Podešavanja</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <h2><i>Prijave za posao</i></h2>
            <p>Ispod se nalaze poslovi za koje ste se prijavili</p>

            <?php
             $sql = "SELECT * FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost WHERE apply_job_post.id_user='$_SESSION[id_user]'";
                  $result = $conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {     
            ?>
            <div class="attachment-block clearfix padding-2">
                <h3 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a></h3>                
                <div class="attachment-text padding-2">
                  <div class="pull-left"><i class="fa fa-calendar"></i> <?php echo $row['createdat']; ?></div>
                  <div class="pull-right"><a class="btn btn-primary" href="delete-application.php?appid=<?php echo $row['id_jobpost']; ?>&userid=<?php echo $_SESSION['id_user']; ?>" role="button">Otkažite prijavu</a></div>
                  <br><br>  
                  <?php 

                  if($row['status'] == 0) {
                    echo '<div class="pull-left"><strong class="text-orange">Na čekanju</strong></div>';
                  } else if ($row['status'] == 1) {
                    echo '<div class="pull-left"><strong class="text-red">Odbijen</strong></div>';
                  } else if ($row['status'] == 2) {
                    echo '<div class="pull-left"><strong class="text-green">Prihvaćen</strong></div> ';
                  }
                  ?>
                                
                </div>
            </div>

            <?php
              }
            }
            ?>
            
          </div>
        </div>
      </div>
    </section>

    

  </div>
 
  <div class="control-sidebar-bg"></div>

</div>

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
</body>
</html>
