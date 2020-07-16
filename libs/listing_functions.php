<?php
///////////////////////////////////////////////////////////////////////////////////////////
// floor plans
///////////////////////////////////////////////////////////////////////////////////////////


if( !function_exists('estate_floor_plan') ):
    function estate_floor_plan($post_id,$is_print=0){
        $is_print_class='';
        if($is_print==1){
            $is_print_class=' floor_print_class ';
        }
        
        $unit               = esc_html( get_option('wp_estate_measure_sys', '') );
        
        $plan_title_array   = get_post_meta($post_id, 'plan_title', true);
        $plan_desc_array    = get_post_meta($post_id, 'plan_description', true) ;
        $plan_image_array   = get_post_meta($post_id, 'plan_image', true) ;
        $plan_size_array    = get_post_meta($post_id, 'plan_size', true) ;
        $plan_image_attach_array    = get_post_meta($post_id, 'plan_image_attach', true) ;
    
        $plan_rooms_array   = get_post_meta($post_id, 'plan_rooms', true) ;
        $plan_bath_array    = get_post_meta($post_id, 'plan_bath', true);
        $plan_price_array   = get_post_meta($post_id, 'plan_price', true) ;
        
        $currency                   =   esc_html( get_option('wp_estate_currency_symbol', '') );
        $where_currency             =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
        global $lightbox;
        $lightbox                   =   '';
        $show= ' style="display:block"; ';
    
        if (is_array($plan_title_array)){        
            foreach ($plan_title_array as $key=> $plan_name) {

                if ( isset($plan_desc_array[$key])){
                    $plan_desc=$plan_desc_array[$key];
                }else{
                    $plan_desc='';
                }

                if ( isset($plan_image_attach_array[$key])){
                    $plan_image_attach=$plan_image_attach_array[$key];
                }else{
                    $plan_image_attach='';
                }

                if ( isset($plan_image_array[$key])){
                    $plan_img=$plan_image_array[$key];
                }else{
                    $plan_img='';
                }

                if ( isset($plan_size_array[$key]) && $plan_size_array[$key]!=''){
                    $plan_size='<span class="bold_detail">'.__('size:','wpestate').'</span> '.$plan_size_array[$key].' '.$unit.'<sup>2</sup>';
                }else{
                    $plan_size='';
                }

                if ( isset($plan_rooms_array[$key]) && $plan_rooms_array[$key]!=''){
                    $plan_rooms= '<span class="bold_detail">'.__('rooms: ','wpestate').'</span> '.$plan_rooms_array[$key];
                }else{
                    $plan_rooms='';
                }

                if ( isset($plan_bath_array[$key]) && $plan_bath_array[$key]!=''){
                    $plan_bath='<span class="bold_detail">'.__('baths:','wpestate').'</span> '.$plan_bath_array[$key];
                }else{
                    $plan_bath='';
                }
                $price='';
                if ( isset($plan_price_array[$key]) && $plan_price_array[$key]!=''){
                    $plan_price=$plan_price_array[$key];
                }else{
                    $plan_price='';
                }
                $full_img           = wp_get_attachment_image_src($plan_image_attach, 'full');

                print '
                <div class="front_plan_row '.$is_print_class.'">
                    <div class="floor_title">'.$plan_name.'</div>
                    <div class="floor_details">'.$plan_size.'</div>
                    <div class="floor_details">'.$plan_rooms.'</div>    
                    <div class="floor_details">'.$plan_bath.'</div> 
                    <div class="floor_details">';
                        if($plan_price!=''){
                            print  __('price: ','wpestate').' '.wpestate_show_price_floor($plan_price,$currency="",$where_currency,1);
                        }
                        print'</div> 
                </div>
                <div class="front_plan_row_image '.$is_print_class.' " '.$show.'>
                    <div class="floor_image">
                        <a href="'.$full_img[0].'" rel="prettyPhoto" title="'.$plan_desc.'"><img class="lightbox_trigger_floor" src="'.$full_img[0].'"  alt="'.$plan_name.'"></a>
                    </div>
                    <div class="floor_description">'.$plan_desc.'</div>
                </div>';
                $show='';
                
                
                $lightbox.='<div class="item" >
                                <div class="itemimage">
                                    <img src="'.$full_img[0].'" alt="'.$plan_name.'">
                                </div>
                        
                                <div class="lightbox_floor_details">
                                    <div class="floor_title">'.$plan_name.'</div>
                                    <div class="floor_light_desc">'.$plan_desc.'</div>    
                                    <div class="floor_details">'.$plan_size.'</div>
                                    <div class="floor_details">'.$plan_rooms.'</div>    
                                    <div class="floor_details">'.$plan_bath.'</div>
                                    <div class="floor_details">';
                                    if($plan_price!=''){
                                        $lightbox.= '<span class="bold_detail">'. __('price: ','wpestate').'</span> '.wpestate_show_price_floor($plan_price,$currency="",$where_currency,1);
                                    }
                                    $lightbox.='</div>
                                </div>
                        </div>';
                
                
            }
        
            
        get_template_part('templates/floorplans_gallery');    
        }
    }
