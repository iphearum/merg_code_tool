<?php
global $property_city;
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
           (    in_array('property_city', $submission_page_fields) ||              
                $custom_fields_show !=  ''
     
            )
        ) { ?>    


<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">
        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Select Location','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('Please Select your business location. ','wpestate')?></div>
        </div>
        
        
        <div class="col-md-8">
            <?php
           
            $user_role = display_user_roles();
            if(is_franchise()){
            ?>
            <div style="clear:both"></div>
            <div class="row" >          
            
             <div class="col-md-12">
                 <p class="">
                    <label for="property_city"><?php _e('Location/City','wpestate');?></label>
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
            

         
             </div><!--end row-->
            <?php

                }//end franchise -----------------------------------------------------------
            ?>

        </div>
        
            
        
    </div>  
</div>

<?php }?>