<?php
// Index Page
// Wp Estate Pack
$status = get_post_status($post->ID);

if (!is_user_logged_in()) {
    if ($status==='expired') {
        wp_redirect(home_url());
        exit;
    }
} else {
    if (!current_user_can('administrator')) {
        if ($status==='expired') {
            wp_redirect(home_url());
            exit;
        }
    }
}


?>
<style>
/*single estate property */
#accordion_prop_addr,.agent_contanct_form_sidebar,.single-content.listing-content#accordion_prop_addr
{
  display: none !important;
}
.btn_login_for_call{
  left: 0px !important;
}
.listing_wrapper .property_listing .a-btn-asking.b-btn-asking{
    font-size: 10px;
}
div.header_media.with_search_1{
  display: none !important;
}
button.a-btn-login{
    background-color: #1ca8dd !important;
    width: 200px;
}
#contact_call
{
  transform:translat(-50%,0%);
  left:30%;
  text-align:center
}
#contact_call .itc-call-popup-footer a button
{
    width: 170px;
}
#contact_call .itc-call-popup-footer.login
{
    margin-left: 38% !important;
}
#contact_call .itc-call-popup-footer
{
  position:relative;
  margin-left: 28%;
}
@media only screen and (min-width: 821px) {
  button.wpresidence_button.a-btn-asking {
    position: relative;
    bottom: 20px;
  }
}

@media only screen and (max-width: 420px) {
    #contact_call .itc-call-popup-footer
    {
      left: 1%;
    }
    #contact_call .itc-call-popup-footer.login
    {
        margin-left: 22% !important;
    }
    #contact_call .itc-call-popup-footer a button
    {
        width: 162px;
    }
    #contact_call .itc-call-popup-footer
    {
        margin-left: 0 !important;
    }
    .listing-content .mylistings{
        width: 107% !important;
    }
    .sub_footer{
        height: 0 !important;
    }
    .notice_area{
        margin-bottom: 0 !important;
    }
}
</style>
<?php

get_header();
global $current_user;
global $feature_list_array;
global $propid ;
global $show_compare_only;
global $currency;
global $where_currency;


$show_compare_only  =   'no';
$current_user       =   wp_get_current_user();
wp_estate_count_page_stats($post->ID);

$propid                     =   $post->ID;
$options                    =   wpestate_page_details($post->ID);
$gmap_lat                   =   esc_html(get_post_meta($post->ID, 'property_latitude', true));
$gmap_long                  =   esc_html(get_post_meta($post->ID, 'property_longitude', true));
$unit                       =   esc_html(get_option('wp_estate_measure_sys', ''));
$currency                   =   esc_html(get_option('wp_estate_currency_symbol', ''));
$use_floor_plans            =   intval(get_post_meta($post->ID, 'use_floor_plans', true));


if (function_exists('icl_translate')) {
    $where_currency             =   icl_translate('wpestate', 'wp_estate_where_currency_symbol', esc_html(get_option('wp_estate_where_currency_symbol', '')));
    $property_description_text  =   icl_translate('wpestate', 'wp_estate_property_description_text', esc_html(get_option('wp_estate_property_description_text')));
    $property_details_text      =   icl_translate('wpestate', 'wp_estate_property_details_text', esc_html(get_option('wp_estate_property_details_text')));
    $property_features_text     =   icl_translate('wpestate', 'wp_estate_property_features_text', esc_html(get_option('wp_estate_property_features_text')));
    $property_adr_text          =   icl_translate('wpestate', 'wp_estate_property_adr_text', esc_html(get_option('wp_estate_property_adr_text')));
} else {
    $where_currency             =   esc_html(get_option('wp_estate_where_currency_symbol', ''));
    $property_description_text  =   esc_html(get_option('wp_estate_property_description_text'));
    $property_details_text      =   esc_html(get_option('wp_estate_property_details_text'));
    $property_features_text     =   esc_html(get_option('wp_estate_property_features_text'));
    $property_adr_text          =   stripslashes(esc_html(get_option('wp_estate_property_adr_text')));
}
// custom 22/04/2020
$cash = custome_estate_options($post->property_estate_option);
$price          =   floatval(get_post_meta(get_the_ID(), 'property_price', true));
$price_label    =   '<span class="price_label">'.esc_html(get_post_meta(get_the_ID(), 'property_label', true)).'</span>';
$price_label_before    =   '<span class="price_label price_label_before">'.esc_html(get_post_meta(get_the_ID(), 'property_label_before', true)).'</span>';
$pg = new PhoneMail($post->ID);
// end custom

