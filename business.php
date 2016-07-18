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
    <title>Bandung Business Potential - Business</title>
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
            <li><a href="#"class="active"><i class="fa fa-database fa-fw"></i>Business</a></li>
            <li><a href="profile.php"><i class="fa fa-user fa-fw"></i>Profile</a></li>
            <li><a href="libs/logout.php"><i class="fa fa-sign-out fa-fw"></i>Log Out</a></li>
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
                <input type="text" class="form-control" placeholder="Search Business Name" name="srch-term" id="srch-term">
              </div>
            </form>
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget col-1 white-bg">
              <i class="fa fa-times"></i>
              <h1 class="text-uppercase" style="float:left;">Business</h1>
              <a href="business-add.php"><button class="margin-right-15 templatemo-blue-button" style="float:right;">Add Business</button></a>
            </div>
          </div>

          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Business Name <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Main Product <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Address <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Phone Number <span class="caret"></span></a></td>
                    <td>Status</td>
                    <td>Edit</td>
                    <td>Delete</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $link = dbConnect();
                    $ktp = $_SESSION['ktp'];
                    $sql = "select * from usaha where ktp = '$ktp'";
                    $res = $link->query($sql);
                    $i = 0;
                    while ($row = mysqli_fetch_array($res)) {
                      $i++;
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['nama_usaha']; ?></td>
                    <td><?php echo $row['produk_utama']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['telepon']; ?></td>
                    <td><center><a href="libs/business-status.php?id=<?php echo $row['id_usaha']; ?>&status=<?php echo $row['status']; ?>" class="templatemo-link"><i class="fa <?php if ($row['status'] == "Aktif") { echo "fa-toggle-on"; } else { echo "fa-toggle-off"; } ?> fa-fw"></i></a></center></td>
                    <td><center><a href="business-edit.php?id=<?php echo $row['id_usaha']; ?>" class="templatemo-link"><i class="fa fa-pencil-square-o fa-fw"></i></a></center></td>
                    <td><center><a href="libs/business-delete.php?id=<?php echo $row['id_usaha']; ?>" class="templatemo-link"><i class="fa fa-times-circle fa-fw"></i></a></center></td>
                  </tr>
                  <?php
                    }
                    mysqli_close($link);
                  ?>
                </tbody>
              </table>
            </div>
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
