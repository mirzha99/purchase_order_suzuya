class po extends core{
    type_po(){
        this.modal('Type Po','admin/po/add_type_po','Tambah','btn btn-primary');
        $('#id').val('');
        $('#type_po').val('');
    }
    edit_type_po(id){
        this.modal('Edit Type Po','admin/po/edit_type_po','Edit','btn btn-warning');
        $.ajax({
            url: this.url(`admin/po/id_type_po/${id}`),
            dataType : 'json',
            success: function(data){
                $('#id').val(data.id);
                $('#type_po').val(data.type_po);
            }
        })
    }
    delete_type_po(id){
        this.modal('Hapus Type Po','admin/po/delete_type_po','Hapus','btn btn-danger');
        $.ajax({
            url: this.url(`admin/po/id_type_po/${id}`),
            dataType : 'json',
            success: function(data){
                $('#id_del').val(data.id);
                $('.dels_type_po').html(data.type_po);
            }
        })
    }
    po(){
        this.modal('Purchase Order','admin/po/add_po','Tambah','btn btn-primary');
            $('#no_po').val('');
            $('#type_po').val('');
            $('#id_suplier').val('');
            $('#date_expired').val('');
    }
    edit_po(no_po){
        this.modal('Edit Purchase Order','admin/po/edit_po','Edit','btn btn-warning');
        $.ajax({
            url : this.url(`admin/po/id_po_edit/${no_po}`),
            dataType:'json',
            success: function(data){
                $('#no_po').val(data.no_po);
                $('#type_po').val(data.id_type);
                $('#id_suplier').val(data.id_suplier);
                $('#date_expired').val(data.date_expired);
            }
        })
    }
    del_po(no_po){
        this.modal('Hapus Purchase Order','admin/po/delete_po','Hapus','btn btn-danger');
        $.ajax({
            url: this.url(`admin/po/id_po_edit/${no_po}`),
            dataType: 'json',
            success: function(data){
                $('#del_no_po').val(data.no_po);
                $('.msg_del').html(`Apakah Anda Yakin Ingin Menghapus Purchase Order Dengan No <span class='text-danger'>${data.no_po}</span>`);
            }
        })
    }
    //po barang
    po_barang(){
        this.modal('Tambah Barang','admin/po/add_po_barang','Tambah','btn btn-primary');
        $('#id_barang').val('');
        $('#id_barang').prop('disabled',false);
        $('#stok_pesanan').val('');
    }
    edit_po_barang(id){
        this.modal('Edit Barang','admin/po/edit_po_barang','Edit','btn btn-warning');
        $.ajax({
            url:this.url(`admin/po/id_po_barang/${id}`),
            dataType : 'json',
            success: function(data){
                $('#id').val(data.id);
                $('.nama_barang').val(`${data.nama_barang}`);
                $('.nama_barang').prop('disabled',true);
                $('.stok_pesanan').val(data.stok_pesanan);
            }
        })
    }
    delete_po_barang(id){
        this.modal('Hapus Barang','admin/po/delete_po_barang','Hapus','btn btn-danger');
        $.ajax({
            url: this.url(`admin/po/id_po_barang/${id}`),
            dataType :'json',
            success: function (data){
                $('#id_del').val(data.id);
                $('.msg_del').html(`Apakah Anda Yakin Menghapus Data Barang <span class="text-danger">${data.nama_barang}</span> dengan Stok Pesanan <span class="text-danger">${data.stok_pesanan}</span>`)
            }
        })
    }
     //receiving
     edit_po_barang_s(id){
        this.modal('Edit Barang','suplier/po/edit_po_barang_suplier','Edit','btn btn-warning');
        $.ajax({
            url:this.url(`suplier/po/id_receiving_barang/${id}`),
            dataType : 'json',
            success: function(data){
                $('#id').val(data.id);
                $('.nama_barang').val(`${data.nama_barang}`);
                $('.nama_barang').prop('disabled',true);
                $('.stok_pesanan').prop('disabled',true);
                $('.stok_pesanan').val(data.stok_pesanan);
                $('.stok_barang_suplier').val(data.stok_tersedia);
            },error:function(err){
                console.log('not call');
            }
        })
    }
     edit_po_barang_c(id){
        this.modal('Edit Barang','checker/edit_barang_receiving','Edit','btn btn-warning');
        $.ajax({
            url:this.url(`checker/id_receiving_barang/${id}`),
            dataType : 'json',
            success: function(data){
                $('#id').val(data.id);
                $('.nama_barang').val(`${data.nama_barang}`);
                $('.nama_barang').prop('disabled',true);
                $('.stok_pesanan').prop('disabled',true);
                $('.stok_pesanan').val(data.stok_pesanan);
                $('.stok_barang_suplier').val(data.stok_tersedia);
                $('.keterangan_barang').val(data.keterangan_barang);
            },error:function(err){
                console.log('not call');
            }
        })
    }
    //modules
    rp(val){
        return `Rp. ${val.toLocaleString('id-ID',{minimumFractionDigits:2,maximumFractionDigits:2})}`;
    }
    harga_diskon(persendiskon,harga){
        var diskon = harga * (persendiskon / 100);
        var harga_diskon = harga - diskon;
        return harga_diskon;
    }
    hitungPPN(hargaBarang,ppn) {
        const tarifPPN = ppn; // Tarif PPN standar (misalnya 10%)
        const hasil_ppn = (hargaBarang * tarifPPN) / 100;
        return hasil_ppn;
    }
      
    hitungPPNBM(hargaBarang,ppn_bm) {
        const tarifPPNBM = ppn_bm; // Tarif PPN BM standar (misalnya 20%)
        const hasil_ppnBM = (hargaBarang * tarifPPNBM) / 100;
        return hasil_ppnBM;
    }
    po_harga(){
        var harga_normal = $('#harga_normal').val();
        var dikon = $('#diskon').val();
        var ppn = $('#ppn').val();
        var ppn_bm = $('#ppn_bm').val();
        //console.log(`harga normal = ${harga_normal}, diskon = ${dikon} , ppn =  ${ppn} ppn_bm =  ${ppn_bm}`);
        var harga_diskon = this.harga_diskon(dikon,harga_normal);
        var harga_ppn = this.hitungPPN(harga_diskon,ppn);
        var harga_ppn_bm = this.hitungPPNBM(harga_diskon,ppn_bm);
        var jumlah_pembelian = harga_diskon + harga_ppn + harga_ppn_bm;
        
        $('#harga_diskon').val(Po.rp(harga_diskon));
        $('#harga_diskon_hide').val(harga_diskon);
        $('#ppn_harga').val(this.rp(harga_ppn));
        $('#ppn_bm_harga').val(this.rp(harga_ppn_bm));
        $('#jumlah_pembelian').val(this.rp(jumlah_pembelian));
        $('#jumlah_pembelians').val(jumlah_pembelian);
    }
}
var Po = new po();

