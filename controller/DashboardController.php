<?php

class DashboardController extends Dashboard {
    public function displayTotalSales() {
        $results = $this->getTotalSales();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response[0]['sales'];
    }

    public function displayTotalProductSold() {
        $results = $this->getTotalProductSold();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response[0]['total_product_sold'];
    }

    public function displayTotalCustomer() {
        $results = $this->getTotalCustomer();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response[0]['total_customer'];
    }

    public function displayTotalPendingOrder() {
        $results = $this->getTotalPendingOrder();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response[0]['total_pending'];
    }
}

?>