$agent_id                   =   '';
$content                    =   '';
$userID                     =   $current_user->ID;
$user_option                =   'favorites'.$userID;
$curent_fav                 =   get_option($user_option);
$favorite_class             =   'isnotfavorite';
$favorite_text              =   __('add to favorites', 'wpestate');
$feature_list               =   esc_html(get_option('wp_estate_feature_list'));
$feature_list_array         =   explode(',', $feature_list);
$pinteres                   =   array();
$property_city              =   get_the_term_list($post->ID, 'property_city', '', ', ', '') ;
$property_area              =   get_the_term_list($post->ID, 'property_area', '', ', ', '');
$property_category          =   get_the_term_list($post->ID, 'property_category', '', ', ', '') ;
$property_action            =   get_the_term_list($post->ID, 'property_action_category', '', ', ', '');
$slider_size                =   'small';
$thumb_prop_face            =   wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'property_full');
$post_author = $post->post_author; //get user id

if ($curent_fav) {
    if (in_array($post->ID, $curent_fav)) {
        $favorite_class =   'isfavorite';
        $favorite_text  =   __('favorite', 'wpestate');
    }
}

if (has_post_thumbnail()) {
    $pinterest = wp_get_attachment_image_src(get_post_thumbnail_id(), 'property_full_map');
}


if ($options['content_class']=='col-md-12') {
    $slider_size='full';
}
?>

<?php
// custom template loading

$wp_estate_global_page_template               = intval(get_option('wp_estate_global_property_page_template'));
$wp_estate_local_page_template                = intval(get_post_meta($post->ID, 'property_page_desing_local', true));
if ($wp_estate_global_page_template!=0 || $wp_estate_local_page_template!=0) {
    global $wp_estate_global_page_template;
    global $wp_estate_local_page_template;
    global $options;
    get_template_part('templates/property_desing_loader');
}


?>


<div class="row">
    <?php get_template_part('templates/breadcrumbs'); ?>
    <div class=" <?php print esc_html($options['content_class']);?> full_width_prop">
        <?php get_template_part('templates/ajax_container'); ?>
        <?php
        $arr = array(

             );
 
        while (have_posts()) : the_post();
            // $price          =   floatval   ( get_post_meta($post->ID, 'property_price', true) );
            // $price  =   custom_number_format(wpestate_show_custom_price($post->ID));
            $image_id       =   get_post_thumbnail_id();
            $image_url      =   wp_get_attachment_image_src($image_id, 'property_full_map');
            $full_img       =   wp_get_attachment_image_src($image_id, 'full');
            $image_url      =   $image_url[0];
            $full_img       =   $full_img [0];
        ?>
        
        <h1 class="entry-title entry-prop"><?php the_title(); ?></h1>
        <span class="price_area">
            <?php
                if ($cash != 1 && !is_user_logged_in()) {
                    // echo '
                    // <script>
                    //     window.location = "Not-Found";
                    // </script>
                    // ';
                }

                $b = 1;
                if ($cash == 2 && !is_user_logged_in())
                    $b = 0;
                if ($cash == 3 || $cash == 4)
                    $b = 0;

                if ($b == 1)
                    print $price_label_before.' '.number_format($price,0);


