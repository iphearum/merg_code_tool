<?php 
global $submit_title;
global $submit_description;
global $prop_category;
global $prop_action_category;       
global $property_city;      
global $property_area;
global $property_address;
global $property_county;
global $property_zip;
global $property_state;
global $country_selected; 
global $property_status; 
global $property_price; 
global $property_label; 
global $property_label_before; 
global $property_size; 
global $property_lot_size; 
global $property_year;
global $property_rooms;    
global $property_bedrooms;      
global $property_bathrooms; 
global $option_video; 
global $embed_video_id; 
global $virtual_tour;
global $property_latitude; 
global $property_longitude;
global $google_view_check; 
global $prop_featured_check;
global $google_camera_angle;  
global $action;
global $edit_id;
global $show_err;
global $feature_list_array;
global $prop_category_selected;
global $prop_action_category_selected;
global $userID;
global $user_pack;
global $prop_featured;                
global $current_user;
global $custom_fields_array;
global $option_slider;
global $property_has_subunits;
global $property_subunits_list;
global $all_submission_fields;
global $submission_page_fields;
global $data;

$images_to_show     =   '';
$remaining_listings =   wpestate_get_remain_listing_user($userID, $user_pack);
if($remaining_listings  === -1){
   $remaining_listings=11;
}
$paid_submission_status= esc_html ( get_option('wp_estate_paid_submission','') );


  if(is_administrator() || is_biz_for_sale() || is_franchise())   {   
    $mandatory_fields           =   ( get_option('wp_estate_mandatory_page_fields','') );
    if(is_array($mandatory_fields)){
        $mandatory_fields           =   array_map("wpestate_strip_array",$mandatory_fields);
    }
    if(is_array($mandatory_fields) && !empty($mandatory_fields) ){
          $all_mandatory_fields   =   wpestate_return_all_fields(1);
        print '<div class="submit_mandatory col-md-9">';
        _e('These fields are mandatory: Title','wpestate');
            foreach ($mandatory_fields as  $key=>$value){
                print ', '.$all_mandatory_fields[$value];
            }
        print '</div>';
    }

    if ( is_franchise() ) {
        $fields = custom_property_fields('franchise');
    } else if (is_biz_for_sale() ) {
        $fields = custom_property_fields('biz_for_sale');
    }

    if (isset($_GET['test'])) {
        echo '<pre>';
        print_r($fields['fields']);
        echo '</pre>';
        exit();
    }

    if (isset($_GET['type']) && is_administrator()){
        $gettype = $_GET['type'];
        if ($gettype == 'franchise'){
            $fields = custom_property_fields('franchise');
        } else if ($gettype == 'biz_for_sale'){
             $fields = custom_property_fields('biz_for_sale');
        }
    }

?>



<form id="new_post" name="new_post" method="post" action="" enctype="multipart/form-data" class="add-estate">
     
       <?php
       
       if( esc_html ( get_option('wp_estate_paid_submission','') ) == 'yes' ){
         print '<br>'.__('This is a paid submission.The listing will be live after payment is received.','wpestate');  
       }
        
       ?>
        </span> 
        
<div class="col-md-12 row_dasboard-prop-listing">
       <?php
       if($show_err){
           print '<div class="alert alert-danger">'.$show_err.'</div>';
       }
       ?>
</div>


    <div class="profile-page row">
             <?php
              if ( wp_is_mobile() ) { 
                    get_template_part('templates/submit_templates/user_memebership_form');
                    get_template_part('templates/submit_templates/property_featured');
//                    print '<div class="submit_container">';
                    // get_template_part('templates/submit_templates/property_description');
                    // get_template_part('templates/submit_templates/property_categories'); 
                    // get_template_part('templates/submit_templates/property_images'); 
                    // get_template_part('templates/submit_templates/property_location'); 
                    // get_template_part('templates/submit_templates/property_details'); 
                    // get_template_part('templates/submit_templates/property_status');  
                    // get_template_part('templates/submit_templates/property_amenities');  
                    // get_template_part('templates/submit_templates/property_video');
                    // get_template_part('templates/submit_templates/video_tour');
                    // get_template_part('templates/submit_templates/property_subunits');
                   // print'<div>';
            }
                
            print '<div class="col-md-9 user_dashboard">';
            foreach ($fields['fields'] as $key => $value) :
                $title = $value['label'];
                $sub_title = $value['small_label'];
                $columns = $value['columns'];
                ?>
                <div class="col-md-12 add-estate profile-page profile-onprofile row"> 
                    <div class="submit_container">
                        <div class="col-md-4 profile_label">
                            <div class="user_details_row"><?php _e($title,'wpestate');?></div> 
                            <div class="user_profile_explain"><?php _e($sub_title,'wpestate')?></div>
                            <input type="hidden" name="is_user_submit" value="1">
                        </div>

                        <div class="col-md-8">  
                            <?php
                            foreach ($columns as $c_key => $c_value) :
                                $name = $c_key;
                                $id = isset($c_value['id']) ? $c_value['id'] : $name;
                                $label = isset($c_value['label']) ? $c_value['label'] : 'Unkown';
                                $require_label = (isset($c_value['is_require']) && $c_value['is_require'] == true )? '(*)' : '';
                                $is_required = isset($c_value['is_require']) ? : false;
                                $p_class = isset($c_value['col']) ? $c_value['col'] : 'full_form'; 
                                $size =  isset($c_value['size']) ? 'size="'. $c_value['size'] .'"' : '';
                                $class =  isset($c_value['class']) ? $c_value['class'] : 'form-control'; 
                                $type = isset($c_value['type']) ? $c_value['type'] : 'text'; 
                                $callbacks = isset($c_value['callback']) ? $c_value['callback'] : '';
                                $callback = '';

                                if (is_array ($callbacks)) {
                                    
                                    $callback = $callbacks['function_name'];
                                    $args = $callbacks['args'];
                                    $default_value = $callbacks['value'];
                                    
                                } else {
                                    $args = array();
                                    $default_value = false;
                                    $callback = $callbacks;
                                }
                                
                                $default_value = isset($data[$name]) ? $data[$name] : '';

                            ?>
                            <div class="<?= $p_class ?>">
                                <label for="<?= $c_key ?>">
                                    <?php _e($label. $require_label, 'wpestate'); ?> 
                                </label>
                                <?php
                                switch ($type) {
                                    case 'textarea':
                                            if ($callback !== '') :
                                                custom_callback($callback, $args, $default_value);
                                            else :
                                                ?>
                                                <textarea 
                                                    id="<?= $id ?>" 
                                                    class="<?= $class?>"  
                                                    name="<?= $c_key ?>" 
                                                    ><?php print $default_value;?></textarea>
                                                <?php

                                            endif;
                                        break;
                                    case 'number':
                                        ?>
                                            <input type="number"  data-ignorepaste="" min=0 oninput="validity.valid||(value='');"  id="<?= $id ?>" class="<?= $class?>" 
                                            value="<?php print stripslashes(($default_value)); ?>" 
                                            <?= $p_class ?> 
                                            name="<?= $c_key ?>" />
                                        <?php
                                        break;
                                    case 'file':      
                                            custom_callback($callback, $args, $default_value);
                                        break;
                                    case 'select':
                                            custom_callback($callback, $args, $default_value);
                                        break;
                                    case 'radio':
                                            custom_callback($callback, $args, $default_value);
                                        break;
                                    case 'text':
                                    default:
                                        ?>
                                        <input type="text" id="<?= $id ?>" class="<?= $class?>" 
                                        value="<?php print stripslashes(($default_value)); ?>" 
                                        <?= $p_class ?> 
                                        name="<?= $name ?>" />
                                    <?php
                                    break;
                                }
                                ?>
                                
                            </div>
                            <?php 
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;

            print '</div>';

            // print '<div class="col-md-3 user_dashboard">';
            
            // get_template_part('templates/submit_templates/user_memebership_form'); 
            // get_template_part('templates/submit_templates/uploaded_images');
            // print '</div>';
                        
        ?>
   <div class="col-md-12">
       <div class="col-md-3"></div>
       <div class="col-md-9">
            <input type="hidden" name="action" value="<?php print $action;?>">
            <div class="submit_form_row">
                <?php
                if($action=='edit'){ ?>
                    <input type="submit" class="wpresidence_button" id="form_submit_1" value="<?php _e('SAVE CHANGES', 'wpestate') ?>" />
                <?php    
                }else{
                ?>

                    <?php
                    if (is_administrator() && !isset($_GET['type'])) {
                        $add_link               =   get_dasboard_add_listing();
                        print '
                            <a href="'.$add_link.'?type=biz_for_sale" class="btn btn-primary">  <i class="fa fa-plus"></i> Add Biz for Sale </a>
                            <a href="'.$add_link.'?type=franchise"  class="btn btn-primary" >  <i class="fa fa-plus"></i> Add Franchise </a>
                        ';
                    } else{

                    ?>
                         <input type="submit" class="wpresidence_button" id="form_submit_1" value="<?php _e('ADD PROPERTY', 'wpestate') ?>" />
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>
    
    
    </div><!-- end row--> 
       
    <input type="hidden" name="edit_id" value="<?php print $edit_id;?>">
    <input type="hidden" name="images_todelete" id="images_todelete" value="">
    <?php wp_nonce_field('submit_new_estate','new_estate'); ?>
</form>
<?php } // end check pack rights ?>
