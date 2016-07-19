<?php
  include("connection.php");

  // Start XML file, create parent node
  $dom = new DOMDocument("1.0");
  $node = $dom->createElement("markers");
  $parnode = $dom->appendChild($node);

  // Opens a connection to a MySQL server
  // Set the active MySQL database
  $link = dbConnect();

  // Select all the rows in the markers table
  $sql = "select * from usaha u join sektor_usaha s on u.id_sektor = s.id_sektor";
  $res = $link->query($sql);
  if (!$res) {
    die('Invalid query: ' . mysqli_error());
  }

  header("Content-type: text/xml");

  // Iterate through the rows, adding XML nodes for each
  while ($row = mysqli_fetch_array($res)) {
    // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['nama_usaha']);
  $newnode->setAttribute("address", $row['alamat']);
  $newnode->setAttribute("lat", $row['latitude']);
  $newnode->setAttribute("lng", $row['longitude']);
  $newnode->setAttribute("type", $row['nama_sektor']);
  }

  echo $dom->saveXML();

?>
