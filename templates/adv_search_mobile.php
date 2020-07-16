<?php
$adv_submit                 =   get_adv_search_link();
$args                       =   wpestate_get_select_arguments();
$action_select_list         =   wpestate_get_action_select_list($args);
$categ_select_list          =   wpestate_get_category_select_list($args);
$select_sub_categories_list =   wpestate_get_subcategories_checkbox_list($args); 
$select_city_list           =   wpestate_get_city_checkbox_list($args); 
$select_area_list           =   wpestate_get_area_checkbox_list($args);
//$select_city_list           =   wpestate_get_city_select_list($args); 
//$select_area_list           =   wpestate_get_area_select_list($args);
$select_county_state_list   =   wpestate_get_county_state_select_list($args);
$home_small_map_status      =   esc_html ( get_option('wp_estate_home_small_map','') );
$show_adv_search_map_close  =   esc_html ( get_option('wp_estate_show_adv_search_map_close','') );
$class                      =   'hidden';
$class_close                =   '';
$allowed_html               =   array();
?>

<?php 
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);  
           
            if($uri_segments[1] == 'apartments') { 
                $display = 'style="display:none"' ;
            } 
        
?>




<!-- background image -->
<style> 
           .background_image .text {
                /* margin:20px 10px 0px 0px;  */
                position: absolute;
                top: 8px;
                left: 16px;
                /* padding: 30px 90px 20px 0px;   */
                text-align:center;
            } 
            
            
            @media only screen and (max-width: 414px) {
                .background_image  .heading_image {
                margin:118px 0 0 35px;
                color: #fff;
                text-shadow: 1px 1px 3px rgba(68,68,68,0.5);
                font-size: 20px;
            }
            .background_image .subheading_image {
                margin-left:45px;
                margin-top:10px;
                color: #fff;
                text-shadow: 1px 1px 3px rgba(68,68,68,0.25);
                font-weight: 400;
                font-size: 15px;
            }
            }

            @media only screen and (max-width: 375px) {
                .heading_image {
                margin:118px 0 0 20px;
                color: #fff;
                text-shadow: 1px 1px 3px rgba(68,68,68,0.5);
                font-size: 20px;
            }
            .subheading_image {
                margin-left:30px;
                margin-top:10px;
                color: #fff;
                text-shadow: 1px 1px 3px rgba(68,68,68,0.25);
                font-weight: 400;
                font-size: 15px;
            }
            }
              
            
            
        </style>

<?php 
     
        echo '<div class="background_image" '.$display.'>
                    <img class="img-responsive api_screen_show_768" src="https://khmerway.com/wp-content/uploads/2017/10/df9d52cbf7c1f995e2b19812488a2f4d_m-1.jpg" style="width: 100%   ; height: 197.416px">
                    <div class="text api_screen_show_768">
                            <h1 class="heading_image">ស្វែងរកអាជីវកម្មដ៏ត្រឹមត្រូវសំរាប់លោកអ្នក</h1>
                            <div class="subheading_image">Find your right business in Cambodia</div>
                    </div>
                </div>';
    
?>


<div id="adv-search-header-mobile"> 
    <i class="fa fa-search"></i>  
    <?php _e('Advanced Search','wpestate');?> 
</div>   




