<?php

class ReportController extends Report {
    public function displayTotalSalesByMonth($type) {
        $results = $this->getTotalSalesByMonth($type);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function displayTotalSalesDaily($type) {
        $results = $this->getTotalSalesDaily($type);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function displayTotalSalesDailyByMonth($type, $month, $year) {
        $results = $this->getTotalSalesDailyByMonth($type, $month, $year);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }
}

?>