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

    public function displayTodayIncome() {
        $results = $this->getTodayIncome();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response[0]['total_income'];
    }

    public function displayTotalProductToday() {
        $results = $this->getTotalProductToday();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        if (count($response) > 0) {
            // return 'true';
            $count = 0;
            foreach ($response as $resp) {
                $count += (int)$resp['qty'];
            }
            return $count;
        } else {
            return '0';
        }

        // return $response;
    }
}

?>