endif;



///////////////////////////////////////////////////////////////////////////////////////////
// List features and ammenities
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('estate_listing_features') ):
function estate_listing_features($post_id,$col=3){
    $return_string='';    
    $counter            =   0;                          
    $feature_list_array =   array();

    global $wpdb;
    $temp = $wpdb->get_results("SELECT option_value FROM wp_options WHERE option_id = 213");
    $feature_list = $temp[0]->option_value;
        

        //$feature_list       =   esc_html( get_option('wp_estate_feature_list') );


    $feature_list_array =   explode( ',',$feature_list);
    $total_features     =   round( count( $feature_list_array )/2 );
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
        
     $show_no_features= esc_html ( get_option('wp_estate_show_no_features','') );

         
             
        if($show_no_features!='no'){
            foreach($feature_list_array as $checker => $value){
                    $counter++;
                    $post_var_name  =   str_replace(' ','_', trim($value) );
                    $input_name     =   wpestate_limit45(sanitize_title( $post_var_name ));
                    $input_name     =   sanitize_key($input_name);
                         
                    
                    if (function_exists('icl_translate') ){
                        $value     =   icl_translate('wpestate','wp_estate_property_custom_amm_'.$value, $value ) ;                                      
                    }
                                        
                    if (esc_html( get_post_meta($post_id, $input_name, true) ) == 1) {
                         $return_string .= '<div class="listing_detail col-md-'.$colmd.'"><i class="fa fa-check"></i>' . trim(stripslashes($value)) . '</div>';
                    }else{
                        $return_string  .=  '<div class="listing_detail col-md-'.$colmd.'"><i class="fa fa-times"></i>' .  trim(stripslashes($value)) . '</div>';
                    }
              }
        }else{

            foreach($feature_list_array as $checker => $value){
   

                $post_var_name  =  str_replace(' ','_', trim($value) );
                $input_name     =   wpestate_limit45(sanitize_title( $post_var_name ));
                $input_name     =   sanitize_key($input_name);

 

                if (function_exists('icl_translate') ){
                    //$value     =   icl_translate('wpestate','wp_estate_property_custom_amm_'.$value, $value ) ;                                      
                }
       

                if (esc_html( get_post_meta($post_id, $input_name, true)) == 1) {


                    $return_string .=  '<div class="listing_detail col-md-'.$colmd.'"><i class="fa fa-check"></i>' .__($value,'wpestate').'</div>';                        

                }

            }
           
       }
    
    return $return_string;
}
endif; // end   estate_listing_features  



