<?php
// Template Name: User Dashboard Submit
// Wp Estate Pack

if ( !is_user_logged_in() ) {   
     wp_redirect( home_url() );exit;
} 

if ( is_buyer() ) {
    wp_redirect( esc_url(get_dashboard_profile_link()) );exit;
}

 add_filter('wp_kses_allowed_html', 'wpestate_add_allowed_tags');


$current_user = wp_get_current_user();
$userID                         =   $current_user->ID;
$user_pack                      =   get_the_author_meta( 'package_id' , $userID );
$status_values                  =   esc_html( get_option('wp_estate_status_list') );
$status_values_array            =   explode(",",$status_values);
$feature_list_array             =   array();
$feature_list                   =   esc_html( get_option('wp_estate_feature_list') );
$feature_list_array             =   explode( ',',$feature_list);
$allowed_html                   =   array();
$submission_page_fields         =   ( get_option('wp_estate_submission_page_fields','') );
$all_submission_fields          =   wpestate_return_all_fields();
$gettype = '';
//custom fields from function
if ( is_franchise() ) {
    $gettype = 'franchise';
    $fields = custom_property_fields('franchise');

} else if (is_biz_for_sale() ) {
    $gettype = 'biz_for_sale';
    $fields = custom_property_fields('biz_for_sale');

} else if (is_administrator()) {
    $gettype = $_GET['type'];
    if ($gettype == 'franchise'){
        $fields = custom_property_fields('franchise');
    } else if ($gettype == 'biz_for_sale'){
         $fields = custom_property_fields('biz_for_sale');
    }
}

global $show_err;
global $submission_page_fields;
global $all_submission_fields;

global $data;

$allowed_html_desc = array (
    'a' => array(
        'href' => array(),
        'title' => array()
    ),
    'br'        =>  array(),
    'em'        =>  array(),
    'strong'    =>  array(),
    'ul'        =>  array('li'),
    'li'        =>  array(),
    'code'      =>  array(),
    'ol'        =>  array('li'),
    'del'       =>  array(
                    'datetime'=>array()
                ),
    'blockquote'=> array(),
    'ins'       =>  array(),
);

