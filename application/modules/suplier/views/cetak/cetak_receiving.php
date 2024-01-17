<!DOCTYPE html>
<html>
  <head>
    <title>Cetak Receiving</title>
    <link rel="shortcut icon" type="image/png" href="<?=base_url();?>assets/imgs/favicon.png"/>
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
        max-width: 1000px;
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
    <img src="<?=base_url();?>assets/imgs/logo.png" class="center" alt="">
          <h4 style="text-align:center;">H838+RXP, Kp. Baru, Kec. Baiturrahman, Kota Banda Aceh, Aceh</h4>
      <hr>
      <h1>Receiving Order</h1>
      <h3 style="text-align: center">Receiving Semua Priode</h3>
      <table id="table_hide">
            <tr>
                <th>Nama Suplier <span>: <?=$suplier->nama_suplier;?></span></th>
            </tr>
            <tr>
                <th>Alamat Suplier <span>: <?=$suplier->alamat;?></span></th>
            </tr>
            <tr>
                <th>No Telpon Suplier <span>: <?=$suplier->no_telpon;?></span></th>
            </tr>
      </table>
      <table>
        <tr>
            <th>No</th>
            <th>No Receiving</th>
            <th>No PO</th>
            <th>Tanggal Receiving</th>
            <th>Status Laporan</th>
            <th>Jumlah Pembelian</th>
        </tr>
        <?php $total_harga = 0;?>
        <?php $no = 0; foreach($receiving as $rc):$no+1; $no++;?>
        <tr>
            <td><?=$no;?>.</td>
            <td><?=$rc->no_receiving;?></td>
            <td><?=$rc->no_po;?></td>
            <td><?=dateme($rc->date_receiving);?></td>
            <td><?=$rc->status_laporan;?></td>
            <?php 
                $rc_barang = $this->receiving->receiving_sup_barang($rc->no_po);
                $total = 0;
                foreach($rc_barang as $d){
                $harga_normal = $d->stok_pesanan * $d->harga_beli;
                //po_harga
                $diskon = $this->receiving->po_harga($d->no_po)->diskon;
                $ppn = $this->receiving->po_harga($d->no_po)->ppn;
                $ppn_bm = $this->receiving->po_harga($d->no_po)->ppn_bm;
                //rumus
                $harga_diskon = $harga_normal * ($diskon / 100);
                $harga_diskons = $harga_normal - $harga_diskon;
                $tarifppn = ($harga_diskons * $ppn) / 100;
                $tarifppn_bm = ($harga_diskons * $ppn_bm) / 100;
                //hasil
                $total += $harga_diskons + $tarifppn + $tarifppn_bm;
                }
            ;?>
            <td><?=rp($total);?></td>
         <?php endforeach;?>
        </tr>
      </table>
  
      <button id="printButton">Print</button>
    </div>
    <script>
      document
        .getElementById("printButton")
        .addEventListener("click", function () {
          window.print();
        });
    </script>
  </body>
</html>