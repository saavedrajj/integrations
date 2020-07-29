<?php



/*



Plugin Name: Openpay Product Calculator Widget



Plugin URI: http://openpaytestandtrain.com.au/devcenter/woocommerce/



Description: Shows multiple repayment options on product page to customers. Works only when WooCommerce is active.



Version: 1.4



Author: Openpay



Author URI: https://www.openpay.com.au/







Copyright: Openpay | All Rights Reserved



License: GNU General Public License v3.0



License URI: http://www.gnu.org/licenses/gpl-3.0.html



*/



if (!defined('ABSPATH')) exit;



define('OPNPYWDGTSPOC_VERSION', '1.4.0');



define('OPNPYWDGTSPOC_PLUGIN', __FILE__);



define('OPNPYWDGTSPOC_PLUGIN_BASENAME', plugin_basename(OPNPYWDGTSPOC_PLUGIN));



define('OPNPYWDGTSPOC_PLUGIN_NAME', trim(dirname(OPNPYWDGTSPOC_PLUGIN_BASENAME), '/'));



define('OPNPYWDGTSPOC_PLUGIN_DIR', untrailingslashit(dirname(OPNPYWDGTSPOC_PLUGIN)));



function opnpywdgtspoc_plugin_avtivation() {



    if (class_exists('WC_ocean_OpenPay')) {



        return true;



    } else {



        $error_message = __('This addon required Openpay Payment Method plugin for WooCommerce to be active!', 'opnpywdgts');



        die($error_message);



    }



}



register_activation_hook(__FILE__, 'opnpywdgtspoc_plugin_avtivation');



function opnpywdgtspoc_plugin_deactivation() {



    return true;



}



register_deactivation_hook(__FILE__, 'opnpywdgtspoc_plugin_deactivation');



function opnpywdgtspoc_css() {



    if (function_exists('get_current_screen')) {



        $screen = get_current_screen();



        if ($screen->id === 'toplevel_page_openpay-poc-widgets') {



            wp_enqueue_style('opnpywdgts_css', plugin_dir_url(__FILE__) . "css/opnpywdgtspoc.css");



        }



    }



    if (function_exists('is_product')) {



        if (is_product()) {



            wp_enqueue_style('opnpywdgts_css', plugin_dir_url(__FILE__) . "css/opnpywdgtspoc.css");



        }



    }



}



add_action('admin_enqueue_scripts', 'opnpywdgtspoc_css');



add_action('wp_enqueue_scripts', 'opnpywdgtspoc_css');



function opnpywdgtspoc_scripts() {



    if (function_exists('get_current_screen')) {



        $screen = get_current_screen();



        if ($screen->id === 'toplevel_page_openpay-poc-widgets') {



            wp_enqueue_script('opnpywdgts_js', plugin_dir_url(__FILE__) . 'js/opnpywdgtspoc.js', array('jquery'), '1.0.0', true);



        }



    }



    if (function_exists('is_product')) {



        if (is_product()) {



            wp_enqueue_script('opnpywdgts_js', plugin_dir_url(__FILE__) . 'js/opnpywdgtspoc.js', array(), '1.0.0', true);



        }



    }



}



add_action('admin_enqueue_scripts', 'opnpywdgtspoc_scripts');



add_action('wp_enqueue_scripts', 'opnpywdgtspoc_scripts');



function opnpywdgtspoc_admin_menu() {



    add_menu_page('Openpay Product Calculator Widget', 'Openpay Product Calculator Widget', 'manage_options', 'openpay-poc-widgets', 'openpay_poc_widgets', plugin_dir_url(__FILE__) . 'images/Openplay-white-icon.png', 3);



}



add_action('admin_menu', 'opnpywdgtspoc_admin_menu', 11);



function openpay_poc_widgets() {



    require_once 'partial/opnpywdgts.php';



}



add_action('woocommerce_single_product_summary', 'openpay__before_add_to_cart_form', 10);



function openpay__before_add_to_cart_form() {



    global $product;



    $product_id = $product->get_id();





    $fractioanl_month = get_option('openpay_pocfm');



    $pay_of_month = get_option('openpay_pocm');



    $expldval_month = explode(',', $pay_of_month);



    $child_prices = array();



    $tax_display_mode = get_option('woocommerce_tax_display_shop');



    if ($product->is_type('variable')) {



        foreach ($product->get_children() as $child_id) {



            $child = wc_get_product($child_id);



            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);



        }



    } elseif ($product->is_type('grouped')) {



        foreach ($product->get_children() as $child_id) {



            $child = wc_get_product($child_id);



            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);



        }



    }



    if (!empty($child_prices)) {



        $price = min($child_prices);



    } else {



        $price = wc_get_price_including_tax( $product );



    }



$fraction_fm = $fractioanl_month + 1;

