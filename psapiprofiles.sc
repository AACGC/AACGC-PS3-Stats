if ($pref['psapi_enable_profiles'] == "1"){

global $sql,$sql2,$user; 

$suser = "";
$USER_ID = "";


$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
	if ($suser[1] == 'php?id') {
	$suser = $suser[2];}

$SUSER_ID = $suser;

if (USER){


//----------------------------------------------------------------

$sql->db_Select("user_extended", "*", "user_extended_id='".intval($SUSER_ID)."'");
$row = $sql->db_Fetch();

$psusername = "".$row['user_ps3api']."";

if ($psusername == ""){}         

else

{$response = file_get_contents('http://api.ps3heroes.com/api/hero/'.$psusername.'');
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


$psapiprofiles = "
<div style='background-image: url(".e_PLUGIN."aacgc_psapi/images/ps3stats_badgebg_large.jpg); width:400px; height:125px'>
	<table style='width:100%' cellspacing='6' cellpadding='6'>
		<tr>
			<td style='width:300px'>
					<a href='".e_PLUGIN."aacgc_psapi/PS3API_Details.php?det.".$SUSER_ID."'><b>".$psusername."</b></a>
			</td>
			<td style='width:100px; text-align:right'>
				Total: ".$all."
			</td>
		</tr>
		<tr valign='top'>
			<td style='width:; text-align:left' rowspan='4'>
				<a href='".$data['url']."' target='_blank'><img width='75px' src='".$data['avatar']."'/></a>
			</td>
			<td style='width:; text-align:center'>".$bronze."</td>
		</tr>
		<tr>			
			<td style='width:; text-align:center'>".$silver."</td>
		</tr>
		<tr>			
			<td style='width:; text-align:center'>".$gold."</td>
		</tr>
		<tr>
			<td style='width:; text-align:center'>".$platinum."</td>
		</tr>
	</table>
</div>
";}



return "<tr><td class='forumheader3' colspan='2'>".$psapiprofiles."</td></tr>";}}
