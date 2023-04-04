<?php

class Payment extends Db {
    protected function processPayment($custID, $chargeID, $amount, $status) {
        $sql = "INSERT INTO payments(custID, chargeID, paymentAmount, paymentStatus) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, $chargeID, $amount, $status]);

        $sql2 = "INSERT INTO orders(custID, chargeID, totalPrice, orderStatus) VALUES (?, ?, ?, ?)";
        $stmt2 = $this->connect()->prepare($sql2);
        $stmt2->execute([$custID, $chargeID, $amount, 'Pending']);
    }
}

?>