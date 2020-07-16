<?php
global $asking_price;
global $average_sale_revenue;
global $cashflow;
global $expected_profir_margin;
global $submission_page_fields;
$measure_sys        =   esc_html ( get_option('wp_estate_measure_sys','') ); 
$custom_fields_show =   '';
$custom_fields      =   get_option( 'wp_estate_custom_fields', true); 
$i=0;

    if( !empty($custom_fields)){  
        while($i< count($custom_fields) ){
            $name               =   $custom_fields[$i][0];
            $label              =   stripslashes( $custom_fields[$i][1] );
            $type               =   $custom_fields[$i][2];
            $order              =   $custom_fields[$i][3];
            $dropdown_values    =   $custom_fields[$i][4];

            $slug  =$prslig            =   str_replace(' ','_',$name);
            $prslig1      =     htmlspecialchars ( str_replace(' ','_', trim($name) ) , ENT_QUOTES );
           
            
            $slug         =   wpestate_limit45(sanitize_title( $name ));
            $slug         =   sanitize_key($slug);
            $post_id      =     $post->ID;
            $show         =     1;  
            $i++;

            if (function_exists('icl_translate') ){
                $label     =   icl_translate('wpestate','wp_estate_property_custom_front_'.$label, $label ) ;
            }   

            if($i%2!=0){
                $custom_fields_show.= '<p class="half_form ">';
            }else{
                $custom_fields_show.= '<p class="half_form">';
            }
            $value=$custom_fields_array[$slug];

         
            if(   is_array($submission_page_fields) && ( in_array($prslig, $submission_page_fields) ||  in_array($prslig1, $submission_page_fields))  ) { 
              $custom_fields_show.=  wpestate_show_custom_field(0,$slug,$name,$label,$type,$order,$dropdown_values,$post_id,$value);
            }
            
            $custom_fields_show.= '</p>';

       }
    }


    ?> 
<?php if(   is_array($submission_page_fields) && 
           (   in_array('asking_price', $submission_page_fields) || 
               in_array('average_sale_revenue', $submission_page_fields) || 
               in_array('cashflow', $submission_page_fields) || 
               in_array('expected_profir_margin', $submission_page_fields) || 
                $custom_fields_show !=  ''
     
            )
        ) { ?>    
<div class="col-md-12 add-estate profile-page profile-onprofile row"> 
    <div class="submit_container">
        
        <div class="col-md-4 profile_label">
            <div class="user_details_row"><?php _e('Price and Expected sale','wpestate');?></div> 
            <div class="user_profile_explain"><?php _e('Price and Expected sale. ','wpestate')?></div>
        </div>
        
        
        <div class="col-md-8">
            <?php
            //It will show Seller-Franchise more field here....if the role is franchise-----------------
                $user_role=display_user_roles();
                if(is_franchise()){
                ?>
            <div style="clear:both"></div>
            <div class="row" >         
                    <div class="col-md-6">
                            <p>
                                <label for="asking_price"><?php _e('Asking Price(Investment)/USD','wpestate');?></label>
                                <input type="text" id="asking_price" class="form-control" value="<?php echo esc_html($asking_price);?>"  name="asking_price" onkeypress="return isNum(event)" >
                            </p>
                    </div>
                    <div class="col-md-6">
                            <p>
                                <label for="average_sale_revenue"><?php _e('Average Sales Revenue','wpestate');?></label>
                                <input type="text" id="average_sale_revenue" class="form-control" value="<?php echo esc_html($average_sale_revenue);?>"  name="average_sale_revenue" onkeypress="return isNum(event)">
                            </p>
                    </div>         
                    <div class="col-md-6">
                            <p>
                                <label for="cashflow"><?php _e('Cash Flow','wpestate');?></label>
                                <input type="text" id="cashflow" class="form-control" value="<?php echo esc_html($cashflow);?>"  name="cashflow" onkeypress="return isNum(event)" >
                            </p>
                    </div>
                    <div class="col-md-6">
                            <p>
                                <label for="expected_profir_margin"><?php _e('Expected Profir Margin','wpestate');?></label>
                                <input type="text" id="expected_profir_margin" class="form-control" value="<?php echo esc_html($expected_profir_margin);?>"  name="expected_profir_margin" onkeypress="return isNum(event)" >
                            </p>
                    </div>
             </div><!--end row-->
            <?php
            }//end franchise -----------------------------------------------------------
            ?>

        </div>
        
            
        
    </div>  
</div>

<?php }?>