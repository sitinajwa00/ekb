<?php

class AboutUs extends Db {
    // About Us Database
    protected function editAboutUsDetails($who_are_we, $prod_desc) {
        $sql = "UPDATE about_us SET who_are_we=?, product_desc=? WHERE id=1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$who_are_we, $prod_desc]);
    }

    protected function getAboutUs() {
        $sql = "SELECT * FROM about_us WHERE id=1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    // Contact Us Database
    protected function editOurContactDetails($contact, $email, $location) {
        $sql = "UPDATE about_us SET contact=?, email=?, location=? WHERE id=1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$contact, $email, $location]);
    }

    protected function getOurContact() {
        $sql = "SELECT * FROM about_us WHERE id=1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    // Store Image Database
    protected function editStoreImage($image) {
        $sql = "UPDATE about_us SET image=? WHERE id=1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$image]);
    }
}