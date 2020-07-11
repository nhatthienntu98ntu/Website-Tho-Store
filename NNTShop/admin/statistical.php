<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/product.php' ?>
<?php include_once '../helpers/fomat.php'; ?>

<?php
$product = new product();
$fm = new Format();
?>
<?php

$array_total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
$array_amount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

?>
<?php
    $getProduct = $product->statisticalRevenue();
    if ($getProduct) {
        $i = 0;
        while ($result = $getProduct->fetch_assoc()) {
            $i++;
            $result_date_compele = preg_split("/[-]+/", substr($result['date_order'], 0, 10));
            if ($result_date_compele[1] == "01") {
                $array_total[0] += $result['quantity'] * $result['price'];
                $array_amount[0] += $result['quantity'];
            } else if ($result_date_compele[1] == "02") {
                $array_total[1] += $result['quantity'] * $result['price'];
                $array_amount[1] += $result['quantity'];
            } else if ($result_date_compele[1] == "03") {
                $array_total[2] += $result['quantity'] * $result['price'];
                $array_amount[2] += $result['quantity'];
            } else if ($result_date_compele[1] == "04") {
                $array_total[3] += $result['quantity'] * $result['price'];
                $array_amount[3] += $result['quantity'];
            } else if ($result_date_compele[1] == "05") {
                $array_total[4] += $result['quantity'] * $result['price'];
                $array_amount[4] += $result['quantity'];
            } else if ($result_date_compele[1] == "06") {
                $array_total[5] += $result['quantity'] * $result['price'];
                $array_amount[5] += $result['quantity'];
            } else if ($result_date_compele[1] == "07") {
                $array_total[6] += $result['quantity'] * $result['price'];
                $array_amount[6] += $result['quantity'];
            } else if ($result_date_compele[1] == "08") {
                $array_total[7] += $result['quantity'] * $result['price'];
                $array_amount[7] += $result['quantity'];
            } else if ($result_date_compele[1] == "09") {
                $array_total[8] += $result['quantity'] * $result['price'];
                $array_amount[8] += $result['quantity'];
            } else if ($result_date_compele[1] == "10") {
                $array_total[9] += $result['quantity'] * $result['price'];
                $array_amount[9] += $result['quantity'];
            } else if ($result_date_compele[1] == "11") {
                $array_total[10] += $result['quantity'] * $result['price'];
                $array_amount[10] += $result['quantity'];
            } else {
                $array_total[11] += $result['quantity'] * $result['price'];
                $array_amount[11] += $result['quantity'];
            }
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thống kê doanh thu</h2>
        <div id="chartContainer" style="height: 540px; width: 100%;"></div>
    </div>
</div>

<div class="grid_10">
    <div class="box round grid">
        <h2>Thống kê sản phẩm</h2>
        <div class="block">
            <?php
            // if (isset($delete_slider)) {
            //     echo $delete_slider;
            // }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="30%">Tên sản phẩm</th>
                        <th width="10%">Màu</th>
                        <th width="10%">Ảnh</th>
                        <th width="10%">Số lượng bán ra</th>
                        <th width="10%">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getProduct = $product->statisticalProduct();
                    if ($getProduct) {
                        $i = 0;
                        while ($result = $getProduct->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><?php echo $result['name'] ?></td>
                                <td><img src="uploads/<?php echo $result['image'] ?>" height="auto" width="60px" /></td>
                                <td><?php echo $result['totalProduct'] ?></td>
                                <td><?php echo $fm->format_price($result['price'] * $result['totalProduct']) . "đ"  ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thống kê khách hàng</h2>
        <div class="block">
            <?php
            if (isset($delete_slider)) {
                echo $delete_slider;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="20%">Tên khách hàng</th>
                        <th width="10%">Số điện thoại</th>
                        <th width="10%">Tổng hóa đơn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getCustomer = $product->statisticalCustomer();
                    if ($getCustomer) {
                        $i = 0;
                        while ($result = $getCustomer->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['name'] ?></td>
                                <td><?php echo $result['phone'] ?></td>
                                <td><?php echo $fm->format_price($result['totalProduct']) . "đ" ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    var array_total = <?php echo json_encode($array_total); ?>;
    var array_amount = <?php echo json_encode($array_amount); ?>;
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true, //false
            theme: "light2", // "light2", "dark1", "dark2"
            title: {
                text: "Thống kê doanh thu"
            },
            axisX: {
                valueFormatString: "MMM, YYY",
                crosshair: {
                    enabled: true,
                    snapToDataPoint: true
                }
            },
            axisY: {
                // title: "Số lượng",
                crosshair: {
                    enabled: true
                }
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "bottom",
                horizontalAlign: "left",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                    // Change type to "bar", "area", "spline", "pie",etc,column.
                    type: "column",
                    showInLegend: true,
                    name: "Tổng doanh thu",
                    xValueFormatString: "MMM, YYYY",
                    color: "#34a105",
                    dataPoints: [{
                            x: new Date(2020, 0),
                            y: array_total[0]
                        },
                        {
                            x: new Date(2020, 1),
                            y: array_total[1]
                        },
                        {
                            x: new Date(2020, 2),
                            y: array_total[2]
                        },
                        {
                            x: new Date(2020, 3),
                            y: array_total[3]
                        },
                        {
                            x: new Date(2020, 4),
                            y: array_total[4]
                        },
                        {
                            x: new Date(2020, 5),
                            y: array_total[5]
                        },
                        {
                            x: new Date(2020, 6),
                            y: array_total[6]
                        },
                        {
                            x: new Date(2020, 7),
                            y: array_total[7]
                        },
                        {
                            x: new Date(2020, 8),
                            y: array_total[8]
                        },
                        {
                            x: new Date(2020, 9),
                            y: array_total[9]
                        },
                        {
                            x: new Date(2020, 10),
                            y: array_total[10]
                        },
                        {
                            x: new Date(2020, 11),
                            y: array_total[11]
                        }
                    ]
                },
                {
                    type: "line",
                    showInLegend: true,
                    name: "Số sản phẩm bán ra",
                    lineDashType: "dash",
                    dataPoints: [{
                            x: new Date(2020, 0),
                            y: array_amount[0]
                        },
                        {
                            x: new Date(2020, 1),
                            y: array_amount[1]
                        },
                        {
                            x: new Date(2020, 2),
                            y: array_amount[2]
                        },
                        {
                            x: new Date(2020, 3),
                            y: array_amount[3]
                        },
                        {
                            x: new Date(2020, 4),
                            y: array_amount[4]
                        },
                        {
                            x: new Date(2020, 5),
                            y: array_amount[5]
                        },
                        {
                            x: new Date(2020, 6),
                            y: array_amount[6]
                        },
                        {
                            x: new Date(2020, 7),
                            y: array_amount[7]
                        },
                        {
                            x: new Date(2020, 8),
                            y: array_amount[8]
                        },
                        {
                            x: new Date(2020, 9),
                            y: array_amount[9]
                        },
                        {
                            x: new Date(2020, 10),
                            y: array_amount[10]
                        },
                        {
                            x: new Date(2020, 11),
                            y: array_amount[11]
                        }
                    ]
                }
            ]
        });
        chart.render();

        function toogleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php include 'inc/footer.php'; ?>