<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo plugins_url() . "/bestmatch-shopping-advisor/assets/bootstrap.min.css" ?>">

<!-- Optional theme -->
<link rel="stylesheet" href="<?php echo plugins_url() . "/bestmatch-shopping-advisor/assets/bootstrap-theme.min.css" ?>">

<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo plugins_url() . "/bestmatch-shopping-advisor/assets/bootstrap.min.js"?>"></script>


<?php

// echo $x->tv->code;
function bestmatch_random_key() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $key = array(); //remember to declare $key as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 16; $i++) {
        $n = rand(0, $alphaLength);
        $key[] = $alphabet[$n];
    }
    return implode($key); //turn the array into a string
}

global $bm_uid;
$bm_uid = get_option("bm_uid",bestmatch_random_key());
update_option("bm_uid",$bm_uid);


function bestmatch_create_admin_section($name="TV") {
    global $settings,$cat_settings;



?>
            <div class="sub-section" data-bm-category="<?php echo $name ?>">
                <label class="category">
                    <input data-disable-all="true" data-reverse="true"   type="checkbox" name="active_category[]" id="<?php echo $name ?>" value="<?php echo $name ?>" <?php echo  $settings[$name] == true ? "checked" : ""  ?>> <?php echo $name ?></label>
                    <div class="column">
                        <label <?php echo  $settings[$name] == true ? "" : "disabled"  ?>  class="all" for="<?php echo $name ?>_all_pages">
                            <input  <?php echo  $cat_settings[$name]["all_pages"] == "true" ? "checked" : ""  ?> 
                            <?php echo  $settings[$name] == true ? "" : "disabled"  ?>
                            data-target="pages" data-reverse="true" type="checkbox" 
                            name="<?php echo $name ?>_all_pages" 
                            id="<?php echo $name ?>_all_pages" value="true"> All Pages </label>
                             <select <?php echo  $cat_settings[$name]["pages"] != false ? "" : "disabled"  ?>  
                                class="select_options form-control" disabled  data-type="pages" name="<?php echo $name ?>_pages[]" size="5" multiple>
                        <optgroup label="Only on Pages">

                                <?php
                                if (!is_null($cat_settings[$name]["pages"])) {
                                    $o = get_object_vars($cat_settings[$name]["pages"]);
                                    $selected = $o["home_page"] == true ? "selected" : "";
                                }
                             echo '<option value=""></option>';
                            echo "<option value='home_page'" . $selected  .">Home Page</option>";

                                    $pages =  get_all_page_ids();
                                
                                      if ($pages) {
                                        foreach($pages as $page_id) {
                                            $page = get_post($page_id);
                                            $selected = "";
                                            if (!is_null($cat_settings[$name]["pages"])) {
                                                $o = get_object_vars($cat_settings[$name]["pages"]);
                                                $selected = $o[$page->post_title] == true ? "selected" : "";
                                            }
                                          echo "<option " . $selected . " value='" . $page->post_title   . "'>" . $page->post_title . "</option>"; 
                                        }
                                      }
                                ?>
                          </optgroup>
                      </select>
                    </div>
                    <div class="column">
                        <label  <?php echo  $settings[$name] == true ? "" : "disabled"  ?>   
                        class="all" for="<?php echo $name ?>_all_categories">
                        <input  <?php echo  $settings[$name] == true ? "" : "disabled"  ?>  
                         <?php echo  $cat_settings[$name]["all_categories"] == "true" ? "checked" : ""  ?> 
                        data-target="category" 
                        data-reverse="true" type="checkbox" 
                        id="<?php echo $name ?>_all_categories" 
                        name="<?php echo $name ?>_all_categories"
                        value="true"> All Categories </label>
                        <select <?php echo  $cat_settings[$name]["categories"] != false ? "" : "disabled"  ?> class="select_options form-control" disabled data-type="category" name="<?php echo $name ?>_categories[]" size="5" multiple>
                            <optgroup label="Only on Categories">
                             <option value=""></option>

                                <?php
                                    $categories = get_categories();
                                    if ($categories) {
                                        foreach($categories as $tag) {
                                            $selected = "";
                                            if (!is_null($cat_settings[$name]["categories"])) {
                                                $o = get_object_vars($cat_settings[$name]["categories"]);
                                                $selected = $o[$tag->name] == true ? "selected" : "";
                                            }
                                          echo "<option " . $selected . " value='" . $tag->name  . "'>" . $tag->name . "</option>"; 
                                        }
                                      }
                                ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="column">
                     <label <?php echo  $settings[$name] == true ? "" : "disabled"  ?>   
                      class="all" for="<?php echo $name ?>_all_tags">
                      <input  <?php echo  $settings[$name] == true ? "" : "disabled"  ?>  
                         <?php echo  $cat_settings[$name]["all_tags"] == "true" ? "checked" : ""  ?> 

                       data-target="tags" data-reverse="true" type="checkbox" id="<?php echo $name ?>_all_tags" name="<?php echo $name ?>_all_tags" value="true"> All Tags </label>
                     <select <?php echo  $cat_settings[$name]["tags"] != false ? "" : "disabled"  ?>   class="select_options form-control"  data-type="tags" name="<?php echo $name ?>_tags[]" size="5" multiple>
                        <optgroup label="Only on Tags">
                            <option value=""></option>
                        <?php
                            $tags = get_tags();
                              if ($tags) {
                                foreach($tags as $tag) {
                                    $selected = "";
                                    if (!is_null($cat_settings[$name]["tags"])) {
                                        $o = get_object_vars($cat_settings[$name]["tags"]);
                                        $selected = $o[$tag->name] == true ? "selected" : "";
                                    }
                                  echo "<option " . $selected . " value='" . $tag->name  . "'>" . $tag->name . "</option>"; 
                                }
                              }
                        ?>
                      </optgroup>

                    </select>
                </div>
            </div>
        


<?php
}

    
function bestmatch_array_to_obj($arr) {
    $object = new stdClass();
    if (is_array($arr)){
        foreach ($arr as $key => $value)
        {
            $object->$value = true;
        }
        return $object;
    }else {
        return false;
    }

}

