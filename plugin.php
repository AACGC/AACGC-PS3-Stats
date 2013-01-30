<?php

if (!defined('e107_INIT'))
{exit;}

/*
#######################################
#     e107 website system plguin      #
#     AACGC PS3                       #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC PS3 Stats";
$eplug_version = "1.6";
$eplug_author = "M@CHIN3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "AACGC PS3 Stats allows users to enter their PS3 name in their profiles and user can see all their stats.";
$eplug_compatible = "e107v7";
$eplug_readme = ""; 
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "aacgc_psapi";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_main.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/ps3api_32.png";
$eplug_icon_small = $eplug_folder . "/images/ps3api_16.png";
$eplug_icon_custom = e_PLUGIN . "aacgc_psapi/images/ps3api_64.png";

$eplug_caption = "AACGC PS3 Stats";

$eplug_prefs = array(
"psapi_pagetitle" => "Member PS3 Stats",
"psapi_menutitle" => "Member PS3 Stats",
"psapi_menuheight" => "200",
"psapi_scrollspeed" => "3",
"psapi_scrollover" => "0",
"psapi_scrolldirection" => "up",
"psapi_uavatar_size" => "25",
"psapi_enable_gold" => "0",
"psapi_enable_uavatar" => "1",
"psapi_enable_forums" => "1",
"psapi_enable_profiles" => "1",
"psapi_enable_names" => "0",
);


$eplug_table_names = "";
$eplug_tables = "";


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Members PS3 Stats";
$eplug_link_url = "".e_PLUGIN."aacgc_psapi/PS3API_List.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Install Complete - Now you need to create an extended user field called user_ps3api in Extend Fields area";

// upgrading ... //
$upgrade_add_prefs = array(
"psapi_pagetitle" => "Member PS3 Stats",
"psapi_menutitle" => "Member PS3 Stats",
"psapi_menuheight" => "200",
"psapi_scrollspeed" => "3",
"psapi_scrollover" => "0",
"psapi_scrolldirection" => "up",
"psapi_uavatar_size" => "25",
"psapi_enable_gold" => "0",
"psapi_enable_uavatar" => "1",
"psapi_enable_forums" => "1",
"psapi_enable_profiles" => "1",
"psapi_enable_names" => "0",
);

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";
$eplug_upgrade_done = "Upgrade Complete";

?>
