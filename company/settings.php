<?php

session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

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
                <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Početna</a></li>
                  <li><a href="edit-company.php"><i class="fa fa-tv"></i> Izmena podataka</a></li>
                  <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Postavite oglas</a></li>
                  <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> Moji oglasi</a></li>
                  <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Prijave na oglase</a></li>
                  <li><a href="comments.php"><i class="fa fa-comment"></i> Komentari</a></li>
                  <li><a href="resume-database.php"><i class="fa fa-user"></i> Baza CV-jeva</a></li>
                  <li class="active"><a href="settings.php"><i class="fa fa-gear"></i> Podešavanja</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <h2><i>Podešavanja profila</i></h2>
            <p>Ovde možete promeniti ime i lozinku.</p>
            <div class="row">
              <div class="col-md-6">
                <br>
                <form id="changePassword" action="change-password.php" method="post">
                  <div class="form-group">
                    <input id="password" class="form-control input-lg" type="password" name="password" autocomplete="off" placeholder="Lozinka" required>
                  </div>
                  <div class="form-group">
                    <input id="cpassword" class="form-control input-lg" type="password" autocomplete="off" placeholder="Potvrda lozinke" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat btn-success btn-lg">Promena lozinke</button>
                  </div>
                  <div id="passwordError" class="color-red text-center hide-me">
                    Lozinke se ne poklapaju!
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <form action="update-name.php" method="post">
                  <div class="form-group">
                    <br><br><br>
                    <label>Ime i prezime</label>
                    <input class="form-control input-lg" name="name" type="text">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat btn-primary btn-lg">Promena imena</button>
                  </div>
                </form>
              </div>              
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-md-6">
                <form action="deactivate-account.php" method="post">
                  <label><input type="checkbox" required> Želim da deaktiviram svoj nalog.</label>
                  <button class="btn btn-danger btn-flat btn-lg">Deaktivacija</button>
                </form>
              </div>
            </div>
            
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
<script>
  $("#changePassword").on("submit", function(e) {
    e.preventDefault();
    if( $('#password').val() != $('#cpassword').val() ) {
      $('#passwordError').show();
    } else {
      $(this).unbind('submit').submit();
    }
  });
</script>
</body>
</html>
