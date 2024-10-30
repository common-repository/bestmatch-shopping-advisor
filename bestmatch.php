<?php   
    /* 
    Plugin Name: BestMatch Shopping Advisor
    Plugin URI: http://bestmat.ch 
    Description: Use the <a href="http://bestmat.ch">BestMatch</a> plug-in to help your readers find the best products for them, and <strong>make money</strong> along the way.
    Author: BestMatch
    Version: 1.2.3
    Author URI: http://bestmat.ch 
    */  
global $script_domain;
// update_option("bm_script_domain","localhost:3000");
// update_option("bm_script_domain","app.bestmat.ch");

if (get_option("bm_script_domain",false) != false) {
  $script_domain = get_option("bm_script_domain");
}else {
  $script_domain = "wp.bestmat.ch";
}
include('stathat.php');
include('bm_site_script.php');

include('admin/bm_admin_stats.php');
include('admin/bm_admin_activate_message.php');
// include('admin/bm_admin_update.php');
include('admin/bm_admin_settings_hook.php');
echo $cat_settings[$name]["pages"]
?>
