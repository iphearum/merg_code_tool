<?php
global $property_adr_text;
global $biz_type_text;
global $financial_info_text;
global $property_details_text;
global $property_features_text;
global $feature_list_array;
global $use_floor_plans;
global $post;


$userID                     =   $current_user->ID;
$user_option                =   'favorites'.$userID;
$curent_fav                 =   get_option($user_option);

$content = get_the_content();
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);

if($content!=''){                            
    print '<div class="wpestate_property_description">'.$content.'</div>';     
}

get_template_part ('/templates/download_pdf');
$show_graph_prop_page= esc_html( get_option('wp_estate_show_graph_prop_page', '') );
?>





            
<div class="panel-group property-panel" id="accordion_prop_addr">
    <div class="panel panel-default">
       <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion_prop_addr" href="#collapseTwo">
                <h4 class="panel-title">  
                <?php if($property_adr_text!=''){
                    echo esc_html($property_adr_text);
                } else{
                    _e('Property Address','wpestate');
                }               
                ?>                    
                </h4>  
            </a>
       </div>
       <div id="collapseTwo" class="panel-collapse collapse in">
         <div class="panel-body">
          <span><b>Location/City:</b></span>
         <?php 
           $property_city          =   ( get_post_meta($post->ID, 'property_city', true) );
           echo get_term_name_by_id($property_city,'property_city');
          ?>
         </div>
       </div>
    </div>            
</div>     