/*
        $str_lang=[
            'contact'=>'[:en]Contact seller[:km]ហៅទៅកាន់អ្នកលក់[:]',
            'login'=>'[:en]Login for detail[:km]សូមបញ្ជូលគណនី[:]',
            'no_contact'=>'[:en]No contact[:km]មិនមានទំនាក់ទំនង[:]'
        ];
        if ($cash===1||$cash===2) {
            if ($price != 0) {
                $price = wpestate_show_price(get_the_ID(), $currency='', $where_currency, 1);
            } else {
                $price=$price_label_before.$price_label;
            }
            print $price;
        } else {
            if ($cash!=1 && is_user_logged_in()) {
                if ($pg->get_agentId()!=null) {
                    print '<a href="#"><button class="wpresidence_button a-btn-login">'.__($str_lang['contact']).'</button></a>';
                } else {
                    print '<a href="#"><button class="wpresidence_button a-btn-login">'.__($str_lang['no_contact']).'</button></a>';
                }
            } else {
                if ($pg->get_agentId()!=null && $cash==31) {
                    print '<a href="#"><button class="wpresidence_button a-btn-login">'.__($str_lang['contact']).'</button></a>';
                } else {
                    print'<button class="user_not_loged wpresidence_button a-btn-login a-btn-login" id="user_menu_u">'.__($str_lang['login']).'</button>';
                }
            }
        }
*/
        // custom 22/04/2020
        // custome_estate_options($post->property_estate_option, $post, the_title());
         ?>
         </span>
        <div class="single-content listing-content">
             
        <?php
      
        $status = esc_html(get_post_meta($post->ID, 'property_status', true));
        if (function_exists('icl_translate')) {
            $status     =   icl_translate('wpestate', 'wp_estate_property_status_'.$status, $status) ;
        }
        $status = stripslashes($status);
        ?>
            
            
        <div class="notice_area">
            <div class="property_categs">
                <?php //print ($property_category) .' '.__('Location in ','wpestate').' '.($property_action);?>
            </div>
            <span class="adres_area">
                <?php
                    $property_address =esc_html(get_post_meta($post->ID, 'property_city', true));
                    $property_address   =   get_term_name_by_id($property_address, 'property_city');

                    if ($property_address != '') {
                        print 'Location : ' . esc_html($property_address);
                    }
                ?>            
            </span> 
            <span class="adres_area">
                <?php
                    $publisher =($post->post_author);
                    if ($publisher != '') {
                        print(__('[:en]Publisher[:km]អ្នកបោះពុម្ពផ្សាយ[:]', 'wpestate').': ');
                        $publisher_name =  (the_author_meta('nickname', $publisher));
                    }
                ?>            
            </span> 
            <span class="adres_area">
                <?php
                    $post_date =($post->post_date);
                    if ($post_date != '') {
                        print(' Publish Date: '. substr($post_date, 0, 11));
                    }
                ?>            
            </span> 
            <span class="adres_area">
                <?php
                        print(__('[:en]Status[:km]អស្ថានភាព[:]', 'wpestate').': '.$status);
                ?>            
            </span> 

            <div id="add_favorites" class="<?php print esc_html($favorite_class);?>" data-postid="<?php the_ID();?>"><?php echo esc_html($favorite_text);?></div>                 
            <div class="download_pdf"></div>
           
            <div class="prop_social">
                <div class="no_views dashboad-tooltip" data-original-title="<?php _e('Number of Page Views', 'wpestate');?>"><i class="fa fa-eye-slash "></i><?php echo intval(get_post_meta($post->ID, 'wpestate_total_views', true));?></div>
                <i class="fa fa-print" id="print_page" data-propid="<?php print $post->ID;?>"></i>
                <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share_facebook"><i class="fa fa-facebook fa-2"></i></a>
                <a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title() .' '. get_permalink()); ?>" class="share_tweet" target="_blank"><i class="fa fa-twitter fa-2"></i></a>
                <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" class="share_google"><i class="fa fa-google-plus fa-2"></i></a> 
                <?php if (isset($pinterest[0])) { ?>
                   <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($pinterest[0]);?>&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share_pinterest"> <i class="fa fa-pinterest fa-2"></i> </a>      
                <?php } ?>
              
            </div>
        </div>
        
        <?php //print 'Status:'.$status.'</br>';?>

        <?php //get_template_part('templates/listingslider');
        // slider type -> vertical or horizinalt
        $local_pgpr_slider_type_status  =   get_post_meta($post->ID, 'local_pgpr_slider_type', true);
        $prpg_slider_type_status        =   esc_html(get_option('wp_estate_global_prpg_slider_type', ''));
       
    
    $show_slider=1;
    if ($local_pgpr_slider_type_status=='full width header') {
        $show_slider=0;
    }
    
    if ($local_pgpr_slider_type_status=='global' && $prpg_slider_type_status == 'full width header') {
        $show_slider=0;
    }
    
    if ($local_pgpr_slider_type_status=='multi image slider') {
        $show_slider=0;
    }
    
    if ($local_pgpr_slider_type_status=='global' && $prpg_slider_type_status == 'multi image slider') {
        $show_slider=0;
    }
    

    if ($show_slider==1) {
        if ($local_pgpr_slider_type_status=='global') {
            $prpg_slider_type_status= esc_html(get_option('wp_estate_global_prpg_slider_type', ''));
            if ($prpg_slider_type_status=='vertical') {
                get_template_part('templates/listingslider-vertical');
            } elseif ($prpg_slider_type_status=='gallery') {
                get_template_part('templates/masonanry_pictures');
            } else {
                get_template_part('templates/listingslider');
            }
        } elseif ($local_pgpr_slider_type_status=='vertical') {
            get_template_part('templates/listingslider-vertical');
        } elseif ($local_pgpr_slider_type_status=='gallery') {
            get_template_part('templates/masonanry_pictures');
        } else {
            get_template_part('templates/listingslider');
        }
    }
    ?>
         
    <?php
       
    global $property_subunits_master;
    $has_multi_units=intval(get_post_meta($post->ID, 'property_has_subunits', true));
    $property_subunits_master=intval(get_post_meta($post->ID, 'property_subunits_master', true));
     
    if ($has_multi_units==1) {
        get_template_part('/templates/multi_units');
    } else {
        if ($property_subunits_master!=0) {
            get_template_part('/templates/multi_units');
        }
    }
   
    
    ?>        
    <?php
    // custom 22/02/2020
    // if ($cash!=4||$cash===1||$cash===2) {
    //     $checkType = $post->post_content_filtered;
    //     if (isset($checkType) && $checkType !== '') {
    //         switch ($checkType) {
    //         case 'franchise':
    //             $arrProperty    =   custom_property_fields('franchise');
    //             show_property_detail($arrProperty, $post->ID);
    //             break;
    //         case 'biz_for_sale':
    //             $arrProperty    =   custom_property_fields('biz_for_sale');
    //             show_property_detail($arrProperty, $post->ID);
    //             break;
    //         default:
    //                 echo 'This is for other type ';
    //     }
    //     } else {
    //         get_template_part('/templates/property_page_acc_content');
    //     }
    // }

    $b = 1;
    if ($cash == 2 && !is_user_logged_in())
        $b = 0;
    if ($cash == 3 && !is_user_logged_in())
        $b = 0;        
    if ($cash == 4)
        $b = 0;
    
    if ($b == 1)
        get_template_part('/templates/property_page_acc_content');

    //if ($pg->get_agentId()!="" && is_user_logged_in() && $cash!=1||$cash==31) {
    if ($pg->get_agentId()!="" && is_user_logged_in()) {        
        if ($pg->get_email()!=null) {
            $c_mail = 'mailto:'.$pg->get_email().'?subject=Khmerway property asking: '.the_title().'&body=Dear owner property,';
            $c_text_mail = '[:en]Email[:km]អ៊ីមែល[:]';
            $disable = 'style="corsor-event:none; float:none !important;"';
        } else {
            $c_text_mail = '[:en]No Email[:km]មិនមាន[:]';
            $c_mail = '#';
            $disable = '';
        }
        $str_lang1 = [
            'mail'=>$c_text_mail,
            'phone'=>'[:en]Call[:km]ទូរស័ព្ទ[:]',
        ];
        print'<div class="panel-group property-panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion_prop_addr" href="#18654" class="" aria-expanded="true">
                    <h4 class="panel-title">'.__('[:en]Contact[:km]ទំនាក់ទំនង[:]').'</h4>  
                </a>
            </div>
            <div id="18654" class="panel-collapse collapse in" aria-expanded="true" style="">
                <div class="panel-body">
                    <div id="contact_call" class="center">
                        
                        <h3 style="margin-top:15px;">'.__('[:en]Contact by[:km]សូមទំនាក់ទំនងតាមរយៈ[:]').'</h3>
                        <div class="itc-call-popup-footer" style="margin:0px; padding:0px; width:100%">
        ';

        if ($pg->get_phone() != '')
        echo '
                            <a href="tel:'.$pg->get_phone().'" style="float:none !important;"><button class="wpresidence_button" style="background-color:#FBC02D!important;margin-right:10px; float:none !important;">'.__($str_lang1['phone']).'</button></a>
        ';

        if ($pg->get_email() != null)
        echo '
                            <a '.$disable.' href="'.$c_mail.'" style="float:none !important;">><button class="wpresidence_button api_float_none" style="background-color:#0288D1!important;margin-left:10px;  float:none !important;">'.__($str_lang1['mail']).'</button></a>
        ';

        echo '
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
    // if (is_user_logged_in()) {

    //     print'<div class="panel-group property-panel">
    //         <div class="panel panel-default">
    //             <div class="panel-heading">
    //                 <a data-toggle="collapse" data-parent="#accordion_prop_addr" href="#18654" class="" aria-expanded="true">
    //                     <h4 class="panel-title">'.__('[:en]Contact[:km]ទំនាក់ទំនង[:]').'</h4>  
    //                 </a>
    //             </div>
    //             <div id="18654" class="panel-collapse collapse in" aria-expanded="true" style="">
    //                 <div class="panel-body">
    //                     <div id="contact_call" class="center">
    //                         <h3>'.__('[:en]The Contact is contacting[:km]ទំនាក់ទំនងតភ្ជាប់មិនទាន់បាន[:]').'</h3><br/>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>            
    //     </div>
    //     ';
    // }
    if (!is_user_logged_in()) {
        print'<div class="panel-group property-panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion_prop_addr" href="#18654" class="" aria-expanded="true">
                    <h4 class="panel-title">'.__("[:en]Contact Infomation[:km]ទំនាក់ទំនងផ្នែកព័ត៍មាន[:]").'</h4>
                </a>
            </div>
            <div id="18654" class="panel-collapse collapse in" aria-expanded="true" style="">
                <div class="panel-body">
                    <div id="contact_call" class="center">
                        <h3 style="margin-top:15px;">'.__('[:en]Please Login first[:km]សូមធ្វើការបញ្ជូលគណនីជាមុន[:]').'</h3><br/>
                        <div class="itc-call-popup-footer login_btn_single_page btn_login_for_call login">
                            <button class="user_not_loged wpresidence_button" style="background-color: #1ca8dd;margin-left:-57px;width:315px" id="user_menu_u">'.__("[:en]Login to see contact infomation[:km]បញ្ជូលគណនីនឹងទទួលបានព័ត៍មានទំនាក់ទំនង[:]").'</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>';
    }
    // end custom
    
    ?>

    <?php
    wp_reset_query();
    ?>  
         
    <?php
    endwhile; // end of the loop
    ?>

    <?php
        // custom hidden 2020/23/04
        // $show_compare=1;
        
        // $sidebar_agent_option_value=    get_post_meta($post->ID, 'sidebar_agent_option', true);
        // $enable_global_property_page_agent_sidebar= esc_html(get_option('wp_estate_global_property_page_agent_sidebar', ''));
        // if ($sidebar_agent_option_value=='global') {
        //     if ($enable_global_property_page_agent_sidebar!='yes') {
        //         get_template_part('/templates/agent_area');
        //     }
        // } elseif ($sidebar_agent_option_value !='yes') {
        //     get_template_part('/templates/agent_area');
        // }
   

        // get_template_part('/templates/other_agents');
        // end custom
        get_template_part('/templates/similar_listings');
     
    

        ?>
        </div><!-- end single content -->
    </div><!-- end 9col container-->
    
<?php  include(locate_template('sidebar.php')); ?>
       
    
</div>   

<?php
$mapargs = array(
        'post_type'         =>  'estate_property',
        'post_status'       =>  'publish',
        'p'                 =>  $post->ID );

$selected_pins  =   wpestate_listing_pins($mapargs, 1);
wp_localize_script(
    'googlecode_property',
    'googlecode_property_vars2',
    array('markers2'          =>  $selected_pins)
);

get_footer(); ?>