<div class="adv-search-mobile"  id="adv-search-mobile" <?php if(is_front_page()) : ?> style="display: block" 
<?php endif;?>> 
   
    <form role="search" method="get"   action="<?php print esc_url($adv_submit); ?>" >
         
        <?php
        $adv_search_type        =   get_option('wp_estate_adv_search_type','');
      
        if ( $adv_search_type!==2 ){       
            $custom_advanced_search= get_option('wp_estate_custom_advanced_search','');
            $adv_search_what        =   get_option('wp_estate_adv_search_what','');
            
            if ( $custom_advanced_search == 'yes'){
                if ( $adv_search_type==6 || $adv_search_type==7 || $adv_search_type==8 || $adv_search_type==9 ){    
                    $adv6_taxonomy          =   get_option('wp_estate_adv6_taxonomy');
                
                    if ($adv6_taxonomy=='property_category'){
                        $search_field="categories";
                    }else if ($adv6_taxonomy=='property_action_category'){
                        $search_field="types";
                    }else if ($adv6_taxonomy=='property_city'){
                        $search_field="cities";
                    }else if ($adv6_taxonomy=='property_area'){
                        $search_field="areas";
                    }else if ($adv6_taxonomy=='property_county_state'){
                        $search_field="county / state";
                    }
                   
                    wpestate_show_search_field_tab_inject('mobile',$search_field,$action_select_list,$categ_select_list,$select_city_list,$select_area_list,'',$select_county_state_list);

                    
                }
                
                if($adv_search_type==10 ){
                    $adv_actions_value=__('All Actions','wpestate');
                    $adv_actions_value1='all';
            
                    print '
                        <input type="text" id="adv_location" class="form-control" name="adv_location"  placeholder="'.__('Type address, state, city or area','wpestate').'" value="">      
                    ';
                    
                    print'
                     
                        <div class="dropdown form-control " >
                            <div data-toggle="dropdown" id="adv_actions" class="filter_menu_trigger" data-value="'.strtolower ( rawurlencode ( $adv_actions_value1) ).'"> 
                                '.$adv_actions_value.' 
                            <span class="caret caret_filter"></span> </div>           
                            <input type="hidden" name="filter_search_action[]" value="">
                            <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_actions">
                                '.$action_select_list.'
                            </ul>        
                        </div>
                    ';
                    print '<input type="hidden" name="is10" value="10">';
                }
                
                
                
                if($adv_search_type==11 ){
                    $adv_actions_value=__('All Actions','wpestate');
                    $adv_actions_value1='all';
                    $adv_categ_value    = __('All Types','wpestate');
                    $adv_categ_value1   ='all';
            
                    print'  
                    <input type="text" id="keyword_search" class="form-control" name="keyword_search"  placeholder="'. __('Type Keyword','wpestate').'" value="">      
                    ';
                    
                    print '
                    
                        <div class="dropdown form-control " >
                            <div data-toggle="dropdown" id="adv_categ" class="filter_menu_trigger"  data-value="'.strtolower ( rawurlencode( $adv_categ_value1)).'"> 
                                '.$adv_categ_value.'               
                            <span class="caret caret_filter"></span> </div>           
                            <input type="hidden" name="filter_search_type[]" value="">
                            <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_categ">
                                '.$categ_select_list.'
                            </ul>
                        </div>    
                    ';
               
                    print'
                      
                        <div class="dropdown form-control " >
                            <div data-toggle="dropdown" id="adv_actions" class="filter_menu_trigger" data-value="'.strtolower ( rawurlencode ( $adv_actions_value1) ).'"> 
                                '.$adv_actions_value.' 
                            <span class="caret caret_filter"></span> </div>           
                            <input type="hidden" name="filter_search_action[]" value="">
                            <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_actions">
                                '.$action_select_list.'
                            </ul>        
                        </div>
                    ';
                    
                    print ' <input type="hidden" name="is11" value="11">';
                }
                
                
                foreach($adv_search_what as $key => $search_field){
                    wpestate_show_search_field('mobile',$search_field,$action_select_list,$categ_select_list,$select_city_list,$select_area_list,$key,$select_county_state_list, $select_sub_categories_list);

                    if ($search_field == 'Current-Real-Estate') {
                        print '
                            <div class="col-md-3 api_padding_0">
                                <div class="dropdown form-control">
                                    <div data-toggle="dropdown" id="adv_actions" class="filter_menu_trigger" data-value="">';        
                                        if( isset($_GET['filter_search_action'][0])  && trim($_GET['filter_search_action'][0])!='' && trim($_GET['filter_search_action'][0])!='all' ){
                                            //$tab_content.= ucwords ( str_replace("-"," ",esc_attr( wp_kses(   rawurldecode ( stripslashes(  $_GET['filter_search_action'][0]) ), $allowed_html) ) ) );
                                            $full_name   =  get_term_by('slug', ( ( $_GET['filter_search_action'][0] ) ),'property_action_category');
                                            print   $full_name->name;
                                        }else{
                                            print __('[:en]All Biz Types[:km]គ្រប់ប្រភេទអាជីវកម្ម[:]','wpestate'); 
                                        }
                                        print '<span class="caret caret_filter"></span>
                                    </div>
                                    
                                    <input type="hidden" name="filter_search_action[]" value="';
                                    if(isset($_GET['filter_search_action'][0])){
                                        print ucwords ( str_replace("-"," ", esc_attr( wp_kses($_GET['filter_search_action'][0], $allowed_html) ) ) );
                                    }
                                    print '">
                                    <ul id="api_actions_mobile" class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_actions">
                                        '.$action_select_list.'
                                    </ul>        
                                </div>
                            </div>
                        ';
                    }

                }
            } else{
            $form = wpestate_show_search_field_classic_form('mobile',$action_select_list,$categ_select_list ,$select_city_list,$select_area_list);
            print $form;
        }
        
        $extended_search= get_option('wp_estate_show_adv_search_extended','');
        if($extended_search=='yes'){            
            show_extended_search('mobile');
        }
        ?>
      
        <?php 
        //if ( $adv_search_type==2) 
        } else {
        ?>
            <input type="text" id="adv_location_mobile" class="form-control" name="adv_location"  placeholder="<?php _e('Search State, City or Area','wpestate');?>" value="">      

            <input type="hidden" name="is2" value="1">
            <div class="dropdown form-control" >
                <div data-toggle="dropdown" id="adv_categ" class="filter_menu_trigger" data-value="<?php // echo  $adv_categ_value1;?>"> 
                    <?php 
                    echo  __('All Types','wpestate');
                    ?> 
                <span class="caret caret_filter"></span> </div>    
               
                <input type="hidden" name="filter_search_type[]" value="<?php if(isset($_GET['filter_search_type'][0])){echo  esc_attr( wp_kses($_GET['filter_search_type'][0], $allowed_html) );}?>">
                <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_categ">
                    <?php print $categ_select_list;?>
                </ul>        
            </div> 

            <div class="dropdown form-control" >
                <div data-toggle="dropdown" id="adv_actions" class="filter_menu_trigger" data-value="<?php // ?>"> 
                    <?php _e('All Actions','wpestate');?> 
                    <span class="caret caret_filter"></span> </div>           
             
                <input type="hidden" name="filter_search_action[]" value="<?php if(isset($_GET['filter_search_action'][0])){echo esc_attr( wp_kses($_GET['filter_search_action'][0], $allowed_html) );}?>">
                <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_actions">
                    <?php print $action_select_list;?>
                </ul>        
            </div>
            
        <?php    
        

            $availableTags='';
            $args = array( 'hide_empty=0' );
            $terms = get_terms( 'property_city', $args );
            foreach ( $terms as $term ) {
               $availableTags.= '"'.$term->name.'",';
            }

            $terms = get_terms( 'property_area', $args );
            foreach ( $terms as $term ) {
               $availableTags.= '"'.$term->name.'",';
            }

            $terms = get_terms( 'property_county_state', $args );
            foreach ( $terms as $term ) {
               $availableTags.= '"'.$term->name.'",';
            }

            print '<script type="text/javascript">
                       //<![CDATA[
                       jQuery(document).ready(function(){
                            var availableTags = ['.$availableTags.'];
                            jQuery("#adv_location_mobile").autocomplete({
                                source: availableTags
                            });
                       });
                       //]]>
                    </script>';
 

        }
        ?>
        
        <button class="wpresidence_button" id="advanced_submit_2_mobile"><?php _e('Search Properties','wpestate');?></button>
        <button class="wpresidence_button" id="showinpage_mobile"><?php _e('See first results here ','wpestate');?></button>
        
        
            <span id="results_mobile"> <?php _e('we found','wpestate')?> <span id="results_no_mobile">0</span> <?php _e('results','wpestate')?> </span>
    </form>   
</div>       