<?php
/*$this_page = basename($_SERVER['REQUEST_URI']);
if (strpos($this_page, "?") !== false) $this_page = reset(explode("?", $this_page));
echo $this_page;*/
if(isset($_GET['e'])) {
	include 'single.php';
} else {
	include 'list.php';
}

?>
