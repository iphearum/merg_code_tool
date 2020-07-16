<?php
global $submission_page_fields;
global $offering ;     
global $brand_name   ;
global $overview;
global $about_your_brand;
global $title;
global $submit_title;

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
           (    in_array('offering', $submission_page_fields) ||
                in_array('brand_name', $submission_page_fields) ||
                in_array('submit_title', $submission_page_fields) ||
                in_array('overview', $submission_page_fields) ||
                in_array('about_your_brand', $submission_page_fields) ||
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
            <?php
            $user_role = display_user_roles();
            if(is_franchise()) {
            ?>
            <div style="clear:both"></div>
            <div class="row" >
            <div class="col-md-12">
                    <p>
                        <label for="wpestate_title"><?php _e('Title','wpestate');?></label>
                        <input type="text" id="wpestate_title" class="form-control" value="<?php echo esc_html($submit_title);?>"  name="wpestate_title">
                    </p>
            </div>           
            <div class="col-md-6">
                    <p>
                        <label for="brand_name"><?php _e('Brand name','wpestate');?></label>
                        <input type="text" id="brand_name" class="form-control" value="<?php echo esc_html($brand_name);?>"  name="brand_name">
                    </p>
            </div>
            
             <div class="col-md-6">
                 <p class="">
                    <label for="offering"><?php _e('Offer for','wpestate');?></label>
                    <?php
                     $args=array(
                                        'class'       => 'form-control',
                                        'hide_empty'  => false,
                                        'selected'    => $offering,
                                        'name'        => 'offering',
                                        'id'          => 'offering',
                                        'orderby'     => 'NAME',
                                        'order'       => 'ASC',
                                        'show_option_none'   => __('None','wpestate'),
                                        'taxonomy'    => 'offering',
                                        'hierarchical'=> true,
                                        'value_field' => 'key'
                                    );
                                    wp_dropdown_categories( $args );
                    ?>
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
                        <label for="about_your_brand"><?php _e('About Your Brand','wpestate');?></label>
                        <input type="text" id="about_your_brand" class="form-control" value="<?php echo esc_html($about_your_brand);?>"  name="about_your_brand">
                    </p>
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