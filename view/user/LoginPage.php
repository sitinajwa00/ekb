<?php

class LoginPage extends UserController {
    public function enterEmailPass($email, $pass) {
        $response = $this->sendEmailPass($email, $pass);
        $result = $response['result'];
        // echo json_encode($response);
        // echo count($result);exit;

        echo '<button class="btn-back" onclick="history.back()" hidden>Go Back</button>';

        // Array for state
        $state_arr = array(
            'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
            'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
        );

        if ($response['message'] == 'valid email' && count($result) > 0) {
            foreach($state_arr as $i=>$val) {
                if ($result[0]['userState'] == $i) {
                    $state = $val;
                    break;
                }
            }

            $address = $result[0]['userAddress'] . ', ' . $result[0]['userPoscode'] . ', ' . $result[0]['userCity'] . ', ' . $state;
        }

        if ($response['message'] == 'invalid email') {
            echo '<script>
                alert("Email does not exist!");
                $(".btn-back").click();
            </script>';
        } else {
            if (count($result) != 0) {
                $_SESSION["login"] = "YES";
                $_SESSION['user']['id'] = $result[0]['userID'];
                $_SESSION['user']['name'] = $result[0]['userName'];
                $_SESSION['user']['pwd'] = $result[0]['userPassword'];
                $_SESSION['user']['email'] = $result[0]['userEmail'];
                $_SESSION['user']['phonenum'] = $result[0]['userPhonenum'];
                $_SESSION['user']['address'] = $address;
                $_SESSION['user']['state'] = $result[0]['userState'];
                $_SESSION['user']['type'] = $result[0]['userType'];

                if ($_SESSION['user']['type'] == 0) {
                    echo '<script>
                        alert("Welcome");
                        window.location.href = "'.APP_URL.'?module=home&action=dashboard";
                    </script>';
                } else if ($_SESSION['user']['type'] == 1) {
                    echo '<script>
                        alert("Welcome, Admin");
                        window.location.href = "'.APP_URL.'?module=home&action=dashboard";
                    </script>';
                } else if ($_SESSION['user']['type'] == 2) {
                    echo '<script>
                        alert("Welcome, '.$_SESSION['user']['name'].'");
                        window.location.href = "'.APP_URL.'?module=home&action=index";
                    </script>';
                }
            } else {
                echo '<script>
                    alert("Incorrect Password");
                    $(".btn-back").click();
                </script>';
            }
        }
    }
}

?>