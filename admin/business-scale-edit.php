<?php
	session_start();
  if (($_SESSION['adminLogged'] == true) && ($_SESSION['nip'] != "")) {
    include("../libs/connection.php");
  	$id_edit = $_GET["id"];

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
    <title>Bandung Business Potential - Edit Business Scale</title>
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
            <li><a href="index.php"><i class="fa fa-users fa-fw"></i>Accounts<span class="badge"><?php if ($data['total'] != 0) { echo $data['total']; } ?></span></a></li>
            <li><a href="region.php"><i class="fa fa-map-marker fa-fw" style="color: #e6e6e6;"></i>Region</a></li>
            <li><a href="business.php"><i class="fa fa-database fa-fw"></i>Business</a></li>
            <li><a href="business-scale.php" class="active"><i class="fa fa-expand fa-fw"></i>Business Scale</a></li>
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
                  <button type="submit" class="fa fa-search" style="color:#13895F;"></button>
                  <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              </div>
            </form>
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="panel panel-default margin-10 col-1">
              <div class="panel-heading"><h2 class="text-uppercase">Edit Business Scale Form</h2></div>
              <div class="panel-body">
                <?php
                  $link = dbConnect();
                  $sql = "select * from skala_usaha where id_skala = '$id_edit'";
                  $res = $link->query($sql);
                  if (mysqli_num_rows($res) == 1) {
                    $data = mysqli_fetch_array($res);
                ?>
                <form action="../libs/business-scale-edit.php?id=<?php echo $id_edit; ?>" method="post" class="templatemo-login-form">
                  <div class="form-group">
                    <label>Scale</label>
                    <input type="text" class="form-control" name="namaSkala" placeholder="Scale" value="<?php echo $data['nama_skala']; ?>" required="true">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="templatemo-blue-button">Save</button>
                    <button type="reset" class="templatemo-white-button">Reset</button>
                  </div>
                </form>
                <?php
                  }
                  mysqli_close($link);
                ?>
              </div>
            </div>
          </div>
          <footer class="text-right">
            <p>Copyright &copy; 2016 Bandung Business Potential</p>
          </footer>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="../js/jquery-1.12.4.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>
<?php } else {
  header("Location: ../admin/login.php");
} ?>
