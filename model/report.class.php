<?php 

class Report extends Db {
    protected function getTotalSalesByMonth($type) {
        $sql = "SELECT YEAR(date) AS Year, MONTHNAME(date) AS Month, SUM(totalPrice) AS Total_Sales, deliveryType AS Delivery_Type FROM orders WHERE deliveryType=? GROUP BY YEAR(date), MONTH(date)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$type]);

        $results = $stmt->fetchAll();
        return $results; 
    }

    protected function getTotalSalesDaily($type) {
        $sql = "SELECT Date(date) AS Date, SUM(totalPrice) AS Total_Sales, deliveryType AS Delivery_Type FROM orders WHERE deliveryType=? GROUP BY Date(date)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$type]);

        $results = $stmt->fetchAll();
        return $results; 
    }

    protected function getTotalSalesDailyByMonth($type, $month, $year) {
        $sql = "SELECT Date(date) AS Date, SUM(totalPrice) AS Total_Sales, deliveryType AS Delivery_Type FROM orders WHERE month(date)=? AND year(date)=? AND deliveryType=? GROUP BY Date(date)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$month, $year, $type]);

        $results = $stmt->fetchAll();
        return $results; 
    }
}

?>