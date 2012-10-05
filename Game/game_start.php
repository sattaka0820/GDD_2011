<?php
$handle = fopen('input_data', 'r');
if ($handle) {
	$i = 0;
	while (($buffer = fgets($handle, 4096)) !== false) {
		if ($i == 0) {
		} elseif ($i % 2 == 1) {
		} else {
			$data = str_replace(' ', ',', $buffer);                                                                                    
			$data = trim($data, "\n");                                                                                                 
			$cmd = sprintf('php game.php %s >> result.txt 2>&1', $data);                                                               
			passthru($cmd);
		}
		$i++;
	}

	if (!feof($handle)) {
		echo "Error: unexpected fgets() fail\n";
	}

	fclose($handle);
}
