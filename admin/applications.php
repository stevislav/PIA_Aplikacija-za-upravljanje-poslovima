<?php

session_start();

if(empty($_SESSION['id_admin'])) {
  header("Location: index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Oglasi za poslove</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
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
                <h3 class="box-title">Dobrodošli <b>Admin</b></h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Profil</a></li>
                  <li><a href="active-jobs.php"><i class="fa fa-briefcase"></i> Aktivni poslovi</a></li>
                  <li class="active"><a href="applications.php"><i class="fa fa-address-card-o"></i> Kandidati</a></li>
                  <li><a href="companies.php"><i class="fa fa-building"></i> Kompanije</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">

            <h3>Baza kandidata</h3>
            <div class="row margin-top-20">
              <div class="col-md-12">
                <div class="box-body table-responsive no-padding">
                  <table id="example2" class="table table-hover">
                    <thead>
                      <th>Kandidat</th>
                      <th>Stručna sprema</th>
                      <th>Veštine</th>
                      <th>Grad</th>
                      <th>Država</th>
                      <th>Preuzmi CV</th>
                      <th>Status</th>
                      <th>Izmena</th>
                      <th>Brisanje</th>
                    </thead>
                    <tbody>
                      <?php
                       $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);

                            if($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) 
                              {     

                                $skills = $row['skills'];
                                $skills = explode(',', $skills);
                      ?>
                      <tr>
                        <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                        <td><?php echo $row['qualification']; ?></td>
                        <td>
                          <?php
                          foreach ($skills as $value) {
                            echo ' <span class="label label-success">'.$value.'</span>';
                          }
                          ?>
                        </td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        
                        <?php if($row['resume'] != '') { ?>
                        <td><a href="../uploads/resume/<?php echo $row['resume']; ?>" download="<?php echo $row['firstname'].' Resume'; ?>"><i class="fa fa-file-pdf-o"></i></a></td>
                        <?php } else { ?>
                        <td>CV nedostupan</td>
                        <?php } ?>
                        <td>
                        <?php
                          if($row['active'] == '1') {
                            echo "Aktiviran";
                          } else if($row['active'] == '2') {
                            ?>
                            <a href="reject-application.php?id=<?php echo $row['id_user']; ?>">Odbij</a> <a href="approve-application.php?id=<?php echo $row['id_user']; ?>">Prihvati</a>
                            <?php
                          } else if ($row['active'] == '3') {
                            ?>
                              <a href="approve-application.php?id=<?php echo $row['id_user']; ?>">Reaktiviraj</a>
                            <?php
                          } else if($row['active'] == '0') {
                            echo "Odbijen";
                          }
                        ?>                          
                        </td>
                        <td><a href="edit-profile.php?id=<?php echo $row['id_user']; ?>"><i class="fa fa-edit"></i></a></td>
                        <td><a href="delete-application.php?id=<?php echo $row['id_user']; ?>"><i class="fa fa-trash"></i></a></td>
                      </tr>

                      <?php

                        }
                      }
                      ?>
                      
                    </tbody>                    
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <div class="modal modal-success fade" id="modal-success">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Profil kandidata</h4>
          </div>
          <div class="modal-body">
              <h3><b>Prijavljen</b></h3>
              <p>10/02/2022</p>
              <br>
              <h3><b>Email</b></h3>
              <p>test@test.com</p>
              <br>
              <h3><b>Broj telefona</b></h3>
              <p>0600000000</p>
              <br>
              <h3><b>Veb sajt</b></h3>
              <p>google.com</p>
              <br>
              <h3><b>Poruka</b></h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Zatvori</button>
          </div>
        </div>
      </div>
    </div>
    

  </div>

  <div class="control-sidebar-bg"></div>

</div>

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>

<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
  });
</script>
</body>
</html>