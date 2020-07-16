<?php

if (!function_exists('wpestate_select_email_type')):
    function wpestate_select_email_type($user_email,$type,$arguments){
        $value          =   get_option('wp_estate_'.$type,'');
        $value_subject  =   get_option('wp_estate_subject_'.$type,'');  
            
        if (function_exists('icl_translate') ){
            $value          =  icl_translate('wpestate','wp_estate_email_'.$value, $value ) ;
            $value_subject  =  icl_translate('wpestate','wp_estate_email_subject_'.$value_subject, $value_subject ) ;
        }

        wpestate_emails_filter_replace($user_email,$value,$value_subject,$arguments);
    }
endif;


if( !function_exists('wpestate_emails_filter_replace')):
    function  wpestate_emails_filter_replace($user_email,$message,$subject,$arguments){
        $arguments ['website_url'] = get_option('siteurl');
        $arguments ['website_name'] = get_option('blogname');       
        $arguments ['user_email'] = $user_email;     
        $user= get_user_by('email',$user_email);

        $arguments ['username'] = $user->user_login;
        
        foreach($arguments as $key_arg=>$arg_val){
            $subject = str_replace('%'.$key_arg, $arg_val, $subject);
            $message = str_replace('%'.$key_arg, $arg_val, $message);
        }
        
        wpestate_send_emails($user_email, $subject, $message );    
    }
endif;



if( !function_exists('wpestate_send_emails') ):
    function wpestate_send_emails($user_email, $subject, $message ){
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        @wp_mail(
            $user_email,
            stripslashes($subject),
            stripslashes($message),
            $headers
            );            
    };
endif;




if( !function_exists('wpestate_email_management') ):
    function wpestate_email_management(){
        print '<div class="wpestate-tab-container">';
        print '<h1 class="wpestate-tabh1">'.__('Email Management','wpestate').'</h1>';
        print '<a href="http://help.wpresidence.net/#" target="_blank" class="help_link">'.__('help','wpestate').'</a>';


        $emails=array(
            'new_user'                  =>  __('New user  notification','wpestate'),
            'admin_new_user'            =>  __('New user admin notification','wpestate'),
            'purchase_activated'        =>  __('Purchase Activated','wpestate'),
            'password_reset_request'    =>  __('Password Reset Request','wpestate'),
            'password_reseted'          =>  __('Password Reseted','wpestate'),
            'purchase_activated'        =>  __('Purchase Activated','wpestate'),
            'approved_listing'          =>  __('Approved Listings','wpestate'),
            'new_wire_transfer'         =>  __('New wire Transfer','wpestate'),
            'admin_new_wire_transfer'   =>  __('Admin - New wire Transfer','wpestate'),
            'admin_expired_listing'     =>  __('Admin - Expired Listing','wpestate'),
            'matching_submissions'      =>  __('Matching Submissions','wpestate'),
            'paid_submissions'          =>  __('Paid Submission','wpestate'),
            'featured_submission'       =>  __('Featured Submission','wpestate'),
            'account_downgraded'        =>  __('Account Downgraded','wpestate'),
            'membership_cancelled'      =>  __('Membership Cancelled','wpestate'),
            'downgrade_warning'         =>  __('Downgrade Warning','wpestate'),
            'free_listing_expired'      =>  __('Free Listing Expired','wpestate'),
            'new_listing_submission'    =>  __('New Listing Submission','wpestate'),
            'listing_edit'              =>  __('Listing Edit','wpestate'),
            'recurring_payment'         =>  __('Recurring Payment','wpestate'),
            'membership_activated'      =>  __('Membership Activated','wpestate'),
            'agent_update_profile'      =>  __('Update Profile','wpestate'),
           
           
        );
        
        
        print '<div class="email_row">'.__('Global variables: %website_url as website url,%website_name as website name, %user_email as user_email, %username as username','wpestate').'</div>';
        
        
        foreach ($emails as $key=>$label ){

            print '<div class="email_row">';
            $value          = stripslashes( get_option('wp_estate_'.$key,'') );
            $value_subject  = stripslashes( get_option('wp_estate_subject_'.$key,'') );

            print '<label for="subject_'.$key.'">'.__('Subject for','wpestate').' '.$label.'</label>';
            print '<input type="text" name="subject_'.$key.'" value="'.$value_subject.'" />';

            print '<label for="'.$key.'">'.__('Content for','wpestate').' '.$label.'</label>';
            print '<textarea rows="10" name="'.$key.'">'.$value.'</textarea>';
            print '<div class="extra_exp"> '.wpestate_emails_extra_details($key).'</div>';
            print '</div>';

        }

        print'<p class="submit">
               <input type="submit" name="submit" id="submit" class="button-primary"  value="'.__('Save Changes','wpestate').'" />
            </p>';

        print '</div>';   
    }
endif;


