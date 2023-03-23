<?php

class LoginPage extends UserController {
    public function enterEmailPass($email, $pass) {
        $response = $this->sendEmailPass($email, $pass);
        $result = $response['result'];

        echo '<button class="btn-back" onclick="history.back()" hidden>Go Back</button>';

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
                $_SESSION['user']['type'] = $result[0]['userType'];

                if ($_SESSION['user']['type'] == 0) {
                    echo '<script>
                        alert("Welcome, '.$_SESSION['user']['name'].'");
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