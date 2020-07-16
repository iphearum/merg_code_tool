 <?php 
 require_once('../../../wp-config.php');
//trying to bring this $parentID value from JS
if(isset($_POST['parentID'])) {
    $id = $parentID = $_POST['parentID'];
     global $wpdb;
    $childCats = $wpdb->get_results( "SELECT term_id,name FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE taxonomy = 'property_category' AND parent = ".$id." )" );

    $str = '<option value="-1">None</option>';

    if ( $childCats) {
        foreach ($childCats as $childCat) { 
          $str .= '<option value="'.esc_attr( $childCat->term_id ).'">'.$childCat->name.'</option>';
        }
    } 
    
    echo $str;    
}
?>