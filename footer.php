</div><!-- end content_wrapper started in header -->

</div> <!-- end class container -->
<?php
$show_sticky_footer_select  =   get_option('wp_estate_show_sticky_footer', '');
$footer_background          =   get_option('wp_estate_footer_background', '');
$repeat_footer_back_status  =   get_option('wp_estate_repeat_footer_back', '');
$logo_header_type           =   get_option('wp_estate_logo_header_type', '');
$footer_style               =   '';
$footer_back_class          =   '';


if ($footer_background!='') {
    $footer_style='style=" background-image: url('.$footer_background.') "';
}

if ($repeat_footer_back_status=='repeat') {
    $footer_back_class = ' footer_back_repeat ';
} elseif ($repeat_footer_back_status=='repeat x') {
    $footer_back_class = ' footer_back_repeat_x ';
} elseif ($repeat_footer_back_status=='repeat y') {
    $footer_back_class = ' footer_back_repeat_y ';
} elseif ($repeat_footer_back_status=='no repeat') {
    $footer_back_class = ' footer_back_repeat_no ';
}

if ($show_sticky_footer_select=='yes') {
    $footer_back_class.=' sticky_footer ';
}

if ($logo_header_type=='type4') {
    $footer_back_class.= ' footer_header4 ';
}

$show_foot          =   get_option('wp_estate_show_footer', '');
$wide_footer        =   get_option('wp_estate_wide_footer', '');
$wide_footer_class  =   '';



if (!wpestate_half_map_conditions($post->ID) && $show_foot=='yes') {
    $wide_status     =   esc_html(get_option('wp_estate_wide_status', ''));
    if ($wide_status==2) {
        $footer_back_class.=" boxed_footer ";
    } ?>    
    <footer id="colophon" role="contentinfo" <?php echo($footer_style); ?> class=" <?php echo($footer_back_class); ?> ">    

        <?php
        if ($wide_footer=='yes') {
            $wide_footer_class=" wide_footer ";
        } ?>
        
        <div id="footer-widget-area" class="row <?php echo $wide_footer_class; ?>">
           <?php get_sidebar('footer'); ?>
        </div>

        
        <?php
        $show_show_footer_copy_select  =   get_option('wp_estate_show_footer_copy', '');
    if ($show_show_footer_copy_select=='yes') {
        ?>
            <div class="sub_footer">  
                <div class="sub_footer_content <?php echo $wide_footer_class; ?>">
                    <span class="copyright">
                        <?php
                        $message = stripslashes(esc_html(get_option('wp_estate_copyright_message', '')));
        if (function_exists('icl_translate')) {
            $property_copy_text      =   icl_translate('wpestate', 'wp_estate_copyright_message', $message);
            print($property_copy_text);
        } else {
            print($message);
        } ?>
                    </span>

                    <div class="subfooter_menu">
                        <?php
                            wp_nav_menu(array(
                                'theme_location'    => 'footer_menu',
                            )); ?>
                    </div>  
                </div>  
            </div>      
        <?php
    }// end show subfooter
        ?>
        
        
    </footer><!-- #colophon -->
<?php
} ?>

<?php get_template_part('templates/footer_buttons');?>
<?php get_template_part('templates/navigational');?>

<?php wp_get_schedules(); ?>
<?php 

    wp_footer(); 

?>

<script>
<?php
echo '
control_vars["login_redirect"] = window.location.href;
ajaxcalls_vars["login_redirect"] = window.location.href;
';
?>

</script>

<?php
$ga = esc_html(get_option('wp_estate_google_analytics_code', ''));
if ($ga != '') { ?>

<script>
    //<![CDATA[
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo esc_html($ga); ?>', '<?php     echo esc_html($_SERVER['SERVER_NAME']); ?>');
  ga('send', 'pageview');
//]]>
</script>

<?php
}
?>


<?php
global $logo_header_align;
$logo_header_type            =   get_option('wp_estate_logo_header_type', '');
$logo_header_align           =   get_option('wp_estate_logo_header_align', '');
if ($logo_header_type=='type3') {
    get_template_part('templates/top_bar_sidebar');
}
?>
</div> <!-- end website wrapper -->
<?php  get_template_part('templates/compare_list'); ?> 
<?php  get_template_part('templates/login_register_modal'); ?> 
<?php if (is_singular('estate_property')) {
    get_template_part('/templates/image_gallery');
}

if (get_bloginfo('language') == 'km-KH')
    echo '<script type="text/javascript" src="'.get_option('siteurl').'/wp-content/themes/script_kh.js"></script>';
else
    echo '<script type="text/javascript" src="'.get_option('siteurl').'/wp-content/themes/script_en.js"></script>';

echo '
    <link rel="stylesheet" href="'.get_option('siteurl').'/wp-content/themes/public.css">
';

?>



</body>
</html>