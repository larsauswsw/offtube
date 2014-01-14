<?php

//SET XML HEADER
header('Content-type: text/xml');

//CONSTRUCT RSS FEED HEADERS
$output = '<rss version="2.0">';
$output .= '<channel>';
$output .= '<title>lars.is - watch later</title>';
$output .= '<description>lars.is - watch later</description>';
$output .= '<link>http://www.lars.is/youtube/</link>';
$output .= '<copyright>No copyright</copyright>';


$files = array();
$dir=opendir("./");

while(($file = readdir($dir)) !== false)  
{  
	if($file == "index.php" || $file == "youtube-dl" || $file == "youtube.sh" || $file == ".htaccess" || $file == '.' || $file == '..' || is_dir($file) ) {
		continue; 
	}

	$output .= '<item>';
    $output .= '<title>'. htmlspecialchars($file) .'</title>';
    $output .= '<enclosure url="http://lars.is/youtube/'.rawurlencode($file).'" length="'.filesize($file).'" type="'.mime_content_type($file).'"/>'; 
    $output .= '<pubDate>'.date("F d Y H:i:s.", filectime($file)).'</pubDate>';
	$output .= '</item> ';
}
closedir($dir);

//CLOSE RSS FEED
$output .= '</channel>';
$output .= '</rss>';

echo($output);
?>
	
