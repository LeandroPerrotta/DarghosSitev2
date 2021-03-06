<?php 
$world = $tools->getServerByName($_GET['name']);

$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="4">
						'.$trans_subTopicPages['server.info'][$g_language].' - '.$world['name'].'
					</td>
				</tr>						
				<tr>
					<td class="tableContLight" width="25%">Status:</td>
					<td class="tableContLight">
						'.(((int)$world['status'] == 1) ? "Online" : "Offline").'
					</td>
				</tr>
				<tr>
					<td class="tableContDark" width="25%">'.$trans_texts['ip_address'][$g_language].':</td>
					<td class="tableContDark">
						'.$world['public_ip'].'
					</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['port'][$g_language].':</td>
					<td class="tableContLight">
						'.$world['port'].'
					</td>
				</tr>				
				<tr>
					<td class="tableContDark" width="25%">'.$trans_texts['players'][$g_language].':</td>
					<td class="tableContDark">
						'.$world['players'].'
					</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['max'][$g_language].':</td>
					<td class="tableContLight">
						'.$world['max'].'
					</td>
				</tr>
				<tr>
					<td class="tableContDark" width="25%">'.$trans_texts['record'][$g_language].':</td>
					<td class="tableContDark">
						'.$world['record'].'
					</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['recordIn'][$g_language].':</td>
					<td class="tableContLight">
						'.date("d/m/Y H:i", $world['recordIn']).'
					</td>
				</tr>
				<tr>
					<td class="tableContDark" width="25%">'.$trans_texts['monsters'][$g_language].':</td>
					<td class="tableContDark">
						'.$world['monsters'].'
					</td>
				</tr>
			 </table><br /><br />';

$DB->query("SELECT 
				online.name, player.vocation, player.level
			FROM 
				whoisonline as online, 
				characterlist as player 
			WHERE 
				online.world_id = '".$world['id']."' AND
				online.name = player.name AND
				online.world_id = player.world_id
			GROUP BY
				online.name
			ORDER BY online.name ASC");
if($DB->num_rows() > 0) {
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" width="5%">#</td>
						<td class="tableTop" width="50%">'.$trans_texts['name'][$g_language].'</td>
						<td class="tableTop" width="30%">'.$trans_texts['vocation'][$g_language].'</td>
						<td class="tableTop" width="7%">'.$trans_texts['level'][$g_language].'</td>
					</tr>';
	$i = 0;
	while($player = $DB->fetch()) {
		$tdStyle = ($i % 2 == 0) ? 'tableContDark' : 'tableContLight';
		$i++;
		$content .= '<tr>
						<td class="'.$tdStyle.'" width="5%">'.$i.'</td>
						<td class="'.$tdStyle.'" width="50%">
							<a href="?act=character.details&name='.$player->name.'">'.$player->name.'</a>
						</td>
						<td class="'.$tdStyle.'" width="30%">'.$trans_texts['vocations'][$player->vocation].'</td>
						<td class="'.$tdStyle.'" width="7%">'.$player->level.'</td>
					</tr>';
	}
	$content .= '</table>';
}
?>