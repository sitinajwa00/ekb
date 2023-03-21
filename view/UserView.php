<?php 

class UserView extends UserController {

    public function viewAllUsers() {
        $results = $this->displayAllUsers();
        // return $results[0]['userName'];
        $i = 0;
        while($i<count($results)) {
            $response[$i]['userID'] = $results[$i]['userID'];
            $response[$i]['userName'] = $results[$i]['userName'];
            $response[$i]['userPassword'] = $results[$i]['userPassword'];
            $response[$i]['userEmail'] = $results[$i]['userEmail'];
            
            $i++;
        }

        $data['message'] = 'Successful';
        $data['status'] = true;
        $data['result'] = $response;

        $encode = json_encode($data);
        $json_response = json_decode($encode);

        return $json_response;
    }

    public function sendErrorMessage() {
        $message = 'Unable to proceed the process';
        return $message;
    }
}

?>