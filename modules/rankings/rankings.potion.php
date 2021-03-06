<?php
$consult = 
"
	SELECT 
		`login`.`pais`,`char`.`name`, `char`.`char_id`,`char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`online`, 
		`char`.`last_map`, `char`.`fame`, `guild`.`name` AS `gname`, `login`.`sex`, `guild`.`guild_id` 
	FROM `char` 
	LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id` 
	LEFT JOIN `guild` ON `guild`.`guild_id` = `char`.`guild_id` 
	WHERE 
		`login`.".$FNC->get_emulator_query()." < 80
	AND 
		`login`.`state` = '0' 
	AND 
		(`char`.`class` = '18' OR `char`.`class` = '4019') 
	AND 
		`char`.`fame` > 0 
	ORDER BY 
		`char`.`fame` DESC, 
		`char`.`base_level` DESC, 
		`char`.`base_exp` DESC, 
		`char`.`job_level` DESC, 
		`char`.`job_exp` 
	DESC LIMIT 0, 25
";

$result = $DB->execute($consult);

$FNC->CreateOboroTitle("fa-hand-pointer-o", "Ranking Potion");
$FNC->CreateOboroDataTable(
	array(
		'pais'			=>	'Country',	
		'sex' 			=>	'Gender', 
		'name'			=>	'Name', 
		'gname'			=>	'Guild Name', 
		'class'			=>	'Job Class', 
		'base_level'	=>	'Base Lv.',
		'job_level'		=>	'Job Lv.',
		'fame'			=>	'Points',
		'last_map'		=>	'Last Seen',
		'online'		=>	'State'
	), $result
);
$DB->free($result);
echo '</div>';
?>