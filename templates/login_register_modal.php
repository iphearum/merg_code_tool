<?php
    $front_end_register     =   esc_html(get_option('wp_estate_front_end_register', ''));
    $front_end_login        =   esc_html(get_option('wp_estate_front_end_login ', ''));
    $facebook_status    =   esc_html(get_option('wp_estate_facebook_login', ''));
    $google_status      =   esc_html(get_option('wp_estate_google_login', ''));
    $yahoo_status       =   esc_html(get_option('wp_estate_yahoo_login', ''));
    $mess='';
    $security_nonce=wp_nonce_field('forgot_ajax_nonce-topbar', 'security-forgot-topbar', true, false);
?>
<!-- custom login with google -->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script> -->
<script src="https://khmerway.com/wp-content/plugins/miniorange-login-openid/includes/js/jquery.cookie.min.js"></script>        
<script type="text/javascript">
function mo_openid_on_consent_change(checkbox){
    if (! checkbox.checked) {
        jQuery('#mo_openid_consent_checkbox').val(1);
        jQuery(".btn-mo").attr("disabled", true);
        jQuery(".login-button").addClass("dis");
    } else {
        jQuery('#mo_openid_consent_checkbox').val(0);
        jQuery(".btn-mo").attr("disabled", false);
        jQuery(".login-button").removeClass("dis");
    }
}

var perfEntries = performance.getEntriesByType("navigation");

