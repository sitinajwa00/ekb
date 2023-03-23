<?php 

class RegistrationPage extends UserController {
    public function enterDetails($userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType) {
        $response = $this->sendUserDetails($userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType);
        
        echo '<button class="btn-back" onclick="history.back()" hidden>Go Back</button>';

        if ($response['message'] == 'register success') {
            echo '<script>
                alert("Successfully Register");
                window.location.href = "'.APP_URL.'?module=auth&action=login";
            </script>';
        } else {
            echo '<script>
                alert("Account with this email already existed!");
                $(".btn-back").click();
            </script>';
        }
    }
}

?>