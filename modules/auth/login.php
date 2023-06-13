<?php

require ASSET_PATH . 'header.php';

?>
<!-- Login Form -->
<section id="login">
    <div class=" container bg-container">
        <div class="bg-login-container shadow p-3 bg-white rounded">
            <h3 class="pt-3">Sign In</h3>
            <img class="img-logo" src="<?php echo ASSET_URL ?>/images/ekb_logo.png" alt="">
            <hr class="mb-4">
            <form class="px-2 login-form" action="<?php echo APP_URL ?>?module=auth&action=submit" method="post" onsubmit="return validate()">
                <div class="form-group">
                    <label for="email-input">Email:</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" id="email-input">
                </div>
                <div class="form-group">
                    <label for="pass-input">Password:</label>
                    <input type="password" class="form-control" name="pwd" placeholder="Password" id="pass-input">  
                </div>
                <div>
                    <button type="submit" name="login" class="my-4 text-uppercase login-btn w-100">login</button>
                </div>
            </form>
        </div>
        <h6 class="py-3 text-center no-account" >Don't have an account? <span><a href="<?php echo APP_URL ?>?module=auth&action=register"> Register</a></span> here</h6>
    </div>
</section>
<!-- /Login Form -->

<script>
    function validate() {
        if ($('#email-input').val() == '') {
            alert('Please fill in the email address!');
            $('#email-input').focus();
            return false;
        }

        if ($('#pass-input').val() == '') {
            alert('Please fill in the password!');
            $('#email-input').focus();
            return false;
        }

        var email = $('#email-input').val();
        var a = email.indexOf("@");
        var b = email.lastIndexOf(".");
        if(  a < 1 || b < a+2) {
            alert( "Invalid email address!");
            $('#email-input').focus();
            return false;
        }
        
        return (true);
    }
</script>