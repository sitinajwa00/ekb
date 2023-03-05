<?php

class UserController extends User {

    public function displayUser($userID) {
        $results = $this->getUser($userID);
        // echo "Count: " . count($results) .  "Full name: " . $results[0]['demo_user_fname'] . ' ' . $results[0]['demo_user_lname'];
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    // For JSON data
    public function displayAllUsers() {
        $results = $this->getAllUsers();
        
        // Encode dulu baru decode
        $encode = json_encode($results);
        $response = json_decode($encode, true);
        return $response;
    }

    public function userAuth($userEmail, $userPassword) {
        $results = $this->getAuthentication($userEmail, $userPassword);

        $encode = json_encode($results);
        $response = json_decode($encode, true);
        return $response;
    }

    public function displayAllCustomers() {
        $results = $this->getAllCustomers('2');

        $encode = json_encode($results);
        $response = json_decode($encode, true);
        return $response;
    }

    public function createUser($userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType) {
        $this->insertUser($userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType);
    }

    public function editUser($userID, $userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType) {
        $this->updateUser($userID, $userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType);
    }

    public function removeUser($userID) {
        $this->deleteUser($userID);
    }
}

?>