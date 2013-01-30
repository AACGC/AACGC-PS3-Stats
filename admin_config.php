<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC PS3 API                   #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



require_once("../../class2.php");
if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

if (e_QUERY == "update")
{
 
    $pref['psapi_pagetitle'] = $_POST['psapi_pagetitle'];
    $pref['psapi_menutitle'] = $_POST['psapi_menutitle'];
    $pref['psapi_menuheight'] = $_POST['psapi_menuheight'];
    $pref['psapi_scrollspeed'] = $_POST['psapi_scrollspeed'];
    $pref['psapi_scrollover'] = $_POST['psapi_scrollover'];
    $pref['psapi_scrolldirection'] = $_POST['psapi_scrolldirection'];
    $pref['psapi_uavatar_size'] = $_POST['psapi_uavatar_size'];


if (isset($_POST['psapi_enable_gold'])) 
{$pref['psapi_enable_gold'] = 1;}
else
{$pref['psapi_enable_gold'] = 0;}

if (isset($_POST['psapi_enable_uavatar'])) 
{$pref['psapi_enable_uavatar'] = 1;}
else
{$pref['psapi_enable_uavatar'] = 0;}

if (isset($_POST['psapi_enable_forums'])) 
{$pref['psapi_enable_forums'] = 1;}
else
{$pref['psapi_enable_forums'] = 0;}

if (isset($_POST['psapi_enable_profiles'])) 
{$pref['psapi_enable_profiles'] = 1;}
else
{$pref['psapi_enable_profiles'] = 0;}

if (isset($_POST['psapi_enable_names'])) 
{$pref['psapi_enable_names'] = 1;}
else
{$pref['psapi_enable_names'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC PS3 API(settings)";
//--------------------------------------------------------------------





$text .= "
<form method='post' action='" . e_SELF . "?update' id='confnwb'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'><b>Main Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='psapi_pagetitle' value='" . $tp->toFORM($pref['psapi_pagetitle']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Stats In Forum Posts:</td>
		        <td colspan=2 class='forumheader3'>".($pref['psapi_enable_forums'] == 1 ? "<input type='checkbox' name='psapi_enable_forums' value='1' checked='checked' />" : "<input type='checkbox' name='psapi_enable_forums' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Stats In Profiles:</td>
		        <td colspan=2 class='forumheader3'>".($pref['psapi_enable_profiles'] == 1 ? "<input type='checkbox' name='psapi_enable_profiles' value='1' checked='checked' />" : "<input type='checkbox' name='psapi_enable_profiles' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show PS3 Username Beside Website Usernames:</td>
		        <td colspan=2 class='forumheader3'>".($pref['psapi_enable_names'] == 1 ? "<input type='checkbox' name='psapi_enable_names' value='1' checked='checked' />" : "<input type='checkbox' name='psapi_enable_names' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Website Avatars Beside Usernames:</td>
		        <td colspan=2 class='forumheader3'>".($pref['psapi_enable_uavatar'] == 1 ? "<input type='checkbox' name='psapi_enable_uavatar' value='1' checked='checked' />" : "<input type='checkbox' name='psapi_enable_uavatar' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Website Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='psapi_uavatar_size' value='" . $tp->toFORM($pref['psapi_uavatar_size']) . "' /></td>
	        </tr>



		<tr>
			<td colspan='3' class='fcaption'><b>Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='psapi_menutitle' value='" . $tp->toFORM($pref['psapi_menutitle']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='psapi_menuheight' value='" . $tp->toFORM($pref['psapi_menuheight']) . "' />px</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Scrolling Direction: (Effects both Game List and User List Menus)</td>
                        <td style='width:' class=''>
                        <select name='psapi_scrolldirection' size='1' class='tbox' style='width:15%'>
                        <option name='psapi_scrolldirection' value='".$pref['psapi_scrolldirection']."'>".$pref['psapi_scrolldirection']."</option>
                        <option name='psapi_scrolldirection' value='up'>up</option>
                        <option name='psapi_scrolldirection' value='down'>down</option>
                        </td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Scrolling Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='psapi_scrollspeed' value='" . $tp->toFORM($pref['psapi_scrollspeed']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Scrolling Mouseover Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='psapi_scrollover' value='" . $tp->toFORM($pref['psapi_scrollover']) . "' /></td>
	        </tr>



		<tr>
			<td colspan='3' class='fcaption'><b>Extra Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Gold Orbs As Usernames: (Must Have Gold Orbs Installed!)</td>
		        <td colspan=2 class='forumheader3'>".($pref['psapi_enable_gold'] == 1 ? "<input type='checkbox' name='psapi_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='psapi_enable_gold' value='0' />")."</td>
	        </tr>



                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";



$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
