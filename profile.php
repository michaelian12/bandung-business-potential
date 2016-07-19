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
    <title>Bandung Business Potential - Profile</title>
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
            <li><a href="#"class="active"><i class="fa fa-user fa-fw"></i>Profile</a></li>
            <li><a href="libs/logout.php"><i class="fa fa-sign-out fa-fw"></i>Log Out</a></li>
          </ul>
        </nav>
      </div>
      <!-- Main content -->
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container" style="height:130px;">
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget col-1 white-bg">
              <i class="fa fa-times"></i>
              <h1 class="text-uppercase" style="float:left;">Profile</h1>
              <a href="profile-edit.php"><button class="margin-right-15 templatemo-blue-button" style="float:right;">Edit Profile</button></a>
            </div>
          </div>

          <div class="templatemo-flex-row flex-content-row">
            <?php
              $ktp = $_SESSION['ktp'];

              $link = dbConnect();
              $sql = "select * from user where ktp = '$ktp'";
            	$res = $link->query($sql);
              if (mysqli_num_rows($res) == 1) {
                $data = mysqli_fetch_array($res);
            ?>
            <!-- first widget -->
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="media margin-bottom-30">
                <div class="media-left padding-right-25">
                  <a href="#">
                    <?php if ($data['foto_user'] != "") { ?>
                    <img class="media-object img-circle templatemo-img-bordered" style="width: 150px; height: 150px;" src="bbp/<?php echo $data['foto_user']; ?>">
                    <?php } else { ?>
                    <img class="media-object img-circle templatemo-img-bordered" style="width: 150px; height: 150px;" src="images/avatar.png">
                    <?php } ?>
                  </a>
                </div>
                <div class="media-body">
                  <h2 class="media-heading text-uppercase blue-text"><?php echo $data['nama']; ?></h2>
                  <p>
                    <?php if ($data['status'] == "aktif") { ?>
                    <i class="fa fa-circle" style="color:green;padding-right:8px;"></i>Active
                    <?php } else { ?>
                    <i class="fa fa-circle" style="color:red;padding-right:8px;"></i>Deactive
                    <?php } ?>
                  </p>
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
            <!-- second widget -->
            <div class="templatemo-content-widget white-bg col-1">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">Identity Card</h2>
              <h3 class="text-uppercase"><?php echo $data['ktp']; ?></h3><hr>
              <img src="bbp/<?php echo $data['foto_ktp']; ?>" class="img-square img-thumbnail margin-bottom-30" style="width:300px; height:200px;">
            </div>
            <?php } ?>
          </div>

          <footer class="text-right">
            <p>Copyright &copy; 2016 Bandung Business Potential</p>
          </footer>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script>
      $(function(){
        $("input[type='submit']").click(function(){
            var $fileUpload = $("input[type='file']");
            if (parseInt($fileUpload.get(0).files.length)>2){
             alert("You can only upload a maximum of 2 files");
            }
        });
      });​
    </script>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>  <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>
<?php } else {
  header("Location: ../login.php");
} ?>
