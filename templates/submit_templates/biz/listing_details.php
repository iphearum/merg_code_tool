<?php
global $submission_page_fields;
global $ownertype ;   
global $listing_head ;     
global $biz_status   ;
global $overview;
global $reason;
global $title;
global $property_city;
global $biz_type;

global $asking_price;
global $sale_revenue;
global $cash_flow;
global $status;
global $total_ar;
global $total_ap;
global $profit_margin;

global $property_rental_fee;
global $annual_fee;
global $property_deposit_fee;
global $royalty_fee;
global $other_fee;
global $assets;
global $total_asset_value;
global $other_financial_info;
global $total_ar_finance_detail;
global $total_ap_finance_detail;

global $video;
global $website_address;
global $attchs;

global $year_established;
global $employees;
global $working_hour;
global $support_and_training;
global $company_name;
global $available_date;
global $vat_regi;
global $origin;
global $address;
global $feature_your_biz;
global $number_of_store;
global $company_info;
global $property_description;



global $submit_title;
global $submit_description;

$measure_sys        =   esc_html ( get_option('wp_estate_measure_sys','') ); 
$custom_fields_show =   '';
$custom_fields      =   get_option( 'wp_estate_custom_fields', true); 
$i=0;
    if( !empty($custom_fields)){  
        while($i< count($custom_fields) ){
            $name               =   $custom_fields[$i][0];
            $label              =   stripslashes( $custom_fields[$i][1] );
            $type               =   $custom_fields[$i][2];
            $order              =   $custom_fields[$i][3];
            $dropdown_values    =   $custom_fields[$i][4];

            $slug  =$prslig            =   str_replace(' ','_',$name);
            $prslig1      =     htmlspecialchars ( str_replace(' ','_', trim($name) ) , ENT_QUOTES );
           
            
            $slug         =   wpestate_limit45(sanitize_title( $name ));
            $slug         =   sanitize_key($slug);
            $post_id      =     $post->ID;
            $show         =     1;  
            $i++;

            if (function_exists('icl_translate') ){
                $label     =   icl_translate('wpestate','wp_estate_property_custom_front_'.$label, $label ) ;
            }   
            if($i%2!=0){
                $custom_fields_show.= '<p class="half_form ">';
            }else{
                $custom_fields_show.= '<p class="half_form">';
            }
            $value=$custom_fields_array[$slug];
         
            if(   is_array($submission_page_fields) && ( in_array($prslig, $submission_page_fields) ||  in_array($prslig1, $submission_page_fields))  ) { 
              $custom_fields_show.=  wpestate_show_custom_field(0,$slug,$name,$label,$type,$order,$dropdown_values,$post_id,$value);
            }            
            $custom_fields_show.= '</p>';

       }
    }
    ?> 