if( !function_exists('estate_listing_content') ):
function estate_listing_content($post_id){
    $content='';
    $args= array( 
        'post_type'         => 'estate_property',
        'post_status'       => 'publish',
        'p' => $post_id
    );
    $the_query = new WP_Query( $args);
   
    
       while ($the_query->have_posts()) : 
            $the_query->the_post(); 
            
            $content= get_the_content();
        endwhile;
        
        wp_reset_postdata();
    
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    
      
    $args = array(  'post_mime_type'    => 'application/pdf', 
                'post_type'         => 'attachment', 
                'numberposts'       => -1,
                'post_status'       => null, 
                'post_parent'       => $post_id 
        );

    $attachments = get_posts($args);

    if ($attachments) {

        $content.= '<div class="download_docs">'.__('Documents','wpestate').'</div>';
        foreach ( $attachments as $attachment ) {
            $content.= '<div class="document_down"><a href="'. wp_get_attachment_url($attachment->ID).'" target="_blank">'.$attachment->post_title.'<i class="fa fa-download"></i></a></div>';
        }
    }

    wp_reset_postdata();
    
  
    return $content;     
    
}
endif;




if( !function_exists('estate_listing_address') ):
function estate_listing_address($post_id,$col=3){
    
    $property_address   = esc_html( get_post_meta($post_id, 'property_address', true) );
    $property_city      = get_the_term_list($post_id, 'property_city', '', ', ', '');
    $property_area      = get_the_term_list($post_id, 'property_area', '', ', ', '');
    $property_county    = get_the_term_list($post_id, 'property_county_state', '', ', ', '') ;
    $property_zip       = esc_html(get_post_meta($post_id, 'property_zip', true) );
    $property_country   = esc_html(get_post_meta($post_id, 'property_country', true) );
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    
    $return_string='';
    
    if ($property_address != ''){
        $return_string.='<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Address','wpestate').':</strong> ' . $property_address . '</div>'; 
    }
    if ($property_city != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('City','wpestate').':</strong> ' .$property_city. '</div>';  
    }  
    if ($property_area != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Area','wpestate').':</strong> ' .$property_area. '</div>';
    }    
    if ($property_county != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('State/County','wpestate').':</strong> ' . $property_county . '</div>'; 
    }
    if ($property_zip != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Zip','wpestate').':</strong> ' . $property_zip . '</div>';
    }  
    if ($property_country != '') {
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Country','wpestate').':</strong> ' . $property_country . '</div>'; 
    } 
    $property_address   =   esc_html( get_post_meta($post_id, 'property_address', true) );
    $property_city      =   strip_tags (  get_the_term_list($post_id, 'property_city', '', ', ', '') );
    $url                =   urlencode($property_address.','.$property_city);
    $google_map_url     =   "http://maps.google.com/?q=".$url;

    $return_string.= ' <a href="'.$google_map_url.'" target="_blank" class="acc_google_maps">'.__('Open In Google Maps','wpestate').'</a>';

    return  $return_string;
}
endif; // end   estate_listing_address  



if( !function_exists('estate_listing_address_print') ):
function estate_listing_address_print($post_id){
    
    $property_address   = esc_html( get_post_meta($post_id, 'property_address', true) );
    $property_city      = strip_tags (  get_the_term_list($post_id, 'property_city', '', ', ', '') );
    $property_area      = strip_tags ( get_the_term_list($post_id, 'property_area', '', ', ', '') );
    $property_county    = strip_tags ( get_the_term_list($post_id, 'property_county_state', '', ', ', '')) ;
    //$property_state     = esc_html(get_post_meta($post_id, 'property_state', true) );
    $property_zip       = esc_html(get_post_meta($post_id, 'property_zip', true) );
    //$property_state     = esc_html(get_post_meta($post_id, 'property_state', true) );
    
    $property_country   = esc_html(get_post_meta($post_id, 'property_country', true) );
    
    $return_string='';
    
    if ($property_address != ''){
        $return_string.='<div class="listing_detail col-md-4"><strong>'.__('Address','wpestate').':</strong> ' . $property_address . '</div>'; 
    }
    if ($property_city != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('City','wpestate').':</strong> ' .$property_city. '</div>';  
    }  
    if ($property_area != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('Area','wpestate').':</strong> ' .$property_area. '</div>';
    }    
    if ($property_county != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('State/County','wpestate').':  </strong> ' . $property_county . '</div>'; 
    }
   /* if ($property_state != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('State','wpestate').':</strong> ' . $property_state . '</div>';
    }
    
    */ 
    if ($property_zip != ''){
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('Zip','wpestate').':</strong> ' . $property_zip . '</div>';
    }  
    if ($property_country != '') {
        $return_string.= '<div class="listing_detail col-md-4"><strong>'.__('Country','wpestate').':</strong> ' . $property_country . '</div>'; 
    } 
    
 
    return  $return_string;
}
endif; // end   estate_listing_address  




