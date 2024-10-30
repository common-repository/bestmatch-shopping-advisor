<?php
function bestmatch_admin() {
  include('bm_admin_settings_style.php' );
  include('bm_admin_settings_js.php' );
  include('bm_admin_settings.php' );

}


function bestmatch_plugin_menu() {
  // add_options_page( 'BestMatch Product Recomenadtion', 'BestMatch Product Recomenadtion', 'manage_options', 'bm_admin', 'bm_admin' );
  $url = plugins_url();
  add_menu_page("Page Title", "BestMatch", 'manage_options', "bestmatch_config_menu", 'bestmatch_admin', $url . "/bestmatch-shopping-advisor/images/icon.ico");

}
add_action( 'admin_menu', 'bestmatch_plugin_menu' );


//////    DASHBOARD WIDGET   /////////
// function dashboard_widget_function() {
//   echo "Hello World, this is my first Dashboard Widget!";
// }

// function add_dashboard_widgets() {
//   wp_add_dashboard_widget('dashboard_widget', 'Example Dashboard Widget', 'dashboard_widget_function');
// }


// add_action('wp_dashboard_setup', 'add_dashboard_widgets' );
//////    DASHBOARD WIDGET   /////////




?>
