<?php 
global $post;
global $adv_search_type;
$adv_search_what            =   get_option('wp_estate_adv_search_what','');
$show_adv_search_visible    =   get_option('wp_estate_show_adv_search_visible','');
$close_class                =   '';

if($show_adv_search_visible=='no'){
    $close_class=' float_search_closed ';
}

$extended_search    =   get_option('wp_estate_show_adv_search_extended','');
$extended_class     =   '';

if ($adv_search_type==2){
     $extended_class='adv_extended_class2';
}

if ( $extended_search =='yes' ){
    $extended_class='adv_extended_class';
    if($show_adv_search_visible=='no'){
        $close_class='adv-search-1-close-extended';
    }
       
}

?>

 


<div class="adv-search-1" id="adv-search-1" > 
    <div id="adv-search-header-1"> <?php _e('Advanced Search','wpestate');?></div>   
    <form role="search" method="get"  id="adv_search_form"  action="<?php esc_url(print $adv_submit); ?>" >
        <?php
        if (function_exists('icl_translate') ){
            print do_action( 'wpml_add_language_form_field' );
        }
        ?>   
        
        
        <div class="adv1-holder">
            <?php
            $custom_advanced_search         =   get_option('wp_estate_custom_advanced_search','');
            $adv_search_fields_no_per_row   =   ( floatval( get_option('wp_estate_search_fields_no_per_row') ) );
        
            // var_dump($adv_search_what);exit;
            if ( $custom_advanced_search == 'yes'){
                foreach($adv_search_what as $key=>$search_field){
                    $search_col         =   3;
                    $search_col_price   =   6;
                    if($adv_search_fields_no_per_row==2){
                        $search_col         =   6;
                        $search_col_price   =   12;
                    }else  if($adv_search_fields_no_per_row==3){
                        $search_col         =   4;
                        $search_col_price   =   4;
                    }
                    if($search_field=='property price' &&  get_option('wp_estate_show_slider_price','')=='yes'){
                        $search_col=$search_col_price;
                    }
                    
                    $temp = '';
                    $temp2 = 3;
                    if (str_replace(" ","_",$search_field) == 'property_price') {
                        $temp = 'style="width:50%; margin-left:0px;"';
                        $temp2 = 6;
                    }

                    print '<div class="col-md-'.$temp2.' '.str_replace(" ","_",$search_field).'" '.$temp.'>';
                    wpestate_show_search_field('mainform',$search_field,$action_select_list,$categ_select_list,$select_city_list,$select_area_list,$key,$select_county_state_list,$select_sub_categories_list);
                    print '</div>';

                    if ($search_field == 'Current-Real-Estate') {
                        print '
                            <div class="col-md-3">
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
                                    <ul id="api_actions" class="dropdown-menu filter_menu" role="menu" aria-labelledby="adv_actions">
                                        '.$action_select_list.'
                                    </ul>        
                                </div>
                            </div>
                        ';
                    }
                    
                }
            }else{
                $search_form = wpestate_show_search_field_classic_form('main',$action_select_list,$categ_select_list ,$select_city_list,$select_area_list);
                print $search_form;
            }

            if($extended_search=='yes'){
               show_extended_search('adv');
            }
            ?>
        </div>
       
        <input name="submit" type="submit" class="wpresidence_button" id="advanced_submit_2" value="<?php _e('SEARCH PROPERTIES','wpestate');?>">
       
        <?php get_template_part('templates/preview_template')?>
     

    </form>   
       <div style="clear:both;"></div>
   
       
</div>  