<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Invoice</title>
    <style>
        body {
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            background-color: #6a6fab;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: right;
            text-align: right;
        }

        .body-section {
            padding: 16px;
            border: 1px solid gray;
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px solid #111;
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }
    </style>
</head>

<body>
    <?php

use App\Models\Order;

    $order = Order::find($order_id);
   
    // dd($order);
    // dd($order->meals);
    ?>
    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white"> Reservation Invoice </h1>
                </div>

            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No:#<?php echo random_int(100000, 999999); ?></h2>
                    <p class="sub-heading"> Date:{{$order->date}} </p>
                    <p class="sub-heading">Invoice total :{{$order->total}} </p>
                    <p class="sub-heading"> Paid:{{$order->paid}} </p>
                </div>
                <div class="col-6">
                    <p class="sub-heading">Full Customer name: {{$order->customer->name}} </p>
                    <p class="sub-heading">Phone Number:{{$order->customer->phone}} </p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-20">Meal</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Discount Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $meals_original_price = [];
                    $total_discount = [];
                    // dd($order->meals);
                    ?>
                    @foreach($order->meals as $meal)
                    <tr>
                        <td><?= ++$i  ?></td>
                        <td><?= $meal->description ?></td>
                        <td><?= $meal->price ?></td>
                        <td><?= ($meal->price) * ($meal->discount_percentage / 100) ?></td>
                    </tr>
                    <?php
                    
                    $meals_original_price[] = $meal->price;
                    $total_discount[] = ($meal->price) * ($meal->discount_percentage / 100) ;

                    ?>
                    @endforeach
          
                    <tr >
                        <td colspan="3" class="text-right">Sub Total</td>
                        <td> <?=  array_sum($meals_original_price); ?> LE</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Total Discount</td>
                        <td> <?=  array_sum($total_discount); ?> LE</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Grand Total</td>
                        <td> <?=  array_sum($meals_original_price) - array_sum($total_discount); ?> LE</td>
                    </tr>
            <br>
                </tbody>
            </table>
        </div>


    </div>

</body>

</html>
<script>
    window.print();
</script>