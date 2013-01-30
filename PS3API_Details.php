<?php

/*
#######################################
#     AACGC PS API                    #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if ($pref['psapi_enable_gold'] == "1"){$gold_obj = new gold();}

//--------------------------------------------------------------

$title .= "Member PS3 Details";

//--------------------------------------------------------------

$text .= "<center>[ <a href='PS3API_List.php'>Back To List
</a> ]</center><br><br>";

//--------------------------------------------------------------

$sql ->db_Select("user_extended", "*", "user_extended_id='".intval($sub_action)."'");
$row = $sql->db_Fetch();
$sql2 = new db;
$sql2 ->db_Select("user", "*", "user_id='".intval($row['user_extended_id'])."'");
$row2 = $sql2->db_Fetch();

if ($pref['psapi_enable_gold'] == "1")
{$username = "".$gold_obj->show_orb($row2['user_id'])."";}
else
{$username = "".$row2['user_name']."";}
if ($pref['psapi_enable_uavatar'] == "1"){
if ($row2['user_image'] == "")
{$uavatar = "";}
else
{$useravatar = $row2[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$uavatar = "<img src='".$useravatar."' width=".$pref['psapi_uavatar_size']."px></img>";}}

$psusername = "".$row['user_ps3api']."";
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


$text .= "<table style='width:100%'>";

$text .= "<tr>
<td colspan=3 class='forumheader3'><center><a href='".e_BASE."user.php?id.".$row['user_extended_id']."'>".$uavatar." ".$username."</a></td>

</tr><tr>

<td rowspan=6 class='indent' style='width:0%'><center><a href='".$data['url']."' target='_blank'><img src='".$data['avatar']."'/></a></td>
<td class='indent' style='width:20%'>PS3 Username:</td>
<td class='indent' style='width:80%'>".$psusername."</td>

</tr><tr>

<td class='indent'>Bronze:</td>
<td class='indent'>".$bronze."</td>

</tr><tr>

<td class='indent'>Silver:</td>
<td class='indent'>".$silver."</td>

</tr><tr>

<td class='indent'>Gold:</td>
<td class='indent'>".$gold."</td>

</tr><tr>

<td class='indent'>Platinum:</td>
<td class='indent'>".$platinum."</td>

</tr><tr>

<td class='indent'>Total: </td>
<td class='indent'>".$all."</td>

</tr><tr>

</table><br><br>";
//--------------------------------------

$response = file_get_contents('http://api.ps3heroes.com/api/hero/'.$psusername.'/games'); 
$data = json_decode($response, true); 
$url = 'http://api.ps3heroes.com/api/hero/'.$username.'/games'; 
$cache_age = 60*30; # 30 minutes 
$filename = 'tmp/games/cache.' . md5($url); 
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
if(!$data)
  
$text .= 'No PS3 Information Found For This User'; 

$text .= '';

foreach($data as $item)  

$text .= "<img src='".$item['img']."' width='100' hight='100'><a herf='".$item['url']."' target='_blank'></a>";


//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_psapi/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+




$ns -> tablerender($title, $text);



//----------------------------------------------------------------------------------

require_once(FOOTERF);