function bestmatch_get_params($name) {
    $res = NULL;

    $res["pages"] = $_POST[$name . "_pages"];
    $res["pages"] = bestmatch_array_to_obj($res["pages"]);
    $res["all_pages"] = $_POST[$name . "_all_pages"] == "true";
    $res["categories"] = $_POST[$name . "_categories"];
    $res["categories"] = bestmatch_array_to_obj($res["categories"]);
    $res["all_categories"] = $_POST[$name . "_all_categories"] == "true";
    $res["tags"] = $_POST[$name . "_tags"];
    $res["tags"] = bestmatch_array_to_obj($res["tags"]);
    $res["all_tags"] = $_POST[$name . "_all_tags"] == "true";
    return $res;
}

    global $settings,$cat_settings,$banner_settings;
        $settings = NULL;
        $cat_settings = NULL;
        $banner_settings = NULL;
    // echo get_option('admin_email');
    if($_POST['bm_hidden'] == 'Y') {  
        //Form data sent  
        $active_category = $_POST["active_category"];
        $active_categories_str = implode("|",$active_category);
        update_option('bm_active_categories', $active_categories_str);  

        $active_category = $_POST["active_category"];
        $active_categories_str = implode("|",$active_category);
        update_option('bm_active_categories', $active_categories_str);  
        
        foreach ($active_category as $cat) {
            $settings[$cat] =  true;
            $cat_settings[$cat] = bestmatch_get_params($cat);
        }
        $banner_settings["banner_type"] = $_POST["banner-type"];
        $banner_settings["enable_banner_popup"] = $_POST["enable-popup"] == "true";

        update_option("bm_active_categories",$settings);
        update_option("bm_cat_settings",$cat_settings);
        update_option("bm_banner_settings",$banner_settings);
        update_option("bm_hide_message",true);
        // delete_option("bm_active_categories");
        // delete_option("bm_cat_settings");
        // delete_option("bm_banner_settings");

        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
        <?php  
    } else {  
        $settings = get_option("bm_active_categories");
        $cat_settings =  get_option("bm_cat_settings");
        $banner_settings = get_option("bm_banner_settings");

        //Normal page display  
    }  
?> 
<?php

function banner($name,$id,$url,$checked=false) {
    ?>
    <tr>
        <td>
            <div class="radio">
              <label>
                <input type="radio" name="banner-type" value="<?php echo $id ?>" <?php echo $checked == true ? "checked" : "" ?>>
                <?php echo $name ?>
              </label>
            </div>
        </td>
        <td>
            <img src="<?php echo $url ?>" >
        </td>
    </tr>
<?php
}
?>

<img src="<?php echo plugins_url() . "/bestmatch-shopping-advisor/images/logo.png" ?>" alt="BestMatch" >
    <div class="alert alert-info bm-code ">Your BestMatch User Id: <strong><?php echo $bm_uid ?></strong>
        <span>To activate your account go to<strong> <a style="cursor:pointer;" href="http://bestmat.ch/publishers" target="_blank">http://bestmat.ch/publishers</a></strong> </span>
    </div>

<div class="wrap">  
    <?php    echo "<h2>" . __( 'BestMatch Configuration ', 'bm_trdom' ) . "</h2>"; ?>  
      
    <form id="bm_form" class="settings" name="bm_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="bm_hidden" value="Y">  
        <div class="active_category ">
            <h3>Advisors</h3>
            <h4>Pick the advisor(s) that you want to enable on your site.</h4>
            <?php 
                global $script_domain,$config;
                $response = file_get_contents("http://" . $script_domain . "/launcher/config/wordpress.js");
                $config = json_decode($response);
                foreach ($config->products as $key => $value) {
                    bestmatch_create_admin_section($key);
                }
            ?>
        </div>
      <button data-form-submit="true" type="button" class="btn btn-primary btn-lg">Save Configuration</button>

        <h3>Call for Actions</h3>
        <h4>The Call for action that you want to add to your site.</h4>

        <table class="table table-bordered">
            <th>Banner Location</th>
            <th>Banner</th>
            <?php
            $index = 0;
            foreach ($config->banners as $key => $value) {
                $checked = (is_null($banner_settings["banner_type"]) && $index == 0) || ($banner_settings["banner_type"] == $value->code);
                banner($key,$value->code,$value->image,$checked);
                    $index += 1;
                }
            $checked = ($cat_settings["banner_type"] == "none");
            
            
            banner("None","none", plugins_url() . "/bestmatch-shopping-advisor/images/s.png",$checked); 

            ?>
        </table>      
      <button data-form-submit="true" type="button" class="btn btn-primary btn-lg">Save Configuration</button>
        <h3>Smart Popup</h3>
        <h4>Smart popup automaticly shown to users that are searching for products</h4>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="enable-popup" value="true" <?php echo ($cat_settings["enable_banner_popup"] == true || is_null($cat_settings["enable_banner_popup"])) ? "checked" : "" ?>> Enable Smart Popup (recomended)
            </label>
            <br/>
            <br/>
        </div>
      <button data-form-submit="true" type="button" class="btn btn-primary btn-lg">Save Configuration</button>


    </form>  
</div>  
