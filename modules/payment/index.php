<?php 
require ASSET_PATH . 'header.php';
// exit(json_encode($_SESSION['payment']['cod']));
?>

<!--BEGIN: Content-->
<div class="container d-flex flex-row justify-content-center">
    <!-- <h2 class="my-4 text-center">Intro To React Course [$50]</h2> -->
    
    <div class="card mt-3 bg-light col-6">
        <div class="card-header text-center">
            <img class="w-25" src="<?php echo ASSET_URL ?>images/stripe-logo.png" alt="">
        </div>
        <div class="card-body p-5">
            <form action="<?php echo APP_URL ?>?module=payment&action=submit" method="post" id="payment-form">
                <div class="form-row">
                    <!-- <label for="card-element">
                        Credit or debit card
                    </label> -->
                    <input type="text" name="full_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Full Name">
                    <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address">
                    <input type="tel" name="phonenum" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Contact No">
                    <div class="mb-3">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">RM</div>
                            </div>
                            <input type="text" class="form-control" name="amount" id="inlineFormInputGroup" value="<?php echo $_SESSION['payment']['amount'] ?>" disabled>
                        </div>
                    </div>
                    <div id="card-element" class="form-control">
                        <!-- a Strip Element will be inserted here. -->
                    </div>

                    <!-- Used to dispaly form errors -->
                    <div id="card-errors" role="start"></div>
                </div>

                <button class="btn">Submit Payment</button>
                
            </form>
        </div>
            
    </div>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="<?php echo ASSET_URL ?>js/charge.js"></script>
<!--END: Content-->