$today = $price / $fraction_fm;







    $remaining = $price - $today;



    $minimum_checkout = determine_plugin_data('minimum_checkout');



    $maximum_checkout = determine_plugin_data('maximum_checkout');



    function action_woocommerce_after_add_to_cart_form() {



        echo '<input type="hidden" name="min_check_val" id="min_check_val" value="' . determine_plugin_data('minimum_checkout') . '">';



        echo '<input type="hidden" name="max_check_val" id="max_check_val" value="' . determine_plugin_data('maximum_checkout') . '">';



    };



    add_action('woocommerce_before_add_to_cart_button', 'action_woocommerce_after_add_to_cart_form', 10, 0);



?>







<?php if (get_option('openpay_pocs') == 'yes') { ?>







 <?php



      

$oplogo = '<img src='. plugin_dir_url(__FILE__) . 'images/openpay-logo.svg' .' alt="Openpay" class="oplogo">';

$fm_condition = (empty(get_option('openpay_pocfm')));

$fraction_fm = $fractioanl_month + 1;

 $tagline = $fm_condition ? get_option('brand_msg') : 'Or ' . $fraction_fm . ' payments of ' . wc_price($today) . ' with ';?>









  <div class="top-info poc_detail">



    <?php if ($minimum_checkout > $price || $maximum_checkout < $price) { ?>



    <p><span class='info-ttl'> <?php echo $oplogo. '  '. get_option('threshold_msg') ; ?> </span> <a class="info-icn learnmorepopup" onclick="myPopupimage()" id="fracpopup" href="javascript:void(0)"><?php echo get_option('openpay_poclmt');?></a></p>



    <?php } elseif (get_option('brand_msg') == 'yes') { ?>



        <p><span class='info-ttl'> <?php echo $oplogo. ' '. get_option('threshold_msg') ; ?> </span> <a class="info-icn learnmorepopup" onclick="myPopupimage()" id="fracpopup" href="javascript:void(0)"><?php echo get_option('openpay_poclmt');?></a></p>



    <?php } else { ?>



    <span class="info-ttl"><?php echo $tagline; ?><?php echo $oplogo; ?><a class="info-icn learnmorepopup" onclick=myPopupimage() id="fracpopup" href="javascript:void(0)"><?php echo get_option('openpay_poclmt');?></a> </span>



   





<?php



        }

echo '</div>';

    } ?>







<?php



}



add_action('wp_footer', 'add_script_footer');



function add_script_footer() {



    if (is_product()) {



?>



<script type="text/javascript">



    jQuery(document).on('change', '.woocommerce select', function () {



        var variationid = jQuery("input[name=variation_id]").val();



        var product_id = jQuery("input[name=product_id]").val();



        var min_check_val = jQuery("#min_check_val").val();



        var max_check_val = jQuery("#max_check_val").val();







        var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';







        if(variationid) {



          var data = {



            'action': 'get_price_product',



            'variationid': variationid,



            'product_id': product_id,



            'min_check_val': min_check_val,



            'max_check_val': max_check_val,



          };







          jQuery.post(ajax_url, data, function(response) {



            if(response) {



              //console.log(response);



          var sephtml = response.html;



          var finalhtml = sephtml.replace(/\\/g, "");



          jQuery('.poc_detail').html(finalhtml);



            }



          });



        }







  });







jQuery('.poc_info-icn').mouseover(function(){



  jQuery('.details-price.poc-popup').show();



});



jQuery('.poc_info-icn').mouseout(function(){



  jQuery('.details-price.poc-popup').hide();



});







jQuery(".close").click(function(){



    jQuery("#popup1").hide();



});



jQuery("#fracpopup").click(function(){



    jQuery("#popup1").show();



});



function myPopupimage() {

    var x = document.getElementById('popup1');

    if (x.style.display === 'none') {

        x.style.display = 'block';

    } else {

        x.style.display = 'none';

    }

    var span = document.getElementsByClassName('closeopenpay')[0];

    span.onclick = function() {

    x.style.display = 'none';

}

}

function openpaywidgetpopup() {



                



           



            <?php if (get_option('openpay_pocipop') == 'yes') { ?>

                    document.querySelector('body').insertAdjacentHTML('beforeend', '<div id="popup1" style="display: none;" class="overlay popupimage"><div class="popup"><a class="close closeopenpay"><img src=\'<?php echo plugin_dir_url(__FILE__);?>images/close.svg\'></a><div class="content"><img src="<?php echo get_option('openpay_poci');?>" alt="Openpay"></div></div></div>');

                <?php } else { ?>

                    document.querySelector('body').insertAdjacentHTML('beforeend', '<div id="popup1" style="display: none;" class="overlay popupimage"><div class="popup"><a class="close closeopenpay"><img src=\'<?php echo plugin_dir_url(__FILE__);?>images/close.svg\'></a><div class="content"> <div class="openpaypopupcenter"><div class="openpaypopup-wrap"><div class="openpaypopup-head-block"><img src=\'<?php echo plugin_dir_url(__FILE__);?>images/openpay-logo.svg\' alt="Openpay" class="op_logopopup" title="Openpay"><h1>Buy now,<br> pay smarter.</h1><h5>Available on orders from &#163;<?php echo number_format(determine_plugin_data('minimum_checkout')); ?> to &#163;<?php echo number_format(determine_plugin_data('maximum_checkout')); ?></h5></div><div class="three-circle-blockpopup"><ul><li><img src=\'<?php echo plugin_dir_url(__FILE__);?>images/basket.svg\'><p>Shop & checkout</p></li><li><img src=\'<?php echo plugin_dir_url(__FILE__);?>images/payment.svg\'><p>Select Openpay as your payment method</p> </li><li><img src=\'<?php echo plugin_dir_url(__FILE__);?>images/calendar.svg\'><p>Register & design  your plan</p></li></ul></div><div class="address-areapopup"><h3>If you are 18 years or older and permanent resident of United Kingdom, all you’ll need is:</h3><ul><li>A debit or credit card</li><li>An email address</li><li>A mobile number</li><li>Today&#39;s payment</li></ul></div></div></div> </div></div></div>');

               <?php  } ?>





  

    

}



setTimeout(function() {

    openpaywidgetpopup()

}, 500);



</script>



<?php



    }



}



