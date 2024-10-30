<?php
function bm_active_message() { 
    include('bm_admin_message.php');
}

function bm_message_style() {
  include('bm_admin_css.php');
}
if (!get_option('bm_hide_message',false)) {
  add_action('admin_head', 'bm_message_style');
  add_action( 'admin_notices', 'bm_active_message' );
}
?>