if(!function_exists('get_userrole_by_id')) {
    function get_userrole_by_id($user_id) {
        $user_info = get_userdata( $user_id );
        $user_roles = implode(', ', $user_info->roles);
        return $user_roles;
    }
}

if( !function_exists('estate_listing_details') ):
function estate_listing_details($post_id,$col=3){
  
    $currency       =   esc_html( get_option('wp_estate_currency_symbol', '') );
    $where_currency =   esc_html( get_option('wp_estate_where_currency_symbol', '') );
    $measure_sys    =   esc_html ( get_option('wp_estate_measure_sys','') ); 
    $property_size  =   floatval( get_post_meta($post_id, 'property_size', true) );
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    
    if ($property_size  != '') {
        $property_size  = wpestate_sizes_no_format($property_size) . ' '.$measure_sys.'<sup>2</sup>';
    }

    $property_lot_size = floatval( get_post_meta($post_id, 'property_lot_size', true) );

    if ($property_lot_size != '') {
        $property_lot_size = wpestate_sizes_no_format($property_lot_size) . ' '.$measure_sys.'<sup>2</sup>';
    }

    $property_rooms     = floatval ( get_post_meta($post_id, 'property_rooms', true) );
    $property_bedrooms  = floatval ( get_post_meta($post_id, 'property_bedrooms', true) );
    $property_bathrooms = floatval ( get_post_meta($post_id, 'property_bathrooms', true) );     
    $price              = floatval   ( get_post_meta($post_id, 'property_price', true) );        
    if ($price != 0) {
        $price =wpestate_show_price($post_id,$currency="",$where_currency,1);           
    }else{
        $price='';
    } 
    $show='';
    $postmetas = (get_post_meta($post_id));
    $author_id = ($postmetas["original_author"]);
    $author_id = $author_id[0];
     $user_info = get_userdata( $author_id );
     $user_roles = implode(', ', $user_info->roles);
     $role_name = get_userrole_by_id($author_id);
   
     if($role_name =='s_franchise'){
          $brand_name        =   esc_html( get_post_meta($post_id, 'brand_name', true) );
          $offering        =   esc_html( get_post_meta($post_id, 'offering', true) );  
          $offering = get_term( $offering );
          $offering = $offering->name;      
          $overview        =   esc_html( get_post_meta($post_id, 'overview', true) );
        $show='
        <div class="row_box">';
        if($brand_name!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Brand Name ','wpestate'). ':</strong> '.$brand_name.'
            </div>
            ';
        }
        if($offering!=''){
            $show.='
             <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Offer for ','wpestate'). ':</strong> '.$offering.'        
            </div>
            ';
        }
        if($overview!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Overview ','wpestate'). ':</strong> '.$overview.'
            </div>
            ';
        }
            
        $show.='
        </div>

        ';
     }

     if($role_name =='s_biz_for_sale'){
          $listing_head        =   esc_html( get_post_meta($post_id, 'listing_head', true) );
          $ownertype        =   esc_html( get_post_meta($post_id, 'ownertype', true) ); 
          $ownertype = get_term( $ownertype );
          $ownertype= $ownertype->name;

          $overview        =   esc_html( get_post_meta($post_id, 'overview', true) );
          $reason        =   esc_html( get_post_meta($post_id, 'reason', true) );
          $biz_status        =   esc_html( get_post_meta($post_id, 'biz_status', true) );
        $show='
        <div class="row_box">';
        if($listing_head!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Listing headline ','wpestate'). ':</strong> '.$listing_head.'
            </div>
            ';
        }
        if($ownertype!=''){
            $show.='
             <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('I am a ','wpestate'). ':</strong> '.$ownertype.'
            </div>
            ';
        }
        if($overview!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Overview ','wpestate'). ':</strong> '.$overview.'
            </div>
            ';
        }
        if($reason!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Reason ','wpestate'). ':</strong> '.$reason.'
            </div>
            ';
        }
        if($reason!=''){
            $show.='
             <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Status of Biz ','wpestate'). ':</strong> '.$biz_status.'
            </div>
            ';
        }    
        $show.='
        </div>

        ';
     }
   


    $return_string='';
    $return_string.='<div class="listing_detail col-md-'.$colmd.'" id="propertyid_display"><strong>'.__('Property Id ','wpestate'). ':</strong> '.$post_id.'</div>';



  

    if ($price !='' ){ 
        //$return_string.='<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Price','wpestate'). ':</strong> '. $price.'</div>';
    }
    
    if ($property_size != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Property Size','wpestate').':</strong> ' . $property_size . '</div>';
    }               
    if ($property_lot_size != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Property Lot Size','wpestate').':</strong> ' . $property_lot_size . '</div>';
    }      
    if ($property_rooms != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Rooms','wpestate').':</strong> ' . $property_rooms . '</div>'; 
    }      
    if ($property_bedrooms != ''){
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Bedrooms','wpestate').':</strong> ' . $property_bedrooms . '</div>'; 
    }     
    if ($property_bathrooms != '')    {
        $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.__('Bathrooms','wpestate').':</strong> ' . $property_bathrooms . '</div>'; 
    }   
   
    // Custom Fields 


    $i=0;
    $custom_fields = get_option( 'wp_estate_custom_fields', true); 
    if( !empty($custom_fields)){  
        while($i< count($custom_fields) ){
           $name =   $custom_fields[$i][0];
           $label= stripslashes($custom_fields[$i][1]);
           $type =   $custom_fields[$i][2];
       //    $slug =   sanitize_key ( str_replace(' ','_',$name) );
           $slug         =   wpestate_limit45(sanitize_title( $name ));
           $slug         =   sanitize_key($slug);
            
           $value=esc_html(get_post_meta($post_id, $slug, true));
           if (function_exists('icl_translate') ){
                $label     =   icl_translate('wpestate','wp_estate_property_custom_'.$label, $label ) ;
                $value     =   icl_translate('wpestate','wp_estate_property_custom_'.$value, $value ) ;                                      
           }
                                   
           if($value!=''){
               $return_string.= '<div class="listing_detail col-md-'.$colmd.'"><strong>'.ucwords($label).':</strong> ' .$value. '</div>'; 
           }
           $i++;       
        }
    }

     //END Custom Fields 

    $return_string.=$show;
         
    return $return_string;
}
endif; // end   estate_listing_details  

