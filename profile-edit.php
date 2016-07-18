<?php
	session_start();
  if (($_SESSION['alreadyLogged'] == true) && ($_SESSION['ktp'] != "")) {
    include("libs/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bandung Business Potential - Edit Profile</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="images/logo-bdg.png">
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
            <li><a href="index.php"><i class="fa fa-home fa-fw"></i>Home</a></li>
            <li><a href="business.php"><i class="fa fa-database fa-fw"></i>Business</a></li>
            <li><a href="profile.php"class="active"><i class="fa fa-user fa-fw"></i>Profile</a></li>
            <li><a href="libs/logout.php"><i class="fa fa-sign-out fa-fw"></i>Log Out</a></li>
          </ul>
        </nav>
      </div>
      <!-- Main content -->
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container" style="height:130px;">
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <h2 class="margin-bottom-10">Edit Profile</h2><hr>
            <?php
              $ktp = $_SESSION['ktp'];

              $link = dbConnect();
              $sql = "select * from user where ktp = '$ktp'";
              $res = $link->query($sql);
              if (mysqli_num_rows($res) == 1) {
                $data = mysqli_fetch_array($res);
            ?>
            <form action="libs/profile-edit.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">
                  <center><div class="media-left" style="padding: 0px 0px 10px 0px;">
                    <a href="#">
                      <?php if ($data['foto_user'] != "") { ?>
                      <img class="media-object img-circle templatemo-img-bordered" style="width: 200px; height: 200px;" src="bbp/<?php echo $data['foto_user']; ?>">
                      <?php } else { ?>
                      <img class="media-object img-circle templatemo-img-bordered" style="width: 200px; height: 200px;" src="images/avatar.png">
                      <?php } ?>
                    </a>
                  </div></center>
                  <label>Change Profile Picture</label>
                  <input id="gambarProfil" type="file" class="filestyle" name="gambarProfil" data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false">
                </div>
                <div class="col-lg-6 col-md-6 form-group">
                  <center><div class="media-left" style="padding: 0px 0px 10px 0px;">
                    <a href="#">
                      <img src="bbp/<?php echo $data['foto_ktp']; ?>" class="img-square img-thumbnail" style="width:300px; height:200px;">
                    </a>
                  </div></center>
                  <label>Change Identity Card Image</label>
                  <input id="gambarKtp" type="file" class="filestyle" name="gambarKtp" data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" name="nama" placeholder="John Smith" value="<?php echo $data['nama']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 form-group">
                  <label>Identity Card Number</label>
                  <input type="text" class="form-control" name="noKtp" placeholder="3273120908950005" value="<?php echo $data['ktp']; ?>" disabled="true">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-12 form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="alamat" placeholder="Jl. Kawaluyaan Indah XVII no. 24" value="<?php echo $data['alamat']; ?>">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="someone@email.com" value="<?php echo $data['email']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="*********************" value="<?php echo decryptIt($data['password']); ?>">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">
                  <label>Birth Place</label>
                  <input type="text" class="form-control" name="tempatLahir" placeholder="Bandung" value="<?php echo $data['tempat_lahir']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 form-group">
                  <label>Birth Date</label>
                  <input type="date" class="form-control" name="tglLahir" value="<?php echo $data['tanggal_lahir']; ?>">
                </div>
              </div>
              <div class="form-group text-right">
                <button type="submit" class="templatemo-blue-button">Update</button>
                <button type="reset" class="templatemo-white-button">Reset</button>
              </div>
            </form>
            <?php } ?>
          </div>
          <footer class="text-right">
            <p>Copyright &copy; 2016 <a href="index.php">Bandung Business Potential</a></p>
          </footer>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>  <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>
<?php } else {
  header("Location: ../login.php");
} ?>
