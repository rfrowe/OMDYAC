<?php
	if(isset($_POST['form-selector'])) {
		include("entryList.php");
	} else {
		if(true) {
			include("sorter.php");
		} else {
			header("location:/");
		}
	}
?>
