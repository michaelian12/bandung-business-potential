var xhr = false;

function updateVillage() {
	if (window.XMLHttpRequest) { // if browser recognize XMLHttpRequest then
		xhr = new XMLHttpRequest(); // create new object (XMLHttpRequest)
	}
	else { // Jika browser tidak mengenal XMLHttpRequest
		if (window.ActiveXObject) {  // if browser recognize ActiveXObject (usually IE6)
			try {
				xhr = new ActiveXObject("Microsoft.XMLHTTP"); // create new object (ActiveXObject)
			}
			catch (e) { }
		}
	}

	if (xhr) {
		xhr.onreadystatechange = createSelection(); // call function when XMLHttpRequest status changed
		xhr.open("GET", "../libs/village.php?id=" + document.getElementById("district").value, true);
		xhr.send(null); // do request
	}
	else {
		document.getElementById("isi").innerHTML = "Sorry , your browser does not support AJAX";
	}
}

function createSelection() {
	if (xhr.readyState == 4) {
		if (xhr.status == 200) {
			var responseServer = xhr.responseText; // get responseText
			var arrVillage = responseServer.split('|'); // Split response by "|" mark
			var i;
			var selectVillage = document.getElementById("village"); // get village object
			var villageData;

			// clear selection
			while (selectVillage.length > 1) {
				selectVillage.remove(1); // hapus option pada posisi 2
			}

			// fill selection
			for (i = 0; i < arrVillage.length-1; i++) {
					villageData = arrVillage[i].split(";");
					var option = document.createElement("option");
					option.value = villageData[0]; // id_kelurahan
					option.text = villageData[1]; // nama_kelurahan
					try {
						 selectVillage.add(option, null);
					} catch(e) {
						selectVillage.add(option); // for IE
					}
			}
		} else {
			document.getElementById("isi").innerHTML = "There is a problem in the request with code " + xhr.status + "(" + xhr.statusText + ")";
		}
	}
}
