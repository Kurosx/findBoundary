<?php 

$mbox = file_get_contents('03-zone2015_at_free.fr_INBOX.mbox');

function findBoundary($mbox){
	if (preg_match('/boundary=(.*)/i', $mbox, $matches)) {
	    echo $matches[1];

	    $messages = explode("--{$matches[1]}--", $mbox);
	    $messages[0] .= "\r\n--{$matches[1]}--\r\n";
	    //echo count($messages)-1;
	    return $messages;
	}
}

$i=0;
while ($mbox == true) {
	$messages = findBoundary($mbox);
	echo '<p>'.$messages[0].'</p><hr>';
	$mbox = !empty($messages[1]) ? $messages[1] : false;
	$i++;
}
echo $i.' mails dans cette archive';
?>
