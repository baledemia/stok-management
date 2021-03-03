<?php date_default_timezone_set('Asia/Jakarta');
$this->load->helper('basic') ?>

<head>
    <title>Delivery Order</title>
    <style>
        * {padding: 0;margin: 0;}
       @font-face {
          font-family: Poppins;
          src: url(<?=base_url() ?>assets/backend/font/Poppins-Regular.ttf);
        }
        .wrap {width: 1000px;margin: 35px auto;}
        body{font-family: 'Poppins', sans-serif;}
        .row {position: relative;}
        .title {border: 1px solid #000000; padding: 10px; border-radius: 15px; font-size: 14px}
        .title p, .title h3 {margin-bottom: 0}
        .title h3{border-bottom: 2px dashed #000000; padding-bottom: 5px; margin-bottom: 5px}
        .title1 {text-align: center}
        td, th {padding: 5px}
        th{border: 1px solid #000}
        .datas td {font-size: 12px; text-align: center}
        .data td:first-child{border-left: 1px solid #000000;}
        .data td:last-child{border-right: 1px solid #000000;}
        .foot td{border: 1px solid #000000;}
        .noted {width: 50%; padding: 10px; margin-top: 10px; border: 1px solid #000000;float: right; height: auto}
        .ttd {width: 60%; float: left; height: auto}
        .old-price {width: 40%; float: right; height: auto; margin-left: 15px}
        .box {border: 1px solid #000000; padding: 10px}
        .clear {clear: both}
        .old-price {padding: 10px}
        .contentttd {width: 25%; }
        .contentttd p { font-size: 12px }
        .contentttd p:first-child {margin-bottom: 80px}
        .contentttd p:last-child {border-top: 1px solid #000000}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="row">
            <table width="100%">
                <tr>
                    <td width="60%">
                        <div class="title">
                            <h3>PT. SUKSES SETIA</h3>
                            <p>Jl. Kasir II No.12, Pasir Jaya <br> Pasar Kemis - Tangerang</p>
                        </div>
                    </td>
                    <td>
                        <h1 class="title1">Delivery Order</h1>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row" style="height: 190px; margin-top: 10px">
            <div style="width: 60%; float: left">
                <div style="overflow: hidden; height: 90px">
                    
                    <div style="width: 15%; float: left; font-size: 12px">
                        Bill To :
                    </div>
                    <div style="width: 85%; float: right">
                         <div class="title" style="padding: 5px; font-size: 12px; height: 75px">
                            <h4><?=$do->nama_perusahaan ?></h4>
                            <p><?=$do->alamat ?></p>
                        </div>
                    </div>
                </div>

                <div style="overflow: hidden; height: 90px">

                    <div style="width: 15%; float: left; font-size: 12px">
                        Ship To :
                    </div>
                    <div style="width: 85%; float: right">
                         <div class="title" style="padding: 5px; font-size: 12px; height: 75px">
                            <p><?=$do->ship_to ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 35%; float: left; border:1px solid #000000; padding: 10px; border-radius: 15px; margin-left: 15px">
                <div style="overflow: hidden; height: 50px">
                    <div style="width: 50%; float: left; border-bottom:1px dashed #000000; padding-bottom: 10px; border-right:1px dashed #000000">
                        <h5>Delivery Date</h5>
                        <p style="text-align: right; margin-right: 10px; font-size: 12px"><?=tgl_indo($do->delivery_date) ?></p>
                    </div>
                    <div style="width: 50%; float: right; border-bottom:1px dashed #000000; padding-bottom: 10px;">
                        <h5 style="margin-left: 10px">Delivery No.</h5>
                        <p style="margin-left: 10px; text-align: right; ; font-size: 12px"><?=$do->id_delivery_order ?></p>
                    </div>
                </div>
                <div style="overflow: hidden;; height: 47px">
                    <div style="width: 50%; float: left; border-right:1px dashed #000000; padding-top: 10px">
                        <h5>Ship Via</h5>
                        <p style="font-size: 12px; text-align: right;margin-right: 10px">-</p>
                    </div>
                    <div style="width: 50%; float: right; padding-top: 10px">
                        <h5 style="margin-left: 10px">PO No.</h5>
                        <p style="margin-left: 10px; text-align: right; font-size: 12px"><?=$do->po_number ?></p>
                    </div>
                </div>
            </div>
        </div>

        <table border="0" width="100%" cellspacing="0" class="datas">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Item Description</th>
                    <th>Qty</th>
                    <th>Per Roll / Mtr</th>
                </tr>
            </thead>
            <tbody>
                <?php $totallength = 0 ;
                foreach($dodetail as $result) { ?>
                <tr class="data">
                    <td><?=$result->item ?></td>
                    <td><?=$result->cable_name ?></td>
                    <td><?=$result->qty ?></td>
                    <td><?=$result->length ?></td>
                </tr>
                <?php $totallength += $result->length; } ?>
                <tr class="foot">
                    <td colspan="2" align="center">Total Item : <?=$totalitem ?></td>
                    <td>Total Kuantitas : </td>
                    <td><?=$totallength ?></td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="noted">
                Catatan : <?=$do->notes ?>
            </div>
        </div>

        <div class="clear"></div>

        <div class="row">
            <div class="ttd">
                <table border="0" width="95%" style="margin-top: 20px">
                    <tr>
                        <td class="contentttd">
                            <p>Disiapkan</p>
                            <p>Date</p>
                        </td>
                        <td class="contentttd">
                            <p>Disetujui</p>
                            <p>Date</p>
                        </td>
                        <td class="contentttd">
                            <p>Pengirim</p>
                            <p>Date</p>
                        </td>
                        <td class="contentttd">
                            <p>Diterima</p>
                            <p>Date</p>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="old-price" style="margin-top: 10px">
                <div class="box" style="margin-left: 10px; height: 100px">
                    <p style="font-size: 12px">Harga Lama :</p>
                </div>
            </div>
        </div>
    </div>
</body>