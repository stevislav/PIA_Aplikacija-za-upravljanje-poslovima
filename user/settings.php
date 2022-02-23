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
                  <li><a href="edit-profile.php"><i class="fa fa-user"></i> Izmeni profil</a></li>
                  <li><a href="index.php"><i class="fa fa-address-card-o"></i> Moje prijave</a></li>
                  <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Poslovi</a></li>
                  <li class="active"><a href="settings.php"><i class="fa fa-gear"></i> Podešavanja</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <h2><i>Promena lozinke</i></h2>
            <p>Ukucajte novu lozinku</p>
            <div class="row">
              <div class="col-md-6">
                <form id="changePassword" action="change-password.php" method="post">
                  <div class="form-group">
                    <input id="password" class="form-control input-lg" type="password" name="password" autocomplete="off" placeholder="Lozinka" required>
                  </div>
                  <div class="form-group">
                    <input id="cpassword" class="form-control input-lg" type="password" autocomplete="off" placeholder="Potvrda lozinke" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat btn-success">Promeni lozinku</button>
                  </div>
                  <div id="passwordError" class="color-red text-center hide-me">
                    Lozinke se ne poklapaju!
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <form action="deactivate-account.php" method="post">
                  <label><input type="checkbox" required> Želim da deaktiviram svoj nalog!</label>
                  <button type="submit" class="btn btn-danger btn-flat btn-lg">Deaktiviraj nalog</button>
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
