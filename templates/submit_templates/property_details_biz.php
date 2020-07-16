<?php
global $unit;
global $property_size;
global $property_lot_size;
global $property_rooms;
global $property_bedrooms;
global $property_bathrooms;
global $custom_fields_array;
global $owner_notes;
global $submission_page_fields;

/*Add New Field Property for Biz for Seller */
global $ownertype ;
global $listing_head ;
global $overview;
global $reason ;
global $biz_status;
/*end adding new field------*/


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
           (    in_array('property_size', $submission_page_fields) || 
                in_array('property_lot_size', $submission_page_fields) || 
                in_array('property_rooms', $submission_page_fields) ||
                in_array('property_bedrooms', $submission_page_fields) ||
                in_array('property_bathrooms', $submission_page_fields) ||
                in_array('owner_notes', $submission_page_fields) ||

      
                $custom_fields_show !=  ''
     
            )
        ) { ?>    


<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">
        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Listing Details','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('Add a little more info about your property. ','wpestate')?></div>
        </div>
        
        
        <div class="col-md-8">
            <?php if(   is_array($submission_page_fields) && in_array('property_size', $submission_page_fields)) { ?>
                <p class="half_form">
                    <label for="property_size"> <?php _e('Size in','wpestate');print ' '.$measure_sys.'<sup>2</sup> '.__(' (*only numbers)','wpestate');?></label>
                    <input type="text" id="property_size" size="40" class="form-control"  name="property_size" value="<?php print $property_size;?>">
                </p>
            <?php }?>

            <?php if(   is_array($submission_page_fields) && in_array('property_lot_size', $submission_page_fields)) { ?>
                <p class="half_form ">
                    <label for="property_lot_size"> <?php  _e('Lot Size in','wpestate');print ' '.$measure_sys.'<sup>2</sup> '.__(' (*only numbers)','wpestate');?> </label>
                    <input type="text" id="property_lot_size" size="40" class="form-control"  name="property_lot_size" value="<?php print $property_lot_size;?>">
                </p>
            <?php }?>

            <?php if(   is_array($submission_page_fields) && in_array('property_rooms', $submission_page_fields)) { ?>
                <p class="half_form ">
                    <label for="property_rooms"><?php _e('Rooms (*only numbers)','wpestate');?></label>
                    <input type="text" id="property_rooms" size="40" class="form-control"  name="property_rooms" value="<?php print $property_rooms;?>">
                </p>
            <?php }?>

            <?php if(   is_array($submission_page_fields) && in_array('property_bedrooms', $submission_page_fields)) { ?>
                <p class="half_form ">
                    <label for="property_bedrooms "><?php _e('Bedrooms (*only numbers)','wpestate');?></label>
                    <input type="text" id="property_bedrooms" size="40" class="form-control"  name="property_bedrooms" value="<?php print $property_bedrooms;?>">
                </p>
            <?php }?>

            <?php if(   is_array($submission_page_fields) && in_array('property_bathrooms', $submission_page_fields)) { ?>
                <p class="half_form ">
                    <label for="property_bathrooms"><?php _e('Bathrooms (*only numbers)','wpestate');?></label>
                    <input type="text" id="property_bathrooms" size="40" class="form-control"  name="property_bathrooms" value="<?php print $property_bathrooms;?>">
                </p>
            <?php }?>

            <!-- Add custom details -->
            <?php
            echo $custom_fields_show;
            ?>  
           

            <?php if(   is_array($submission_page_fields) && in_array('owner_notes', $submission_page_fields)) { ?>
                <p class="full_form ">
                    <label for="owner_notes"><?php _e('Owner/Agent notes (*not visible on front end)','wpestate');?></label>
                    <textarea id="owner_notes" class="form-control"  name="owner_notes" ><?php print $owner_notes;?></textarea>
                </p>
            <?php } ?>    

        </div>
        
            <?php
            //It will show Seller-Franchise more field here....if the role is franchise-----------------
                $user_role=display_user_roles();
                if($user_role=='s_biz_for_sale'){
                ?>
            <div style="clear:both"></div>
             <h4>Additional Properties for Biz for Sale Account</h4>
                <div class="row" style="border:1px dashed gray;padding:10px">           
                <div class="col-md-6">
                        <p>
                            <label for="listing_head"><?php _e('Listing headline','wpestate');?></label>
                            <input type="text" id="listing_head" class="form-control" value="<?php echo esc_html($listing_head);?>"  name="listing_head">
                        </p>
                </div>
               
                 <div class="col-md-6">
                     <p class="">
                        <label for="ownertype"><?php _e('I am a ','wpestate');?></label>
                        <?php
                         $args=array(
                                            'class'       => 'form-control form-control100',
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
                <div style="clear:both"></div>
                 <div class="col-md-4">
                        <p>
                        <label for="overview"><?php _e('Overview','wpestate');?></label>
                        <textarea id="overview" class="form-control" name="overview"><?php echo ($overview);?></textarea>
                    </p>
                </div>
                <div class="col-md-4">
                        <p>
                        <label for="reason"><?php _e('Reason','wpestate');?></label>
                        <textarea id="reason" class="form-control" name="reason"><?php echo ($reason);?></textarea>
                    </p>
                </div>
                <div class="col-md-4">
                        <p>
                        <label for="biz_status"><?php _e('Status of Biz','wpestate');?></label>
                        <textarea id="biz_status" class="form-control" name="biz_status"><?php echo ($biz_status);?></textarea>
                    </p>
                </div>

         
             </div><!--end row-->
            <?php

                }//end franchise -----------------------------------------------------------
            ?>
        
    </div>  
</div>

<?php }?>