add_action('wp_ajax_get_price_product', 'get_price_product');



add_action('wp_ajax_nopriv_get_price_product', 'get_price_product');



function get_price_product() {



    $variationid = $_POST['variationid'];



    $product_id = $_POST['product_id'];



    $min_check_val = $_POST['min_check_val'];



    $max_check_val = $_POST['max_check_val'];



    global $product;



    $product = wc_get_product($variationid);



   



    $pay_of_month = get_option('openpay_pocm');



    $fractioanl_month = get_option('openpay_pocfm');



    $drop_month_pay = explode(',', $pay_of_month);



    $child_prices = array();



    $tax_display_mode = get_option('woocommerce_tax_display_shop');



    if ($product->is_type('variable')) {



        foreach ($product->get_children() as $child_id) {



            $child = wc_get_product($child_id);



            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);



        }



    } elseif ($product->is_type('grouped')) {



        foreach ($product->get_children() as $child_id) {



            $child = wc_get_product($child_id);



            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);



        }



    }



    if (!empty($child_prices)) {



        $variationprice = min($child_prices);



    } else {



        $variationprice = $product->get_price();



    }



    //echo $variationprice.'myprice';





            $fraction_fm = $fractioanl_month + 1;



        $today_var = $variationprice / $fraction_fm;



    $remaining_var = $variationprice - $today_var;



    $treshold_msg = get_option('threshold_msg');



    $html = '';



    if (get_option('openpay_pocs') == 'yes') {





       $oplogo = '<img src='. plugin_dir_url(__FILE__) . 'images/openpay-logo.svg' .' alt="Openpay" class="oplogo">';



        $fm_condition = (empty(get_option('openpay_pocfm')));



        $tagline = $fm_condition ? get_option('brand_msg') : 'Or ' . $fraction_fm . ' payments of ' . wc_price($today_var) . ' with ';



        if ($min_check_val > $variationprice || $max_check_val < $variationprice) {



$html.= "<p>". $oplogo ."<span class='info-ttl'> ". htmlentities($treshold_msg, ENT_COMPAT, 'utf-8')." </span><a class='info-icn learnmorepopup' onclick=myPopupimage() id='fracpopup' href='javascript:void(0)'>" .' '. get_option('openpay_poclmt') . "</a></p>";



         } else if (get_option('brand_msg') == 'yes') {   



         $html.= "<p>". $oplogo ." <span class='info-ttl'>". htmlentities($treshold_msg, ENT_COMPAT, 'utf-8') ." </span><a class='info-icn learnmorepopup' onclick=myPopupimage() id='fracpopup' href='javascript:void(0)'>" .' '. get_option('openpay_poclmt') . "</a></p>";   



        } else {



         



                $html.= "<span class='info-ttl'> " . $tagline . " " . $oplogo . "";



                $html.= "<a class='info-icn learnmorepopup' onclick=myPopupimage() id='fracpopup' href='javascript:void(0)'>";

                $html.= "" . get_option('openpay_poclmt') . "</a></span>";







               



     $html.= '</div>';



          



        }



    }

 

    $p_id = $_POST['product_id'];



    //$arr = array('a' => $p_id, 'b' => utf8_encode($html));



    $arr = array('html' => utf8_encode($html));



    wp_send_json($arr);



    die();



}