<?php 

    $arrCity = array(
                'property_city' => array (
                            'label'=> 'Location/City',
                            'meta_key'   => 'property_city',
                            'dropdown' => true
                        )
                
            );
    print custom_estate_listing_details($post->ID,3,'ABC0','Location/City',$arrCity);

    $arrBizType = array(
                'biz_type' => array (
                            'label'=> 'Biz Type ',
                            'meta_key'   => 'biz_type',
                            'dropdown' => true
                        )
                
            );
    print custom_estate_listing_details($post->ID,3,'ABC0','Biz Type',$arrBizType);

    $arrListingDetail = array(
                'brand_name' => array (
                            'label'=> 'Brand Name ',
                            'meta_key'   => 'brand_name',
                            'dropdown' => false
                        ),
                'ownertype' => array(
                            'label' => 'I am a ',
                            'meta_key' => 'ownertype',
                            'dropdown' => true
                        ),
                'listing_head' => array(
                            'label' => 'Listing headline',
                            'meta_key' => 'listing_head',
                            'dropdown' => false
                        ),
                'overview' => array(
                            'label' => 'Overview',
                            'meta_key' => 'overview',
                            'dropdown' => false
                        ),
                'reason' => array(
                            'label' => 'Reason',
                            'meta_key' => 'reason',
                            'dropdown' => false
                        ),
                'Status of Biz' => array(
                            'label' => 'Status of Biz',
                            'meta_key' => 'biz_status',
                            'dropdown' => false
                        )
            );
    print custom_estate_listing_details($post->ID,3,'ABC1','Listing Details',$arrListingDetail);
 
    $arrFinancialInfo = array(
                'asking_price' => array (
                            'label'=> 'Asking Price ',
                            'meta_key'   => 'asking_price',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'sale_revenue' => array(
                            'label' => 'Sale Revenue ',
                            'meta_key' => 'sale_revenue',
                            'dropdown' => true,
                            'is_number' => true,
                        ),
                'cash_flow' => array(
                            'label' => 'Cash Flow',
                            'meta_key' => 'cash_flow',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'status' => array(
                            'label' => 'Status',
                            'meta_key' => 'status',
                            'dropdown' => false
                        ),
                'total_ar' => array(
                            'label' => 'Total AR',
                            'meta_key' => 'total_ar',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'total_ap' => array(
                            'label' => 'Total AP',
                            'meta_key' => 'total_ap',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'profit_margin' => array(
                            'label' => 'Profir Margin',
                            'meta_key' => 'profit_margin',
                            'dropdown' => false,
                            'is_number' => true,
                        )
            );
    print custom_estate_listing_details($post->ID,3,'ABC2','Financial Info',$arrFinancialInfo);

    $arrFinancialDetails = array(
                'property_rental_fee' => array (
                            'label'=> 'Property Rental Fee ',
                            'meta_key'   => 'property_rental_fee',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'annual_fee' => array(
                            'label' => 'Annual Fee ',
                            'meta_key' => 'annual_fee',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'property_deposit_fee' => array(
                            'label' => 'Property Desposit Fee',
                            'meta_key' => 'property_deposit_fee',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'royalty_fee' => array(
                            'label' => 'Royalty Fee',
                            'meta_key' => 'royalty_fee',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'other_fee' => array(
                            'label' => 'Other Fee',
                            'meta_key' => 'other_fee',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'assets' => array(
                            'label' => 'Assets',
                            'meta_key' => 'assets',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'total_asset_value' => array(
                            'label' => 'Total Asset Value',
                            'meta_key' => 'total_asset_value',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'other_financial_info' => array(
                            'label' => 'Other Financial Info',
                            'meta_key' => 'other_financial_info',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'total_ar_finance_detail' => array(
                            'label' => 'Total AP',
                            'meta_key' => 'total_ar_finance_detail',
                            'dropdown' => false,
                            'is_number' => true,
                        ),
                'total_ap_finance_detail' => array(
                            'label' => 'Total AP',
                            'meta_key' => 'total_ap_finance_detail',
                            'dropdown' => false,
                            'is_number' => true,
                        )
            );
    print custom_estate_listing_details($post->ID,3,'ABC3','Financial Details',$arrFinancialDetails);

     $arrPhotographs = array(
                'video' => array (
                            'label'=> 'Video',
                            'meta_key'   => 'video',
                            'dropdown' => false
                        ),
                'website_address' => array(
                            'label' => 'Website Address ',
                            'meta_key' => 'website_address',
                            'dropdown' => false
                        )
            );
    print custom_estate_listing_details($post->ID,3,'ABC3','Photographs & Photo',$arrPhotographs);

     $bizDetails = array(
                'year_established' => array (
                            'label'=> 'Year Established',
                            'meta_key'   => 'year_established',
                            'dropdown' => false
                        ),
                'employees' => array(
                            'label' => 'Employees ',
                            'meta_key' => 'employees',
                            'dropdown' => false
                        ),
                'working_hour' => array(
                            'label' => 'Working Hour ',
                            'meta_key' => 'working_hour',
                            'dropdown' => false
                        ),
                'support_and_training' => array(
                            'label' => 'Support and Training ',
                            'meta_key' => 'support_and_training',
                            'dropdown' => false
                        ),
                'company_name' => array(
                            'label' => 'Company Name ',
                            'meta_key' => 'company_name',
                            'dropdown' => false
                        ),
                'available_date' => array(
                            'label' => 'Available Date ',
                            'meta_key' => 'available_date',
                            'dropdown' => false
                        ),
                'vat_regi' => array(
                            'label' => 'VAT Regi ',
                            'meta_key' => 'vat_regi',
                            'dropdown' => false
                        ),
                'origin' => array(
                            'label' => 'Origin ',
                            'meta_key' => 'origin',
                            'dropdown' => false
                        ),
                'address' => array(
                            'label' => 'Address ',
                            'meta_key' => 'address',
                            'dropdown' => false
                        ),
                'feature_your_biz' => array(
                            'label' => 'Feature your biz ',
                            'meta_key' => 'feature_your_biz',
                            'dropdown' => false
                        ),
                'number_of_store' => array(
                            'label' => 'Number of Store ',
                            'meta_key' => 'number_of_store',
                            'dropdown' => false
                        ),
                'company_info' => array(
                            'label' => 'Company Info ',
                            'meta_key' => 'company_info',
                            'dropdown' => false
                        ),
                'property_description' => array(
                            'label' => 'Property Description ',
                            'meta_key' => 'property_description',
                            'dropdown' => false
                        ),

            );
    print custom_estate_listing_details($post->ID,3,'ABC4','Biz Details',$bizDetails);
?>


<!-- Features and Ammenties -->
<?php          
if ( count( $feature_list_array )!= 0 && count($feature_list_array)!=1 ){ //  if are features and ammenties
?>      
<div class="panel-group property-panel" id="accordion_prop_features">  
    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion_prop_features" href="#collapseThree">
              <?php
                if($property_features_text ==''){
                    print '<h4 class="panel-title" id="prop_ame">'.__('Amenities and Features', 'wpestate').'</h4>';
                }else{
                    print '<h4 class="panel-title" id="prop_ame">'. $property_features_text.'</h4>';
                }
              ?>
            </a>
        </div>
        <div id="collapseThree" class="panel-collapse collapse in">
          <div class="panel-body">
          <?php print estate_listing_features($post->ID); ?>
          </div>
        </div>
    </div>
</div>  
<?php
} // end if are features and ammenties
?>
<!-- END Features and Ammenties -->


<?php
    $prpg_slider_type_status= esc_html ( get_option('wp_estate_global_prpg_slider_type','') );    
    $local_pgpr_slider_type_status  =   get_post_meta($post->ID, 'local_pgpr_slider_type', true);
    if( ($local_pgpr_slider_type_status=='global' && $prpg_slider_type_status == 'full width header'  ) ||
            $local_pgpr_slider_type_status=='full width header'  ){     
   
    ?>
    <div class="panel-group property-panel" id="accordion_prop_map">  
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion_prop_map" href="#collapsemap">
                    <h4 class="panel-title" id="prop_ame"><?php _e('Map', 'wpestate');?></h4>
                  
                </a>
            </div>
            <div id="collapsemap" class="panel-collapse collapse in">
              <div class="panel-body">
              <?php print do_shortcode('[property_page_map propertyid="'.$post->ID.'"][/property_page_map]') ?>
              </div>
            </div>
        </div>
    </div> 


    <?php
    }
?>


<!-- Walkscore -->    

<?php
    $virtual_tour                   =   get_post_meta($post->ID, 'embed_virtual_tour', true);
    if($virtual_tour!=''){?>

    
<div class="panel-group property-panel" id="accordion_virtual_tour">  
    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion_virtual_tour" href="#collapsenine">
                <?php
                    print '<h4 class="panel-title" id="prop_ame">'.__('Virtual Tour', 'wpestate').'</h4>';
                ?>
            </a>
        </div>

        <div id="collapsenine" class="panel-collapse collapse in">
            <div class="panel-body">
                <?php wpestate_virtual_tour_details($post->ID); ?>
            </div>
        </div>
    </div>
</div>  



       
<?php       
    }
?>


<!-- Walkscore -->    

<?php
    $walkscore_api= esc_html ( get_option('wp_estate_walkscore_api','') );
    if($walkscore_api!=''){?>

    
<div class="panel-group property-panel" id="accordion_walkscore">  
    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion_walkscore" href="#collapseFour">
                <?php
                    print '<h4 class="panel-title" id="prop_ame">'.__('WalkScore', 'wpestate').'</h4>';
                ?>
            </a>
        </div>

        <div id="collapseFour" class="panel-collapse collapse in">
            <div class="panel-body">
                <?php wpestate_walkscore_details($post->ID); ?>
            </div>
        </div>
    </div>
</div>  



       
<?php       
    }
?>



<?php
$yelp_client_id         =   get_option('wp_estate_yelp_client_id','');
$yelp_client_secret     =   get_option('wp_estate_yelp_client_secret','');
if($yelp_client_secret!=='' && $yelp_client_id!==''  ){
?>

<div class="panel-group property-panel" id="accordion_yelp">  
    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion_yelp" href="#collapseyelp">
                <?php
                    print '<h4 class="panel-title" id="prop_ame">'.__('What\'s Nearby', 'wpestate').'</h4>';
                ?>
            </a>
        </div>

        <div id="collapseyelp" class="panel-collapse collapse in">
            <div class="panel-body">
                <?php wpestate_yelp_details($post->ID); ?>
            </div>
        </div>
    </div>
</div>  

<?php
}
?>




<?php // floor plans
if ( $use_floor_plans==1 ){ 
?>

<div class="panel-group property-panel" id="accordion_prop_floor_plans">  
    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion_prop_floor_plans" href="#collapseflplan">
                <?php
                    print '<h4 class="panel-title" id="prop_ame">'.__('Floor Plans', 'wpestate').'</h4>';
                ?>
            </a>
        </div>

        <div id="collapseflplan" class="panel-collapse collapse in">
            <div class="panel-body">
                <?php print estate_floor_plan($post->ID); ?>
            </div>
        </div>
    </div>
</div>  


<?php
}
?>


<?php
if($show_graph_prop_page=='yes'){
?>
    <div class="panel-group property-panel" id="accordion_prop_stat">
        <div class="panel panel-default">
           <div class="panel-heading">
               <a data-toggle="collapse" data-parent="#accordion_prop_stat" href="#collapseSeven">
                <h4 class="panel-title">  
                <?php 
                    _e('Page Views Statistics','wpestate');
               
                ?>
                </h4>    
               </a>
           </div>
           <div id="collapseSeven" class="panel-collapse collapse in">
             <div class="panel-body">
                <canvas id="myChart"></canvas>
             </div>
           </div>
        </div>            
    </div>    
    <script type="text/javascript">
    //<![CDATA[
        jQuery(document).ready(function(){
             wpestate_show_stat_accordion();
        });
    
    //]]>
    </script>
<?php
}

?>