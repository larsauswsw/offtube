<?php

//SET XML HEADER
header('Content-type: text/xml');

//CONSTRUCT RSS FEED HEADERS
$output = '<rss version="2.0">';
$output .= '<channel>';
$output .= '<title>Hundertneun</title>';
$output .= '<description>hundertneun video and audio</description>';
$output .= '<link>http://www.hundertneun.de/</link>';
$output .= '<copyright>No copyright</copyright>';


$files = array();
$dir=opendir("./");

while(($file = readdir($dir)) !== false)  
{  
	if($file == "index.php" || $file == '.' || $file == '..' || is_dir($file) ) {
		continue; 
	}

	$output .= '<item>';
    $output .= '<title>'. htmlspecialchars($file) .'</title>';
    $output .= '<enclosure url="http://hundertneun.de/media/'.rawurlencode($file).'" length="'.filesize($file).'" type="'.mime_content_type($file).'"/>'; 
    $output .= '<pubDate>'.date("F d Y H:i:s.", filectime($file)).'</pubDate>';
	$output .= '</item> ';
}
closedir($dir);

//CLOSE RSS FEED
$output .= '</channel>';
$output .= '</rss>';

echo($output);
?>
	