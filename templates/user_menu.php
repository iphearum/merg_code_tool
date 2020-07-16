<?php 
$current_user = wp_get_current_user();
$userID                 =   $current_user->ID;
$user_login             =   $current_user->user_login;  
$add_link               =   get_dasboard_add_listing();
$dash_profile           =   get_dashboard_profile_link();
$dash_favorite          =   get_dashboard_favorites();
$dash_link              =   get_dashboard_link();
$dash_searches          =   get_searches_link();
$activeprofile          =   '';
$activedash             =   '';
$activeadd              =   '';
$activefav              =   '';
$activesearch           =   '';
$activeinvoices         =   '';
$user_pack              =   get_the_author_meta( 'package_id' , $userID );    
$clientId               =   esc_html( get_option('wp_estate_paypal_client_id','') );
$clientSecret           =   esc_html( get_option('wp_estate_paypal_client_secret','') );  
$user_registered        =   get_the_author_meta( 'user_registered' , $userID );
$user_package_activation=   get_the_author_meta( 'package_activation' , $userID );
$home_url               =   home_url();
$dash_invoices          =   wpestate_get_invoice_link();

if ( basename( get_page_template() ) == 'user_dashboard.php' ){
    $activedash  =   'user_tab_active';    
}
// else if ( basename( get_page_template() ) == 'user_dashboard_add.php' ){
//     $activeadd   =   'user_tab_active';
// }
else if ( basename( get_page_template() ) == 'user_dashboard_profile.php' ){
    $activeprofile   =   'user_tab_active';
}else if ( basename( get_page_template() ) == 'user_dashboard_favorite.php' ){
    $activefav   =   'user_tab_active';
}else if( basename( get_page_template() ) == 'user_dashboard_searches.php' ){
    $activesearch  =   'user_tab_active';
}else if( basename( get_page_template() ) == 'user_dashboard_invoices.php' ){
    $activeinvoices  =   'user_tab_active';
}
?>


<div class="user_tab_menu">

    <div class="user_dashboard_links">
        <?php if( $dash_profile != $home_url ){ ?>
            <a href="<?php print esc_url($dash_profile);?>"  class="<?php print $activeprofile; ?>"><i class="fa fa-cog"></i> <?php _e('My Profile','wpestate');?></a>
        <?php }

         ?>

        <a href="<?php echo wp_logout_url( home_url() );?>" title="Logout"><i class="fa fa-power-off"></i> <?php _e('Log Out','wpestate');?></a>
    </div>
    
</div>

 