if( !function_exists('estate_listing_details_franchise') ):
function estate_listing_details_franchise($post_id,$col=3){
 
    $brand_name  =   ( get_post_meta($post_id, 'brand_name', true) );
    $overview  =   ( get_post_meta($post_id, 'overview', true) );
    $offering   =  ( get_post_meta($post_id, 'offering', true) );
    $offering   =   get_term_name_by_id($offering,'offering');
    $about_your_brand   =   ( get_post_meta($post_id, 'about_your_brand', true) );
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    $show='';
        if($brand_name!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Brand Name ','wpestate'). ':</strong> '.$brand_name.'
            </div>
            ';
        }
        if($offering!=''){
            $show.='
             <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Offer for ','wpestate'). ':</strong> '.$offering.'        
            </div>
            ';
        }
        if($overview!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Overview ','wpestate'). ':</strong> '.$overview.'
            </div>
            ';
        }
        if($about_your_brand!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('About Your Brand ','wpestate'). ':</strong> '.$about_your_brand.'
            </div>
            ';
        }
    $return_string.='<div class="listing_detail col-md-'.$colmd.'" id="propertyid_display"><strong>'.__('Property Id ','wpestate'). ':</strong> '.$post_id.'</div>';
    $return_string.=$show;         
    return $return_string;
}
endif; // end   estate_listing_details franchise 
if( !function_exists('price_and_expectsale_franchise') ):
function price_and_expectsale_franchise($post_id,$col=3){
 
    $asking_price  =   ( get_post_meta($post_id, 'asking_price', true) );
    $average_sale_revenue  =   ( get_post_meta($post_id, 'average_sale_revenue', true) );
    $cashflow  =   ( get_post_meta($post_id, 'cashflow', true) );
    $expected_profir_margin  =   ( get_post_meta($post_id, 'expected_profir_margin', true) );
   
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    $show='';
        if($asking_price!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Asking Price ','wpestate'). ':</strong> '.$asking_price.'
            </div>
            ';
        }
        if($average_sale_revenue!=''){
            $show.='
             <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Average Sale Revenue ','wpestate'). ':</strong> '.$average_sale_revenue.'        
            </div>
            ';
        }
        if($cashflow!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Cash Flow ','wpestate'). ':</strong> '.$cashflow.'
            </div>
            ';
        }
        if($expected_profir_margin!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Expected Profir Margin ','wpestate'). ':</strong> '.$expected_profir_margin.'
            </div>
            ';
        }
   
    $return_string.=$show;         
    return $return_string;
}
endif; // end   price_and_expectsale_franchise  

