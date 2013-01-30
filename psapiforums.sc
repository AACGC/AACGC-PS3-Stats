if ($pref['psapi_enable_forums'] == "1"){

global $post_info, $sql;
$postowner  = $post_info['user_id'];

$sql->db_Select("user_extended", "*", "user_extended_id='".intval($postowner)."'");
$row = $sql->db_Fetch();

$psusername = "".$row['user_ps3api']."";
if ($psusername != ""){

$response = file_get_contents('http://api.ps3heroes.com/api/hero/'.$psusername.'');
$data = json_decode($response, true);
$url = 'http://api.ps3heroes.com/api/hero/'.$psusername.''; 
$cache_age = 60*30; # 30 minutes 
$filename = 'tmp/trophy/cache.' . md5($url); 
$data = null; 
if(file_exists($filename))  
$stat = stat($filename); 
$age = time() - $stat['ctime']; 
if($age < $cache_age)  
$data = file_get_contents($filename); 
$data = unserialize($data); 
if(is_null($data))  
$response = file_get_contents($url); 
$data = json_decode($response, true); 
if($data)  
file_put_contents($filename, serialize($data)); 
$platinum = $data['trophies']['platinum']; 
$gold = $data['trophies']['gold']; 
$silver = $data['trophies']['silver']; 
$bronze = $data['trophies']['bronze']; 
$all = $platinum + $gold + $silver + $bronze;



$psapiforums = "
<div style='background-image: url(".e_PLUGIN."aacgc_psapi/images/ps3stats_badgebg.jpg); width:200px; height:125px'>
	<table style='width:100%' cellspacing='6' cellpadding='6'>
		<tr>
			<td colspan='4'>
					<a href='".e_PLUGIN."aacgc_psapi/PS3API_Details.php?det.".$postowner."'><b>".$psusername."</b></a>
			</td>
		</tr>
		<tr valign='top'>
			<td style='text-align:left' colspan='2'>
				<a href='".$data['url']."' target='_blank'><img width='50px' src='".$data['avatar']."'/></a>
			</td>
			<td colspan='2' style='text-align:right'>
				Total: ".$all."
			</td>
		</tr>
		<tr valign='top'>

			<td style='width:; text-align:center'>".$bronze."</td>
			<td style='width:; text-align:center'>".$silver."</td>
			<td style='width:; text-align:center'>".$gold."</td>
			<td style='width:; text-align:center'>".$platinum."</td>
		</tr>
	</table>
</div>
";
}

return "".$psapiforums."";
}