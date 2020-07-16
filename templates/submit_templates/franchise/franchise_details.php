<?php
global $space_required;
global $average_staff;
global $royalty_fee;
global $brand_logo;
global $photo;
global $docs;
global $website_address;
global $video;
global $submission_page_fields;
global $action;
global $edit_id;
global $attchs;
global $attchsL;

$images='';
$thumbid='';
$attachid='';
$floor_link                     =   get_dasboard_floor_plan();
$floor_link                     =   esc_url_raw ( add_query_arg( 'floor_edit', $edit_id, $floor_link) ) ;
$use_floor_plans                =   get_post_meta($edit_id, 'use_floor_plans', true);


    if(is_array($attchs)){
        $attachid= implode(',', $attchs);
    }

    if ($action=='edit'){
        wp_reset_postdata();
        wp_reset_query();
        $arguments = array(
            'post_type'         =>  'attachment',
            'posts_per_page'    =>  -1,
            'post_status'       =>  'any',
            'post_parent'       =>  $edit_id,
            'orderby'           =>  'menu_order',
            'order'             =>  'ASC'
        );

        $post_attachments   = get_posts($arguments);
        $post_thumbnail_id  = $thumbid = get_post_thumbnail_id( $edit_id );
        $attachid='';

        foreach ($post_attachments as $attachment) {
            $preview =  wp_get_attachment_image_src($attachment->ID, 'user_picture_profile');    

            if($preview[0]!=''){
                $images .=  '<div class="uploaded_images" data-imageid="'.$attachment->ID.'"><img src="'.$preview[0].'" alt="thumb" /><i class="fa fa-trash-o"></i>';
                if($post_thumbnail_id == $attachment->ID){
                    $images .='<i class="fa thumber fa-star"></i>';
                }
            }else{
                $images .=  '<div class="uploaded_images" data-imageid="'.$attachment->ID.'"><img src="'.get_template_directory_uri().'/img/pdf.png" alt="thumb" /><i class="fa fa-trash-o"></i>';
                if($post_thumbnail_id == $attachment->ID){
                    $images .='<i class="fa thumber fa-star"></i>';
                }
            }
            
            $images .='</div>';
            $attachid.= ','.$attachment->ID;
        }
    }

//end photo upload-------------------------------------------------------------------------

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
              
                $custom_fields_show !=  ''
     
            )
        ) { ?>    
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">
        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Franchise Details','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('Price and Expected sale. ','wpestate')?></div>
        </div>
        
        
        <div class="col-md-8">
            <?php
            
                $user_role = display_user_roles();
                if(is_franchise()){
                ?>
            <div style="clear:both"></div>
            <div class="row" >         
                    <div class="col-md-12">
                            <p>
                                <label for="space_required"><?php _e('Space required(fee,deposit,period)','wpestate');?></label>
                                <input type="text" id="space_required" class="form-control" value="<?php echo esc_html($space_required);?>"  name="space_required">
                            </p>
                    </div>
                    <div class="col-md-6">
                            <p>
                                <label for="average_staff"><?php _e('Average Staff','wpestate');?></label>
                                <input type="text" id="average_staff" class="form-control" value="<?php echo esc_html($average_staff);?>"  name="average_staff" onkeypress="return isNum(event)">
                            </p>
                    </div>         
                    <div class="col-md-6">
                            <p>
                                <label for="royalty_fee"><?php _e('Royalty fee','wpestate');?></label>
                                <input type="text" id="royalty_fee" class="form-control" value="<?php echo esc_html($royalty_fee);?>"  name="royalty_fee" onkeypress="return isNum(event)" >
                            </p>
                    </div>
                
                     <div class="col-md-12 add-estate profile-page profile-onprofile ">
                            <p>
                                <label for="photo"><?php _e('Brand Logo','wpestate');?></label>
                            </p>
                            <?php
                                  include(locate_template('templates/submit_templates/franchise/brand_logo.php')); 
                            ?>
                                
                    </div>

                     <div class="col-md-12 add-estate profile-page profile-onprofile ">
                            <p>
                                <label for="photo"><?php _e('Upload Photo','wpestate');?></label>
                            </p>
                            <?php
                                  include(locate_template('templates/submit_templates/franchise/photo.php')); 
                            ?>
                                
                    </div>
                     <div class="col-md-12">
                            <p>
                                <label for="docs"><?php _e('Docs','wpestate');?></label>
                                
                            </p>
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
             </div><!--end row-->
            <?php
             }//end franchise -----------------------------------------------------------
            ?>

        </div>
        
            
        
    </div>  
</div>

<?php }?>