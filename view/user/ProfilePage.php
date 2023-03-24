<?php 

class ProfilePage extends UserController {
    public function displayProfilePage($userID) {
        $req = $this->getUserDetails($userID);
        $detail = $req[0];

        $state = array(
            'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
            'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
        );
        
        foreach ($state as $i=>$val) {
            $userState = NULL;
            if ($i == $detail['userState']) {
                $userState = $val;
                break;
            }
        }
        
        $userAddress = $detail['userAddress'] . ', ' . $detail['userPoscode'] . ' ' . $detail['userCity'] . ', ' . $userState;

        ?>
        <div class="mt-4">
            <div class="card">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card-body text-center border-end">
                                <!-- Profile picture image-->
                                <img class="img-account-profile rounded mb-2" src="<?php echo ASSET_URL ?>images/default_image.jpg" alt="" style="width:200px;object-fit:cover">
                            </div>
                        </div>
                        <div class="col-8">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold col-3">Name</td>
                                    <td><?php echo $detail['userName'] ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email</td>
                                    <td><?php echo $detail['userEmail'] ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Phone Number</td>
                                    <td><?php echo $detail['userPhonenum'] ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Address</td>
                                    <td><?php echo $userAddress ?></td>
                                </tr>
                            </table>
                            <button class="btn btn-primary" onclick="window.location.href='<?php echo APP_URL ?>?module=profile&action=update'" name="edit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
    }
}

?>