if( isset( $_GET['listing_edit'] ) && is_numeric( $_GET['listing_edit'] ) ){

    $edit_id                        =  intval ($_GET['listing_edit']);
  
    $the_post= get_post( $edit_id); 

    if( $current_user->ID != $the_post->post_author ) {
        exit('You don\'t have the rights to edit this');
    }
    
    $show_err                       =   '';
    $action                         =   'edit';
    $submit_title                   =   get_the_title($edit_id);
    $submit_description             =   get_post_field('post_content', $edit_id);
    
    foreach ($fields['fields'] as $key => $columns) {
        foreach ($columns['columns'] as $c_key => $value) {

            $is_post_title = isset($value['is_post_title']) ? : false;
            $is_post_description = isset($value['is_post_description']) ? : false;
            $is_thumbnail = isset($value['is_thumbnail']) ? : false;
            $type = isset($value['type']) ? $value['type'] : 'text';

            if ($is_post_title) {
                $data[$c_key] = $submit_title;
            }
            else if ($is_post_description) {
                $data[$c_key] = $submit_description;
            } 
            else if ($is_thumbnail) {
                $data[$c_key] = get_post_attachments_by_id($edit_id);
        
            } else {
                switch ($type) {
                    case 'number':
                        $value = intval(get_post_meta($edit_id, $c_key, true) ); 
                        break;
                    case 'float':
                        $value = floatval(get_post_meta($edit_id, $c_key, true) ); 
                        break;

                    case 'iframe':
                    case 'file':
                        if ($is_thumbnail) {
                            $value = get_post_attachments_by_id($edit_id);
                        }else {
                            $value = esc_html( get_post_meta($edit_id, $c_key, true) );
                        }   
                        
                        break;
                    case 'text':
                    default:
                        $value = esc_html( get_post_meta($edit_id, $c_key, true) );
                        break;
                }
                $data[$c_key] = $value;
            }
            
        }
    }
   
    /**
     * Keep the same
     */
    foreach ($status_values_array as $key => $value) {
        $value = (trim($value));
        $value_wpml = $value;
        $slug_status = sanitize_title($value);

        if ( function_exists('icl_translate') ){
            $value_wpml= icl_translate('wpestate','wp_estate_property_status_front_'.$slug_status,$value );
        }
        
        $property_status.='<option value="' . $value . '"';

        if ($value == $prop_stat) {
            $property_status .= 'selected="selected"';
        }
        $property_status .= '>' .stripslashes( $value_wpml) . '</option>';
    }
    

} else {    
    ///////////////////////////////////////////////////////////////////////////////////////////
    /////// If default view make vars blank 
    ///////////////////////////////////////////////////////////////////////////////////////////
    $action                         =   'view';
    $submit_title                   =   ''; 
    $submit_description             =   ''; 
    $prop_category                  =   ''; 
    $property_address               =   ''; 
    $property_county                =   ''; 
    $property_state                 =   ''; 
    $property_zip                   =   ''; 
    $country_selected               =   ''; 
    $prop_stat                      =   ''; 
    $property_status                =   '';
    $property_price                 =   ''; 
    $property_label                 =   '';   
    $property_label_before          =   '';  
    $property_size                  =   ''; 
    $owner_notes                    =   '';   
    $property_lot_size              =   ''; 
    $property_year                  =   ''; 
    $property_rooms                 =   ''; 
    $property_bedrooms              =   ''; 
    $property_bathrooms             =   ''; 
    $option_video                   =   '';
    $option_slider                  =   '';
    $video_type                     =   '';  
    $embed_video_id                 =   ''; 
    $virtual_tour                   =   '';
    $property_latitude              =   ''; 
    $property_longitude             =   '';  
    $google_view                    =   ''; 
    $google_camera_angle            =   ''; 
    $prop_category                  =   '';  
    $plan_title_array               =   '';
    $plan_desc_array                =   '';
    $plan_image_array               =   '';
    $plan_size_array                =   '';
    $plan_rooms_array               =   '';
    $plan_bath_array                =   '';
    $plan_price_array               =   '';
    $property_has_subunits          =   '';
    $property_subunits_list         =   '';
    
    $custom_fields = get_option( 'wp_estate_custom_fields', true);    
    $custom_fields_array=array();
    $i=0;
    if( !empty($custom_fields)){  
        while($i< count($custom_fields) ){
           $name    =   $custom_fields[$i][0];
           $type    =   $custom_fields[$i][2];
           $slug    =   wpestate_limit45(sanitize_title( $name ));
           $slug    =   sanitize_key($slug);
           $custom_fields_array[$slug]='';
           $i++;
        }
    }
    
    foreach ($status_values_array as $key=>$value) {
        $value          =   trim($value);
        $value_wpml     =   $value;
        $slug_status    =   sanitize_title($value);
        if (function_exists('icl_translate') ){
            $value_wpml = icl_translate('wpestate','wp_estate_property_status_front_'.$slug_status,$value );
        }
        $property_status.='<option value="' . $value . '"';
        $property_status.='>' . $value_wpml . '</option>';
    }
    
    $video_values  =   array('vimeo', 'youtube');
    foreach ($video_values as $value) {
      $option_video.='<option value="' . $value . '"';
      $option_video.='>' . $value . '</option>';
    }    

    $option_slider ='';
    $slider_values = array('full top slider', 'small slider');
      
    foreach ($slider_values as $value) {
        $option_slider.='<option value="' . $value . '"';
        $option_slider.='>' . $value . '</option>';
    }
}

///////////////////////////////////////////////////////////////////////////////////////////
/////// Submit Code
///////////////////////////////////////////////////////////////////////////////////////////

