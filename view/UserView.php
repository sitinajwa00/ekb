<?php 

class UserView extends UserController {

    public function viewAllUsers() {
        $results = $this->displayAllUsers();
        return $results;
    }

    public function sendErrorMessage() {
        $message = 'Unable to proceed the process';
        return $message;
    }
}

?>