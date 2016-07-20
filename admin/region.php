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
    <title>Bandung Business Potential - Region</title>
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
            <li><a href="#" class="active"><i class="fa fa-map-marker fa-fw" style="color: #e6e6e6;"></i>Region</a></li>
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
                  <button type="submit" class="fa fa-search" style="color:#13895F;"></button>
                  <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              </div>
            </form>
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg col-2">
            <ul class="nav nav-tabs nav-justified text-uppercase" style="padding-bottom:20px;">
              <li class="active"><a data-toggle="tab" href="#district">District (Kecamatan)</a></li>
              <li><a data-toggle="tab" href="#village">Village (Kelurahan)</a></li>
            </ul>

		        <div class="tab-content">
		          <div id="district" class="tab-pane fade in active">
                <div class="templatemo-flex-row flex-content-row">
                  <div class="col-1">
                    <div class="panel panel-default margin-10">
                      <div class="panel-heading"><h2 class="text-uppercase">Add District Form</h2></div>
                      <div class="panel-body">
                        <form action="../libs/region-add-district.php" method="post" class="templatemo-login-form">
                          <div class="form-group">
                            <label>District Name</label>
                            <input type="text" class="form-control" name="namaKecamatan" placeholder="District Name" required="true">
                          </div>
                          <div class="form-group">
                            <button type="submit" class="templatemo-blue-button">Add</button>
                            <button type="reset" class="templatemo-white-button">Reset</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-1">
                    <div class="templatemo-content-widget no-padding">
                      <div class="panel panel-default table-responsive">
                        <table class="table table-striped table-bordered templatemo-user-table">
                          <thead>
                            <tr>
                              <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                              <td><a href="" class="white-text templatemo-sort-by">District <span class="caret"></span></a></td>
                              <td>Edit</td>
                              <td>Delete</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $link = dbConnect();
                              $sql = "select * from kecamatan";
                              $res = $link->query($sql);
                              $i = 0;
                              while ($row = mysqli_fetch_array($res)) {
                                $i++;
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['nama_kecamatan']; ?></td>
                              <td><center><a href="region-edit.php?id=<?php echo $row["id_kecamatan"]; ?>" class="templatemo-edit-btn">Edit</a></center></td>
                              <td><center><a href="../libs/region-delete-district.php?id=<?php echo $row["id_kecamatan"]; ?>" class="templatemo-link"><i class="fa fa-remove fa-fw" style="color:red;"></i></a></center></td>
                            </tr>
                            <?php
                              }
                              mysqli_close($link);
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="village" class="tab-pane fade">
              	<div class="templatemo-flex-row flex-content-row">
                  <div class="col-1">
                    <div class="panel panel-default margin-10">
                      <div class="panel-heading"><h2 class="text-uppercase">Add Village Form</h2></div>
                      <div class="panel-body">
                        <form action="../libs/region-add-village.php" method="post" class="templatemo-login-form">
                          <div class="form-group">
                            <label>District Name</label>
                            <select id="district" name="idKecamatan" class="form-control" style="margin-top:10px;" required="true">
															<option value="" disabled="true" selected="true">Select District</option>
	                            <?php
	        											$link = dbConnect();
	        											$sqlDis = "select * from kecamatan order by nama_kecamatan";
	        											$resDis = $link->query($sqlDis);
	        											while ($rowDis = mysqli_fetch_array($resDis)) {
	        												echo "<option value=\"".$rowDis['id_kecamatan']."\">".$rowDis['nama_kecamatan']." </option>";
	        											}
	        											mysqli_close($link);
	        										?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Village Name</label>
                            <input type="text" class="form-control" name="namaKelurahan" placeholder="Village Name" required="true">
                          </div>
                          <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" name="kodePos" placeholder="Postal Code" required="true">
                          </div>
                          <div class="form-group">
                            <button type="submit" class="templatemo-blue-button">Add</button>
                            <button type="reset" class="templatemo-white-button">Reset</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-1">
                    <div class="templatemo-content-widget no-padding">
                      <div class="panel panel-default table-responsive">
                        <table class="table table-striped table-bordered templatemo-user-table">
                          <thead>
                            <tr>
                              <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                              <td><a href="" class="white-text templatemo-sort-by">District <span class="caret"></span></a></td>
                              <td><a href="" class="white-text templatemo-sort-by">Village <span class="caret"></span></a></td>
                              <td><a href="" class="white-text templatemo-sort-by">Postal Code <span class="caret"></span></a></td>
                              <td>Edit</td>
                              <td>Delete</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $link = dbConnect();
                              $sql = "select * from kelurahan kel join kecamatan kec on kel.id_kecamatan = kec.id_kecamatan";
                              $res = $link->query($sql);
                              $i = 0;
                              while ($row = mysqli_fetch_array($res)) {
                                $i++;
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['nama_kecamatan']; ?></td>
                              <td><?php echo $row['nama_kelurahan']; ?></td>
                              <td><?php echo $row['kode_pos']; ?></td>
                              <td><a href="region-edit.php?id=<?php echo $row["id_kelurahan"]; ?>#village" class="templatemo-edit-btn">Edit</a></td>
                              <td><center><a href="../libs/region-delete-village.php?id=<?php echo $row["id_kelurahan"]; ?>" class="templatemo-link"><i class="fa fa-remove fa-fw" style="color:red;"></i></a></center></td>
                            </tr>
                            <?php
                              }
                              mysqli_close($link);
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
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
    <script>
      // Javascript to enable link to tab
      var url = document.location.toString();
      if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
      }

      // Change hash for page-reload
      $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
        window.scrollTo(0,0);
      })
    </script>
  </body>
</html>
<?php } else {
  header("Location: ../admin/login.php");
} ?>