if( !function_exists('biz_details_franchise') ):
function biz_details_franchise($post_id,$col=3){
 
    $year_establish  =   ( get_post_meta($post_id, 'year_establish', true) );
    $product_service  =   ( get_post_meta($post_id, 'product_service', true) );
    $procedure  =   ( get_post_meta($post_id, 'procedure', true) );
    $support_and_training  =   ( get_post_meta($post_id, 'support_and_training', true) );
    $origin  =   ( get_post_meta($post_id, 'origin', true) );
   
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    $show='';
        if($year_establish!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Year Established ','wpestate'). ':</strong> '.$year_establish.'
            </div>
            ';
        }
        if($product_service!=''){
            $show.='
             <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Product Service ','wpestate'). ':</strong> '.$product_service.'        
            </div>
            ';
        }
        if($procedure!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Procedure ','wpestate'). ':</strong> '.$procedure.'
            </div>
            ';
        }
        if($support_and_training!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Support and Training ','wpestate'). ':</strong> '.$support_and_training.'
            </div>
            ';
        }
   
    $return_string.=$show;         
    return $return_string;
}
endif; // end   biz_details_franchise  

if( !function_exists('franchise_detail') ):
function franchise_detail($post_id,$col=3){
 
    $space_required  =   ( get_post_meta($post_id, 'space_required', true) );
    $average_staff  =   ( get_post_meta($post_id, 'average_staff', true) );
    $royalty_fee  =   ( get_post_meta($post_id, 'royalty_fee', true) );
    $website_address  =   ( get_post_meta($post_id, 'website_address', true) );
    $video  =   ( get_post_meta($post_id, 'video', true) );
   
    $colmd=4;
    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    $show='';
        if($space_required!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Space Required ','wpestate'). ':</strong> '.$space_required.'
            </div>
            ';
        }
        if($average_staff!=''){
            $show.='
             <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Average Staff ','wpestate'). ':</strong> '.$average_staff.'        
            </div>
            ';
        }
        if($royalty_fee!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Royalty Fee','wpestate'). ':</strong> '.$royalty_fee.'
            </div>
            ';
        }
        if($website_address!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Website Address ','wpestate'). ':</strong> '.$website_address.'
            </div>
            ';
        }
        if($video!=''){
            $show.='
            <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__('Embed Video ','wpestate'). ':</strong> '.$video.'
            </div>
            ';
        }
   
    $return_string.=$show;         
    return $return_string;
}
endif; // end   franchise_detail  




