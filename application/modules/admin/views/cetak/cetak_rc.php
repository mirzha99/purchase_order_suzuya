<!DOCTYPE html>
<html>
  <head>
    <title>Cetak <?=$receiving_suplier->no_po;?></title>
    <link rel="shortcut icon" type="image/png" href="<?=base_url();?>assets/imgs/favicon.png" />
    <style>
      body {
        font-family: Arial, sans-serif;
      }
      .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width:40%;
    }
      .container {
        max-width: 1500px;
        margin: 0 auto;
      }

      h1 {
        text-align: center;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th,
      td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }

      th {
        background-color: #f2f2f2;
      }
      ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
      }

      li {
        margin-bottom: 10px;
      }

      label {
        font-weight: bold;
      }
      .label {
        float: left;
        width: 150px;
      }
      .value {
        float: left;
        width: 250px;
      }
      .total {
        font-weight: bold;
        text-align: right;
      }
      #printButton {
        background-color: #4c95af;
        color: white;
        padding: 10px 20px;
        margin-top: 3px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      /* disble border color */
      #table_hide {
        border-collapse: collapse;
        background-color: transparent;
      }

      #table_hide th,
      #table_hide td {
        border: none;
        padding: 8px;
        text-align: left;
        background-color: transparent;
      }
      /* Media query untuk mencetak */
      @media print {
        #printButton {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
    <img src="http://localhost/project/assets/imgs/logo.png" class="center" alt="">
      <h1>RECEIVING ORDER</h1>
      <h4 style="text-align:center;">H838+RXP, Kp. Baru, Kec. Baiturrahman, Kota Banda Aceh, Aceh</h4>
    <hr>
    <table id="table_hide">
        <tr>
            <th>No Receiving</th>
            <td>: <?=$receiving_suplier->no_receiving;?></td>
            <th>Tanggal Receiving</th>
            <td>: <?=dateme($receiving_suplier->date_receiving);?></td>
        </tr>
        <tr>
            <th>No Po</th>
            <td>: <?=$receiving_suplier->no_po;?></td>
            <th>Suplier</th>
            <td>: <?=$receiving_suplier->nama_suplier;?></td>
        </tr>
        <tr>
            <th>Type Po</th>
            <td>: <?=$receiving_suplier->type_po;?></td>
            <th>No Telpon Suplier</th>
            <td>: <?=$receiving_suplier->no_telpon;?></td>
        </tr>
        <tr>
            <th>Tanggal Po</th>
            <td>: <?=dateme($receiving_suplier->date_po);?></td>
            <th>Tanggal Expired</th>
            <td>: <?=dateme($receiving_suplier->date_expired);?></td>
        </tr>
    </table>
      <table>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Jenis Barang</th>
          <th>Satuan Barang</th>
          <th>Unit of Measurement</th>
          <th>Stok Pesanan</th>
          <th>Harga Beli</th>
          <th>Total</th>
          <th>Keterangan Barang</th>
        </tr>
        <?php $total_harga = 0;?>
        <?php $no = 0; foreach($po_barang as $pb):$no+1; $no++;?>
            <?php
                $total = $pb->stok_pesanan * $pb->harga_beli;
                $total_harga += $total;
            ?>
        <tr>
            <td><?=$no;?>.</td>
            <td><?=$pb->nama_barang;?></td>
            <td><?=$pb->jenis_barang;?></td>
            <td><?=$pb->satuan_barang;?></td>
            <td><?=$pb->uom_order;?></td>
            <td><?=$pb->stok_pesanan;?></td>
            <td><?=rp($pb->harga_beli);?></td>
            <?php
                $total = $pb->stok_pesanan * $pb->harga_beli
            ;?>
            <td><?=rp($total);?></td>
            <td><?=$pb->keterangan_barang;?></td>
         <?php endforeach;?>
        </tr>
        <tr class="total">
          <td>Total Harga</td>
          <td colspan="6" style="text-align: right"><?=rp($total_harga);?></td>
        </tr>
      </table>
      <table id="table_hide">
        <tr>
          <th>Harga Normal</th>
          <td><?=rp($total_harga);?></td>
          <th>PPN</th>
          <td><?=$po_harga->ppn;?> % <span id="harga_ppn"></span></td>
        </tr>
        <tr>
          <th>Diskon</th>
          <td><?=$po_harga->diskon;?> % </td>
          <th>PPN BM</th>
          <td><?=$po_harga->ppn_bm;?> % <span id="harga_ppn_bm"></span></td>
        </tr>
        <tr>
          <th>Harga Diskon</th>
          <td><span id="harga_diskon"></span></td>
          <th>Jumlah Pembelian</th>
          <td><span id="jumlah_pembelian"></span></td>
        </tr>
      </table>
      <button id="printButton">Print</button>
    </div>

    <!-- input hidden -->
    <input type="hidden" id="harga_normal" value="<?=$total_harga;?>">
    <input type="hidden" id="diskon" value="<?=$po_harga->diskon;?>">
    <input type="hidden" id="ppn" value="<?=$po_harga->ppn;?>">
    <input type="hidden" id="ppn_bm" value="<?=$po_harga->ppn_bm;?>">


    <script src="<?=base_url();?>assets/js/jquery.js"></script>
    <script src="<?=base_url();?>assets/script/cetak.js"></script>
    <script>
      document
        .getElementById("printButton")
        .addEventListener("click", function () {
          window.print();
        });
    </script>
  </body>
</html>