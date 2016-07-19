<?php
	session_start();
	include("libs/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bandung Business Potential - Home</title>
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
    <script type="text/javascript" src="js/maps.api.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvXxoC8wGKiCUSY-FZTENW0z6P2fRrikg&libraries=geometry&v=3&callback=initMap">
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
            <li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>Home</a></li>
            <?php
              if (($_SESSION['alreadyLogged'] == true) && ($_SESSION['ktp'] != "")) {
            ?>
						<li><a href="business.php"><i class="fa fa-database fa-fw"></i>Business</a></li>
            <li><a href="profile.php"><i class="fa fa-user fa-fw"></i>Profile</a></li>
            <li><a href="libs/logout.php"><i class="fa fa-sign-out fa-fw"></i>Log Out</a></li>
						<?php
							} else {
						?>
						<li><a href="signup.php"><i class="fa fa-user-plus fa-fw"></i>Sign Up</a></li>
		      	<li><a href="login.php"><i class="fa fa-sign-in fa-fw"></i>Log In</a></li>
						<?php
							}
						?>
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
            <!-- first widget -->
            <div class="templatemo-content-widget col-1 black-bg">
              <i class="fa fa-times"></i>
              <div class="media">
                <div class="media-body">
                  <h2 class="media-heading text-uppercase">Filter</h2><hr>
                  <h3 class="text-uppercase">Region</h3>
                  <select id="district" name="district" class="form-control" style="margin-top:10px;">
										<?php
											$link = dbConnect();
											$sqlDis = "select * from kecamatan order by nama_kecamatan";
											$resDis = $link->query($sqlDis);
											while ($rowDis = mysqli_fetch_array($resDis)) {
												echo "<option value=\"".$rowDis['id_kecamatan']."\">".$rowDis['nama_kecamatan']." </option>";
											}
											mysqli_close($link);
										?>
                  </select><br>
                  <select id="village" name="village" class="form-control">
										<?php
											$link = dbConnect();
											$sqlVil = "select * from kelurahan order by nama_kelurahan";
											$resVil = $link->query($sqlVil);
											while ($rowVil = mysqli_fetch_array($resVil)) {
												echo "<option value=\"".$rowVil['id_kelurahan']."\">".$rowVil['nama_kelurahan']." </option>";
											}
											mysqli_close($link);
										?>
                  </select><br>
                  <h3 class="text-uppercase">Business Sector</h3>
                  <select class="form-control" style="margin-top:10px;">
										<?php
											$link = dbConnect();
											$sqlSec = "select * from sektor_usaha order by nama_sektor";
											$resSec = $link->query($sqlSec);
											while ($rowSec = mysqli_fetch_array($resSec)) {
												echo "<option value=\"".$rowSec['id_sektor']."\">".$rowSec['nama_sektor']." </option>";
											}
											mysqli_close($link);
										?>
                  </select><br>
                  <input id="show-listings" type="button" class="templatemo-green-button" value="Show Listings">
                  <input id="hide-listings" type="button" class="templatemo-black-button" value="Hide Listings"><br>
                </div>
              </div>
            </div>
            <!-- second widget -->
            <div class="templatemo-content-widget white-bg col-2" style="height:450px;">
              <div id="map" class="map"></div>
            </div>
          </div>

          <div class="templatemo-flex-row flex-content-row">
            <!-- first widget -->
						<div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="media margin-bottom-30">
                <div class="media-body">
                  <h2 class="media-heading text-uppercase blue-text">McDonald's</h2>
                  <p>Jl. Jend. Gatot Subroto no. 160</p>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><div class="circle green-bg"></div></td>
                      <td>Main Product</td>
                      <td>Food & Drinks</td>
                    </tr>
                    <tr>
                      <td><div class="circle pink-bg"></div></td>
                      <td>Phone Number</td>
                      <td>(022) 7313333</td>
                    </tr>
                  </tbody>
                </table>
              </div><br><br><hr>
							<div class="media-left padding-right-25">
								<a href="#">
									<img class="media-object img-circle templatemo-img-bordered" src="images/person.jpg" alt="Sunset">
								</a>
							</div>
							<div class="media-body">
								<h2 class="media-heading text-uppercase blue-text">John Barnet</h2>
								<p>Owner</p>
							</div>
            </div>

						<!-- second widget -->
						<div id="pano" class="templatemo-content-widget white-bg col-1 text-center" style="height:450px;">
              <div class="street-view"><p class="text-uppercase">Street view will appear once you choose a location</p></div>
            </div>

          </div> <!-- Second row ends -->

          <footer class="text-right">
            <p>Copyright &copy; 2016 Bandung Business Potential</p>
          </footer>
        </div>
      </div>
    </div>

    <!-- JS -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#district').on('change', function() {
					var id_kecamatan = $(this).val();
					if (id_kecamatan) {
						$.ajax({
							type: 'POST',
							url: 'libs/village.php',
							data: 'id=' + id_kecamatan,
							success: function(html) {
								$('#village').html(html);
							}
						});
					} else {
						$('#village').html('<option value="">Select district first</option>');
					}
				});
			});
		</script>

		<!--<script src="js/ajax.js"></script>																					<!-- AJAX -->
    <script src="js/jquery-1.11.2.min.js"></script>      												<!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> 											<!--  jQuery Migrate Plugin -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>
