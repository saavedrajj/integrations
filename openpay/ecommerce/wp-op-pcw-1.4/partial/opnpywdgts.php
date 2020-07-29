<?php

if(isset($_POST['openpay_poc'])){



if(isset($_FILES['openpay_poci'])){

        if ( ! function_exists( 'wp_handle_upload' ) ) {

            require_once( ABSPATH . 'wp-admin/includes/file.php' );

        }

        $uploadedfile = $_FILES['openpay_poci'];

        $upload_overrides = array( 'test_form' => false );

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

        if(!empty($movefile['url'])) update_option('openpay_poci', $movefile['url']);

    }

 if(isset($_POST['openpay_pocipop'])) {

        update_option('openpay_pocipop', $_POST['openpay_pocipop']);

    }else{

        update_option('openpay_pocipop', '');

    }


   

    if(isset($_POST['openpay_pocs'])) {

        update_option('openpay_pocs', $_POST['openpay_pocs']);

    }else{

        update_option('openpay_pocs', '');

    }

    

    


    if(isset($_POST['openpay_pocf'])) {

        update_option('openpay_pocf', $_POST['openpay_pocf']);

    }else{

        update_option('openpay_pocf', '');

    }



    if(isset($_POST['openpay_pocpw'])) {

        update_option('openpay_pocpw', $_POST['openpay_pocpw']);

    }else{

        update_option('openpay_pocpw', '');

    }



    if(isset($_POST['openpay_pocpf'])) {

        update_option('openpay_pocpf', $_POST['openpay_pocpf']);

    }else{

        update_option('openpay_pocpf', '');

    }





    if(isset($_POST['openpay_pocfm'])) {

        update_option('openpay_pocfm', $_POST['openpay_pocfm']);

    }else{

        update_option('openpay_pocfm', '');

    }



    

    if(isset($_POST['openpay_pocm'])) {

        $openpay_pocm = implode(', ', $_POST['openpay_pocm']);

        update_option('openpay_pocm', $openpay_pocm);

    }else{

        update_option('openpay_pocm', '');

    }



    if(isset($_POST['threshold_msg'])) {

         update_option('threshold_msg', $_POST['threshold_msg']);

    }else{

        update_option('threshold_msg', '');

    }



    if(isset($_POST['brand_msg'])) {

         update_option('brand_msg', $_POST['brand_msg']);

    }else{

        update_option('brand_msg', '');

    }



    



     if(isset($_POST['openpay_poclmt'])) {

        update_option('openpay_poclmt', $_POST['openpay_poclmt']);

    }else{

        update_option('openpay_poclmt', '');

    }


	

}

?>

 <?php $selectedvaldrp = get_option( 'openpay_pocm'); ?>

<form method="post" enctype="multipart/form-data">



<table class="widefat fixed" cellspacing="0">

    <tbody>

  <tr>

            <td width="20%"><b><h2>Product Calculator Widget</h2></b></td>

        </tr>

        <tr>

            <td><b>Product Calculator Status</b></td>

            <td><label for=""><input type="checkbox" <?php if(get_option('openpay_pocs')=='yes') echo 'checked="checked"' ?> name="openpay_pocs" id="openpay_pocs" class="" value="yes">Active</label></td>

        </tr>

      
         <tr>

            <td><b>Openpay Brand Message</b></td>

            <td><textarea name="threshold_msg" id="threshold_msg" style="height: 40px; width:400px;"><?php echo get_option('threshold_msg'); ?></textarea></td>

        </tr>

       



         
         

        <tr>

            <td><b>Show Brand Message Only</b></td>

             <td><label for=""><input type="checkbox" <?php if(get_option('brand_msg')=='yes') echo 'checked="checked"' ?> name="brand_msg" id="brand_msg" class="" value="yes"></label></td>

        </tr>

           <tr>

            <td><b>Pay of Month</b></td>

             <td><input type="number" name="openpay_pocfm" id="openpay_pocfm" value="<?php echo get_option('openpay_pocfm'); ?>" class=""></td>

        </tr>



          <tr>

            <td><b>Enable Learn More</b></td>

            <td><textarea name="openpay_poclmt" id="openpay_poclmt" style="height: 40px; width:200px;"><?php echo get_option('openpay_poclmt'); ?></textarea></td>

        </tr>

           

        <tr>

            <td><b>Popup Image</b></td>

            <?php $openpay_poci = get_option('openpay_poci') ?>

            <td><label for=""><input type="checkbox" <?php if(get_option('openpay_pocipop')=='yes') echo 'checked="checked"' ?> name="openpay_pocipop" id="openpay_pocipop" class="" value="yes"></label>
                <?php if(null !== get_option('openpay_poci') && !empty(get_option('openpay_poci'))){ ?><img src="<?php echo $openpay_poci ?>" style="margin-top: 5px; max-width: 50px;vertical-align: middle;"><?php } ?>

            <input type="file" name="openpay_poci" id="openpay_poci" value="<?php echo get_option('openpay_poci') ?>" class="" accept="image/*"></td>



        </tr>


            <td><b>Save</b></td>

             <td><input type="submit" value="Save" class="button button-primary" id="openpay_poc" name="openpay_poc">

             </td>

    </tr>


   

    </tbody>



</table>



</form>

