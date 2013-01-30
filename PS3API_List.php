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

//-------------------------Title--------------------------------+

$title .= "".$pref['psapi_pagetitle']."";

//-------------------------------------------------------------------+


$text .= "<table style='width:95%' class=''>
          <tr><td style='' class=''><center>
          <a href='http://ps3heroes.com/' target='_blank'><img src='".e_PLUGIN."aacgc_psapi/images/PS3Heros.jpg'></img></a><br>
          <font size='1'>All about Games and Trophies for your Playstation 3</font>
          </center></td></tr></table><br><br><br>";





//-------------------------Info Section-------------------+

$text .= "
<table style='width:95%' class=''><tr>
<td class='forumheader3' style='width:100%'><b>User:</b></td>
<td class='forumheader3' style='width:0%'>Bronze:</td>
<td class='forumheader3' style='width:0%'>Silver:</td>
<td class='forumheader3' style='width:0%'>Gold:</td>
<td class='forumheader3' style='width:0%'>Platinum:</td>
<td class='forumheader3' style='width:0%'>Total:</td>
<td class='forumheader3' style='width:0%'></td>
</tr>";


        $sql ->db_Select("user_extended", "*", "ORDER BY user_extended_id ASC", "");
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
$link = "<a href='".e_PLUGIN."aacgc_psapi/PS3API_Details.php?det.".$userid."'><img src='".e_PLUGIN."/aacgc_psapi/images/statslink.jpg'></img></a>";
if ($pref['psapi_enable_names'] == "1")
{$psname = "(".$psusername.")";}

$text .= "<tr>";
$text .= "<td class='indent'><a href='".e_BASE."user.php?id.".$userid."'>".$uavatar." ".$username." ".$psname."</a></td>";
$text .= "<td class='indent'>".$bronze."";
$text .= "<td class='indent'>".$silver."";
$text .= "<td class='indent'>".$gold."";
$text .= "<td class='indent'>".$platinum."</td>";
$text .= "<td class='indent'>".$all."</td>";
$text .= "<td class='indent'>".$link."</td>";

$text .= "</tr>";}}




$text .= "</table>";





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
