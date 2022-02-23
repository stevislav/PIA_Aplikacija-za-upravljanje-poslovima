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
                  <li class="active"><a href="edit-profile.php"><i class="fa fa-user"></i> Izmeni profil</a></li>
                  <li><a href="index.php"><i class="fa fa-address-card-o"></i> Moje prijave</a></li>
                  <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Poslovi</a></li>
                  <li><a href="settings.php"><i class="fa fa-gear"></i> Podešavanja</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <h2><i>Izmena profila</i></h2>
            <form action="update-profile.php" method="post" enctype="multipart/form-data">
            <?php
            //Sql za logovanje
            $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
            ?>
              <div class="row">
                <div class="col-md-6 latest-job ">
                  <div class="form-group">
                     <label for="fname">Ime</label>
                    <input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="Ime" value="<?php echo $row['firstname']; ?>" required="">
                  </div>
                  <div class="form-group">
                    <label for="lname">Prezime</label>
                    <input type="text" class="form-control input-lg" id="lname" name="lname" placeholder="Prezime" value="<?php echo $row['lastname']; ?>" required="">
                  </div>
                  <div class="form-group">
                    <label for="email">Email adresa</label>
                    <input type="email" class="form-control input-lg" id="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="address">Adresa</label>
                    <textarea id="address" name="address" class="form-control input-lg" rows="5" placeholder="Adresa"><?php echo $row['address']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="city">Grad</label>
                    <input type="text" class="form-control input-lg" id="city" name="city" value="<?php echo $row['city']; ?>" placeholder="Grad">
                  </div>
                  <div class="form-group">
                    <label for="state">Država</label>
                    <input type="text" class="form-control input-lg" id="state" name="state" placeholder="Država" value="<?php echo $row['state']; ?>">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat btn-primary">Ažuriraj profil</button>
                  </div>
                </div>
                <div class="col-md-6 latest-job ">
                  <div class="form-group">
                    <label for="contactno">Kontakt broj</label>
                    <input type="text" class="form-control input-lg" id="contactno" name="contactno" placeholder="Kontakt broj" value="<?php echo $row['contactno']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="qualification">Stručna sprema</label>
                    <input type="text" class="form-control input-lg" id="qualification" name="qualification" placeholder="Stručna sprema" value="<?php echo $row['qualification']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="stream">Radno iskustvo</label>
                    <input type="text" class="form-control input-lg" id="stream" name="stream" placeholder="Radno iskustvo" value="<?php echo $row['stream']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Veštine</label>
                    <textarea class="form-control input-lg" rows="4" name="skills"><?php echo $row['skills']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>O meni</label>
                    <textarea class="form-control input-lg" rows="4" name="aboutme"><?php echo $row['aboutme']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Dodaj CV</label>
                    <input type="file" name="resume" class="btn btn-default">
                  </div>
                </div>
              </div>
              <?php
                }
              }
            ?>   
            </form>
            <?php if(isset($_SESSION['uploadError'])) { ?>
            <div class="row">
              <div class="col-md-12 text-center">
                <?php echo $_SESSION['uploadError']; ?>
              </div>
            </div>
            <?php } ?>
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
