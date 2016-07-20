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
    <title>Bandung Business Potential - Edit Business</title>
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
    <!-- js google maps api -->
    <script type="text/javascript" src="js/maps.geocode.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvXxoC8wGKiCUSY-FZTENW0z6P2fRrikg&v=3&callback=initMap">
    </script>

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
            <li><a href="business.php"class="active"><i class="fa fa-database fa-fw"></i>Business</a></li>
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
                  <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              </div>
            </form>
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <!-- first widget -->
            <div class="templatemo-content-widget col-2 white-bg">
              <i class="fa fa-times"></i>
              <h2 class="margin-bottom-10 text-uppercase">Edit Business</h2><hr>
              <?php
                $link = dbConnect();
                $id_usaha = $_GET['id'];
                $sql = "select * from usaha where id_usaha = '$id_usaha'";
                $res = $link->query($sql);
                if (mysqli_num_rows($res) == 1) {
                  $data = mysqli_fetch_array($res);
              ?>
              <form action="libs/business-edit.php?id=<?php echo $id_usaha; ?>" class="templatemo-login-form" method="post" enctype="multipart/form-data">
                <div class="row form-group">
                  <div class="col-lg-12 form-group">
                    <label>Business Name</label>
                    <input type="text" class="form-control" name="namaUsaha" placeholder="McDonald's" value="<?php echo $data['nama_usaha']; ?>" required="true">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-12 form-group">
                    <label>Main Product</label>
                    <input type="text" class="form-control" name="produkUtama" placeholder="Foods & Drinks" value="<?php echo $data['produk_utama']; ?>" required="true">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-6 col-md-6 form-group">
                      <label>Business Scale</label>
                      <select class="form-control" name="skalaUsaha" required="true">
                        <?php
    											$sqlScale = "select * from skala_usaha";
    											$resScale = $link->query($sqlScale);
    											while ($rowScale = mysqli_fetch_array($resScale)) {
														if ($rowScale['id_skala'] == $data['id_skala']) {
    													echo "<option value=\"".$rowScale['id_skala']."\" selected>".$rowScale['nama_skala']." </option>";
														} else {
															echo "<option value=\"".$rowScale['id_skala']."\">".$rowScale['nama_skala']." </option>";
														}
    											}
    										?>
                      </select>
                  </div>
                  <div class="col-lg-6 col-md-6 form-group">
                      <label>Business Sector</label>
                      <select class="form-control" name="sektorUsaha" required="true">
                        <?php
    											$sqlSector = "select * from sektor_usaha order by nama_sektor";
    											$resSector = $link->query($sqlSector);
    											while ($rowSector = mysqli_fetch_array($resSector)) {
														if ($rowSector['id_sektor'] == $data['id_sektor']) {
															echo "<option value=\"".$rowSector['id_sektor']."\" selected>".$rowSector['nama_sektor']." </option>";
														} else {
															echo "<option value=\"".$rowSector['id_sektor']."\">".$rowSector['nama_sektor']." </option>";
														}
    											}
    										?>
                      </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-12 form-group">
                    <label>Address</label>
                    <div class="input-group">
                      <input id="address" type="text" class="form-control" name="alamat" placeholder="Jl. Jend. Gatot Subroto no. 160"  value="<?php echo $data['alamat']; ?>" required="true">
                      <div class="input-group-addon">
                        <input id="geocode" type="button" class="fa fa-map-marker" style="font-family: FontAwesome" value="&#xf041;">
                      </div>
            		    </div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-6 col-md-6 form-group">
                      <label>District (Kecamatan)</label>
                      <select id="district" class="form-control" name="kecamatan" required="true">
                        <?php
													$id_kelurahan = $data['id_kelurahan'];
													$sqlD = "select * from kelurahan where id_kelurahan = '$id_kelurahan'";
													$resD = $link->query($sqlD);
													if (mysqli_num_rows($resD) == 1) {
														$rowD = mysqli_fetch_array($resD);
														$rowD['id_kecamatan'];
													}

    											$sqlDist = "select * from kecamatan order by nama_kecamatan";
    											$resDist = $link->query($sqlDist);
    											while ($rowDist = mysqli_fetch_array($resDist)) {
														if ($rowDist['id_kecamatan'] == $rowD['id_kecamatan']) {
    													echo "<option value=\"".$rowDist['id_kecamatan']."\" selected>".$rowDist['nama_kecamatan']." </option>";
														} else {
															echo "<option value=\"".$rowDist['id_kecamatan']."\">".$rowDist['nama_kecamatan']." </option>";
														}
    											}
    										?>
                      </select>
                  </div>
                  <div class="col-lg-6 col-md-6 form-group">
                      <label>Village (Kelurahan)</label>
                      <select id="village" class="form-control" name="kelurahan" required="true">
                        <?php
    											$sqlVil = "select * from kelurahan order by nama_kelurahan";
    											$resVil = $link->query($sqlVil);
    											while ($rowVil = mysqli_fetch_array($resVil)) {
														if ($rowVil['id_kelurahan'] == $data['id_kelurahan']) {
    													echo "<option value=\"".$rowVil['id_kelurahan']."\" selected>".$rowVil['nama_kelurahan']." </option>";
														} else {
															echo "<option value=\"".$rowVil['id_kelurahan']."\">".$rowVil['nama_kelurahan']." </option>";
														}
    											}
    										?>
                      </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-12 form-group">
                      <label for="inputUsername">Phone Number</label>
                      <input type="text" class="form-control" name="telepon" placeholder="(022) 7313333" value="<?php echo $data['telepon']; ?>" required="true">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-6 col-md-6 form-group">
                      <label>Latitude</label>
                      <input id="lat" type="text" class="form-control" name="lat" placeholder="-6.925961" value="<?php echo $data['latitude']; ?>" required="true">
                  </div>
                  <div class="col-lg-6 col-md-6 form-group">
                      <label>Longitude</label>
                      <input id="lng" type="text" class="form-control" name="lng" placeholder="107.632100" value="<?php echo $data['longitude']; ?>" required="true">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-12 form-group">
                    <div>
                      <label>Business Status</label>
                      <div class="templatemo-block margin-bottom-5">
                        <input type="radio" id="r1" name="statusUsaha" value="Aktif" <?php if ($data['status'] == "Aktif") { echo "checked"; } ?>>
                        <label for="r1" class="font-weight-400"><span></span>Actived</label>
                      </div>
                      <div class="templatemo-block margin-bottom-5">
                        <input type="radio" id="r2" name="statusUsaha" value="Deaktif" <?php if ($data['status'] == "Deaktif") { echo "checked"; } ?>>
                        <label for="r2" class="font-weight-400"><span></span>Deactived</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-12 form-group">
                    <label class="control-label templatemo-block">Business Image Files</label>
                    <input type="file" id="gambarUsaha" class="filestyle" name="gambarUsaha" data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false">
                    <p>Maximum upload size is 2 MB.</p>
                  </div>
                </div>
                <div class="form-group text-right">
                  <button type="submit" class="templatemo-blue-button">Save</button>
									<button onclick="goBack()" class="templatemo-white-button">Cancel</button>
                </div>
              </form>
              <?php
                }
								mysqli_close($link);
              ?>
            </div>

            <!-- second widget -->
            <div class="templatemo-content-widget white-bg col-2" style="height:500px;">
              <i class="fa fa-times"></i>
              <div id="map" class="map"></div>
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
			function goBack() {
				window.history.back();
			}
    </script>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>  <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>
<?php } else {
  header("Location: ../login.php");
} ?>