if (perfEntries[0].type === "back_forward") {
    location.reload(true);
}
function HandlePopupResult(result) {
    window.location = "https://khmerway.com";
}
function moOpenIdLogin(app_name,is_custom_app) {
    var current_url = window.location.href;
    var cookie_name = "redirect_current_url";
    var d = new Date();
    d.setTime(d.getTime() + (2 * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cookie_name + "=" + current_url + ";" + expires + ";path=/";

    var base_url = 'https://khmerway.com';
    var request_uri = '/wp-login.php?redirect_to=https%3A%2F%2Fkhmerway.com%2Fwp-admin%2F&reauth=1';
    var http = 'https://';
    var http_host = 'khmerway.com';
    var default_nonce = '9d85cbab26';
    var custom_nonce = 'ebc6e9c0a1';

if(is_custom_app == 'false'){
    if ( request_uri.indexOf('wp-login.php') !=-1){
        var redirect_url = base_url + '/?option=getmosociallogin&wp_nonce=' + default_nonce + '&app_name=';
        } else {
        var redirect_url = http + http_host + request_uri;
        if(redirect_url.indexOf('?') != -1){
            redirect_url = redirect_url +'&option=getmosociallogin&wp_nonce=' + default_nonce + '&app_name=';
        }else
        {
            redirect_url = redirect_url +'?option=getmosociallogin&wp_nonce=' + default_nonce + '&app_name=';
        }
    }
}
else {
    if ( request_uri.indexOf('wp-login.php') !=-1){
        var redirect_url = base_url + '/?option=oauthredirect&wp_nonce=' + custom_nonce + '&app_name=';
    }else {
        var redirect_url = http + http_host + request_uri;
        if(redirect_url.indexOf('?') != -1)
        redirect_url = redirect_url +'&option=oauthredirect&wp_nonce=' + custom_nonce + '&app_name=';
        else
        redirect_url = redirect_url +'?option=oauthredirect&wp_nonce=' + custom_nonce + '&app_name=';
    }
}
if( 0) {
    var myWindow = window.open(redirect_url + app_name, "", "width=700,height=620");
}
else{
    window.location.href = redirect_url + app_name;
}
}
</script>
<!--end custom -->
<div id="modal_login_wrapper">

    <div class="modal_login_back"></div>
    <div class="modal_login_container">
        
        <div id="login-modal_close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <h3   id="login-div-title-topbar"><?php _e('[:en]Sign into your account[:km]ចូលទៅក្នុងគណនីរបស់អ្នក[:]', 'wpestate');?></h3>
            <div class="login_form" id="login-div_topbar">
                <div class="loginalert" id="login_message_area_topbar" > </div>
                <input type="text" class="form-control" name="log" id="login_user_topbar" placeholder="<?php _e('[:en]Username[:km]ឈ្មោះ​អ្នកប្រើប្រាស់[:]','wpestate');?>"/>
                <input type="password" class="form-control" name="pwd" id="login_pwd_topbar" placeholder="<?php _e('[:en]Password[:km]ពាក្យសម្ងាត់[:]', 'wpestate');?>"/>
                <input type="hidden" name="loginpop" id="loginpop_wd_topbar" value="0">
                <?php //wp_nonce_field( 'login_ajax_nonce_topbar', 'security-login-topbar',true);?>   
                <input type="hidden" id="security-login-topbar" name="security-login-topbar" value="<?php  echo estate_create_onetime_nonce('login_ajax_nonce_topbar');?>">

                <button class="wpresidence_button" id="wp-login-but-topbar"><?php _e('[:en]Login[:km]ចូលគណនី[:]', 'wpestate');?></button>
                <div class="login-links">
                   
                    <?php
                    if ($facebook_status=='yes' || $google_status=='yes' || $yahoo_status=='yes') {
                        echo '<div class="or_social">'.__('or', 'wpestate').'</div>';
                    }
                    if ($facebook_status=='yes') {
                        print '<div id="facebookloginsidebar_topbar" data-social="facebook">'.__('[:en]Login with Facebook[:km]ចូលគណនីជា​មួយ​ Facebook[:]', 'wpestate').'</div>';
                    }
                    if ($google_status=='yes') {
                        print '<div id="googleloginsidebar_topbar" data-social="google">'.__('Login with Google', 'wpestate').'</div>';
                        //print '<div onclick="moOpenIdLogin('."'google','true'".');" id="googlelogin_mobile" data-social="google">'.__('Login with Google', 'wpestate').'</div>';
                    }
                    if ($yahoo_status=='yes') {
                        print '<div id="yahoologinsidebar_topbar" data-social="yahoo">'.__('Login with Yahoo', 'wpestate').'</div>';
                    }
                    ?>
                </div>    
           </div>

            <h3  id="register-div-title-topbar"><?php _e('[:en]Create an account[:km]បង្កើត​គណនី[:]', 'wpestate');?></h3>
            <div class="login_form" id="register-div-topbar">

                <div class="loginalert" id="register_message_area_topbar" ></div>
                <input type="text" name="user_login_register" id="user_login_register_topbar" class="form-control" placeholder="<?php _e('[:en]Username[:km]ឈ្មោះ​អ្នកប្រើប្រាស់[:]', 'wpestate');?>"/>
                <input type="text" name="user_email_register" id="user_email_register_topbar" class="form-control" placeholder="<?php _e('[:en]Email[:km]អ៊ីមែល[:]', 'wpestate');?>"  />

                <?php
                $enable_user_pass_status= esc_html(get_option('wp_estate_enable_user_pass', ''));
                if ($enable_user_pass_status == 'yes') {
                    print ' <input type="password" name="user_password" id="user_password_topbar" class="form-control" placeholder="'.__('[:en]Password[:km]ពាក្យសម្ងាត់[:]', 'wpestate').'"/>
                    <input type="password" name="user_password_retype" id="user_password_topbar_retype" class="form-control" placeholder="'.__('[:en]Retype Password[:km]វាយ​លេខសម្ងាត់​ម្តង​ទៀត[:]', 'wpestate').'"  />
                    ';
                }
                ?>

                <?php
                // custom hidden 2020/04/27, style will hide it
                $user_roles = custom_register_roles();
                print'<select class="form-control" name="new_user_type" id="new_user_type_topbar"><option value="" >User Types</option>';
                foreach ($user_roles as $key => $role) {
                    print '<option value="'.$key.'">'.$role.'</option>';
                    break;
                }
                print'</select>';?>
                <!-- end -->

                <input type="checkbox" name="terms" id="user_terms_register_topbar" />
                <label id="user_terms_register_topbar_label" for="user_terms_register_topbar"><?php _e('[:en]I agree with[:km]ខ្ញុំ​យល់ស្រប​ជាមួយ[:]', 'wpestate');?><a href="<?php print get_terms_links();?> " target="_blank" id="user_terms_register_topbar_link"><?php _e('[:en]Terms & conditions[:km]ល័ក្ខខ័ណ្ឌ[:]', 'wpestate');?></a> </label>


                <?php
                if (get_option('wp_estate_use_captcha', '')=='yes') {
                    print '<div id="top_register_menu" style="float:left;transform:scale(0.75);-webkit-transform:scale(0.75);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>';
                }
                ?>

                <?php   if ($enable_user_pass_status != 'yes') {  ?>
                    <p id="reg_passmail_topbar"><?php _e('[:en]A password will be e-mailed to you[:km]ពាក្យសម្ងាត់នឹងត្រូវបានផ្ញើទៅអ្នក[:]', 'wpestate');?></p>
                <?php } ?>

                <?php //wp_nonce_field( 'register_ajax_nonce_topbar', 'security-register-topbar',true );?>   
                <input type="hidden" id="security-register-topbar" name="security-register-topbar" value="<?php  echo estate_create_onetime_nonce('register_ajax_nonce_topbar');?>">
                <button class="wpresidence_button" id="wp-submit-register_topbar" ><?php _e('[:en]Register[:km]ចុះឈ្មោះ[:]', 'wpestate');?></button>
              
            </div>

            <h3   id="forgot-div-title-topbar"><?php _e('[:en]Reset Password[:km]កំណត់ពាក្យសម្ងាត់ឡើងវិញ[:]', 'wpestate');?></h3>
            <div class="login_form" id="forgot-pass-div">
                <div class="loginalert" id="forgot_pass_area_topbar"></div>
                <div class="loginrow">
                        <input type="text" class="form-control" name="forgot_email" id="forgot_email_topbar" placeholder="<?php _e('[:en]Enter Your Email Address[:km]សូម​ប​ញ្ជូ​ល​អាសយដ្ឋាន​អ៊ី​ម៊ែ​ល​របស់​អ្នក[:]', 'wpestate');?>" size="20" />
                </div>
                <?php echo($security_nonce);?>  
                <input type="hidden" id="postid" value="'.$post_id.'">    
                <button class="wpresidence_button" id="wp-forgot-but-topbar" name="forgot" ><?php _e('[:en]Reset Password[:km]កំណត់ពាក្យសម្ងាត់ឡើងវិញ[:]', 'wpestate');?></button>
               
            </div>

            <div class="login_modal_control">
                <a href="#" id="widget_register_topbar"><?php _e('[:en]Register here![:km]ចុះឈ្មោះនៅទីនេះ![:]', 'wpestate');?></a>
                <a href="#" id="forgot_pass_topbar"><?php _e('[:en]Forgot Password?[:km]ភ្លេច​លេខសំងាត់​?[:]', 'wpestate');?></a>
                
                <a href="#" id="widget_login_topbar"><?php _e('[:en]Back to Login[:km]ត្រលប់ទៅចូលគណនី[:]', 'wpestate');?></a>  
                <a href="#" id="return_login_topbar"><?php _e('[:en]Return to Login[:km]ត្រឡប់ទៅ[:]', 'wpestate');?></a>
                 <input type="hidden" name="loginpop" id="loginpop" value="0">
            </div>
            
    </div>
    
</div>