<?php
$current_user               =   wp_get_current_user();
$user_custom_picture        =   get_the_author_meta('small_custom_picture', $current_user->ID);
$user_small_picture_id      =   get_the_author_meta('small_custom_picture', $current_user->ID);
if ($user_small_picture_id == '') {
    $user_small_picture[0]= get_template_directory_uri().'/img/default_user_small.png';
} else {
    $user_small_picture = wp_get_attachment_image_src($user_small_picture_id, 'user_thumb');
}
?>

   
<?php if (is_user_logged_in()) { ?>   
    <div class="user_menu user_loged" id="user_menu_u">
<!--        <a class="menu_user_tools dropdown" id="user_menu_trigger" data-toggle="dropdown"> </a>-->
            <a class="navicon-button x">
                <div class="navicon"></div>
            </a>
        <div class="menu_user_picture" style="background-image: url('<?php print $user_small_picture[0]; ?>');"></div>
        </div> 
<?php } else { ?>
    <div class="user_menu user_not_loged" id="user_menu_u">   
        <a class="menu_user_tools dropdown" id="user_menu_trigger" data-toggle="dropdown">  </a>
            <a class="navicon-button x">
                <div class="navicon"></div>
            </a>
        <!-- <div class="submit_action"><?php //_e('Buy&Sell  your business','wpestate');?></div> -->
        <div class="submit_action"><?php _e('Login', 'wpestate');?></div>
        </div> 
<?php } ?>   
                  
    
        
        
<?php
if (0 != $current_user->ID  && is_user_logged_in()) {
    $username               =   $current_user->user_login ;
    $add_link               =   get_dasboard_add_listing();
    $dash_profile           =   get_dashboard_profile_link();
    $dash_favorite          =   get_dashboard_favorites();
    $dash_link              =   get_dashboard_link();
    $dash_searches          =   get_searches_link();
    $logout_url             =   wp_logout_url();
    $home_url               =   home_url();
    $dash_invoices          =   wpestate_get_invoice_link(); ?> 
    <ul id="user_menu_open" class="dropdown-menu menulist topmenux" role="menu" aria-labelledby="user_menu_trigger"> 
        <?php if ($home_url!=$dash_profile) {?>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php print esc_url($dash_profile);?>"  class="active_profile"><i class="fa fa-cog"></i><?php _e('My Profile', 'wpestate');?></a></li>    
        <?php
        } ?>
        
        
           
       
        <li role="presentation" class="divider"></li>
        <li role="presentation"><a href="<?php echo wp_logout_url(home_url()); ?>" title="Logout" class="menulogout"><i class="fa fa-power-off"></i><?php _e('Log Out', 'wpestate'); ?></a></li>
    </ul>
<?php
}?>