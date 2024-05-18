<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill Print</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- font : Raleway  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Bootsrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body{
            margin:25px;
        }
        .clearfix {
            zoom: 1;
        }
        .clearfix:before,
        .clearfix:after {
            content: "";
            display: table;
        }
        .clearfix:after {
            clear: both;
        }
        </style>
        <style type='text/css' media="print">
        
        @page{
            size:auto;
            margin: 0mm;
        }
        html{
            background-color: #FFFFFF;
            margin: 0px;
            font-size:10px;
        }
        body{
            border: solid 1px #FFFFFF;
            margin: 5px 12px 0px 0px;
            font-size:12px;
            font-family: 'Arial';
        }
        </style>

    <script type='text/javascript'>
        window.print();
    </script>
</head>
<body>
    <div style='text-align:center'>
        <b>Kasir Simpel</b>
        <br>
        Telp. : 123-899-98
        <br>
        Nota Pembelian
        <br>
        Dine In
        <br>
    </div>
    <hr>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class='text-center'>No</th>
                <th class='text-center'>Nama Menu</th>
                <th class='text-center'>Harga</th>
                <th class='text-center'></th>
                <th class='text-center'>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $allTotal = 0; ?>
            <?php $no = 0; ?>
            @if($rows)
            @foreach($rows as $row)
                <?php $no++; ?>
                <?php
                $thisTotal = $row['quantity'] * $row['price'];
                ?>
                <tr>
                    <td class='text-center'>{{ $no }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td class='text-end'>Rp. {{ number_format($row['price'],0,",",".") }}</td>
                    <td class='text-end'>{{ 'x ' . $row['quantity'] }}</td>
                    <td class='text-end'>Rp. {{ number_format($thisTotal,0,",",".") }}</td>
                </tr>
                <?php $allTotal += $thisTotal; ?>
            @endforeach
            @endif
            <tr>
                <th class='text-end' colspan='4'>TOTAL</th>
                <th class='text-end'>Rp. {{ number_format($allTotal,0,",",".") }}</th>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table width="100%">
        <tr>
            <td width="70%"></td>
            <td width="30%">
                Dibuat Pada Tanggal : <?= date("d-m-Y") ?>
                <br>
                Pembuat Nota
                <br><br><br><br>
                <u><b>Kasir 001</b></u>
            </td>
        </tr>
    </table>
</body>
</html>