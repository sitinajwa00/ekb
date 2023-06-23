<?php 

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'about_us.inc.php';

if (isset($_POST['submit_desc'])) {
    $who_are_we = $_POST['who_are_we'];
    $our_product = $_POST['what_we_sell'];

    $about_us = new AboutUsController();
    $about_us->updateAboutUsDetails($who_are_we, $our_product);

    echo '<script>
        alert("Succesfully Updated!");
        window.location.href = "'.APP_URL.'?module=about_us";
    </script>';

} else if (isset($_POST['submit_contact'])) {
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $about_us = new AboutUsController();
    $about_us->updateOurContactDetails($contact, $email, $location);

    echo '<script>
        alert("Succesfully Updated!");
        window.location.href = "'.APP_URL.'?module=about_us";
    </script>';
} else if (isset($_POST['submit_image'])) {
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $tempName = $_FILES['image']['tmp_name'];

    $old_image = (($_POST['old_image']) != '' ? $_POST['old_image'] : '');

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
        echo '<script>
            alert("Unable to upload image!");
            window.location.href = "'.APP_URL.'?module=about_us";
        </script>';
    } else {
        $newImageName = 'ekbimage_'.uniqid();
        $newImageName .= '.' . $imageExtension;

        move_uploaded_file($tempName, IMG_PATH . $newImageName);
        
        $store_image = new AboutUsController();
        $store_image->updateStoreImage($newImageName);

        if($old_image != '') {
            $imagePath = IMG_PATH . $old_image;
            unlink($imagePath);
        }

        echo '<script>
            alert("Successfully Updated!");
            window.location.href = "'.APP_URL.'?module=about_us";
        </script>';
    }
}

?>