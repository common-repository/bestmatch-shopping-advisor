<?php
function bestmatch_plugin_deactivation() {
  bestmatch_stathat_ez_count('BestMatch', 'BestMatch WP - Deactivate', 1);
}

function bestmatch_plugin_uninstall() {
  bestmatch_stathat_ez_count('BestMatch', 'BestMatch WP - Uninstall', 1);
}

function bestmatch_plugin_activate() {
  bestmatch_stathat_ez_count('BestMatch', 'BestMatch WP - Active', 1);  
}


register_activation_hook(__FILE__, 'bestmatch_plugin_activate');
register_deactivation_hook(__FILE__,'bestmatch_plugin_deactivation');
register_uninstall_hook(__FILE__,'bestmatch_plugin_uninstall');
?>