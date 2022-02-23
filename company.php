<?php

session_start();

require_once("db.php");
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
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="css/custom.css">
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
        <?php
          if(isset($_SESSION["id_admin"]))
          {
          $reference="admin/dashboard.php";
          }
          else { $reference="jobs.php";}
          ?>
          <a href=<?php echo $reference; ?>>Poslovi</a>
        </li>          
      </ul>
    </div>
  </nav>
</header>

  <div class="content-wrapper" style="margin-left: 0px;">

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">

          <div class="col-md-12 bg-white padding-2">
            <h1 style="text-align:center;">Detalji o kompaniji</h1>
            <div class="row">
              <form action="update-company.php" method="post" enctype="multipart/form-data">
                <?php
                  $sql = "SELECT * FROM company WHERE id_company='$_GET[id]'";
                  $result = $conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-12 latest-job ">
                  <div class="form-group">
                     <h4 style="text-align:center;"><b>Ime kompanije:</b></h4>
                    <h3 style="text-align:center;"><?php echo $row['companyname']; ?></h3><br>
					      <?php if($row['logo'] != "") { ?>
                    <p style="text-align: center;"><img src="uploads/logo/<?php echo $row['logo']; ?>" class="img-responsive center" style="max-height: 200px; max-width: 200px;"></p>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <br>
                    <h3 style="text-align:center;"><a href="<?php echo $row['website']; ?>">Veb sajt</a></h3>
                  </div>
                  <div class="form-group">
                    <h4 style="text-align:center;" for="email">Email adresa</h4>
                    <h3 style="text-align:center;"><?php echo $row['email']; ?></h3>
                  </div>
                  <div class="form-group">
                    <h4 style="text-align:center;">O nama</h4>
                    <h3 style="text-align:center;"><?php echo $row['aboutme']; ?></h3>
                  </div>
                  <div class="form-group">
                    <h4 style="text-align:center;" for="contactno">Kontakt telefon</h4>
                    <h3 style="text-align:center;"><?php echo $row['contactno']; ?></h3>
                  </div>
                  <div class="form-group">
                    <h4 style="text-align:center;" for="city">Grad</h4>
                    <h3 style="text-align:center;"><?php echo $row['city']; ?></h3>
                  </div>
                  <div class="form-group">
                    <h4 style="text-align:center;" for="country">Država</h4>
                    <h3 style="text-align:center;"><?php echo $row['country']; ?></h3><br>
                  </div>
                  <div class="pull-right">
                    <a href="jobs.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-left"></i> Nazad</a>
                  </div>
                </div>
                    <?php
                    }
                  }
                ?>  
              </form>
            </div>
            <?php if(isset($_SESSION['uploadError'])) { ?>
            <div class="row">
              <div class="col-md-12 text-center">
                <?php echo $_SESSION['uploadError']; ?>
              </div>
            </div>
            <?php unset($_SESSION['uploadError']); } ?>
            
            <?php 
              if(isset($_SESSION["id_user"]) && empty($_SESSION['companyLogged'])) { ?>
              <div class="col-md-12 bg-white padding-2">
              <hr>
              <h2><i>Ostavite komentar</i></h2>
              <div class="row">
                <form method="post" action="user/addcomment.php?id_company=<?php echo $_GET['id']; ?> ">
                  <div class="col-md-12 latest-job ">
                    <div class="form-group">
                      <select id='rating'name='rating'>
              <option value="1">1 ZVEZDICA</option>
              <option value="2">2 ZVEZDICE</option>
              <option value="3">3 ZVEZDICE</option>
              <option value="4">4 ZVEZDICE</option>
              <option value="5">5 ZVEZDICE</option>
            </select>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control input-lg" id="comment" name="comment" placeholder="Vaš komentar ovde"></textarea>
                    </div>
            
                    <div class="form-group">
                      <button type="submit" class="btn btn-flat btn-primary">Pošalji</button>
                    </div>
                  </div>
                </form>
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
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
</body>
</html>
