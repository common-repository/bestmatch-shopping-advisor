<?php 



wp_enqueue_script('jquery');
global $script_domain,$script_url;
$script_url = "http://" . $script_domain . "/launcher/wordpress.js";


function bestmatch_banner($id=1) {
  echo "<img data-bestmatch='open' src='http://assets.bestmat.ch/wordpress/banners/owl" . $id . ".png' >";
}

function bestmatch_js_script() {

  global $script_url,$bm_uid,$tags_str,$categories_str;


  $tags_str = "";

  $config = json_encode(get_option("bm_cat_settings"));
  $banners = json_encode(get_option("bm_banner_settings"));

  $bm_uid = get_option("bm_uid");
  

  $tags_array = array();
  $tags = wp_get_post_tags(get_the_ID());
  foreach ($tags as $key => $value) {
    array_push($tags_array,$value->name);
  }
  $tags_str = implode("||", $tags_array);

  $categories_array = array();
  $categories = get_the_category();
  if($categories){
    foreach($categories as $category) {
      array_push($categories_array,$category->name);
      // $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
    }
  }  
  $categories_str = implode("||", $categories_array);

  ?>
  <script>

    var __bm_queue = null;
    if (typeof $bm !== "undefined" && typeof $bm.push !== "undefined" )  {
      __bm_queue = $bm
    }

    var $bm = $bm || {};
    $bm.push = []

    $bm._queue = __bm_queue || []
    $bm.$ = jQuery;
    $bm.Config = {};
    $bm.Config.source = "Wordpress"
    $bm.Config.Categories = <?php echo $config ?> || {}
    $bm.Config.Banners = <?php echo $banners ?> || {}
    
    $bm.Config.uid = "<?php echo $bm_uid ?>";

    $bm.PageInfo = {}
    $bm.PageInfo.tags = "<?php echo $tags_str  ?>".split('||')
    $bm.PageInfo.categories = "<?php  echo $categories_str; ?>".split('||')
    $bm.PageInfo.page = <?php  echo json_encode(get_post()); ?>;
    $bm.PageInfo.is_homepage = ("<?php echo is_home() ?>" == 1);
  </script>
  <script  type='text/javascript' src='<?php echo $script_url ?>'></script>

<?php
} 
add_action('wp_head', 'bestmatch_js_script');



?>