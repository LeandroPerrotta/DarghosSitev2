<?
$DB->query("SELECT lastUpdate, record, recordIn FROM site.servers_status WHERE server_id = 1");
$fetch = $DB->fetch();

if($fetch->lastUpdate + STATUS_UPDATE < time() or $fetch->lastUpdate == 0)
{
	$ip = $global_cfg['ipnet'];
	$port = $global_cfg['ipport'];

	$info = chr(6).chr(0).chr(255).chr(255).'info'; 
	$sock = @fsockopen($ip, $port, $errno, $errstr, 1); 

	if ($sock) 
	{ 
		$status = 1;
		stream_set_timeout($sock, 5);
		
	    fwrite($sock, $info); 
		
	    while (!feof($sock)) 		 
	        $data .= fgets($sock, 1024);

		if( empty($data) )
			$status = 0;
			
	    fclose($sock); 
	}
	else
		$status = 0;

	$info = array();

	function startElement($parser, $name, $attributes)
	{
	    global $info;

	    switch($name)
	    {
			case 'serverinfo':
			$info['uptime'] = $attributes['uptime'];
			$info['location'] = $attributes['location'];
			$info['version'] = $attributes['version'];
			
			case 'owner':
			$info['name'] = $attributes['name'];
			$info['email'] = $attributes['email'];
			
	        case 'players':
			$info['online'] = $attributes['online'];
			$info['max'] = $attributes['max'];
			$info['peak'] = $attributes['peak'];
	        break;
			
			case 'monsters':
			$info['totalmonsters'] = $attributes['total'];
			break;
	    }
	}

	function endElement($parser, $name)
	{

	}

	$parser = xml_parser_create();
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	xml_set_element_handler($parser, 'startElement', 'endElement');
	xml_parse($parser, $data);
	xml_parser_free($parser);

	$seconds = $info['uptime'] % 60;
	$uptime = floor($info['uptime'] / 60);

	$minutes = $uptime % 60;
	$uptime = floor($uptime / 60);

	$hours = $uptime % 24;
	$uptime = floor($uptime / 24);

	$days = $uptime % 365;
		
	if($fetch->record < $info['peak'])
	{
		$recordIn = time();
		$record = $info['peak'];
	}	
	else
	{
		$recordIn = $fetch->recordIn;
		$record = $fetch->record;
	}	
		
		
	if($days > 0)	
		$uptimeFormat = "".$days."d ".$hours."h ".$minutes."m";
	else
		$uptimeFormat = "".$hours."h ".$minutes."m";
		
	$DB->query("UPDATE site.servers_status SET `status` = ".$status.", `players` = '".$info['online']."', `uptime` = '".$uptimeFormat."', `monsters` = '".$info['totalmonsters']."', `max` = '".$info['max']."', `record` = '".$record."', `recordIn` = '".$recordIn."', `lastUpdate` = ".time()." WHERE `server_id` = 1");
}	
?>