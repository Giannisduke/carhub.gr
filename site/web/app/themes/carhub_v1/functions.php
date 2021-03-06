<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// Register Custom Navigation Walker (Soil)
require_once('wp_bootstrap_navwalker.php');
//declare your new menu
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'sage' ),
) );

// Add svg & swf support
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    $mimes['swf']  = 'application/x-shockwave-flash';

    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );



//enable logo uploading via the customize theme page

function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themeslug_logo_section' , array(
    'title'       => __( 'Logo', 'themeslug' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description     in the header',
) );
$wp_customize->add_setting( 'themeslug_logo' );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,     'themeslug_logo', array(
    'label'    => __( 'Logo', 'themeslug' ),
    'section'  => 'themeslug_logo_section',
    'settings' => 'themeslug_logo',
    'extensions' => array( 'jpg', 'jpeg', 'gif', 'png', 'svg' ),
) ) );
}
add_action('customize_register', 'themeslug_theme_customizer');



function show_attributes_doors() {
global $product;
$product_id = $product->get_id();
$attribute_slug = 'doors';
$array = wc_get_product_terms( $product_id , 'pa_' . $attribute_slug, array( 'fields' => 'names' ) );
$text = array_shift( $array );
echo '<div class="cars-slider_item-option car-option-' . $attribute_slug . '"><h6>Doors:<span class="attribute">' . $text . '</span></h6></div>';
}
add_action( 'woocommerce_attribute_doors', 'show_attributes_doors' );

function show_attributes_passengers() {
global $product;
$product_id = $product->get_id();
$attribute_slug = 'passengers';
$array = wc_get_product_terms( $product_id , 'pa_' . $attribute_slug, array( 'fields' => 'names' ) );
$text = array_shift( $array );
echo '<div class="cars-slider_item-option car-option-' . $attribute_slug . '"><h6>passengers:<span class="attribute">' . $text . '</span></h6></div>';
}
add_action( 'woocommerce_attribute_passengers', 'show_attributes_passengers' );

function show_attributes_luggage() {
global $product;
$product_id = $product->get_id();
$attribute_slug = 'luggage';
$array = wc_get_product_terms( $product_id , 'pa_' . $attribute_slug, array( 'fields' => 'names' ) );
$text = array_shift( $array );
echo '<div class="cars-slider_item-option car-option-' . $attribute_slug . '"><h6>luggage:<span class="attribute">' . $text . '</span></h6></div>';
}
add_action( 'woocommerce_attribute_luggage', 'show_attributes_luggage' );

function show_attributes_transmission() {
global $product;
$product_id = $product->get_id();
$attribute_slug = 'transmission';
$array = wc_get_product_terms( $product_id , 'pa_' . $attribute_slug, array( 'fields' => 'names' ) );
$text = array_shift( $array );
echo '<div class="cars-slider_item-option car-option-' . $attribute_slug . '"><h6>transmission:<span class="attribute">' . $text . '</span></h6></div>';
}
add_action( 'woocommerce_attribute_tansmission', 'show_attributes_transmission' );

function show_attributes_air_conditioning() {
global $product;
$product_id = $product->get_id();
$attribute_slug = 'air-conditioning';
$array = wc_get_product_terms( $product_id , 'pa_' . $attribute_slug, array( 'fields' => 'names' ) );
$text = array_shift( $array );
echo '<div class="cars-slider_item-option car-option-' . $attribute_slug . '"><h6>air condtitoning:<span class="attribute">' . $text . '</span></h6></div>';
}
add_action( 'woocommerce_attribute_air_conditioning', 'show_attributes_air_conditioning' );

function show_attributes_drive_wheel() {
global $product;
$product_id = $product->get_id();
$attribute_slug = 'drive-wheel';
$array = wc_get_product_terms( $product_id , 'pa_' . $attribute_slug, array( 'fields' => 'names' ) );
$text = array_shift( $array );
echo '<div class="cars-slider_item-option car-option-' . $attribute_slug . '"><h6>Drive wheel:<span class="attribute">' . $text . '</span></h6></div>';
}
add_action( 'woocommerce_attribute_drive_wheel', 'show_attributes_drive_wheel' );



add_filter( 'woocommerce_add_cart_item_data', 'ps_empty_cart', 10,  3);

