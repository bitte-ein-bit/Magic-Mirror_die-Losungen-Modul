<?php
if (file_exists("losungen.csv")) {
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
				header('Content-Type: application/json');
				echo json_encode($json);
				break;
			}
		}
		fclose($handle);
		return '';
	}
}
header('HTTP/1.1 500 Internal Server Error');
echo 'failed to open losungen.csv';