if( 'POST' == $_SERVER['REQUEST_METHOD'] && $_POST['action'] == 'view' ) {
    $paid_submission_status    = esc_html ( get_option('wp_estate_paid_submission','') );
     
    if ( $paid_submission_status != 'membership' || 
            ( $paid_submission_status== 'membership' || 
            wpestate_get_current_user_listings($userID) > 0)  ){ // if user can submit
        
        if ( !isset($_POST['new_estate']) || !wp_verify_nonce($_POST['new_estate'],'submit_new_estate') ){
           exit('Sorry, your not submiting from site'); 
        }
                
        $show_err                       =   '';
        $post_id                        =   '';
        $has_errors                      =   false;
        $errors                         =   array();

        $data = array();
        $meta_data = array();
        $handle_attachs = array();
        // validate fields 
        $title      = '';
        $description    =   '';
       
        $hold_fields = user_add_validation($fields);
        $errors = $hold_fields['errors'];
        $data = $hold_fields['data'];
        $meta_data = $hold_fields['meta_data'];
        $handle_attachs = $hold_fields['handle_attachs'];
        
        $post_title = isset($hold_fields['post_title']) ? $hold_fields['post_title'] : '';
        $post_content = isset($hold_fields['post_content']) ? $hold_fields['post_content'] : '';
        $thumbnail = isset($hold_fields['thumbnail']) ? $hold_fields['thumbnail'] : '';
       
        if (count($errors)) {
            foreach($errors as $key=>$value){
                $show_err .= $value.'</br>';
            }            
        } else {
            $paid_submission_status = esc_html ( get_option('wp_estate_paid_submission','') );
            $new_status             = 'pending';
            $new_status             = 'publish';
            
            $admin_submission_status= esc_html ( get_option('wp_estate_admin_submission','') );
            
            if ($admin_submission_status=='no' && $paid_submission_status != 'per listing') {
               $new_status = 'publish';  
            }

            $post = array(
                'post_title'	=> $post_title,
                'post_content'	=> $post_content,
                'post_status'	=> $new_status, 
                'post_type'     => 'estate_property' ,
                'post_content_filtered' => $gettype,
                'post_author'   => $current_user->ID 
            );
            $post_id =  wp_insert_post($post );  

            if( $paid_submission_status == 'membership'){ // update pack status
                wpestate_update_listing_no($current_user->ID);                
            }
        }
        
        
        //if inserted to post
        if($post_id) {
            // uploaded images or files
            $order  =   0;
            $last_id='';

            //upload attachements
            foreach ($handle_attachs as  $att_id){
            
                if( is_numeric($att_id) ) {
                    if ( $last_id == '' ) {
                        $last_id =  $att_id;  
                    }

                    $order++;

                    wp_update_post( array(
                        'ID' => $att_id,
                        'post_parent' => $post_id,
                        'menu_order' => $order
                    ));
                }
            }

            if ( isset($_POST['attachthumb ']) &&  is_numeric($_POST['attachthumb']) && $_POST['attachthumb']!=''  ){
                set_post_thumbnail( $post_id, wp_kses(esc_html($_POST['attachthumb']),$allowed_html )); 
            } else {
                set_post_thumbnail( $post_id, $last_id );                
            }

            foreach ($meta_data as $key => $value) {
                $value                =   sanitize_text_field ( wp_kses( $value ,$allowed_html) );
                update_post_meta( $post_id, $key , $value) ;
            }
            
            // get user dashboard link
            $redirect = get_dashboard_link();
            
            $arguments = array(
                'new_listing_url'   => get_permalink($post_id),
                'new_listing_title' => $post['post_title']
            );
            // wpestate_select_email_type(get_option('admin_email'),'new_listing_submission',$arguments);
            wpestate_send_email_to_seller($post_title);
            wpestate_send_email_to_admin($post_title);
    
            wp_reset_query();
            wp_redirect( $redirect);
            exit;
        }
    }//end if user can submit   
} // end post

