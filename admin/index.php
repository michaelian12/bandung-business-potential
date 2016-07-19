<?php
	session_start();
  if (($_SESSION['adminLogged'] == true) && ($_SESSION['nip'] != "")) {
    include("../libs/connection.php");

    $link = dbConnect();
    $sql = "select count(ktp) as total from user where status = 'Deaktif'";
    $res = $link->query($sql);
    if (mysqli_num_rows($res) == 1) {
      $data = mysqli_fetch_array($res);
    }
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bandung Business Potential - Accounts</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="../images/logo-bdg.png">
  </head>
  <body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square">
          	<h1 style="margin-left:42px;">Bandung Business Potential</h1>
          </div>
        </header>

        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>

        <nav class="templatemo-left-nav">
          <ul>
            <li><a href="#" class="active"><i class="fa fa-users fa-fw"></i>Accounts<span class="badge"><?php if ($data['total'] != 0) { echo $data['total']; } ?></span></a></li>
            <li><a href="region.php"><i class="fa fa-map-marker fa-fw" style="color: #e6e6e6;"></i>Region</a></li>
            <li><a href="business.php"><i class="fa fa-database fa-fw"></i>Business</a></li>
            <li><a href="business-scale.php"><i class="fa fa-expand fa-fw"></i>Business Scale</a></li>
            <li><a href="business-sector.php"><i class="fa fa-flag fa-fw"></i>Business Sector</a></li>
            <li><a href="../libs/logout-admin.php"><i class="fa fa-sign-out fa-fw"></i>Sign Out</a></li>
          </ul>
        </nav>
      </div>
      <!-- Main content -->
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container" style="height:130px;">
          <div class="row">
            <!-- Search box -->
            <form class="templatemo-search-form" role="search">
              <div class="input-group">
                  <button type="submit" class="fa fa-search"></button>
                  <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              </div>
            </form>
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Name <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Identity Card Number <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Email <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Address <span class="caret"></span></a></td>
                    <td>Status</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $link = dbConnect();
                    $sql = "select * from user";
                    $res = $link->query($sql);
                    $i = 0;
                    while ($row = mysqli_fetch_array($res)) {
                      $i++;
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><a href="?id=<?php echo $row['ktp']; ?>" class="templatemo-link"><?php echo $row['nama']; ?></a></td>
                    <td><?php echo $row['ktp']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row["alamat"]; ?></td>
                    <td><?php if ($row['status'] == "Aktif") { echo "Active"; } else { echo "Deactive"; } ?></td>
                    <td><center><a href="../libs/user-status.php?ktp=<?php echo $row['ktp']; ?>&status=<?php echo $row['status']; ?>" class="templatemo-link"><i class="fa <?php if ($row['status'] == "Aktif") { echo "fa-toggle-on"; } else { echo "fa-toggle-off"; } ?> fa-fw"></i></a></center></td>
                  </tr>
                  <?php
                    }
                    mysqli_close($link);
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <?php
            if (!empty($_GET['id'])) {
              $link = dbConnect();
              $ktp = $_GET['id'];
              $sql = "select * from user where ktp ='$ktp'";
              $res = $link->query($sql);
              if (mysqli_num_rows($res) == 1) {
                $data = mysqli_fetch_array($res);
          ?>
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="media margin-bottom-30">
                <div class="media-left padding-right-25">
                  <a href="#">
                    <?php if ($data['foto_user'] != "") { ?>
                    <img class="media-object img-circle templatemo-img-bordered" style="width: 100px; height: 100px;" src="<?php echo $data['foto_user']; ?>">
                    <?php } else { ?>
                    <img class="media-object img-circle templatemo-img-bordered" style="width: 100px; height: 100px;" src="../images/avatar.png">
                    <?php } ?>
                  </a>
                </div>

                <div class="media-body">
                  <h2 class="media-heading text-uppercase blue-text"><?php echo $data['nama']; ?></h2>
                  <p><i class="fa fa-circle" style="<?php if ($data['status'] == "Aktif") { echo "color:green"; } else { echo "color:red"; } ?>; padding-right:8px;"></i><?php if ($data['status'] == "Aktif") { echo "Active"; } else { echo "Deactive"; } ?></p>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Address</td>
                      <td><?php echo $data['alamat']; ?></td>
                    </tr>
                    <tr>
                      <td>Place of Birth</td>
                      <td><?php echo $data['tempat_lahir']; ?></td>
                    </tr>
                    <tr>
                      <td>Date of Birth</td>
                      <td><?php echo date('d M Y', strtotime($data['tanggal_lahir']));?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><?php echo $data['email']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="templatemo-content-widget white-bg col-1">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase"><?php echo $data['nama']; ?></h2>
              <h3 class="text-uppercase"><?php echo $data['ktp']; ?></h3><hr>
              <img src="<?php echo $data['foto_ktp']; ?>" class="img-square img-thumbnail margin-bottom-30" style="width:300px; height:200px;">
            </div>
          </div>
          <?php
                }
                mysqli_close($link);
              }
          ?>

          <footer class="text-right">
            <p>Copyright &copy; 2016 Bandung Business Potential</p>
          </footer>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="../js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>
<?php } else {
  header("Location: ../admin/login.php");
} ?>