<?php if(   is_array($submission_page_fields) && 
           (   
                in_array('submit_title', $submission_page_fields) ||
                in_array('submit_description', $submission_page_fields) ||
                $custom_fields_show !=  ''
     
            )
        ) { ?>   


 <?php
// $edit_id       =  intval ($_GET['listing_edit']);
// var_dump(esc_html( get_post_meta($edit_id, 'listing_head', true)));
$user_role = display_user_roles();
if(is_biz_for_sale()) {
?>
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">    
        <div class="one_wrapper">        
            <div class="col-md-4 profile_label">
                <div class="user_details_row"><?php _e('Listing Details','wpestate');?></div> 
                <div class="user_profile_explain"><?php _e('Add a little more info about your property. ','wpestate')?></div>
            </div>     
            <div class="col-md-8">   
                <div class="col-md-12">
                        <p>
                            <label for="wpestate_title"><?php _e('Title','wpestate');?></label>
                            <input type="text" id="wpestate_title" class="form-control" value="<?php echo esc_html($submit_title);?>"  name="wpestate_title">
                        </p>
                </div>           
                <div class="col-md-12">
                        <p>
                            <label for="ownertype"><?php _e('I am a ','wpestate');?></label>
                           <?php
                             $args=array(
                                                'class'       => 'form-control',
                                                'hide_empty'  => false,
                                                'selected'    => $ownertype,
                                                'name'        => 'ownertype',
                                                'id'          => 'ownertype',
                                                'orderby'     => 'NAME',
                                                'order'       => 'ASC',
                                                'show_option_none'   => __('None','wpestate'),
                                                'taxonomy'    => 'ownertype',
                                                'hierarchical'=> true,
                                                'value_field' => 'key'
                                            );
                                            wp_dropdown_categories( $args );
                            ?>
                        </p>
                </div>
                <div class="col-md-12">
                        <p>
                            <label for="listing_head"><?php _e('Listing headline','wpestate');?></label>
                            <input  type="text" id="listing_head" class="form-control" value="<?php echo esc_html($listing_head);?>"  name="listing_head"  >
                        </p>
                </div>           
                <div style="clear:both"></div>
                 <div class="col-md-12">
                        <p>
                        <label for="overview"><?php _e('Overview','wpestate');?></label>
                        <textarea id="overview" class="form-control" name="overview" rows="8"><?php echo ($overview);?></textarea>
                    </p>
                 </div>
                <div class="col-md-12">
                       <p>
                            <label for="reason"><?php _e('Reason','wpestate');?></label>
                            <input type="text" id="reason" class="form-control" value="<?php echo esc_html($reason);?>"  name="reason">
                        </p>
                    </p>
                 </div> 
                 <div class="col-md-12">
                       <p>
                            <label for="biz_status"><?php _e('Status of Biz','wpestate');?></label>
                            <input type="text" id="biz_status" class="form-control" value="<?php echo esc_html($biz_status);?>"  name="biz_status">
                        </p>
                    </p>
                 </div> 
             </div>
         </div><!--end one_wrapper**********************************************************************-->
</div>
</div>

<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">  
        <div class="one_wrapper">        
            <div class="col-md-4 profile_label">
                <div class="user_details_row"><?php _e('Biz Type','wpestate');?></div> 
                <div class="user_profile_explain"><?php _e('Please select one of the biz type here. ','wpestate')?></div>
            </div>     
            <div class="col-md-8">              
                <div class="col-md-12">
                    <p>
                        <label for="biz_type"><?php _e('Biz Type ','wpestate');?></label>
                       <?php
                         $args=array(
                                            'class'       => 'form-control',
                                            'hide_empty'  => false,
                                            'selected'    => $biz_type,
                                            'name'        => 'biz_type',
                                            'id'          => 'biz_type',
                                            'orderby'     => 'NAME',
                                            'order'       => 'ASC',
                                            'show_option_none'   => __('None','wpestate'),
                                            'taxonomy'    => 'biz_type',
                                            'hierarchical'=> true,
                                            'value_field' => 'key'
                                        );
                                        wp_dropdown_categories( $args );
                        ?>
                    </p>
                </div>                
            </div>         
        </div><!--end one_wrapper**********************************************************************-->
</div>
</div>
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">  
        <div class="one_wrapper">        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Select Location/City','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('Please select one of your location/city. ','wpestate')?></div>
        </div>     
        <div class="col-md-8">     
                <div class="col-md-12">
                    <p>
                        <label for="property_city"><?php _e('Location/City ','wpestate');?></label>
                       <?php
                         $args=array(
                                            'class'       => 'form-control',
                                            'hide_empty'  => false,
                                            'selected'    => $property_city,
                                            'name'        => 'property_city',
                                            'id'          => 'property_city',
                                            'orderby'     => 'NAME',
                                            'order'       => 'ASC',
                                            'show_option_none'   => __('None','wpestate'),
                                            'taxonomy'    => 'property_city',
                                            'hierarchical'=> true,
                                            'value_field' => 'key'
                                        );
                                        wp_dropdown_categories( $args );
                        ?>
                    </p>
                </div>
        </div>           
        </div><!--end one_wrapper**********************************************************************-->
</div>
</div>
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">  
        <div class="one_wrapper">        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Financial Information','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('The financial information goes here. ','wpestate')?></div>
        </div>     
        <div class="col-md-8">              
                <div class="col-md-12">
                   <p>
                        <label for="asking_price"><?php _e('Asking Price','wpestate');?></label>
                        <input type="text" id="asking_price" class="form-control" value="<?php echo esc_html($asking_price);?>"  name="asking_price" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="sale_revenue"><?php _e('Sale Revenue','wpestate');?></label>
                        <input type="text" id="sale_revenue" class="form-control" value="<?php echo esc_html($sale_revenue);?>"  name="sale_revenue" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="cash_flow"><?php _e('Cash Flow','wpestate');?></label>
                        <input type="text" id="cash_flow" class="form-control" value="<?php echo esc_html($cash_flow);?>"  name="cash_flow" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="status"><?php _e('Status','wpestate');?></label>
                        <input type="text" id="status" class="form-control" value="<?php echo esc_html($status);?>"  name="status">
                    </p>
                    <p>
                        <label for="total_ar"><?php _e('Total AR','wpestate');?></label>
                        <input type="text" id="total_ar" class="form-control" value="<?php echo esc_html($total_ar);?>"  name="total_ar" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="total_ap"><?php _e('Total AP','wpestate');?></label>
                        <input type="text" id="total_ap" class="form-control" value="<?php echo esc_html($total_ap);?>"  name="total_ap" onkeypress="return isNum(event)" >
                    </p>
                     <p>
                        <label for="profit_margin"><?php _e('Profir Margin','wpestate');?></label>
                        <input type="text" id="profit_margin" class="form-control" value="<?php echo esc_html($profit_margin);?>"  name="profit_margin" onkeypress="return isNum(event)">
                    </p>
                </div>         
        </div>           
        </div><!--end one_wrapper**********************************************************************-->
</div>
</div>
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">  
         <div class="one_wrapper">        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Financial Detail','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('The financial details goes here. ','wpestate')?></div>
        </div>     
        <div class="col-md-8">               
                <div class="col-md-12">
                   <p>
                        <label for="property_rental_fee"><?php _e('Property rental fee','wpestate');?></label>
                        <input type="text" id="property_rental_fee" class="form-control" value="<?php echo esc_html($property_rental_fee);?>"  name="property_rental_fee" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="annual_fee"><?php _e('Annual fee','wpestate');?></label>
                        <input type="text" id="annual_fee" class="form-control" value="<?php echo esc_html($annual_fee);?>" onkeypress="return isNum(event)"  name="annual_fee">
                    </p>
                    <p>
                        <label for="property_deposit_fee"><?php _e('Propety deposit fee','wpestate');?></label>
                        <input type="text" id="property_deposit_fee" class="form-control" value="<?php echo esc_html($property_deposit_fee);?>"  name="property_deposit_fee" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="royalty_fee"><?php _e('Royalty fee','wpestate');?></label>
                        <input type="text" id="royalty_fee" class="form-control" value="<?php echo esc_html($royalty_fee);?>"  name="royalty_fee" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="other_fee"><?php _e('Other fee','wpestate');?></label>
                        <input type="text" id="other_fee" class="form-control" value="<?php echo esc_html($other_fee);?>"  name="other_fee" onkeypress="return isNum(event)">
                    </p>
                    <p>
                        <label for="assets"><?php _e('Assets','wpestate');?></label>
                        <input type="text" id="assets" class="form-control" value="<?php echo esc_html($assets);?>"  name="assets" onkeypress="return isNum(event)" >
                    </p>
                     <p>
                        <label for="total_asset_value"><?php _e('Total Assets Value','wpestate');?></label>
                        <input type="text" id="total_asset_value" class="form-control" value="<?php echo esc_html($total_asset_value);?>"  name="total_asset_value" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="other_financial_info"><?php _e('Other Financial Info','wpestate');?></label>
                        <input type="text" id="other_financial_info" class="form-control" value="<?php echo esc_html($other_financial_info);?>"  name="other_financial_info" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="total_ar_finance_detail"><?php _e('Total AR','wpestate');?></label>
                        <input type="text" id="total_ar_finance_detail" class="form-control" value="<?php echo esc_html($total_ar_finance_detail);?>"  name="total_ar_finance_detail" onkeypress="return isNum(event)" >
                    </p>
                    <p>
                        <label for="total_ap_finance_detail"><?php _e('Total AP','wpestate');?></label>
                        <input type="text" id="total_ap_finance_detail" class="form-control" value="<?php echo esc_html($total_ap_finance_detail);?>"  name="total_ap_finance_detail" onkeypress="return isNum(event)" >
                    </p>
                </div>          
        </div>           
        </div><!--end one_wrapper**********************************************************************-->
</div>
</div>
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">  
        <div class="one_wrapper">        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Photograph and Documents','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('photograph and documents goes here. ','wpestate')?></div>
        </div>     
        <div class="col-md-8">                
                    <div class="col-md-12 add-estate profile-page profile-onprofile ">
                            <p>
                                <label for="photo"><?php _e('Photo','wpestate');?></label>
                            </p>
                            <?php
                                  include(locate_template('templates/submit_templates/franchise/photo.php')); 
                            ?>                                
                    </div>                    
                    <div class="col-md-12">
                            <p>
                                <label for="website_address"><?php _e('Website Address','wpestate');?></label>
                                <input type="text" id="website_address" class="form-control" value="<?php echo esc_html($website_address);?>"  name="website_address">
                            </p>
                    </div>
                     <div class="col-md-12">
                            <p>
                                <label for="video"><?php _e('Video','wpestate');?></label>
                                <input type="text" id="video" class="form-control" value="<?php echo esc_html($video);?>"  name="video">
                            </p>
                    </div>       
        </div>           
        </div><!--end one_wrapper**********************************************************************-->
</div>
</div>
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">  
        <div class="one_wrapper">        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Biz Details','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('Biz Details. ','wpestate')?></div>
        </div>     
        <div class="col-md-8">              
                <div class="col-md-12 add-estate profile-page profile-onprofile ">
                    <p>
                        <label for="year_established"><?php _e('Year Established','wpestate');?></label>
                        <input type="text" id="year_established" class="form-control" value="<?php echo esc_html($year_established);?>"  name="year_established">
                    </p> 
                    <p>
                        <label for="employees"><?php _e('Employees','wpestate');?></label>
                        <input type="text" id="employees" class="form-control" value="<?php echo esc_html($employees);?>"  name="employees">
                    </p> 
                    <p>
                        <label for="working_hour"><?php _e('Working hour','wpestate');?></label>
                        <input type="text" id="working_hour" class="form-control" value="<?php echo esc_html($working_hour);?>"  name="working_hour">
                    </p> 
                    <p>
                        <label for="support_and_training"><?php _e('Support and Training','wpestate');?></label>
                        <input type="text" id="support_and_training" class="form-control" value="<?php echo esc_html($support_and_training);?>"  name="support_and_training">
                    </p> 
                    <p>
                        <label for="company_name"><?php _e('Company name','wpestate');?></label>
                        <input type="text" id="company_name" class="form-control" value="<?php echo esc_html($company_name);?>"  name="company_name">
                    </p> 
                    <p>
                        <label for="available_date"><?php _e('Available date','wpestate');?></label>
                        <input type="text" id="available_date" class="form-control" value="<?php echo esc_html($available_date);?>"  name="available_date" onkeypress="return isNum(event)">
                    </p>  
                    <p>
                        <label for="vat_regi"><?php _e('VAT Regi','wpestate');?></label>
                        <input type="text" id="vat_regi" class="form-control" value="<?php echo esc_html($vat_regi);?>"  name="vat_regi">
                    </p>  
                    <p>
                        <label for="origin"><?php _e('Origin','wpestate');?></label>
                        <input type="text" id="origin" class="form-control" value="<?php echo esc_html($origin);?>"  name="origin">
                    </p>
                    <p>
                        <label for="address"><?php _e('Address','wpestate');?></label>
                        <input type="text" id="address" class="form-control" value="<?php echo esc_html($address);?>"  name="address">
                    </p>
                    <p>
                        <label for="feature_your_biz"><?php _e('Feature your biz','wpestate');?></label>
                        <input type="text" id="feature_your_biz" class="form-control" value="<?php echo esc_html($feature_your_biz);?>"  name="feature_your_biz">
                    </p>   
                    <p>
                        <label for="number_of_store"><?php _e('Number of store','wpestate');?></label>
                         <?php
                         $args=array(
                                            'class'       => 'form-control',
                                            'hide_empty'  => false,
                                            'selected'    => $number_of_store,
                                            'name'        => 'number_of_store',
                                            'id'          => 'number_of_store',
                                            'orderby'     => 'NAME',
                                            'order'       => 'ASC',
                                            'show_option_none'   => __('None','wpestate'),
                                            'taxonomy'    => 'number_of_store',
                                            'hierarchical'=> true,
                                            'value_field' => 'key'
                                        );
                                        wp_dropdown_categories( $args );
                        ?>
                    </p>  
                    <p>
                        <label for="company_info"><?php _e('Company Info','wpestate');?></label>
                        <textarea id="company_info" class="form-control" name="company_info" rows="8"><?php echo ($company_info);?></textarea>
                    </p>   
                     <p>
                        <label for="wpestate_description"><?php _e('Property Description','wpestate');?></label>
                        <textarea id="wpestate_description" class="form-control" name="wpestate_description" rows="8"><?php echo ($submit_description);?></textarea>
                    </p>             
                </div>         
        </div>           
        </div><!--end one_wrapper**********************************************************************-->
   
    </div>  
</div>
 <?php
}//end  -----------------------------------------------------------
?>
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
 
<?php }?>