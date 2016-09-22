<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script
 
$path = "C:\\wamp\\www\\OpenPittsburgh\\public_html\\xml\\"; // change the path to fit your websites document structure
 
$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $_GET['download_file']); // simple file name validation
$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
$fullPath = $path.$dl_file;
 
if ($fd = fopen ($fullPath, "r")) {
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
        break;
        // add more headers for other content types here
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
        break;
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
exit;

//<a href="http://mydomain.com/download.php?download_file=some_file.pdf">PHP download file</a>
/*
 * ignore_user_abort(true);
set_time_limit(0); 
$path = "/absolute_path_to_your_files/";
 
$secret = 'your-secret-string';
 
if (isset($_GET['fid']) && preg_match('/^([a-f0-9]{32})$/', $_GET['fid'])) {
	$db = new mysqli('localhost', 'username', 'password', 'databasename');
	$result = $db->query(sprintf("SELECT filename FROM mytable WHERE MD5(CONCAT(ID, '%s')) = '%s'", $secret, $db->real_escape_string($_GET['fid'])));
	if ($result_>num_rows == 1) {
		$obj = $result->fetch_object();
		$fullPath = $path.$obj->filename;
		if ($fd = fopen ($fullPath, "r")) {
			//
			// the other PHP download code
			//
		}
		fclose ($fd);
		exit;
	} else {
		die('no match');
	}
} else {
	die('missing file ID');
}
 * http://www.web-development-blog.com/archives/php-download-file-script/
 * $file_id = 123; // or something else you got from your MySQL database
$slug = md5($secret.$file_id);
 
echo '
<a href="http://mydomain.com/dowload.php?fid='.$slug.'">PHP download file via MySQL</a>';
 */