if( !function_exists('wpestate_emails_extra_details') ):
    function wpestate_emails_extra_details($type){
        $return_string='';
        switch ($type) {
            case "new_user":
                    $return_string=__('%user_login_register as new username, %user_pass_register as user password, %user_email_register as new user email' ,'wpestate');
                    break;
                
            case "admin_new_user":
                    $return_string=__('%user_login_register as new username and %user_email_register as new user email' ,'wpestate');
                    break;
                
            case "password_reset_request":
                    $return_string=__('%reset_link as reset link','wpestate');
                    break;
                
            case "password_reseted":
                    $return_string=__('%user_pass as user password','wpestate');
                    break;
                
            case "purchase_activated":
                    $return_string='';
                    break;
                
            case "approved_listing":
                    $return_string=__('* you can use %post_id as listing id, %property_url as property url and %property_title as property name','wpestate');
                    break;

            case "new_wire_transfer":
                    $return_string=  __('* you can use %invoice_no as invoice number, %total_price as $totalprice and %payment_details as  $payment_details','wpestate');
                    break;
            
            case "admin_new_wire_transfer":
                    $return_string=  __('* you can use %invoice_no as invoice number, %total_price as $totalprice and %payment_details as  $payment_details','wpestate');
                    break;    
                
            case "admin_expired_listing":
                    $return_string=  __('* you can use %submission_title as property title number, %submission_url as property submission url','wpestate');
                    break;  
                
            case "matching_submissions":
                    $return_string=  __('* you can use %matching_submissions as matching submissions list','wpestate');
                    break;
                
            case "paid_submissions":  
                    $return_string= '';
                    break;
                
            case  "featured_submission":
                    $return_string=  '';
                    break;

            case "account_downgraded":   
                    $return_string=  '';
                    break;
                
            case "free_listing_expired":
                    $return_string=  __('* you can use %expired_listing_url as expired listing url and %expired_listing_name as expired listing name','wpestate');
                    break;
                
            case "new_listing_submission":
                    $return_string=  __('* you can use %new_listing_title as new listing title and %new_listing_url as new listing url','wpestate');
                    break;
                
            case "listing_edit":
                    $return_string=  __('* you can use %editing_listing_title as editing listing title and %editing_listing_url as editing listing url','wpestate');
                    break;
                
            case "recurring_payment":  
                    $return_string=  __('* you can use %recurring_pack_name as recurring packacge name and %merchant as merchant name','wpestate');
                    break;
                
            case "membership_activated":  
                    $return_string=  '';
                    break;    
        
                
                
        }
        return $return_string;
    }
endif;


if( !function_exists('wpestate_send_email_to_seller') ):
    function wpestate_send_email_to_seller($sub){
        $current_user = wp_get_current_user();
        $user_email = $current_user->user_email;
        $subject = "[khmerway.com]-".$sub;
        $message = '';
        $message .= '
            <div class="emailcontainer emailheader">
              <img src="https://www.khmerway.com/wp-content/uploads/2017/10/khmer_2x.png" class="img img-responsive">  
            </div>
              
            <div class="emailcontainer emailbody">
                <br/>
                  <p>Dear <b>'.$user_email.'!</b></p>
                    <hr/>
                     <p>
                    You received this message because you published an important property page for " '.$sub.'" on khmerway.com. <br>Khmerway.com is an online website provide posting property for sale both franchise and biz for sale.
                    </p>
                    <hr/>
                    <div class="row">
                      <img  class="img img-responsive" src="https://static.thenounproject.com/png/281836-200.png">
                    </div>    
            </div>

            <div class="emailcontainer emailfooter">
                <p class="center">
                    &copy;2019 Khmerway, #20 St454 Toul Tum Poung Phnom Penh
                </p>
                <p>
                    <span><b>Telephone:</b> (855)968886688 | </span>
                    <span><b>Email:</b> info@khmerway.com | </span>
                    <span><b>Website:</b><a href="http://khmerway.com" target="_blank"> www.khmerway.com | </a></span>
                    <span><b>Address:</b> #20 St454 Toul Tum Poung Phnom Penh</span>
                </p>   
            </div>
        ';
        // Set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Khmerway.com <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        @wp_mail(
            $user_email,
            stripslashes($subject),
            stripslashes($message),
            $headers
            );            
    };
endif;

if( !function_exists('wpestate_send_email_to_admin') ):
    function wpestate_send_email_to_admin($sub){
        $current_user = wp_get_current_user();
        $user_email = $current_user->user_email;
        $admin_email = 'info@khmerway.com';
        $subject = "[khmerway.com]-".$sub;
        $message = '';
        $message .= '
            <div class="emailcontainer emailheader">
              <img src="https://www.khmerway.com/wp-content/uploads/2017/10/khmer_2x.png" class="img img-responsive">  
            </div>
              
            <div class="emailcontainer emailbody">
                <br/>
                  <p>Dear <b>admin of khmerway.com!</b></p>
                    <hr/>
                     <p>
                    You received this message because '.$current_user->user_login.' have published an important property page for " '.$sub.'" on khmerway.com. <br>Khmerway.com is an online website provide posting property for sale both franchise and biz for sale.
                    </p>
                    <hr/>
                    <div class="row">
                      <img  class="img img-responsive" src="https://static.thenounproject.com/png/281836-200.png">
                    </div>    
            </div>

            <div class="emailcontainer emailfooter">
                <p class="center">
                    &copy;2019 Khmerway, #20 St454 Toul Tum Poung Phnom Penh
                </p>
                <p>
                    <span><b>Telephone:</b> (855)968886688 | </span>
                    <span><b>Email:</b> info@khmerway.com | </span>
                    <span><b>Website:</b><a href="http://khmerway.com" target="_blank"> www.khmerway.com | </a></span>
                    <span><b>Address:</b> #20 St454 Toul Tum Poung Phnom Penh</span>
                </p>   
            </div>
        ';
        // Set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Khmerway.com <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        @wp_mail(
            $admin_email,
            stripslashes($subject),
            stripslashes($message),
            $headers
            );            
    };
endif;