function ps_empty_cart( $cart_item_data, $product_id, $variation_id ) {

    global $woocommerce;
    $woocommerce->cart->empty_cart();

    // Do nothing with the data and return
    return $cart_item_data;
}

remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 0) ;
remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40) ;

function woocommerce_template_loop_product_open() {
    echo '<div class="card">';
}
add_action ('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_open', 15) ;

function woocommerce_template_loop_product_close() {
    echo '</div>';
}
add_action ('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_close', 15) ;

add_action ('woocommerce_shop_loop_item_image', 'woocommerce_loop_item_image_open', 10) ;
function woocommerce_loop_item_image_open() {
    echo '<img class="card-img-top" src=" ">';
}




/**
 * The following hook will add a input field right before "add to cart button"
 * will be used for getting Your first name
 */

 function add_before_your_first_name_field() {
     echo '<fieldset class="wc-bookings-fields second_step hidden_form">';
     echo '<div class="form-group row">';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_before_your_first_name_field', 10 );

 function add_intime_field() {
    echo '<div class="row">';
    echo '<div class="col col-lg-6">';
    echo '<label>Check-in</label>';
    echo '<input type="text" name="in-time" value="12:30" class="in_time"/>';
    echo '</div>';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_intime_field', 11 );

 function add_outtime_field() {
   echo '<div class="col col-lg-6">';
   echo '<label>Check-out</label>';
   echo '<input type="text" name="out-time" value="12:30" class="out_time"/>';
   echo '</div>';
      echo '</div>';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_outtime_field', 12 );

 function add_location_in_start_field() {
  //echo '<div class="row">';
  echo '<div class="col-lg-6">';
   echo '<div class="row form-group">';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_start_field', 13 );

  function add_location_in_airport_field() {
    echo '<div class="col-lg-4 text-center custom-radio-airport">';
    echo '<input id="radio1" type="radio" name="pick-up" value="Airport" class="custom-radio" checked="">';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_airport_field', 14 );

  function add_location_in_airport_text_field() {
    echo '<div class="reveal-if-active">
    <textarea name="pick-up-airport" class="input-text form-control require-if-active pick_up_airport" id="order_comments" placeholder="Flight Number ex. PH 4238" rows="4" cols="5"></textarea>
    </div>
    </div>';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_airport_text_field', 15 );

  function add_location_in_port_field() {
    echo '<div class="col-lg-4 text-center custom-radio-port">';
    echo '<input id="radio2" type="radio" name="pick-up" value="Port" class="custom-radio">';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_port_field', 16 );

  function add_location_in_port_text_field() {
    echo '<div class="reveal-if-active">
    <textarea name="pick-up-airport" class="input-text form-control require-if-active port-position" data-require-pair="#pick-up-hotel" id="order_comments" placeholder="Boat Name" rows="4" cols="5"></textarea>
    </div>
    </div>';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_port_text_field', 17 );



  function add_location_in_custom_field() {
    echo '<div class="col-lg-4 text-center custom-radio-location">';
    echo '<input id="radio1" type="radio" name="pick-up" value="other_location" class="custom-radio">';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_custom_field', 18 );

  function add_location_in_custom_text_field() {
    echo '<div class="reveal-if-active">
    <textarea name="pick-up" class="input-text form-control require-if-active location-position" data-require-pair="#pick-up-hotel" id="order_comments" placeholder="" rows="4" cols="5"></textarea>
    </div>
    </div>';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_custom_text_field', 19 );



  function add_location_in_end_field() {
    echo '</div>';
    echo '</div>';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_in_end_field', 20 );



    function add_location_out_start_field() {
      echo '<div class="col-lg-6">';
      echo '<div class="row form-group">';
    }
    add_action( 'woocommerce_before_add_to_cart_button', 'add_location_out_start_field', 21 );

  function add_location_out_end_field() {
    echo '</div>';
    echo '</div>';
    //echo '</div>';
  }
  add_action( 'woocommerce_before_add_to_cart_button', 'add_location_out_end_field', 22 );

 function add_your_first_name_field() {
   echo '<div class="col-lg-6">';
     //echo '<label>Name</label>';
     echo '<input name="your-first-name" type="text" class="form-control" id="inputName" placeholder="Your First Name" required>';
 echo '</div>';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_your_first_name_field', 23 );

 function add_your_last_name_field() {
 echo '<div class="col-lg-6">';
 //echo '<div class="form-group">';
 //echo '<label>Last Name</label>';
     echo '<input type="text" name="your-last-name" placeholder="Last Name" value="" />';
 echo '</div>';
 //echo '</div>';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_your_last_name_field', 24 );


 function add_your_email_field() {
 echo '<div class="col-lg-6">';
 //echo '<label>Email</label>';
     echo '<input type="email" name="your-email" placeholder="email" value="" />';
 echo '</div>';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_your_email_field', 25 );

 function add_your_phone_field() {
 echo '<div class="col-lg-6">';
 //echo '<label>Phone</label>';

   echo '<input type="text" name="your-phone" placeholder="Phone" value="" />';
 echo '</div>';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_your_phone_field', 26 );





 function add_after_your_first_name_field() {
   echo '</div>';
     echo '</fieldset>';
 }
 add_action( 'woocommerce_before_add_to_cart_button', 'add_after_your_first_name_field', 30 );




  function save_your_first_name_field( $cart_item_data, $product_id ) {
      if( isset( $_REQUEST['your-first-name'] ) ) {
          $cart_item_data[ 'your_first_name' ] = $_REQUEST['your-first-name'];
          /* below statement make sure every add to cart action as unique line item */
          $cart_item_data['unique_key'] = md5( microtime().rand() );
      }
      return $cart_item_data;
  }
  add_action( 'woocommerce_add_cart_item_data', 'save_your_first_name_field', 10, 2 );

  function save_your_last_name_field( $cart_item_data, $product_id ) {
      if( isset( $_REQUEST['your-last-name'] ) ) {
          $cart_item_data[ 'your_last_name' ] = $_REQUEST['your-last-name'];
          /* below statement make sure every add to cart action as unique line item */
          $cart_item_data['unique_key'] = md5( microtime().rand() );
      }
      return $cart_item_data;
  }
 add_action( 'woocommerce_add_cart_item_data', 'save_your_last_name_field', 10, 3 );


 function save_your_email_field( $cart_item_data, $product_id ) {
     if( isset( $_REQUEST['your-email'] ) ) {
         $cart_item_data[ 'your_email' ] = $_REQUEST['your-email'];
         /* below statement make sure every add to cart action as unique line item */
         $cart_item_data['unique_key'] = md5( microtime().rand() );
     }
     return $cart_item_data;
 }
 add_action( 'woocommerce_add_cart_item_data', 'save_your_email_field', 10, 5 );

 function save_your_phone_field( $cart_item_data, $product_id ) {
     if( isset( $_REQUEST['your-phone'] ) ) {
         $cart_item_data[ 'your_phone' ] = $_REQUEST['your-phone'];
         /* below statement make sure every add to cart action as unique line item */
         $cart_item_data['unique_key'] = md5( microtime().rand() );
     }
     return $cart_item_data;
 }
 add_action( 'woocommerce_add_cart_item_data', 'save_your_phone_field', 10, 6 );

 function save_intime_field( $cart_item_data, $product_id ) {
     if( isset( $_REQUEST['in-time'] ) ) {
         $cart_item_data[ 'in_time' ] = $_REQUEST['in-time'];
         /* below statement make sure every add to cart action as unique line item */
         $cart_item_data['unique_key'] = md5( microtime().rand() );
     }
     return $cart_item_data;
 }
 add_action( 'woocommerce_add_cart_item_data', 'save_intime_field', 10, 7 );

  function render_on_cart_and_checkout_your_first_name( $cart_data, $cart_item = null ) {
      $custom_items = array();
      /* Woo 2.4.2 updates */
      if( !empty( $cart_data ) ) {
          $custom_items = $cart_data;
      }
      if( isset( $cart_item['your_first_name'] ) ) {
          $custom_items[] = array( "name" => 'Your first name', "value" => $cart_item['your_first_name'] );
      }
      return $custom_items;
  }
  add_filter( 'woocommerce_get_item_data', 'render_on_cart_and_checkout_your_first_name', 10, 2 );

  function render_on_cart_and_checkout_your_last_name( $cart_data, $cart_item = null ) {
      $custom_items = array();
      /* Woo 2.4.2 updates */
      if( !empty( $cart_data ) ) {
          $custom_items = $cart_data;
      }
      if( isset( $cart_item['your_last_name'] ) ) {
          $custom_items[] = array( "name" => 'Your last name', "value" => $cart_item['your_last_name'] );
      }
      return $custom_items;
  }
 add_filter( 'woocommerce_get_item_data', 'render_on_cart_and_checkout_your_last_name', 10, 3 );

 function render_on_cart_and_checkout_your_email( $cart_data, $cart_item = null ) {
     $custom_items = array();
     /* Woo 2.4.2 updates */
     if( !empty( $cart_data ) ) {
         $custom_items = $cart_data;
     }
     if( isset( $cart_item['your_email'] ) ) {
         $custom_items[] = array( "name" => 'Your email', "value" => $cart_item['your_email'] );
     }
     return $custom_items;
 }

 add_filter( 'woocommerce_get_item_data', 'render_on_cart_and_checkout_your_email', 10, 4 );

 function render_on_cart_and_checkout_your_phone( $cart_data, $cart_item = null ) {
     $custom_items = array();
     /* Woo 2.4.2 updates */
     if( !empty( $cart_data ) ) {
         $custom_items = $cart_data;
     }
     if( isset( $cart_item['your_phone'] ) ) {
         $custom_items[] = array( "name" => 'Your Phone', "value" => $cart_item['your_phone'] );
     }
     return $custom_items;
 }

 add_filter( 'woocommerce_get_item_data', 'render_on_cart_and_checkout_your_phone', 10, 5 );


 function render_on_cart_and_checkout_in_time( $cart_data, $cart_item = null ) {
     $custom_items = array();
     /* Woo 2.4.2 updates */
     if( !empty( $cart_data ) ) {
         $custom_items = $cart_data;
     }
     if( isset( $cart_item['in_time'] ) ) {
         $custom_items[] = array( "name" => 'In time', "value" => $cart_item['in_time'] );
     }
     return $custom_items;
 }

 add_filter( 'woocommerce_get_item_data', 'render_on_cart_and_checkout_in_time', 10, 6 );

 add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

 function child_manage_woocommerce_styles() {
 	//remove generator meta tag
 	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

 	//first check that woo exists to prevent fatal errors
 	if ( function_exists( 'is_woocommerce' ) ) {
 		//dequeue scripts and styles
 		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
 			wp_dequeue_style( 'woocommerce_frontend_styles' );
 			wp_dequeue_style( 'woocommerce_fancybox_styles' );
 			wp_dequeue_style( 'woocommerce_chosen_styles' );
 			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    //  wp_dequeue_style( 'woocommerce-layout' );
    //  wp_dequeue_style( 'woocommerce-smallscreen' );
      //wp_dequeue_style('gforms_css');
      //wp_dequeue_script( 'datepicker' );
 			wp_dequeue_script( 'wc_price_slider' );
 			wp_dequeue_script( 'wc-single-product' );
 			wp_dequeue_script( 'wc-add-to-cart' );
 			wp_dequeue_script( 'wc-cart-fragments' );
 			wp_dequeue_script( 'wc-checkout' );
 			wp_dequeue_script( 'wc-add-to-cart-variation' );
 			wp_dequeue_script( 'wc-single-product' );
 			wp_dequeue_script( 'wc-cart' );
 			wp_dequeue_script( 'wc-chosen' );
 			wp_dequeue_script( 'woocommerce' );
 			wp_dequeue_script( 'prettyPhoto' );
 			wp_dequeue_script( 'prettyPhoto-init' );
 			wp_dequeue_script( 'jquery-blockui' );
 			wp_dequeue_script( 'jquery-placeholder' );
 			wp_dequeue_script( 'fancybox' );
 			//wp_dequeue_script( 'jqueryui' );

 		}
 	}

 }



 // Hook in specified cart item data
 add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

 function custom_override_checkout_fields( $fields  ) {

$stored_value = "something pulled from the DB";
   unset($fields['billing']['billing_address_1']);
   unset($fields['billing']['billing_address_2']);
   unset($fields['billing']['billing_postcode']);
   unset($fields['billing']['billing_state']);
   unset($fields['billing']['billing_company']);
   unset($fields['billing']['billing_address_2']);
   unset($fields['billing']['billing_country']);
   unset($fields['billing']['billing_city']);
 $fields['order']['order_comments']['placeholder'] = 'My new placeholder';


     return $fields;
 }
 add_filter('woocommerce_email_order_meta_keys', 'my_custom_order_meta_keys');

 function my_custom_order_meta_keys( $keys ) {
      $keys[] = 'Your Phone'; // This will look for a custom field called 'Tracking Code' and add it to emails
      return $keys;
 }


 //*Add custom redirection
add_action( 'template_redirect', 'wc_custom_redirect_after_purchase' );
function wc_custom_redirect_after_purchase() {
 global $wp;
  if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) ) {
   wp_redirect( 'https://eboy.gr/coolcars/thank-you-for-your-order/' );
   exit;
 }
}

//add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button($button, $form) {
    ///return '<div class="row">';
    //return '<div class="co-12">';
    return '<input type="submit" class="btn btn-primary btn-lg" id="gform_submit_button_' . $form['id'] . '" value="' . $form['button']['text'] . '">';
  //  return '</div>';
  //  return '</div>';
}



// Force Gravity Forms to init scripts in the footer and ensure that the DOM is loaded before scripts are executed
add_filter( 'gform_init_scripts_footer', '__return_true' );
add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open', 1 );
function wrap_gform_cdata_open( $content = '' ) {
if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) ) {
return $content;
}
$content = 'document.addEventListener( "DOMContentLoaded", function() { ';
return $content;
}
add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close', 99 );
function wrap_gform_cdata_close( $content = '' ) {
if ( ( defined('DOING_AJAX') && DOING_AJAX ) || isset( $_POST['gform_ajax'] ) ) {
return $content;
}
$content = ' }, false );';
return $content;
}

/* --------------------------------------------
Add Bootstrap to Gravity Forms
-------------------------------------------- */

add_filter("gform_field_content", "bootstrap_styles_for_gravityforms_fields", 10, 5);

function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){

    // Currently only applies to most common field types, but could be expanded.

    if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
        $content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
    }

    if($field["type"] == 'name' || $field["type"] == 'address') {
        $content = str_replace('<input ', '<input class=\'form-control\' ', $content);
    }

    if($field["type"] == 'textarea') {
        $content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
    }

    if($field["type"] == 'checkbox') {
        $content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
        $content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
    }

    if($field["type"] == 'radio') {
        $content = str_replace('li class=\'', 'li class=\'radio ', $content);
        $content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
    }

    return $content;

} // End bootstrap_styles_for_gravityforms_fields()



// Populate Contact form Locations field with dropdown of Location posts
add_filter( 'gform_pre_render_5', 'populate_posts' );
add_filter( 'gform_pre_validation_5', 'populate_posts' );
add_filter( 'gform_pre_submission_filter_5', 'populate_posts' );
add_filter( 'gform_admin_pre_render_5', 'populate_posts' );
function populate_posts( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-locations' ) === false ) {
            continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)
        $posts = get_posts( 'post_type=product&numberposts=-10&post_status=publish' );

        $choices = array();

        foreach ( $posts as $post ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
        }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = '-- Select a Car --';
        $field->choices = $choices;

    }

    return $form;
}

add_filter("gform_confirmation_anchor_5", create_function("","return false;"));

function sendContactFormToSiteAdmin () {
  try {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
      throw new Exception('Bad form parameters. Check the markup to make sure you are naming the inputs correctly.');
    }
    if (!is_email($_POST['email'])) {
      throw new Exception('Email address not formatted correctly.');
    }

    $subject = 'Contact Form: '.$reason.' - '.$_POST['name'];
    $headers = 'From: My Blog Contact Form <contact@myblog.com>';
    $send_to = "rentalspotgreece@gmail.com";
    $subject = "MyBlog Contact Form ($reason): ".$_POST['name'];
    $message = "Message from ".$_POST['name'].": \n\n ". $_POST['message'] . " \n\n Reply to: " . $_POST['email'];

    if (wp_mail($send_to, $subject, $message, $headers)) {
      echo json_encode(array('status' => 'success', 'message' => 'Contact message sent.'));
      exit;
    } else {
      throw new Exception('Failed to send email. Check AJAX handler.');
    }
  } catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
    exit;
  }
}
add_action("wp_ajax_contact_send", "sendContactFormToSiteAdmin");
add_action("wp_ajax_nopriv_contact_send", "sendContactFormToSiteAdmin");
