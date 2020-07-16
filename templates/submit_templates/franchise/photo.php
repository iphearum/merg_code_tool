<?php

global $action;
global $edit_id;
global $attchs;



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
    ?>
                          
<div class="submit_container">
        <div id="upload-container">                 
            <div id="aaiu-upload-container">                 
                <div id="aaiu-upload-imagelist">
                    <ul id="aaiu-ul-list" class="aaiu-upload-list"></ul>
                </div>

                <div id="imagelist">

                    <?php 
                   
                    if($images!=''){
                        print $images;
                    } 

                    if ( ($attachid!='' && $action!='edit') ){
                        $attchs=explode(',',$attachid);
                        $attachid=''; 
                        foreach($attchs as $att_id){
                            if( $att_id!='' && is_numeric($att_id) ){
                                $attachid .= $att_id.',';
                                $preview =  wp_get_attachment_image_src($att_id, 'user_picture_profile');    

                                if($preview[0]!=''){
                                    $images .=  '<div class="uploaded_images" data-imageid="'.$att_id.'"><img src="'.$preview[0].'" alt="thumb" /><i class="fa fa-trash-o"></i>';

                                }else{
                                    $images .=  '<div class="uploaded_images" data-imageid="'.$att_id.'"><img src="'.get_template_directory_uri().'/img/pdf.png" alt="thumb" /><i class="fa fa-trash-o"></i>';

                                }
                                $images .='</div>';
                            }
                        }
                        print $images;
                    }
                ?>  
                </div>
                 <button id="aaiu-uploader"  class="wpresidence_button wpresidence_success">
                    <?php _e('Select Media','wpestate');?>
                </button>                                            
                <p class="full_form full_form_image">
                    <?php 
                    _e('* At least 1 image is required for a valid submission.Minimum size is 500/500px.','wpestate');
                    $max_images=intval   ( get_option('wp_estate_prop_image_number','') );
                    if($max_images!=0){
                        printf( __(' You can upload maximum %s images','wpestate'),$max_images);
                    }
                    print '</br>'; 
                    _e('** Double click on the image to select featured.','wpestate');print '</br>';
                    _e('*** Change images order with Drag & Drop.','wpestate');print '</br>';
                    _e('**** PDF files upload supported as well.','wpestate');?>
                </p>
    
                <input type="hidden" name="attachid" id="attachid" value="<?php echo esc_html($attachid);?>">
                <input type="hidden" name="attachthumb" id="attachthumb" value="<?php echo esc_html($thumbid);?>">
            </div>  
    </div>
</div> 
                                
                

           
