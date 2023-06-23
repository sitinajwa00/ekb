<?php

class AboutUsController extends AboutUs {
    // About Us Database
    public function updateAboutUsDetails($who_are_we, $prod_desc) {
        $this->editAboutUsDetails($who_are_we, $prod_desc);
    }

    public function displayAboutUs() {
        $results = $this->getAboutUs();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    // Contact Us Database
    public function updateOurContactDetails($contact, $email, $location) {
        $this->editOurContactDetails($contact, $email, $location);
    }

    // Store Image Database
    public function updateStoreImage($image) {
        $this->editStoreImage($image);
    }
}