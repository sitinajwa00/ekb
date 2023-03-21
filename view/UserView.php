<?php 

class UserView extends UserController {

    public function viewAllUsers() {
        $results = $this->displayAllUsers();

        $data['message'] = 'Successful';
        $data['status'] = true;
        $data['result'] = $results;

        return $data;
    }

    public function sendErrorMessage() {
        $message = 'Unable to proceed the process';
        return $message;
    }
}

?>