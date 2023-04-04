<?php

class PaymentController extends Payment {
    public function getPaymentDetails($custID, $chargeID, $amount, $status) {
        $this->processPayment($custID, $chargeID, $amount, $status);
    }
}

?>