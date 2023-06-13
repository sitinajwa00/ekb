<?php 

class EditProfilePage extends UserController {
    public function displayEditPage($userID) {
        $req = $this->getUserDetails($userID);
        $detail = $req[0];

        $state = array(
            'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
            'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
        );

        ?>
        <div class="mt-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded mb-2" src="<?php echo ASSET_URL ?>images/default_image.jpg" alt="" style="width:200px;object-fit:cover">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form action="<?php echo APP_URL . '?module=' . $_GET['module'] . '&action=submit' ?>" method="post" onsubmit="return validate()">
                                <!-- Form (Name) -->
                                <div class="mb-3">
                                    <label for="" class="small mb-1">Name</label>
                                    <input type="text" class="form-control name" name="name" placeholder="Name" value="<?php echo $detail['userName'] ?>" required>
                                </div>

                                <!-- Form Row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (Email) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Email</label>
                                        <input type="text" class="form-control email" name="email" placeholder="Email" value="<?php echo $detail['userEmail'] ?>" required>  
                                    </div>
                                    
                                    <!-- Form Group (Phone) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Phone Number</label>
                                        <input type="text" class="form-control phonenum" name="phonenum" placeholder="Tel" value="<?php echo $detail['userPhonenum'] ?>" required>
                                    </div>
                                </div>

                                <!-- Form (Address) -->
                                <div class="mb-3">
                                    <label for="" class="small mb-1">Address</label>
                                    <input type="text" class="form-control address" name="address" placeholder="Address" value="<?php echo $detail['userAddress'] ?>" required>
                                </div>

                                <!-- Form row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (Poscode) -->
                                    <div class="col-md-4">
                                        <label for="" class="small mb-1">Poscode</label>
                                        <input type="number" class="form-control poscode" name="poscode" value="<?php echo $detail['userPoscode'] ?>">
                                    </div>

                                    <!-- Form Group (City) -->
                                    <div class="col-md-4">
                                        <label for="" class="small mb-1">City</label>
                                        <input type="text" class="form-control city" name="city" value="<?php echo $detail['userCity'] ?>">    
                                    </div>

                                    <!-- Form Group (State) -->
                                    <div class="col-md-4">
                                        <label for="" class="small mb-1">State</label>
                                        <select name="state" id="" class="form-select state">
                                            <?php foreach ($state as $i=>$val) {?>
                                            <option value="<?php echo $i ?>" <?php echo ($i==$detail['userState'] ? 'selected' : '') ?>><?php echo $val ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                </div>

                                <!-- Form Row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (Password) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Password</label>
                                        <input type="password" id="" class="form-control pwd" name="pwd" value="">
                                    </div>

                                    <!-- Form Group (Confirm Password) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Confirm Password</label>
                                        <input type="password" id="" class="form-control confirm_pwd" name="confirm_pwd" value="">
                                    </div>
                                </div>

                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit" name="submit">Update</button>
                                <span class="btn btn-danger" onclick="return cancel();">Cancel</span>
                            </form>
                            <script>
                                function cancel() {
                                    var text = 'Are you sure to exit this page?';
                                    if (confirm(text) == true) {
                                        window.location.href='<?php echo APP_URL ?>?module=profile';
                                    }
                                }

                                function validate() {
                                    var email = $('.email').val();
                                    var a = email.indexOf("@");
                                    var b = email.lastIndexOf(".");
                                    if(  email != '' && (a < 1 || b < a+2)) {
                                        alert( "Invalid email address!");
                                        $('#email-input').focus();
                                        return false;
                                    }

                                    if ($('.name').val() == '') {
                                        alert('Please fill in the name!');
                                        return false;
                                    }

                                    if ($('.phonenum').val() == '') {
                                        alert('Please fill in the phone number!');
                                        return false;
                                    }

                                    if ($('.address').val() == '') {
                                        alert('Please fill in the address!');
                                        return false;
                                    }

                                    if ($('.poscode').val() == '') {
                                        alert('Please fill in the poscode!');
                                        return false;
                                    }

                                    if ($('.city').val() == '') {
                                        alert('Please fill the city!');
                                        return false;
                                    }

                                    if ($('.state').val() == '') {
                                        alert('Please fill in the state!');
                                        return false;
                                    }

                                    if ($('.pwd').val()!='' && $('.confirm_pwd').val()=='') {
                                        alert('Please enter the confirm password!');
                                        $('.confirm_pwd').focus();
                                        return false;
                                    }

                                    if ($('.pwd').val()=='' && $('.confirm_pwd').val()!='') {
                                        alert('Please enter the password!');
                                        $('.pwd').focus();
                                        return false;
                                    }

                                    if ($('.pwd').val() != $('.confirm_pwd').val()) {
                                        alert('Password and confirm password does not match!');
                                        $('.confirm_pwd').focus();
                                        return false;
                                    }
                                    
                                    return (true);
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    }

    public function updateProfile($userID, $userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType) {
        $req = $this->editUser($userID, $userName, $userPassword, $userEmail, $userPhonenum, $userAddress, $userPoscode, $userCity, $userState, $userType);

        echo '<script>
            alert("Successfully Update Profile");
            window.location.href = "'.APP_URL.'?module=profile";
        </script>';
    }
}

?>