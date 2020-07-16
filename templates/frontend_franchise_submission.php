<?php 
global $submit_title;
global $submit_description;


global $action;
global $edit_id;
global $attchs;
global $attchsL;
global $show_err;
global $feature_list_array;
global $userID;
global $user_pack;
global $prop_featured;                
global $current_user;
global $custom_fields_array;
global $all_submission_fields;
global $submission_page_fields;

global $offering ;     
global $brand_name   ;
global $overview;
global $about_your_brand;
global $submit_title;
global $businesstype;
global $property_city;

global $asking_price;
global $average_sale_revenue;
global $cashflow;
global $expected_profir_margin;

global $space_required;
global $average_staff;
global $royalty_fee;
global $website_address;
global $video;

global $year_establish;
global $product_service;
global $procedure;
global $support_and_training;
global $origin;



$images_to_show     =   '';
$remaining_listings =   wpestate_get_remain_listing_user($userID,$user_pack);
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
                    get_template_part('templates/submit_templates/property_description');
                    get_template_part('templates/submit_templates/property_categories'); 
                    get_template_part('templates/submit_templates/property_images'); 
                    get_template_part('templates/submit_templates/property_location'); 
                    get_template_part('templates/submit_templates/property_details'); 
                    get_template_part('templates/submit_templates/property_status');  
                    get_template_part('templates/submit_templates/property_amenities');  
                    get_template_part('templates/submit_templates/property_video');
                    get_template_part('templates/submit_templates/video_tour');
                    get_template_part('templates/submit_templates/property_subunits');
                   // print'<div>';
            }else{
                    print '<div class="col-md-9 user_dashboard">';
                   
                    get_template_part('templates/submit_templates/franchise/listing_details');
                    get_template_part('templates/submit_templates/franchise/select_business');
                    get_template_part('templates/submit_templates/franchise/select_location');
                    get_template_part('templates/submit_templates/franchise/price_and_expected_sale');
                    get_template_part('templates/submit_templates/franchise/franchise_details');
                    get_template_part('templates/submit_templates/franchise/biz_details');

                    print '</div>';

                    print '<div class="col-md-3 user_dashboard">';
                 
                    get_template_part('templates/submit_templates/user_memebership_form'); 
                    get_template_part('templates/submit_templates/property_featured');
                    print '</div>';
                             
            }
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


                   <input type="submit" class="wpresidence_button" id="form_submit_1" value="<?php _e('ADD PROPERTY', 'wpestate') ?>" />
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


<script type="text/javascript">
function isNum(evt)
    {
    if (event.type == "paste") {
        return false;
    }
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
     return true;
    }
    
</script>