$('#diskon').change(function (){
    var diskon = $(this).val();
    if(diskon > 100){
        alert('diskon tidak boleh melebih 100');
    }else{
        var harga_normal = $('#harga_normal').val();
        var harga_diskon = Po.harga_diskon(diskon,harga_normal);
        $('#harga_diskon').val(Po.rp(harga_diskon));
        $('#harga_diskon_hide').val(harga_diskon);

        var ppn = $('#ppn').val();
        var hasil_ppn = Po.hitungPPN(harga_diskon,ppn);
        $('#ppn_harga').val(Po.rp(hasil_ppn));
        $('#ppn_harga_hide').val(hasil_ppn);

        var ppn_bm = $('#ppn_bm').val();
        var hasil_ppn_bm = Po.hitungPPNBM(harga_diskon,ppn_bm);
        $('#ppn_bm_harga').val(Po.rp(hasil_ppn_bm));
        $('#ppn_bm_harga_hide').val(hasil_ppn_bm);

        var jumlah_pembelian = harga_diskon + hasil_ppn + hasil_ppn_bm;

        $('#jumlah_pembelian').val(Po.rp(jumlah_pembelian));
        $('#jumlah_pembelians').val(jumlah_pembelian);
    }
});
$('#ppn').change(function (){
    var ppn = $(this).val();
    var harga_diskon = Po.harga_diskon($('#diskon').val(),$('#harga_normal').val());
    var hasil_ppn = Po.hitungPPN(harga_diskon,ppn);
    $('#ppn_harga').val(Po.rp(hasil_ppn));
    $('#ppn_harga_hide').val(hasil_ppn);

    var ppn_bm = $('#ppn_bm').val();
    var hasil_ppn_bm = Po.hitungPPNBM(harga_diskon,ppn_bm);
    $('#ppn_bm_harga').val(Po.rp(hasil_ppn_bm));
    $('#ppn_bm_harga_hide').val(hasil_ppn_bm);

    var jumlah_pembelian = harga_diskon + hasil_ppn + hasil_ppn_bm;
     $('#jumlah_pembelian').val(Po.rp(jumlah_pembelian));
     $('#jumlah_pembelians').val(jumlah_pembelian);
});
$('#ppn_bm').change(function (){
    var ppn = $('#ppn').val();
    var harga_diskon = Po.harga_diskon($('#diskon').val(),$('#harga_normal').val());
    var hasil_ppn = Po.hitungPPN(harga_diskon,ppn);
    $('#ppn_harga').val(Po.rp(hasil_ppn));
    $('#ppn_harga_hide').val(hasil_ppn);

    var ppn_bm = $(this).val();
    var harga_diskon = Po.harga_diskon($('#diskon').val(),$('#harga_normal').val());
    var hasil_ppn_bm = Po.hitungPPNBM(harga_diskon,ppn_bm);
    $('#ppn_bm_harga').val(Po.rp(hasil_ppn_bm));
    $('#ppn_bm_harga_hide').val(hasil_ppn_bm);

    var jumlah_pembelian = harga_diskon + hasil_ppn + hasil_ppn_bm;
     $('#jumlah_pembelian').val(Po.rp(jumlah_pembelian));
     $('#jumlah_pembelians').val(jumlah_pembelian);
});
Po.po_harga();
