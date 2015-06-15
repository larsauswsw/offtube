<?php

//SET XML HEADER
header('Content-type: text/xml');

//CONSTRUCT RSS FEED HEADERS
$output = '<rss version="2.0">';
$output .= '<channel>';
$output .= '<title>lars.is - watch later</title>';
$output .= '<description>lars.is - watch later</description>';
$output .= '<link>http://www.lars.is/offtube/</link>';
$output .= '<copyright>No copyright</copyright>';
$output .= '<image>';
$output .= '<url>http://s.ytimg.com/yts/img/youtube_logo_stacked-vfl225ZTx.png</url>';
$output .= '<title>W3Schools.com</title>';
$output .= '<link>http://www.w3schools.com</link>';
$output .= '</image>';


$files = array();
$dir=opendir("./");

while(($file = readdir($dir)) !== false)  
{  
	if($file == "index.php" || $file == "youtube-dl" || $file == "youtube.sh" || $file == ".htaccess" || $file == '.' || $file == '..' || is_dir($file) ||  strpos($file, ".part") !== false || strpos($file, ".swp") ) {
		continue; 
	}

	$output .= '<item>';
    $output .= '<title>'. htmlspecialchars($file) .'</title>';
    $output .= '<enclosure url="http://lars.is/offtube/'.rawurlencode($file).'" length="'.filesize($file).'" type="'.mime_content_type($file).'"/>'; 
    $output .= '<pubDate>'.date(DATE_RSS, filemtime($file)).'</pubDate>';
//    $output .= '<pubDate>'.date("F d Y H:i:s.", filemtime($file)).'</pubDate>';
//$output .= '<pubDate>'.date("F d Y H:i:s.", filectime($file)).'</pubDate>';
	$output .= '</item> ';
}
closedir($dir);

//CLOSE RSS FEED
$output .= '</channel>';
$output .= '</rss>';

echo($output);
?>
	
