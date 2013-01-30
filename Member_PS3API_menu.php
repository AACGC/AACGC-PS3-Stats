<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC PS3 API                   #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

if ($pref['psapi_enable_gold'] == "1"){$gold_obj = new gold();}

//-------------------------Menu Title--------------------------------+

$psapi_title .= "".$pref['psapi_menutitle']."";

//-------------------------------------------------------------------+

$psapi_text .= "

<script type=\"text/javascript\">
function psapiup(){psapi.direction = \"up\";}
function psapidown(){psapi.direction = \"down\";}
function psapistop(){psapi.stop();}
function psapistart(){psapi.start();}
</script>

<table style='width:95%' class=''><tr>
<td class='forumheader3' style='width:50%'><b>Username:</b></td>
<td class='forumheader3' style='width:10%'>B:</td>
<td class='forumheader3' style='width:10%'>S:</td>
<td class='forumheader3' style='width:10%'>G:</td>
<td class='forumheader3' style='width:10%'>P:</td>
<td class='forumheader3' style='width:10%'>T:</td>
</tr></table>

<marquee height='".$pref['psapi_menuheight']."px' id='psapi' scrollamount='".$pref['psapi_scrollspeed']."' onMouseover='this.scrollAmount=".$pref['psapi_scrollover']."' onMouseout='this.scrollAmount=".$pref['psapi_scrollspeed']."' direction='".$pref['psapi_scrolldirection']."' loop='true'>
<table style='width:95%' class=''>";


        $sql ->db_Select("user_extended", "*", "ORDER BY user_extended_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2 ->db_Select("user", "*", "user_id='".intval($row['user_extended_id'])."'");
        $row2 = $sql2->db_Fetch();


        if ($row['user_ps3api'] == ""){$psapi_text .= "";}         
        else{

        if ($pref['psapi_enable_gold'] == "1"){
        $username = "".$gold_obj->show_orb($row2['user_id'])."";}
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

        $userid = "".$row2['user_id']."";
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

$psapi_text .= "<tr>
<td class='forumheader3' style='width:50%; text-align:left'><a href='".e_PLUGIN."aacgc_psapi/PS3API_Details.php?det.".$userid."'>".$uavatar." ".$username."</a></td>";

$psapi_text .= "<td class='indent' style='width:10%'>".$bronze."";
$psapi_text .= "<td class='indent' style='width:10%'>".$silver."";
$psapi_text .= "<td class='indent' style='width:10%'>".$gold."";
$psapi_text .= "<td class='indent' style='width:10%'>".$platinum."</td>";
$psapi_text .= "<td class='indent' style='width:10%'>".$all."</td>";


$psapi_text .= "</tr>";}}


$psapi_text .= "</table></marquee>
<br><br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"Start\" onClick=\"psapistart();\" type=\"button\">
<input class=\"button\" value=\"Stop\" onClick=\"psapistop();\" type=\"button\">
<input class=\"button\" value=\"Up\" onClick=\"psapiup();\" type=\"button\">
<input class=\"button\" value=\"Down\" onClick=\"psapidown();\" type=\"button\">
</center>
</td></tr></table>
<br>
";


$ns -> tablerender($psapi_title, $psapi_text);


?>