///////////////////////////////////////////////////////////////////////////////////////////
/////// Edit Part Code
///////////////////////////////////////////////////////////////////////////////////////////
if( 'POST' == $_SERVER['REQUEST_METHOD'] && $_POST['action'] == 'edit' ) {

  // var_dump($_POST);exit;
    $show_err                       =   '';
    $post_id                        =   '';
    $has_errors                      =   false;
    $errors                         =   array();
    $edited                         =   '';
    
    $hold_fields = user_add_validation($fields);
    $errors = $hold_fields['errors'];
    $data = $hold_fields['data'];
    $meta_data = $hold_fields['meta_data'];
    $handle_attachs = $hold_fields['handle_attachs'];
    
    $post_title = isset($hold_fields['post_title']) ? $hold_fields['post_title'] : '';
    $post_content = isset($hold_fields['post_content']) ? $hold_fields['post_content'] : '';
    $thumbnail = isset($hold_fields['thumbnail']) ? $hold_fields['thumbnail'] : '';
   
    if (count($errors)) {
        foreach($errors as $key =>$value){
            $show_err .= $value.'</br>';
        }            
    } else {
        $new_status             = 'publish'; 
        $post = array(
            'ID'    => intval( $_POST['edit_id']),
            'post_title'    => $post_title,
            'post_content'  => $post_content,
            'post_status'   => $new_status, 
            'post_content_filtered' => $gettype,
            'post_type'     => 'estate_property' ,
            'post_author'   => $current_user->ID 
        );
        $post_id =  wp_update_post($post ); 
        $edited = 1;
       
    }

    //end validation
    if ($edited) {  

        // check for deleted images
        $arguments = array(
                    'numberposts'   => -1,
                    'post_type'     => 'attachment',
                    'post_parent'   => $post_id,
                    'post_status'   => null,
                    'orderby'       => 'menu_order',
                    'order'         => 'ASC'
        );
        $post_attachments = get_posts($arguments);
        $new_thumb=0;
        // echo '<pre>';
        // echo 'attachement';
        // print_r($post_attachments);
        // echo '<br/>';
        // echo 'handle_attache';
        // print_r($handle_attachs);
        // echo '<br/>';
        // echo 'thumbnail';
        // print_r($_POST[$thumbnail]);

        // var_dump(isset($_POST[$thumbnail]));
        // exit();
        $curent_thumb = get_post_thumbnail_id($post_id);
        
        foreach ($post_attachments as $attachment) {
            if ( isset($_POST[$thumbnail]) && !in_array ($attachment->ID, $handle_attachs) ){            
                wp_delete_post($attachment->ID);
                if( $curent_thumb == $attachment->ID ){
                    $new_thumb = 1;
                }
            }
        }


        // edit thumbbnail
        // uploaded images or files
        $order  =   0;
        $last_id='';

        //upload attachements
        foreach($handle_attachs as  $att_id){
        
            if( is_numeric($att_id) ){

                if ($last_id == '') {
                    $last_id=  $att_id;  
                }
                
                $order++;

                wp_update_post( 
                    array(
                        'ID' => $att_id,
                        'post_parent' => $post_id,
                        'menu_order' => $order
                    )
                );
            }
               
        }
      
        if( isset($_POST['attachthumb']) && is_numeric($_POST['attachthumb']) && $_POST['attachthumb']!=''  ){
            set_post_thumbnail( $post_id, wp_kses(esc_html($_POST['attachthumb']), $allowed_html )); 
        }  

        if($new_thumb==1 || !has_post_thumbnail($post_id) || ( isset($_POST['attachthumb']) && $_POST['attachthumb']=='') ){
            set_post_thumbnail( $post_id, $last_id );
        }

        //update meta data
        foreach ($meta_data as $key => $value) {
            $value                =   sanitize_text_field ( wp_kses( $value ,$allowed_html) );
            update_post_meta( $post_id, $key , $value) ;
        }
        
        // get user dashboard link
        $redirect = get_dashboard_link();
        
        $arguments=array(
            'new_listing_url'   => get_permalink($post_id),
            'new_listing_title' => $post['post_title']
        );
        // wpestate_select_email_type(get_option('admin_email'),'listing_edit',$arguments);
        wpestate_send_email_to_seller($post_title);
        wpestate_send_email_to_admin($post_title);

        wp_reset_query();
        wp_redirect( $redirect);
        exit;
    }//end If post_id------------------------------------------------------- 
      
}

get_header();
$options = wpestate_page_details($post->ID);

///////////////////////////////////////////////////////////////////////////////////////////
/////// Html Form Code below
///////////////////////////////////////////////////////////////////////////////////////////
?> 
<?php
$current_user               =   wp_get_current_user();
$user_custom_picture        =   get_the_author_meta( 'small_custom_picture' , $current_user->ID  );
$user_small_picture_id      =   get_the_author_meta( 'small_custom_picture' , $current_user->ID  );
if( $user_small_picture_id == '' ){

    $user_small_picture[0]=get_template_directory_uri().'/img/default-user_1.png';
}else{
    $user_small_picture=wp_get_attachment_image_src($user_small_picture_id,'agent_picture_thumb');
    
}
?>


<div id="cover"></div>
<div class="row row_user_dashboard">

    <div class="col-md-3 user_menu_wrapper">
       <div class="dashboard_menu_user_image" style="margin-bottom:60px">
            <div class="menu_user_picture" style="background-image: url('<?php print $user_small_picture[0];  ?>');height: 80px;width: 80px;" ></div>
            <div class="dashboard_username">
                <?php _e('Welcome back, ','wpestate'); echo $user_login.'!';?>           
                <p style="color:white;font-weight: bold">[<?php  echo welcome_user_roles(); ?>]</p>

            </div> 
        </div>
     
        <?php  get_template_part('templates/user_menu');  ?>

    </div>  
    
    <div class="col-md-9 dashboard-margin">
        <?php   get_template_part('templates/breadcrumbs'); ?>
        <?php   get_template_part('templates/user_memebership_profile');  ?>
        <?php   get_template_part('templates/ajax_container'); ?>
        
        <?php 
            while (have_posts()) : the_post(); 
                if (esc_html( get_post_meta($post->ID, 'page_show_title', true) ) != 'no' && !is_administrator()) { 
                 echo '<h3 class="entry-title">'. the_title() .'</h3>';
                } 
            endwhile;

           get_template_part('templates/front_end_submission'); 
            
        ?> 
    </div>
</div>   
<?php   
remove_filter('wp_kses_allowed_html', 'wpestate_add_allowed_tags');        
get_footer();
?>