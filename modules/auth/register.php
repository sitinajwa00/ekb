<?php 

require ASSET_PATH . 'header.php';

?>

<!-- Register Form -->
<section id="login">
    <div class=" container bg-container">
        <div class="bg-register-container shadow p-3 bg-white rounded">
            <h3 class="pt-3">Sign Up</h3>
            <hr class="mb-4">
            <form class="px-2 login-form" action="<?php echo APP_URL ?>?module=auth&action=submit" method="post" onsubmit="return validate()">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Email</label>
                        <input type="text" class="form-control email" name="email" placeholder="email@gmail.com" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="">Password</label>
                        <input type="password" class="form-control pwd" name="pwd" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Name</label>
                        <input type="text" class="form-control name" name="name" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone Number</label>
                        <input type="number" class="form-control phonenum" name="phonenum" placeholder="0123456789">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address-input">Address:</label>
                    <input type="text" class="form-control address" name="address" placeholder="Address" id="address-input">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Poscode</label>
                        <input type="number" class="form-control poscode" name="poscode" placeholder="12345">
                    </div>
                    <div class="col-md-4">
                        <label for="">City</label>
                        <input type="text" class="form-control city" name="city" placeholder="City">
                    </div>
                    <div class="col-md-4">
                        <label for="">State</label>
                        <select name="state" id="" class="form-select state">
                            <option value="">-- Choose --</option>
                            <option value="johor">Johor</option>
                            <option value="kedah">Kedah</option>
                            <option value="kelantan">Kelantan</option>
                            <option value="melaka">Melaka</option>
                            <option value="n9">Negeri Sembilan</option>
                            <option value="pahang">Pahang</option>
                            <option value="perak">Perak</option>
                            <option value="perlis">Perlis</option>
                            <option value="pp">Pulau Pinang</option>
                            <option value="sabah">Sabah</option>
                            <option value="sarawak">Sarawak</option>
                            <option value="selangor">Selangor</option>
                            <option value="terengganu">Terengganu</option>
                            <option value="kl">W.P. Kual Lumpur</option>
                            <option value="labuan">W.P. Labuan</option>
                            <option value="pj">W.P. Putrajaya</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" name="register" class="my-3 text-uppercase login-btn w-50">register</button>
                </div>
            </form>
        </div>
        <h6 class="py-3 text-center no-account" >Have already an account? <span><a href="<?php echo APP_URL ?>?module=auth&action=login"> Sign In</a></span> here</h6>
    </div>
</section>
<!-- /Register Form -->

<script>
    function validate() {
        var email = $('.email').val();
        var a = email.indexOf("@");
        var b = email.lastIndexOf(".");
        if(  email != '' && (a < 1 || b < a+2)) {
            alert( "Invalid email address!");
            $('#email-input').focus();
            return false;
        }

        if ($('.email').val() == '' || $('.pwd').val() == '' || $('.name').val() == '' || $('.phonenum').val() == '' || $('.address').val() == '' || $('.poscode').val() == '' || $('.city').val() == '' || $('.state').val() == '') {
            alert('Please complete the form!');
            return false;
        }
        
        return (true);
    }
</script>