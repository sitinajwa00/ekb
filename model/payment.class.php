<?php

class Payment extends Db {
    protected function processPayment($custID, $chargeID, $amount, $status) {
        $sql = "INSERT INTO payments(custID, chargeID, paymentAmount, paymentStatus) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, $chargeID, $amount, $status]);
    }
}

?>