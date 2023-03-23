<?php 

class User extends Db {
    protected function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getUser($id) {
        $sql = "SELECT * FROM users WHERE userID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function checkEmail($email) {
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getEmailPass($userEmail, $userPassword) {
        $sql = "SELECT * FROM users WHERE userEmail=:userEmail AND userPassword=:userPassword";
        $stmt = $this->connect()->prepare($sql);

        $stmt->bindParam(':userEmail', $userEmail);
        $stmt->bindParam(':userPassword', $userPassword);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getAllCustomers($userType) {
        $sql = "SELECT * FROM users WHERE userType = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userType]);

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function insertUser($name, $pwd, $email, $phonenum, $address, $poscode, $city, $state, $type) {
        $sql = "INSERT INTO users(userName, userPassword, userEmail, userPhonenum, userAddress, userPoscode, userCity, userState, userType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $pwd, $email, $phonenum, $address, $poscode, $city, $state, $type]);
    }

    protected function updateUser($id, $name, $pwd, $email, $phonenum, $address, $poscode, $city, $state, $type) {
        $sql = "UPDATE users SET 
            userName=:userName, 
            userPassword=:userPassword, 
            userEmail=:userEmail, 
            userPhonenum=:userPhonenum, 
            userAddress=:userAddress,
            userPoscode=:userPoscode,
            userCity=:userCity,
            userState=:userState, 
            userType=:userType WHERE 
            userID=:userID";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(':userID', $id);
        $stmt->bindParam(':userName', $name);
        $stmt->bindParam(':userPassword', $pwd);
        $stmt->bindParam(':userEmail', $email);
        $stmt->bindParam(':userPhonenum', $phonenum);
        $stmt->bindParam(':userAddress', $address);
        $stmt->bindParam(':userPoscode', $poscode);
        $stmt->bindParam(':userCity', $city);
        $stmt->bindParam(':userState', $state);
        $stmt->bindParam(':userType', $type);

        $stmt->execute();
    }

    protected function deleteUser($userID) {
        $sql = "DELETE from users WHERE userID='$userID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }
}

?>