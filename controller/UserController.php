<?php

class UserController extends User {

    public function getUserDetails($userID) {
        $results = $this->getUser($userID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    // For JSON data
    public function displayAllUsers() {
        $results = $this->getAllUsers();
        
        // Encode then decode
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
            $data['result'] = '';
            return $data;
        }
    }

    public function displayAllCustomers() {
        $results = $this->getAllCustomers('2');

        $encode = json_encode($results);
        $response = json_decode($encode, true);
        return $response;
    }

    public function sendUserDetails($userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType) {
        $check_email = $this->checkEmail($userEmail);
    
        $encode = json_encode($check_email);
        $response = json_decode($encode, true);
        if (count($response) == 0) {
            $getAuth = $this->setUserDetails($userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType);
            $encode = json_encode($getAuth);
            $response = json_decode($encode, true);
            $data['message'] = 'register success';
            $data['result'] = $response;
            return $data;
        } else {
            $data['message'] = 'account exist';
            $data['result'] = $response;
            return $data;
        }
        // $this->setUserDetails($userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType);
    }

    public function editUser($userID, $userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType) {
        $this->updateUser($userID, $userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType);
    }

    public function removeUser($userID) {
        $this->deleteUser($userID);
    }
}

?>