<?php
global $year_establish;
global $product_service;
global $procedure;
global $support_and_training;
global $origin;
global $submission_page_fields;

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
           (    in_array('year_establish', $submission_page_fields) || 
                in_array('product_service', $submission_page_fields) || 
                in_array('procedure', $submission_page_fields) || 
                in_array('support_and_training', $submission_page_fields) || 
                in_array('origin', $submission_page_fields) || 
             
                $custom_fields_show !=  ''
     
            )
        ) { ?>    


<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">
        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Biz Details','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('biz details. ','wpestate')?></div>
        </div>
        
        
        <div class="col-md-8">
            <?php           
            $user_role = display_user_roles();
            if(is_franchise()){
            ?>
            <div style="clear:both"></div>
            <div class="row" >         
                    <div class="col-md-6">
                            <p>
                                <label for="year_establish"><?php _e('Year Established','wpestate');?></label>
                                <input type="text" id="year_establish" class="form-control" value="<?php echo esc_html($year_establish);?>"  name="year_establish">
                            </p>
                    </div>
                    <div class="col-md-6">
                            <p>
                                <label for="product_service"><?php _e('Product/Service','wpestate');?></label>
                                <input type="text" id="product_service" class="form-control" value="<?php echo esc_html($product_service);?>"  name="product_service">
                            </p>
                    </div>         
                    <div class="col-md-6">
                            <p>
                                <label for="procedure"><?php _e('Procedure','wpestate');?></label>
                                <input type="text" id="procedure" class="form-control" value="<?php echo esc_html($procedure);?>"  name="procedure">
                            </p>
                    </div>
                    <div class="col-md-6">
                            <p>
                                <label for="support_and_training"><?php _e('Support and Training','wpestate');?></label>
                                <input type="text" id="support_and_training" class="form-control" value="<?php echo esc_html($support_and_training);?>"  name="support_and_training">
                            </p>
                    </div>
                     <div class="col-md-12">
                            <p>
                                <label for="origin"><?php _e('Origin','wpestate');?></label>
                                <input type="text" id="origin" class="form-control" value="<?php echo esc_html($origin);?>"  name="origin">
                            </p>
                    </div>
                    <div class="col-md-12">
                            <p>
                                <label for="wpestate_description"><?php _e('Property Description','wpestate');?></label>
                                <textarea id="wpestate_description" class="form-control" name="wpestate_description" rows="8"><?php echo ($submit_description);?></textarea>
                            </p>  
                    </div>
             </div><!--end row-->
            <?php
            }//end franchise -----------------------------------------------------------            ?>

        </div>
    </div>  
</div>

<?php }?>