if( !function_exists('custom_estate_listing_details') ):
function custom_estate_listing_details($post_id,$col=3,$collapseCode='BT',$panel_title='Panel Title',$array_for_display){
    $colmd=4;    
    switch ($col) {
        case 1:
            $colmd=12;
            break;
        case  2:
            $colmd=6;
            break;
        case  3:
            $colmd=4;
            break;
        case  4:
            $colmd=3;
            break;
    }
    $show='';
    foreach ($array_for_display as $key => $value) {
        $data = '';  
           if ($value['dropdown']){
                $id   =   get_post_meta($post_id, $value['meta_key'], true);
                $data   =   get_term_name_by_id($id,$value['meta_key']);
           }else if ($value['is_photo'])  {
                $pid   =   get_post_meta($post_id, $value['meta_key'], true);
                $myArray = explode(',', get_post_meta( $post_id, $value['meta_key'], true ));
                if ( isset ( $myArray) && sizeof($myArray) > 0) {
                    $pid = $myArray[0];
                     $data = wp_get_attachment_image ($pid, 'full');
                }
                
           }else if( $value['is_docs'] ) {
                $pid   =   get_post_meta($post_id, $value['meta_key'], true);
                $myArray = explode(',', get_post_meta( $post_id, $value['meta_key'], true ));
                if ( isset ( $myArray) && sizeof($myArray) > 0) {
                    $data = '
                        <hr/>
                    ';
                    for($i=0;$i<sizeof($myArray)-1;$i++){
                        $pid = $myArray[$i];
                        $attName = get_attached_file($pid);
                        $data .= '<a class="download_link" href="'.wp_get_attachment_url($pid).'" target="_blank">'.($i+1).'.&nbsp;'.basename($attName).'&nbsp;<i class="fa fa-download"></i></a><br>';
                    }
                    $data .='<hr/>';
                }
           }else if ($value['is_video']) {
                    $video = (get_post_meta($post_id, $value['meta_key'], true));
                    if ( $video !== ''){
                         $data = '<br>
                            <iframe width="220" height="200" src="'.$video.'">
                            </iframe>
                         ';
                   
                    }else{
                        $data = '<img width="220" height="200" src="http://euonthemove.eu/wp-content/uploads/2017/05/no-video.jpg" />';
                    }
                   
           }else {
                $data =     get_post_meta($post_id, $value['meta_key'], true);
           }


           if ($data != ''){
                if($value['is_number']) {
                    $data   =   '  '.custom_number_format($data,2);
                }
                 $show.='
                <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__($value['label'],'wpestate'). ':</strong> '.$data.'
                </div>

                ';
           }
    } 
    $layout='
    <div class="panel-group property-panel" >
        <div class="panel panel-default">
           <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion_prop_addr" href="#'.$collapseCode.'">
                    <h4 class="panel-title">  
                        '.$panel_title.'
                    </h4>  
                </a>
           </div>
           <div id="'.$collapseCode.'" class="panel-collapse collapse in">
             <div class="panel-body">
                    '.$show.'
             </div>
           </div>
        </div>            
    </div>';  
    return $layout;
}
endif; // end   estate_listing_details_biz  


?>