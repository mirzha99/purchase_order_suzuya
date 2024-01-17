<!DOCTYPE html>
<html>
<head>
  <title><?=$title;?></title>
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
    .row {
      display: flex; /* Menggunakan flexbox untuk tata letak (layout) baris */
      justify-content: space-between; /* Membuat jarak di antara kolom */
      background-color: transparent; /* Warna latar belakang */
      margin-bottom: 50px; /* Jarak di bawah setiap baris */
      padding: 5px; /* Jarak dalam kolom */
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="<?=base_url();?>assets/imgs/logo.png" class="center" alt="">
        <h4 style="text-align:center;">H838+RXP, Kp. Baru, Kec. Baiturrahman, Kota Banda Aceh, Aceh</h4>
    <hr>
    <h1>RECEIVING ORDER SUPLIER</h1>
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
      <tr>
        <?php $total_harga = 0; $no = 0;foreach($po_barang as $rb):$no+1; $no++;?>
      </tr>
          <td><?=$no;?>.</td>
          <td><?=$rb->nama_barang;?></td>
          <td><?=$rb->jenis_barang;?></td>
          <td><?=$rb->satuan_barang;?></td>
          <td><?=$rb->uom_order;?></td>
          <td><?=$rb->stok_pesanan;?></td>
          <td><?=rp($rb->harga_beli);?></td>
          <?php 
                $total = $rb->stok_pesanan * $rb->harga_beli;
                $total_harga +=$total;
          ?>
          <td><?=rp($total);?></td>
          <td><?=$rb->keterangan_barang;?></td>
        <?php endforeach;?>
      <tr class="total">
        <td colspan="7">Total Harga</td>
        <td colspan="2"><?=rp($total_harga);?></td>
      </tr>
    </table>
    <table id="table_hide">
      <tr>
        <th>Harga Normal</th>
        <td><?=rp($total_harga);?></td>
        <th>PPN</th>
        <td><span id="harga_ppn"></span> (<?=$po_harga->ppn;?> %)</td>
      </tr>
      <tr>
        <th>Diskon</th>
        <td><?=$po_harga->diskon;?> % </td>
        <th>PPN BM</th>
        <td><span id="harga_ppn_bm"></span> (<?=$po_harga->ppn_bm;?> %)</td>
      </tr>
      <tr>
        <th>Harga Diskon</th>
        <td><span id="harga_diskon"></span></td>
        <th>Jumlah Pembelian</th>
        <td><span id="jumlah_pembelian"></span></td>
      </tr>
    </table>
    <!-- mengetahui checker -->
        <table id="table_hide">
          <tr class="row">
            <th></th>
            <th>Mengetahui Suplier<br> Banda Aceh, <?=date('d-m-Y');?></th>  
          </tr>
          <tr class ="row">
            <td></td>
            <td><?=$receiving_suplier->nama_suplier;?></td>
          </tr>
        </table>
  
   <!-- end mengetahui checker -->
    <button id="printButton">Print</button>
  </div>

  <!-- input hidden -->
  <input type="hidden" id="harga_normal" value="<?=$total_harga;?>">
  <input type="hidden" id="diskon" value="<?=$po_harga->diskon;?>">
  <input type="hidden" id="ppn" value="<?=$po_harga->ppn;?>">
  <input type="hidden" id="ppn_bm" value="<?=$po_harga->ppn_bm;?>">
  <script src="<?=base_url();?>/assets/js/jquery.js"></script>
  <script src="<?=base_url();?>/assets/script/cetak.js"></script>
  <script>
    document
      .getElementById("printButton")
      .addEventListener("click", function () {
        window.print();
      });
  </script>
</body>
</html>