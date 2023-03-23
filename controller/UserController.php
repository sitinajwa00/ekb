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

    public function sendEmailPass($userEmail, $userPassword) {
        $check_email = $this->checkEmail($userEmail);
    
        $encode = json_encode($check_email);
        $response = json_decode($encode, true);
        if (count($response) != 0) {
            $getAuth = $this->getEmailPass($userEmail, $userPassword);
            $encode = json_encode($getAuth);
            $response = json_decode($encode, true);
            $data['message'] = 'valid email';
            $data['result'] = $response;
            return $data;
        } else {
            $data['message'] = 'invalid email';
            return $data;
        }


        // $results = $this->getEmailPass($userEmail, $userPassword);

        // $encode = json_encode($results);
        // $response = json_decode($encode, true);
        // return $response;
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