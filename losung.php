<?php
if (($handle = fopen("losungen.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
		if ($data[0] == date('d.m.Y')) {
			$json = array(
				"Sonntag" => htmlentities($data[2]),
				"Losungsvers" => htmlentities($data[3]),
				"Losungstext" => preg_replace('/\/(.*)\//', '<i>\1</i>', htmlentities($data[4])),
				"Lehrtextvers" => htmlentities($data[5]),
				"Lehrtext" => preg_replace('/\/(.*)\//', '<i>\1</i>', htmlentities($data[6])),
			);
			echo json_encode($json);
		}
	}
	fclose($handle);
}