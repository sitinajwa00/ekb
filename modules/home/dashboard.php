<?php

require ASSET_PATH . 'header.php';
if (isset($_SESSION['login']) && $_SESSION['user']['type'] == 0) {
    require ASSET_PATH . 'sidenav_owner.php';
} else if (isset($_SESSION['login']) && $_SESSION['user']['type'] == 1) {
    require ASSET_PATH . 'sidenav_admin.php';
} else if (!isset($_SESSION['login'])){
    require ASSET_PATH . 'sidenav.php';
}

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                </ol>
                </nav>
            </div>
        </nav>
        </div>
        <div class="row mb-4">
        <div class="col-3">
            <div class="card h-100">
            <div class="card-header bg-primary text-light">
                Overview
            </div>
            <div class="card-body">
                <table class="w-100">
                <tr>
                    <td><h3>14.5K</h3></td>
                    <td class="text-end text-secondary"><i class="fa-solid fa-dollar-sign fa-3x"></i></td>
                </tr>
                </table>
            </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card h-100">
            <div class="card-header bg-info text-light">
                Total Product Sold
            </div>
            <div class="card-body">
                <table class="w-100">
                <tr>
                    <td><h3>10.2K</h3></td>
                    <td class="text-end text-secondary"><i class="fa-solid fa-bag-shopping fa-3x"></i></td>
                </tr>
                </table>
            </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card h-100">
            <div class="card-header bg-success text-light">
                Total Customer
            </div>
            <div class="card-body">
                <table class="w-100">
                <tr>
                    <td><h3>1,502</h3></td>
                    <td class="text-end text-secondary"><i class="fa-solid fa-users fa-3x"></i></td>
                </tr>
                </table>
            </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card h-100">
            <div class="card-header bg-warning text-light">
                Pending Order
            </div>
            <div class="card-body">
                <table class="w-100">
                <tr>
                    <td><h3>5</h3></td>
                    <td class="text-end text-secondary"><i class="fa-solid fa-clock-rotate-left fa-3x"></i></td>
                </tr>
                </table>
            </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="mb-3">Product Sales</div>
                <div id="chart-product-sales"></div>
            </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card h-100">
            <div class="row">
                <div class="card-body col-8 border-end">
                <div>Total Sales</div>
                <div id="chart-total-sales"></div>
                </div>
                <div class="card-body col-4">
                <div>Today's Summary</div>
                <div class="mt-5">
                    <p class="text-center">Income:</p>
                    <h3 class="text-center">5.3K</h3>
                    <p class="text-center">Product Sold:</p>
                    <h3 class="text-center">1023</h3>
                </div>
                </div>
            </div>
                
            </div>
        </div>
        </div>
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>

<script>
    var product_sales = {
        series: [102, 55, 203],
        chart: {
        type: 'donut',
    },
    responsive: [{
        breakpoint: 480,
        options: {
        chart: {
            width: 200
        },
        legend: {
            position: 'bottom'
        }
        }
    }],
    labels: ['Original', 'Salted Egg', 'Belang']
    };

    var chart = new ApexCharts(document.querySelector("#chart-product-sales"), product_sales);
    chart.render();

    var total_sales = {
        series: [{
        name: 'Net Profit',
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
    }, {
        name: 'Revenue',
        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
    }, {
        name: 'Free Cash Flow',
        data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
    }],
        chart: {
        type: 'bar',
        height: 250
    },
    plotOptions: {
        bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    },
    yaxis: {
        title: {
        text: 'Monthly Sales'
        }
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
        formatter: function (val) {
            return "RM " + val
        }
        }
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart-total-sales"), total_sales);
    chart.render();

    $(document).on('click', '.demo', function(){
        swal.fire('OK', 'Click', 'success');
    });
</script>