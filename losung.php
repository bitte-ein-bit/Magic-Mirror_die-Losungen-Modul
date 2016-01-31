<?php
/* From http://php.net/manual/de/function.htmlentities.php#97215 */
function philsXMLClean($strin) {
        $strout = null;

        for ($i = 0; $i < strlen($strin); $i++) {
                $ord = ord($strin[$i]);

                if (($ord > 0 && $ord < 32) || ($ord >= 127)) {
                        $strout .= "&#{$ord};";
                }
                else {
                        switch ($strin[$i]) {
                                case '<':
                                        $strout .= '&lt;';
                                        break;
                                case '>':
                                        $strout .= '&gt;';
                                        break;
                                case '&':
                                        $strout .= '&amp;';
                                        break;
                                case '"':
                                        $strout .= '&quot;';
                                        break;
                                default:
                                        $strout .= $strin[$i];
                        }
                }
        }

        return $strout;
}

if (file_exists("losungen.csv")) {
	if (($handle = fopen("losungen.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
			if ($data[0] == date('d.m.Y')) {
				$json = array(
					"Sonntag" => philsXMLClean($data[2]),
					"Losungsvers" => philsXMLClean($data[3]),
					"Losungstext" => preg_replace('/\/(.*)\//', '<i>\1</i>', philsXMLClean($data[4])),
					"Lehrtextvers" => philsXMLClean($data[5]),
					"Lehrtext" => preg_replace('/\/(.*)\//', '<i>\1</i>', philsXMLClean($data[6])),
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