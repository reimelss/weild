<?php
add_action( 'init', 'weild_deal_init' );
/**
 * Register a deal post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function weild_deal_init() {
  $labels = array(
    'name'               => _x( 'Deals', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Deal', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Deals', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Deal', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Add New', 'deal', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Add New Deal', 'your-plugin-textdomain' ),
    'new_item'           => __( 'New Deal', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Edit Deal', 'your-plugin-textdomain' ),
    'view_item'          => __( 'View Deal', 'your-plugin-textdomain' ),
    'all_items'          => __( 'All Deals', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Search Deals', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Parent Deals:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'deal' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'deal', $args );
}
//create forum after creating new deal
function weild_deal_forum( $post_id ) {
    // Only do it for "custom_post" post type
    if( get_post_type($post_id) != 'deal' ){
        return;
    }  
    // Only do it on the front end
    if( is_admin() ){
        return;
    }
    $post_title = get_the_title($post_id);
    $forum_id = wp_insert_post( array(
                    'post_status' => 'pending',
                    'post_type' => 'forum',
                    'post_title' => 'Forum '.$post_title,
                    'post_content' => $post_title
                ) );
    update_post_meta($post_id,'forumn_id',$forum_id);
}

// run after ACF saves the $_POST['acf'] data
add_action('acf/save_post', 'weild_deal_forum', 99);


function my_pre_save_post($post_id) {

 

  // // check for numerical post_id and check post_type
  // if (!is_numeric($post_id) || get_post_type($post_id) == 'deal') {
  //   return $post_id;
  // }

  if(!$_POST["acf"]["field_5d032303d63f2"]) {
    $post = array(
      'ID' => $post_id,
      'post_status'  => 'draft' ,
      'post_title'   => $_POST["acf"]["field_5cf2ee7943029"]
    );  
  }else {
      $post = array(
        'ID' => $post_id,
        'post_status'  => 'pending' ,
        'post_title'   => $_POST["acf"]["field_5cf2ee7943029"]
      );  
  }
  // echo "<pre>";
  // var_dump($post); 
  // die();

  // update the post
  wp_update_post($post);
  
  return $post_id;
}

add_filter('acf/pre_save_post' , 'my_pre_save_post', 10, 1 );


add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Set value to display orders', 'Deals Order', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-tickets', 6  );
}


function myplguin_admin_page(){

  if( $_POST["Pre-Engagement"] ){ 
    echo "<pre>";
    var_dump($_POST);
    echo "<br>";
    echo "<br>";
  
    $new_options = array(
      'Pre-Engagement' => $_POST["Pre-Engagement"],
      'Pre-Market' => $_POST["Pre-Market"],
      'Active' => $_POST["Active"],
      'Closed' => $_POST["Closed"],
      'Pitching_Issuer_/_Seller' => $_POST["Pitching_Issuer_/_Seller"],
      'Locating_Investors_/_Buyers' => $_POST["Locating_Investors_/_Buyers"],
      'Industry_/_Sector_Expertise' => $_POST["Industry_/_Sector_Expertise"],
      'Deal_Structure_(product_expertise)' => $_POST["Deal_Structure_(product_expertise)"],
      'Diligence' => $_POST["Diligence"],
      'Deal_Management' => $_POST["Deal_Management"],
      'Under_1_million' => $_POST["Under_1_million"],
      '1-5_million' => $_POST["1-5_million"],
      '5-15_million' => $_POST["5-15_million"],
      '15-50_million' => $_POST["15-50_million"],
      '50-100_million' => $_POST["50-100_million"],
      'Over_100_million' => $_POST["Over_100_million"],
      'Retail_-_Public' => $_POST["Retail_-_Public"],
      'Retail_-_Accredited' => $_POST["Retail_-_Accredited"],
      'non-QIB_Family_Office' => $_POST["non-QIB_Family_Office"],
      'QIB_-_Family_Office' => $_POST["QIB_-_Family_Office"],
      'QIB_-_Pension_Fund' => $_POST["QIB_-_Pension_Fund"],
      'QIB_-_13(f)_filer' => $_POST["QIB_-_13(f)_filer"],
      'QIB_-_Insurance' => $_POST["QIB_-_Insurance"],
      'Corporate_/_Strategic' => $_POST["Corporate_/_Strategic"]
    );
  
   

    if(!get_option("display_order") !== false) {
      add_option("display_order", $new_options);
    }else {
      update_option("display_order", $new_options);
    }
    $option_get_data = get_option("display_order");

    var_dump($new_options);

    echo "<Br>";
    $posts = get_posts([
      'post_type' => 'deal',
      'post_status' => 'publish',
      'numberposts' => -1
      // 'order'    => 'ASC'
      ]);
    echo "<Br>";
    foreach($posts as $post) {


      $fields = get_fields($post->ID); 
      var_dump($fields); 
      $score = 0;
      if (in_array("Pre-Engagement", $fields)) $score = $score + $option_get_data["Pre-Engagement"];
      if (in_array("Pre-Market", $fields)) $score = $score + $option_get_data["Pre-Market"];
      if (in_array("Active", $fields)) $score = $score + $option_get_data["Active"];
      if (in_array("Closed", $fields)) $score = $score + $option_get_data["Closed"];
      if (in_array("Pitching Issuer / Seller", $fields)) $score = $score + $option_get_data["Pitching_Issuer_/_Seller"];

      if (in_array("Locating Investors / Buyers", $fields)) $score = $score + $option_get_data["Locating_Investors_/_Buyers"];
      if (in_array("Industry_/_Sector_Expertise", $fields)) $score = $score + $option_get_data["Industry_/_Sector_Expertise"];
      if (in_array("Deal Structure (product expertise)", $fields)) $score = $score + $option_get_data["Deal_Structure_(product_expertise)"];
      
      if (in_array("Diligence", $fields)) $score = $score + $option_get_data["Diligence"];
      if (in_array("Deal Management", $fields)) $score = $score + $option_get_data["Deal_Management"];
      if (in_array("Under $1 million", $fields)) $score = $score + $option_get_data["Under_1_million"];
      
      
      if (in_array("$ 1-5 million", $fields)) $score = $score + $option_get_data["1-5_million"];
      if (in_array("$ 5-15 million", $fields)) $score = $score + $option_get_data["5-15_million"];
      if (in_array("$ 15-50 million", $fields)) $score = $score + $option_get_data["15-50_million"];
      
      
      if (in_array("$ 50-100 million`", $fields)) $score = $score + $option_get_data["50-100_million"];
      if (in_array("Over $100 million", $fields)) $score = $score + $option_get_data["Over_100_million"];
      if (in_array("Retail - Public", $fields)) $score = $score + $option_get_data["Retail_-_Public"];
      
      
      if (in_array("Retail - Accredited", $fields)) $score = $score + $option_get_data["Retail_-_Accredited"];
      if (in_array("non-QIB Family Office", $fields)) $score = $score + $option_get_data["non-QIB_Family_Office"];
      if (in_array("QIB - Family Office", $fields)) $score = $score + $option_get_data["QIB_-_Family_Office"];
      
      
      if (in_array("QIB - Pension Fund", $fields)) $score = $score + $option_get_data["QIB_-_Pension_Fund"];
      if (in_array("QIB - 13(f) filer", $fields)) $score = $score + $option_get_data["QIB_-_13(f)_filer"];
      if (in_array("QIB - Insurance", $fields)) $score = $score + $option_get_data["QIB_-_Insurance"];
      if (in_array("Corporate / Strategic", $fields)) $score = $score + $option_get_data["Corporate_/_Strategic"];
      
      
      // var_dump($post);
      if ( ! add_post_meta( $post->ID, 'post_score', $score, true ) ) { 
        update_post_meta( $post->ID, 'post_score', $score );
     }
     

    }
  


  }

  $option_get_data = get_option("display_order");
  var_dump($option_get_data);
	?>
	<div class="wrap">
		<h2>Point value to Deal attributes</h2>
		<p>The total of those points would determine the sort order</p>
    <form method="post">

    <h3 for="Status">Status</h3>
    <label for="Pre-Engagement">Pre-Engagement</label> <br>
    <input required type="number" <?php  if($option_get_data['Pre-Engagement']) echo "value='" . $option_get_data['Pre-Engagement'] ."'"; ?> name="Pre-Engagement" min="0" max="10" > 
    <br>
    <label for="Pre-Market">Pre-Market</label> <br>
    <input required type="number" <?php  if($option_get_data['Pre-Market']) echo "value='" . $option_get_data['Pre-Market'] ."'"; ?> name="Pre-Market" min="0" max="10" > 
    <br>
    <label for="Active">Active</label> <br>
    <input required type="number" <?php  if($option_get_data['Active']) echo "value='" . $option_get_data['Active'] ."'"; ?> name="Active" min="0" max="10" > 
    <br>
    <label for="Closed">Closed</label> <br>
    <input required type="number" <?php  if($option_get_data['Closed']) echo "value='" . $option_get_data['Closed'] ."'"; ?> name="Closed" min="0" max="10" > 
    <br>

    <h3 for="Status">Seeking Assistance</h3>

    <label for="Pitching Issuer / Seller">Pitching Issuer / Seller</label> <br>
    <input required type="number" <?php  if($option_get_data['Pitching_Issuer_/_Seller']) echo "value='" . $option_get_data['Pitching_Issuer_/_Seller'] ."'"; ?> name="Pitching Issuer / Seller" min="0" max="10" > 
    <br>

    <label for="Locating Investors / Buyers">Locating Investors / Buyers</label> <br>
    <input required type="number" <?php  if($option_get_data['Locating_Investors_/_Buyers']) echo "value='" . $option_get_data['Locating_Investors_/_Buyers'] ."'"; ?> name="Locating Investors / Buyers" min="0" max="10" > 
    <br>

    <label for="Industry / Sector Expertise">Industry / Sector Expertise</label> <br>
    <input required type="number" <?php  if($option_get_data['Industry_/_Sector_Expertise']) echo "value='" . $option_get_data['Industry_/_Sector_Expertise'] ."'"; ?> name="Industry / Sector Expertise" min="0" max="10" > 
    <br>

    <label for="Deal Structure (product expertise)">Deal Structure (product expertise)</label> <br>
    <input required type="number" <?php  if($option_get_data['Deal_Structure_(product_expertise)']) echo "value='" . $option_get_data['Deal_Structure_(product_expertise)'] ."'"; ?> name="Deal Structure (product expertise)" min="0" max="10" > 
    <br>

    <label for="Diligence">Diligence</label> <br>
    <input required type="number" <?php  if($option_get_data['Diligence']) echo "value='" . $option_get_data['Diligence'] ."'"; ?> name="Diligence" min="0" max="10" > 
    <br>

    <label for="Deal Management">Deal Management</label> <br>
    <input required type="number" <?php  if($option_get_data['Deal_Management']) echo "value='" . $option_get_data['Deal_Management'] ."'"; ?> name="Deal Management" min="0" max="10" > 
    <br>

    <h3 for="Status">Size</h3>

    <label for="Under $1 million">Under $1 million</label> <br>
    <input required type="number" <?php  if($option_get_data['Under_1_million']) echo "value='" . $option_get_data['Under_1_million'] ."'"; ?> name="Under 1 million" min="0" max="10" > 
    <br>

    <label for="$ 1-5 million">$ 1-5 million</label> <br>
    <input required type="number" <?php  if($option_get_data['1-5_million']) echo "value='" . $option_get_data['1-5_million'] ."'"; ?> name="1-5 million" min="0" max="10" > 
    <br>

    <label for="5-15 million">$ 5-15 million</label> <br>
    <input required type="number" <?php  if($option_get_data['5-15_million']) echo "value='" . $option_get_data['5-15_million'] ."'"; ?> name="5-15 million" min="0" max="10" > 
    <br>

    <label for="15-50 million">$ 15-50 million</label> <br>
    <input required type="number" <?php  if($option_get_data['15-50_million']) echo "value='" . $option_get_data['15-50_million'] ."'"; ?> name="15-50 million" min="0" max="10" > 
    <br>

    <label for="50-100 million">$ 50-100 million</label> <br>
    <input required type="number" <?php  if($option_get_data['50-100_million']) echo "value='" . $option_get_data['50-100_million'] ."'"; ?> name="50-100 million" min="0" max="10" > 
    <br>

    <label for="Over 100 million">Over $100 million</label> <br>
    <input required type="number" <?php  if($option_get_data['Over_100_million']) echo "value='" . $option_get_data['Over_100_million'] ."'"; ?> name="Over 100 million" min="0" max="10" > 
    <br>


    <h3 for="Status">Target Investor Type</h3>


    <label for="Retail - Public">Retail - Public</label> <br>
    <input required type="number" <?php  if($option_get_data['Retail_-_Public']) echo "value='" . $option_get_data['Retail_-_Public'] ."'"; ?> name="Retail - Public" min="0" max="10" > 
    <br>

    <label for="Retail - Accredited">Retail - Accredited</label> <br>
    <input required type="number" <?php  if($option_get_data['Retail_-_Accredited']) echo "value='" . $option_get_data['Retail_-_Accredited'] ."'"; ?> name="Retail - Accredited" min="0" max="10" > 
    <br>

    <label for="non-QIB Family Office">non-QIB Family Office</label> <br>
    <input required type="number" <?php  if($option_get_data['non-QIB_Family_Office']) echo "value='" . $option_get_data['non-QIB_Family_Office'] ."'"; ?> name="non-QIB Family Office" min="0" max="10" > 
    <br>

    <label for="QIB - Family Office">QIB - Family Office</label> <br>
    <input required type="number" <?php  if($option_get_data['QIB_-_Family_Office']) echo "value='" . $option_get_data['QIB_-_Family_Office'] ."'"; ?> name="QIB - Family Office" min="0" max="10" > 
    <br>

    <label for="QIB - Pension Fund">QIB - Pension Fund</label> <br>
    <input required type="number" <?php  if($option_get_data['QIB_-_Pension_Fund']) echo "value='" . $option_get_data['QIB_-_Pension_Fund'] ."'"; ?> name="QIB - Pension Fund" min="0" max="10" > 
    <br>

    <label for="QIB - Insurance">QIB - Insurance</label> <br>
    <input required type="number" <?php  if($option_get_data['QIB_-_Insurance']) echo "value='" . $option_get_data['QIB_-_Insurance'] ."'"; ?> name="QIB - Insurance" min="0" max="10" > 
    <br>
    
    <label for="QIB - 13(f) filer">QIB - 13(f) filer</label> <br>
    <input required type="number" <?php  if($option_get_data['QIB_-_13(f)_filer']) echo "value='" . $option_get_data['QIB_-_13(f)_filer'] ."'"; ?> name="QIB - 13(f) filer" min="0" max="10" > 
    <br>

    <label for="Corporate / Strategic">Corporate / Strategic</label> <br>
    <input required type="number" <?php  if($option_get_data['Corporate_/_Strategic']) echo "value='" . $option_get_data['Corporate_/_Strategic'] ."'"; ?> name="Corporate / Strategic" min="0" max="10" > 
    <br>

    <br>
    <input type="submit">


    </form>
	</div>
	<?php
}
